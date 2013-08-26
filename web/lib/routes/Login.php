<?php
class Login {
	public static function stub() {
		getTemplate()->display("login.php", array('referrer' => (isset($_GET['modopenid.referrer']) ? $_GET['modopenid.referrer'] : "http://dashboard.loadingchunks.net/")));
	}
}
?>