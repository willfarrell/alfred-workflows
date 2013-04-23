<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

// ****************

require_once('workflows.php');

$w = new Workflows();
$query = "{query}";

$char = substr($query, 0, 1);

$encodes = array();
$encodes["URL Encoded"] = urlencode($query);
$encodes["HTML Encoded"] = htmlspecialchars($query);
//$encodes["UTF-8 Encoded"] = utf8_encode($query);

foreach($encodes as $key => $value) {
	$w->result( 'encode', $value, $value, $key, 'terminal.png', 'np' );
}

echo $w->toxml();
// ****************
?>