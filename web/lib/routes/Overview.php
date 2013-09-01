<?php

class Overview extends Router {
	public static function stub() {
		parent::start("overview");

		getTemplate()->display('overview.php');

		parent::end();
	}
}