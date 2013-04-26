<?php
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();

foreach($cache->dbs as $key => $url) {
	$cache->update_db($key);
}
// ****************
?>