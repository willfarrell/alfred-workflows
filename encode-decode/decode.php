<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

// ****************

require_once('workflows.php');

$w = new Workflows();
$query = "{query}";

function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

$decodes = array();
$decodes["URL Decoded"] = urldecode($query);
//$decodes["Unicode Decoded"] = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $query);
$decodes["HTML Decoded"] = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), htmlspecialchars_decode($query, ENT_NOQUOTES));
$dencodes["UTF-8 Decoded"] = utf8_decode($query);

foreach($decodes as $key => $value) {
	$w->result( 'encode', $value, $value, $key, 'terminal.png', 'np' );
}

echo $w->toxml();
// ****************
?>