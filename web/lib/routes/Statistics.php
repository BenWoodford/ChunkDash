<?php

class Statistics extends Router {
	public static function stub($server = "all") {
		parent::start("statistics");

		getTemplate()->display('statistics.php', array('server' => $server));

		parent::end();
	}
}