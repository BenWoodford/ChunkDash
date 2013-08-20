<?php

require_once("wunderlist/api.class.php");
require_once("wunderlist/api.files.class.php");

class Task {
	static function stub() {
		echo "Please use /api/tasks/list";
	}

	static $wunderlist;

	static function initWunderlist() {
		try {
			Task::$wunderlist = new Wunderlist(WLUSER, WLPASS);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	static function getTasks() {
		Task::initWunderlist();

		try {
			$tasks = Task::$wunderlist->getTasksByList("WLLIST", true);
			return $tasks;
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}

?>