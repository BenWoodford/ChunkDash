<?php

class Metrics extends Router {
	public static function stub() {
		parent::start("metrics");

		getTemplate()->display('metrics.php', array('today' => date("M j, Y h:m A"), 'yesterday' => date("M j, Y h:m A", strtotime("yesterday"))));

		parent::end(array('/skin/static/js/pages/metrics/metrics.js'));
	}
}