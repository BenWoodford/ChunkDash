<?php

class Graph {
	static function stub() {
		return array('response' => 'error', 'message' => 'POST only.');
	}

	static function getSocial($timeframe) {
		$ret = array(
			'start' => strtotime("-1 " . $timeframe),
			'end' => time(),
			'twitter' => array(
				'tweets' => array(),
				'followers' => array()
			),
			'facebook' => array(
				'likes' => array(),
			),
			'axis' => array(
				'y' => array('min' => null, 'max' => null),
			)
		);

		$sql = "SELECT *,AVG(`value`) as `point` FROM `world_usage` WHERE `server` = 'socialmedia' AND `timestamp` BETWEEN " . $ret['start'] . " AND " . $ret['end'];

		if($timeframe == 'year') {
			$sql .= " GROUP BY MONTH(FROM_UNIXTIME(`timestamp`))";
		} else {
			$sql .= " GROUP BY DAY(FROM_UNIXTIME(`timestamp`))";
		}

		$sql .= ",`world`,`metric`";

		$rows = getDatabase()->all($sql);

		foreach($rows as $row) {
			$ret[$row['world']][$row['metric']][] = array($row['timestamp'] * 1000, $row['value']);

			if($row['value'] > $ret['axis']['y']['max'] || $ret['axis']['y']['max'] == null) {
				$ret['axis']['y']['max'] = $row['value'];
			}
		}

		$ret['axis']['y']['max'] += orderOfMagnitude($ret['axis']['y']['max']);

		return $ret;
	}

	static function postMetrics() {
		$ret = array(
			'start' => strtotime($_POST['start']),
			'end' => strtotime($_POST['end']),
			'series' => array(),
			'given' => $_POST,
			'sql' => array(),
			'axis' => array(
				'x' => array('min' => null, 'max' => null, 'unit' => $_POST['x_unit']),
				'y' => array('min' => 0,'max' => null),
			),
		);

		foreach($_POST['metrics'] as $met) {
			$split = explode("_", $met);

			$finish = false;

			foreach($split as $check) {
				if(!ctype_alnum($check))
					$finish = true;

			}

			if($finish)
				continue;

			$groupstring = "";
			$wherestring = "WHERE ";

			if($split['0'] != "all") {
				$wherestring .= "`server` = '" . $split[0] . "' AND ";
			}

			$groupstring .= formatDateGrouping($_POST['x_unit']);

			$metric = "";

			if(count($split) == 4) {
				$wherestring .="`world` = '" . str_replace("-", "_", $split[2]) . "' AND ";
				$metric = $split[3];
			} else {
				$metric = $split[2];
			}

			if($split['0'] == 'socialmedia') {
				$wherestring .= " `world` = '" . $split[1] . "' AND `metric` = '" . $metric;
			} else {
				$wherestring .= " `metric` = '" . $split[1] . "_" . $metric;
			}

			$wherestring .= "' AND `timestamp` BETWEEN " . $ret['start'] . " AND " . $ret['end'];
			$additionals = "";

			switch($metric) {
				case 'avg':
					$additionals .= ",AVG(`value`) as point";
					break;

				case 'max':
					$additionals .= ",MAX(`value`) as point";
					break;

				case 'min':
					$additionals .= ",MIN(`value`) as point";
					break;

				default:
					$additionals .= ",`value` as point";
					break;
			}

			$ret['sql'][] = $sql = "SELECT `server`,`world`,`timestamp`,`metric`" . $additionals . " FROM `world_usage` " . $wherestring . " " . $groupstring . " ORDER BY `timestamp` ASC";

			$points = array();

			$dbret = getDatabase()->all($sql);

			foreach($dbret as $res) {
				$points[] = array(@intval($res['timestamp'])*1000, @floatval($res['point']));
			}

			$data = array(
				'label' => $split[0] . " - " . $split[1] . " - " . $metric,
				'data' => $points,
			);

			foreach($data['data'] as $parr) {
				$point = $parr[1];
				$timestamp = $parr[0];

				if($point > $ret['axis']['y']['max'] || $ret['axis']['y']['max'] == null) {
					$ret['axis']['y']['max'] = $point;
				}

				/*if($point < $ret['axis']['y']['min'] || $ret['axis']['y']['min'] == null) {
					$ret['axis']['y']['min'] = $point;
				}*/


				if($timestamp > $ret['axis']['x']['max'] || $ret['axis']['x']['max'] == null) {
					$ret['axis']['x']['max'] = $timestamp;
				}

				if($timestamp < $ret['axis']['x']['min'] || $ret['axis']['x']['min'] == null) {
					$ret['axis']['x']['min'] = $timestamp;
				}
			}

			if(count($data['data']) > 0)
				$ret['series'][] = $data;
		}

 		$ret['axis']['y']['max'] += orderOfMagnitude($ret['axis']['y']['max']);

		return $ret;
	}
}

?>