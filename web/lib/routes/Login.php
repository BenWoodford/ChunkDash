<?php
class Login {
	public static function stub() {
		if(isset($_SERVER['REMOTE_USER']) && strlen($_SERVER['REMOTE_USER'] > 1))
			getRoute()->redirect('/', 307);
		else
			getTemplate()->display("login.php", array('referrer' => (isset($_GET['modopenid.referrer']) ? $_GET['modopenid.referrer'] : "http://dashboard.loadingchunks.net/")));
	}
}
?>