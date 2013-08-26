<?php
require_once("../global.php");

Epi::init('template');
Epi::setPath('view', 'skin/templates');

getTemplate()->display('header.php', array('name' => $_SERVER['REMOTE_USER']));

Epi::init('route');

getTemplate()->display('footer.php');
?>