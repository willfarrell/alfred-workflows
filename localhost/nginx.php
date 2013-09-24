<?php

// ****************
error_reporting(0);
require_once('workflows.php');

$w = new Workflows();
if (!isset($query)) {
	$query = urlencode( "{query}" );
}

$allowed = array("start", "stop", "restart");

foreach($allowed as $item) {
	$w->result( 'nginx-'.$item, 'sudo nginx '.$item, ucfirst($item).' nginx', 'Run `sudo nginx '.$item.'`', 'icon-cache/nginx.png' );
}

echo $w->toxml();
// ****************
?>