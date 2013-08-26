<?php
require_once("../global.php");

Epi::init('template');
Epi::setPath('view', 'skin/templates');

getTemplate()->display('header.php', array('name' => (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] : "anonymous@loadingchunks.net")));

Epi::init('route');

getTemplate()->display('footer.php');
?>