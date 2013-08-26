<?php
class Router {
	public static function start() {
		getTemplate()->display('header.php', array('name' => (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] : "anonymous@loadingchunks.net")));
	}

	public static function end() {
		getTemplate()->display('footer.php');
	}
}