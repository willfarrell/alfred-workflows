<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "ap";

// ****************

require_once('workflows.php');

$w = new Workflows();
//$query = "{query}";

$encodes = array();
// url
$url_encode = urlencode($query);
if ($url_encode != $query) $encodes["URL Encoded"] = $url_encode;

// utf8
$utf8_encode = utf8_encode($query);
if ($utf8_encode != $query) $encodes["UTF8 Encoded"] = $utf8_encode;

// HTML
$html_encode = htmlentities($query, ENT_QUOTES, 'UTF-8');
if ($html_encode != $query) $encodes["HTML Encoded"] = $html_encode;
//$dencodes["UTF-8 encoded"] = utf8_encode($query);

// base64
$base64_encode = base64_encode($query);
if ($base64_encode != $query) $encodes["base64 Encoded"] = $base64_encode;

foreach($encodes as $key => $value) {
	$w->result( $key, $value, $value, $key, 'terminal.png', 'yes' );
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'encode', $query, 'Nothing useful resulted', 'The encoded strings were the same as your query', 'terminal.png', 'yes' );
}

echo $w->toxml();
// ****************
?>