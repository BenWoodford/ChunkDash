<?php
require_once("../global.php");

Epi::init('template');
Epi::setPath('view', 'skin/templates');

Epi::init('route');

getRoute()->get('/', array('Overview', 'stub'));
getRoute()->get('/tasks/?', array('Tasks', 'stub'));
getRoute()->get('/notifications/?', array('Notifications', 'stub'));
getRoute()->get('/notifications/(\d+)/?', array('Notifications', 'stub'));

getRoute()->get('/metrics/?', array('Metrics', 'stub'));
getRoute()->get('/metrics/(\w+)/?', array('Metrics', 'stub'));

getRoute()->run();
?>