<?php

class User {

	public static function stub() {
		echo "Please use /api/user/<username>/";
	}

	public static function getOwnedRegions($user) {
		return getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, owners)", array(':user', $user));
	}

	public static function getMembershipRegions($user) {
		return getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, members)", array(':user', $user));
	}
}

?>