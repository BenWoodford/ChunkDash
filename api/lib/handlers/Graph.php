<?php

class Graph {
	static function stub() {
		return array('response' => 'error', 'message' => 'POST only.');
	}

	static function postMetrics() {
		$ret = array(
			'start' => strtotime($_POST['start']),
			'end' => strtotime($_POST['end']),
			'data' => array(),
		);

		foreach($_POST['metrics'] as $met) {
			$split = explode("_", $met);

			$finish = false;

			foreach($split as $check) {
				if(ctype_alnum($check))
					$finish = true;

			}

			if($finish)
				continue;

			$groupstring = "GROUP BY ";
			$wherestring = "WHERE ";

			if($split['0'] != "all") {
				$wherestring .= "`server` = '" . $split[0] . "' AND ";
			}

			$groupstring .= formatDateGrouping($_POST['x_unit']) . ",";

			$metric = "";

			if(count($split) == 4) {
				$wherestring .="`world` = '" . $split[2] . "' AND ";
				$metric = $split[3];
			} else {
				$metric = $split[2];
			}

			$wherestring .= " `metric` = ':value_:metric' AND `timestamp` BETWEEN " . $ret['start'] . " AND " . $ret['end'];
			$additionals = "";

			switch($metric) {
				case 'avg':
					$additionals .= "AVG(`value`)";
					break;

				case 'peak':
					$additionals .= "MAX(`value`)";
					break;
			}

			$ret['data'][] = "SELECT *" . $additionals . " FROM `world_usage` " . $groupstring . " " . $wherestring . " ORDER BY `timestamp` ASC";
		}
		return $ret;
	}
}

?>