<?php

class Notifications extends Router {
	public static function stub($page = 1) {
		parent::start();

		getTemplate()->display('notifications.php', array('page' => $page));

		parent::end('<script src="/skin/static/js/pages/notifications/notifications.js"');
	}
}

?>