<?php
require_once("global.php");

Epi::init('route');

getRoute()->get('/', 'home');
getRoute()->get('/user/', array('User', 'stub'));
getRoute()->get('/user/(\[a-z0-9_\]{2,16})', array('User', 'getUser'));
getRoute()->get('/user/(\[a-z0-9_\]{2,16})/regions', array('User', 'getRegions'));
getRoute()->get('/user/(\[a-z0-9_\]{2,16})/regions/owned', array('User', 'getOwnedRegions'));
getRoute()->get('/user/(\[a-z0-9_\]{2,16})/regions/member', array('User', 'getMembershipRegions'));

function home() {
	echo "Welcome to the API root.";
}

getRoute()->run();
?>