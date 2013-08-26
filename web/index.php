<?php
require_once("../global.php");

Epi::init('template');
Epi::setPath('view', 'skin/templates');

Epi::init('route');

getRoute()->get('/', array('Overview', 'stub'));

getRoute()->run();
?>