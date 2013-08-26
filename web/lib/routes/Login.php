<?php
class Login {
	public static function stub() {
		getTemplate()->display("login.php", array('referrer' => $_GET['modopenid.referrer']));
	}
}
?>