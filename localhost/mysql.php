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
	$w->result( 'mysql-'.$item, 'sudo mysqld '.$item, ucfirst($item).' MySQL', 'Run `sudo mysqld '.$item.'`', 'icon-cache/mysql.png' );
}

echo $w->toxml();
// ****************
?>