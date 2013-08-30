<?php

class Notifications extends Router {
	public static function stub($page = 1) {
		parent::start("notifications");

		getTemplate()->display('notifications.php', array('page' => $page));

		parent::end(array('/skin/static/js/pages/notifications/notifications.js'));
	}
}

?>