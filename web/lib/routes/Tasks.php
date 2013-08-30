<?php

class Tasks extends Router {
	public static function stub() {
		parent::start();

		getTemplate()->display('tasks.php');

		parent::end(array('/skin/static/js/pages/tasks/tasks.js'));
	}
}

?>