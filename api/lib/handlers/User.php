<?php

class User {

	public static function stub() {
		echo "Please use /api/user/<username>/";
	}

	public static function getUser($user) {
		$arr = array(
			'name' => $user,
			'regions' => array(
				'owned' => User::getOwnedRegions($user),
				'member' => User::getMembershipRegions($user),
			),
		);

		return $arr;
	}

	public static function regionFormat($arr) {
		if(array_key_exists('flags', $arr))
			$arr['flags'] = unserialize($arr['flags']);

		if(array_key_exists('owners', $arr))
			$arr['owners'] = explode(",", $arr['owners']);

		if(array_key_exists('members', $arr))
			$arr['members'] = explode(",", $arr['members']);

		return $arr;
	}

	public static function getRegions($user) {
		return array_map(array("User", "regionFormat"), getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, owners) OR FIND_IN_SET(:user, members)", array(':user' => $user)));
	}

	public static function getOwnedRegions($user) {
		return array_map(array("User", "regionFormat"), getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, owners)", array(':user' => $user)));
	}

	public static function getMembershipRegions($user) {
		return array_map(array("User", "regionFormat"), getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, members)", array(':user' => $user)));
	}
}

?>