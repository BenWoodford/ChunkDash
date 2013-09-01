<?php

class Metrics extends Router {
	public static function stub() {
		parent::start("metrics");

		getTemplate()->display('metrics.php', array('today' => date("d/m/Y"), 'yesterday' => date("d/m/Y", strtotime("yesterday"))));

		parent::end(array('/skin/static/js/pages/metrics/metrics.js'));
	}
}