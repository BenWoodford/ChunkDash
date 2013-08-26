<?php
require_once("../global.php");
require_once("lib/functions.php");

Epi::init('route');
Epi::init('api');

getRoute()->get('/', 'home');

getRoute()->get('/user/?', array('User', 'stub'));
getApi()->get('/user/([a-zA-Z0-9_]{2,16})/?', array('User', 'getUser'), EpiApi::external);
getApi()->get('/user/([a-zA-Z0-9_]{2,16})/regions/?', array('User', 'getRegions'), EpiApi::external);
getApi()->get('/user/([a-zA-Z0-9_]{2,16})/regions/spawnplots/?', array('User', 'getShopPlots'), EpiApi::external);
getApi()->get('/user/([a-zA-Z0-9_]{2,16})/regions/owned/?', array('User', 'getOwnedRegions'), EpiApi::external);
getApi()->get('/user/([a-zA-Z0-9_]{2,16})/regions/member/?', array('User', 'getMembershipRegions'), EpiApi::external);

getApi()->get('/users/list/?', array('User', 'getUserList'), EpiApi::external);
getApi()->get('/users/list/(\d+)/?', array('User', 'getUserList'), EpiApi::external);
getApi()->get('/users/list/(\d+)/(\d+)/?', array('User', 'getUserList'), EpiApi::external);

//getApi()->post('/users/list/?', array('User', 'getFilteredUserList'), EpiApi::external);
//getApi()->post('/users/list/(\d+)/?', array('User', 'getFilteredUserList'), EpiApi::external);

getRoute()->get('/notifications/?', array('Notification', 'stub'));
getApi()->get('/notifications/full/?', array('Notification', 'getNotificationsFull'), EpiApi::external);
getApi()->get('/notifications/full/(\d+)/?', array('Notification', 'getNotificationsFull'), EpiApi::external);
getApi()->get('/notifications/full/(\d+)/(\d+)/?', array('Notification', 'getNotificationsFull'), EpiApi::external);
getApi()->get('/notifications/mini/?', array('Notification', 'getNotificationsMini'), EpiApi::external);
getApi()->get('/notifications/mini/([a-zA-Z0-9-_]+)@loadingchunks.net/?', array('Notification', 'getNotificationsMini'), EpiApi::external);

getRoute()->get('/tasks/?', array('Task', 'stub'));
getApi()->get('/tasks/list/?', array('Task', 'getTasks'), EpiApi::external);

function home() {
	echo "Welcome to the API root.";
}

getRoute()->run();
?>