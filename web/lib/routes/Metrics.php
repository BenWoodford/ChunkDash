<?php

class Metrics extends Router {
	public static function stub() {
		parent::start("metrics");

		getTemplate()->display('metrics.php');

		parent::end();
	}
}