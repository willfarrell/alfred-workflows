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
	$w->result( 'apache-'.$item, 'sudo apachectl '.$item, ucfirst($item).' Apache', 'Run `sudo apachectl '.$item.'`', 'icon-cache/apache.png' );
}

echo $w->toxml();
// ****************
?>