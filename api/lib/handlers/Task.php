<?php

require_once("../lib/wunderlist/api.class.php");
require_once("../lib/wunderlist/api.files.class.php");

class Task {
	static function stub() {
		echo "Please use /api/tasks/list";
	}

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
			$tasks = $wunderlist->getTasksByList("lwf0b5f1136ea4ec6dada98412620e24", true);
			return $tasks;
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}

?>