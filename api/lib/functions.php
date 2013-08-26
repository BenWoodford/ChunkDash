<?php
function ago($time)
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

	return "$difference $periods[$j]";
}
?>