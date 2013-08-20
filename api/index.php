<?php
require_once("global.php");

Epi::init('route');
Epi::init('api');

getRoute()->get('/', 'home');
getRoute()->get('/user/', array('User', 'stub'));
getApi()->get('/user/([a-z0-9_]{2,16})', array('User', 'getUser'), EpiApi::external);
getApi()->get('/user/([a-z0-9_]{2,16})/regions', array('User', 'getRegions'), EpiApi::external);
getApi()->get('/user/([a-z0-9_]{2,16})/regions/owned', array('User', 'getOwnedRegions'), EpiApi::external);
getApi()->get('/user/([a-z0-9_]{2,16})/regions/member', array('User', 'getMembershipRegions'), EpiApi::external);

function home() {
	echo "Welcome to the API root.";
}

getRoute()->run();
?>