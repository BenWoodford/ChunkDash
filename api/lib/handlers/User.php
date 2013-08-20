<?php

class User {

	public static function stub() {
		echo "Please use /api/user/<username>/";
	}

	public static function getUser($user) {
		$arr = array(
			'name' => $user,
			'basic_data' => User::getBasicInfo($user),
			'response' => 'success',
			'regions' => array(
				'owned' => User::getOwnedRegions($user),
				'member' => User::getMembershipRegions($user),
			),
		);

		if(count($arr['basic_data']) == 0) {
			// No essentials data? Must not be a user.
			$arr = array(
				'name' => $user,
				'response' => "error",
				'error' => "User " . $user . " not found in the database!",
			);
		}

		return $arr;
	}

	public static function getBasicInfo($user) {
		$userdatums = getDatabase()->all("SELECT * FROM `basic` WHERE `name` = :user", array(':user' => $user));

		$arr = array();

		foreach($userdatums as $data) {
			$serv = $data['server'];
			$data['homes'] = unserialize($data['homes']);
			unset($data['server']);
			unset($data['name']);
			$arr[$serv] = $data;
		}

		return $arr;
	}

	public static function regionFormat($arr) {
		if(array_key_exists('flags', $arr)) {
			$arr['flags'] = unserialize($arr['flags']);
			if($arr['flags'] == false)
				$arr['flags'] = array();
		}

		if(array_key_exists('owners', $arr)) {
			$arr['owners'] = explode(",", $arr['owners']);
			if(count($arr['owners']) == 1 && $arr['owners'][0] == "")
				$arr['owners'] = array();
		}

		if(array_key_exists('members', $arr)) {
			$arr['members'] = explode(",", $arr['members']);
			if(count($arr['members']) == 1 && $arr['members'][0] == "")
				$arr['members'] = array();
		}

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

	public static function getShopPlots($user) {
		return array_map(array("User", "regionFormat"), getDatabase()->all("SELECT * FROM `regions` WHERE FIND_IN_SET(:user, owners) AND `id` LIKE 'plot_%'", array(':user' => $user)));
	}

	public static function getUserList($page = 0, $perpage = 25) {
		$page = @intval($page);
		$perpage = @intval($perpage);

		$userdatums = getDatabase()->all("SELECT * FROM `basic` ORDER BY `name` ASC LIMIT " . $page . "," . $perpage);

		$arr = array();

		foreach($userdatums as $data) {
			$serv = $data['server'];
			$data['homes'] = unserialize($data['homes']);
			unset($data['server']);

			$name = $data['name'];
			unset($data['name']);

			if(!is_array($data['name']))
				$data['name'] = array();

			$arr[$name][$serv] = $data;
		}

		return $arr;
	}

	public static function getFilteredUserList($page = 0, $perpage = 25) {
		$page = @intval($page);
		$perpage = @intval($perpage);

		$userdatums = getDatabase()->all("SELECT * FROM `basic` ORDER BY `name` ASC LIMIT " . $page . "," . $perpage);

		$arr = array();

		foreach($userdatums as $data) {
			$serv = $data['server'];
			$data['homes'] = unserialize($data['homes']);
			unset($data['server']);

			$name = $data['name'];
			unset($data['name']);

			if(!is_array($data['name']))
				$data['name'] = array();

			$arr[$name][$serv] = $data;
		}

		return $arr;
	}
}

?>