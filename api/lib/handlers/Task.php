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
			return array(
				'response' => 'error',
				'message' => $e->getMessage(),
				'user_login' => WLUSER,
			);
		}
	}

	static function getTasks() {
		$response = Task::initWunderlist();
		if(is_array($response))
			return $response;

		try {
			$tasks = Task::$wunderlist->getTasksByList(WLLIST, true);
			return $tasks;
		} catch(Exception $e) {
			return array(
				'response' => 'error',
				'message' => $->getMessage(),
				'list_id' => WLLIST,
			);
		}
	}
}

?>