<?php

class User {

	public static function stub() {
		echo "Please use /api/user/<username>/";
	}

	public static function getUser($user) {
		$arr = array(
			'name' => $user,
			'region' => array(
				'owned' => User::getOwnedRegions($user),
				'member' => User::getMembershipRegions($user),
			),
		);

		return $arr;
	}

	public static function getRegions($user) {
		return getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, owners) OR FIND_IN_SET(:user, members)", array(':user' => $user));
	}

	public static function getOwnedRegions($user) {
		return getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, owners)", array(':user' => $user));
	}

	public static function getMembershipRegions($user) {
		return getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, members)", array(':user' => $user));
	}
}

?>