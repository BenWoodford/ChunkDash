<?php

class Notification {
	public static function getNotificationsFull($page = 0, $perpage = 25) {
		$page = @intval($page);
		$perpage = @intval($perpage);

		return getDatabase()->all("SELECT * FROM `notifications` ORDER BY `id` DESC LIMIT " . $page . "," . $perpage);
	}

	public static function getNotificationsMini($user = null) {
		$notifications = getDatabase()->all("SELECT `id`,`title`,`text`,`level`,`type` FROM `notifications` ORDER BY `id` DESC LIMTI 10");

		foreach($notifications as $k=>$n) {
			$seen = getDatabase()->one("SELECT COUNT(*) as seen FROM `notifications_seen` WHERE `user` = :user LIMIT 1", array(':user' => $user));
			if($seen['seen'] > 0) {
				$notifications[$k]['seen'] = true;
			} else {
				$notifications[$k]['seen'] = false;
				getDatabase()->execute("INSERT INTO `notifications_seen` (`id`,`user`) VALUES (:id, :user)", array(':id' => $n['id'], ':user' => $user));
			}
		}

		return $notifications;
	}
}