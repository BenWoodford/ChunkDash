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
			'axis' => array('min'=>null,'max'=>null),
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

			$data = array(
				'label' => $split[1] . " - " . $metric,
				'data' => getDatabase()->all($sql),
			);

			foreach($data['data'] as $d) {
				if($d['point'] > $ret['axis']['max'] || $ret['axis']['max'] == null) {
					$ret['axis']['max'] = $d['point'];
				}

				if($d['point'] < $ret['axis']['min'] || $ret['axis']['min'] == null) {
					$ret['axis']['min'] = $d['point'];
				}
			}

			$ret['series'][] = $data;
		}
		return $ret;
	}
}

?>