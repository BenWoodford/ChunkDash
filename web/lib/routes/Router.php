<?php
class Router {
	public static function start() {
		getTemplate()->display('header.php', array('name' => (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] : "anonymous@loadingchunks.net")));
	}

	public static function end($footer_include = null) {
		$params = array();

		if($footer_include != null)
			$params['footer_include'] = $footer_include;


		getTemplate()->display('footer.php', $params);
	}
}