<?php

class Graph {
	static function stub() {
		return array('response' => 'error', 'message' => 'POST only.');
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
				'y' => array('min' => null,'max' => null),
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

			$wherestring .= " `metric` = '" . $split[1] . "_" . $metric . "' AND `timestamp` BETWEEN " . $ret['start'] . " AND " . $ret['end'];
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
			}

			$ret['sql'][] = $sql = "SELECT `server`,`world`,`timestamp`,`metric`" . $additionals . " FROM `world_usage` " . $wherestring . " " . $groupstring . " ORDER BY `timestamp` ASC";

			$points = array();

			$dbret = getDatabase()->all($sql);

			foreach($dbret as $res) {
				$points[$res['timestamp']] = $res['point'];
			}

			$data = array(
				'label' => $split[1] . " - " . $metric,
				'data' => $points,
			);

			foreach($data['data'] as $d) {
				if($d['point'] > $ret['axis']['y']['max'] || $ret['axis']['y']['max'] == null) {
					$ret['axis']['y']['max'] = $d['point'];
				}

				if($d['point'] < $ret['axis']['y']['min'] || $ret['axis']['y']['min'] == null) {
					$ret['axis']['y']['min'] = $d['point'];
				}


				if($d['timestamp'] > $ret['axis']['x']['max'] || $ret['axis']['x']['max'] == null) {
					$ret['axis']['x']['max'] = $d['timestamp'];
				}

				if($d['timestamp'] < $ret['axis']['x']['min'] || $ret['axis']['x']['min'] == null) {
					$ret['axis']['x']['min'] = $d['timestamp'];
				}
			}

			$ret['series'][] = $data;
		}
		return $ret;
	}
}

?>