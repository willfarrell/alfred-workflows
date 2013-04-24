<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "%5D & > \u0058"; // URL, 
// ****************

require_once('workflows.php');

$w = new Workflows();
//$query = "{query}";

function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

function html_decode($str) {
	return str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), htmlspecialchars_decode($str, ENT_NOQUOTES));
}

$decodes = array();
// url
$url_decode = urldecode($query);
if ($url_decode != $query) $decodes["URL Decoded"] = $url_decode;

// utf-8
$utf8_decode = utf8_decode($query);
if ($utf8_decode != $query) $decodes["UTF8 Decoded"] = $utf8_decode;

// unicode
$unicode_decode = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $query);
if ($unicode_decode != $query) $decodes["Unicode Decoded"] = $unicode_decode;

// HTML
$html_decode = html_entity_decode($query);
if ($html_decode != $query) $decodes["HTML Decoded"] = $html_decode;

// base64
$base64_decode = base64_decode($query);
if ($base64_decode != $query) $decodes["base64 Decoded"] = $base64_decode;

//$dencodes["UTF-8 Decoded"] = utf8_decode($query);

foreach($decodes as $key => $value) {
	$w->result( $key, $value, $value, $key, 'terminal.png', 'yes' );
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'decode', $query, 'Nothing useful resulted', 'The decoded strings were the same as your query', 'terminal.png', 'yes' );
}

echo $w->toxml();
// ****************
?>