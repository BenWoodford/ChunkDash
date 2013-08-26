<?php
require_once("../../inc/config.php");

function autoloader($class) {
    if(!is_dir("lib/cache/"))
        mkdir("lib/cache/");

    if(!file_exists("lib/cache/autoload.cache"))
        file_put_contents("lib/cache/autoload.cache", "");

    $dirs = file_get_contents("lib/cfg/autoload.cfg");
    $cache = @file_get_contents("lib/cache/autoload.cache");

    if(!empty($cache))
    {
        $json = json_decode($cache, true);
        if(array_key_exists($class, $json))
        {
            require_once($json[$class]);
            return;
        }
    } else {
        $json = array();
    }

    foreach(explode("\n", $dirs) as $d)
    {
        if(file_exists($d . $class . ".php"))
        {
            require_once($d . $class . ".php");
            $json[$class] = $d . $class . ".php";
            file_put_contents("lib/cache/autoload.cache", json_encode($json));
            return;
        }
    }
}

$libdirs = file_get_contents("lib/cfg/autoload.cfg");

foreach(explode("\n", $libdirs) as $d) {
    set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . "/" . $d);
}

spl_autoload_register('autoloader');

Epi::setPath('base', 'lib/epiphany/src');
Epi::setSetting('exceptions', false);
Epi::init('database');
EpiDatabase::employ('mysql', $databases['analytics']['db'], $databases['analytics']['host'], $databases['analytics']['username'], $databases['analytics']['password']);

?>