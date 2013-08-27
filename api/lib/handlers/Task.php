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
			$tasks = @Task::$wunderlist->getTasksByList(WLLIST, true);
			$format = "F j, Y";
			foreach($tasks as $k=>$t['tasks']) {
				$tasks['tasks'][$k]['created_readable'] = (isset($t['created_at']) ? date($format, strtotime($t['created_at'])) : null);
				$tasks['tasks'][$k]['created_ago'] = (isset($t['created_at']) ? ago(strtotime($t['created_at'])) : null);

				$tasks['tasks'][$k]['due_readable'] = (isset($t['due_date']) ? date($format, strtotime($t['due_date'])) : null);
				$tasks['tasks'][$k]['deleted_readable'] = (isset($t['deleted_at']) ? date($format, strtotime($t['deleted_at'])) : null);
				$tasks['tasks'][$k]['completed_readable'] = (isset($t['completed_at']) ? date($format, strtotime($t['completed_at'])) : null);
				$tasks['tasks'][$k]['updated_readable'] = (isset($t['updated_at']) ? date($format, strtotime($t['updated_at'])) : null);
			}

			return $tasks;
		} catch(Exception $e) {
			return array(
				'response' => 'error',
				'message' => $e->getMessage(),
				'list_id' => WLLIST,
			);
		}
	}
}

?>