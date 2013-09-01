<?php
function ago($time, $plural = false, $suffix = "")
{
	$periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");

	$now = time();

	$difference = $now - $time;
	$tense = "ago";

	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if($difference == 1) {
		switch($j) {
			case 3:
				return "yesterday";
				break;
			case 4:
				return "last week";
				break;
			case 5:
				return "last month";
				break;
			case 6:
				return "last year";
				break;
		}
	}

	if($difference > 1 && $plural) {
		$suffix = "s" . $suffix;
	}

	return $difference . " " . $periods[$j] . $suffix;
}

function formatDateGrouping($x_unit, $col = "timestamp") {
	switch($x_unit) {
		case 'month':
			return "GROUP BY MONTH(FROM_UNIXTIME(`" . $col . "`))";
			break;
		case 'week':
			return "GROUP BY WEEK(FROM_UNIXTIME(`" . $col . "`))";
			break;
		case 'day':
			return "GROUP BY DAY(FROM_UNIXTIME(`" . $col . "`))";
			break;
		case 'hour':
			return "GROUP BY HOUR(FROM_UNIXTIME(`" . $col . "`))";
			break;
	}
}

function orderOfMagnitude($n) {
	return pow(10,floor(log10($n)));
}
?>