<?php

class Notification {
	public static function stub() {
		echo "Please use /api/notifications/list";
	}

	public static function getNotificationsFull($page = 0, $perpage = 25) {
		$page = @intval($page);
		$perpage = @intval($perpage);

		$notifications = getDatabase()->all("SELECT * FROM `notifications` ORDER BY `notification_id` DESC LIMIT " . $page . "," . $perpage);

		foreach($notifications as $k=>$n) {
			$notifications[$k]['ago'] = ago($n['time']);
		}

		return $notifications;
	}

	public static function getNotificationsMini($user = null) {
		$user = $user . "@loadingchunks.net";
		$notifications = getDatabase()->all("SELECT * FROM `notifications` ORDER BY `notification_id` DESC LIMIT 10");

		foreach($notifications as $k=>$n) {
			$notifications[$k]['ago'] = ago($n['time']);

			if($user != null) {
				$seen = getDatabase()->one("SELECT COUNT(*) as seen FROM `notifications_seen` WHERE `user` = :user AND `notification_id` = :id LIMIT 1", array(':user' => $user, ':id' => $n['notification_id']));
				if($seen['seen'] > 0) {
					$notifications[$k]['seen'] = true;
				} else {
					$notifications[$k]['seen'] = false;
					getDatabase()->execute("INSERT INTO `notifications_seen` (`notification_id`,`user`) VALUES (:id, :user)", array(':id' => $n['notification_id'], ':user' => $user));
				}
			}
		}
		return $notifications;
	}
}