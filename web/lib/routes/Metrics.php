<?php

class Metrics extends Router {
	public static function stub() {
		parent::start("metrics");

		getTemplate()->display('metrics.php', array('today' => date("M D, Y h:mm A"), 'yesterday' => date("M D, Y h:mm A", strtotime("yesterday"))));

		parent::end(array('/skin/static/js/pages/metrics/metrics.js'));
	}
}