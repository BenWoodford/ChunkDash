<?php

class Metrics extends Router {
	public static function stub() {
		parent::start("overview");

		getTemplate()->display('overview.php', array('page' => $page));

		parent::end();
	}
}