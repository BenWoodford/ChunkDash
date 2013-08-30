<?php
class Router {
	public static function start($active_tab = "") {
		getTemplate()->display('header.php', array('name' => (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] : "anonymous@loadingchunks.net"), 'active' => $active_tab));
	}

	public static function end($footer_include = array()) {
		$params = array();

		$footer_include_parsed = "";

		foreach($footer_include as $f) {
			$footer_include_parsed .= "\t" . '<script type="text/javascript" src="' . $f . '"></script>' . "\n";
		}

		if(count($footer_include) > 0)
			$params['footer_include'] = $footer_include_parsed;


		getTemplate()->display('footer.php', $params);
	}
}