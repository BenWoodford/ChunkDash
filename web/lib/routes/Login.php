<?php
class Login {
	public static function stub() {
		if(isset($_SERVER['REMOTE_USER']) && strlen($_SERVER['REMOTE_USER'] > 1))
			var_dump($_SERVER);
		else
			getTemplate()->display("login.php", array('referrer' => (isset($_GET['modauthopenid.referrer']) ? $_GET['modauthopenid.referrer'] : "http://dashboard.loadingchunks.net/")));
	}
}
?>