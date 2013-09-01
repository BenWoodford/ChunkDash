<?php

class Metrics extends Router {
	public static function stub() {
		parent::start("metrics");

		getTemplate()->display('metrics.php', array('today' => date("MM D, YYYY h:mm A"), 'yesterday' => date("MM D, YYYY h:mm A", strtotime("yesterday"))));

		parent::end(array('/skin/static/js/pages/metrics/metrics.js'));
	}
}