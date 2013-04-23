<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "%5B";
$query = "\u005B";
$query = "U+005B";

$query = "&gt; test";/*
Encoded formats
%## = URL
\u#### Unicode
U+#### Unicode Number
&####; HTML
*/
// ****************

require_once('workflows.php');

$w = new Workflows();
$query = "{query}";

function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

$decodes = array();
$decodes["URL Dencoded"] = urldecode($query);
//$decodes["Unicode Dencoded"] = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $query);
$decodes["HTML Dencoded"] = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), htmlspecialchars_decode($query, ENT_NOQUOTES));
//$dencodes["UTF-8 Dencoded"] = utf8_dencode($query);

foreach($decodes as $key => $value) {
	$w->result( 'encode', $value, $value, $key, 'terminal.png', 'np' );
}

/*$char = substr($query, 0, 1);

switch($char) {
	case "%":
		$value = urldecode($query);
		$type = "URL Encoded";
		break;
	case "\\":
		$value = preg_replace_callback('/\\\\u([0-9a-f]{4})/ig', 'replace_unicode_escape_sequence', $query);
		$type = "Unicode Encoded";
		break;
	case "U":
		$value = preg_replace_callback('/U\+([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $query);
		$type = "Unicode Number Encoded";
		break;
	case "&":
		$value = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), htmlspecialchars_decode($query, ENT_NOQUOTES)); 
		$type = "HTML Encoded";
		break;
	default:
		$value = "Encoding Not Supported";
		$type = "";
		break;
}

if (strlen($query) == 1) {
	$value = "We need a few more chars.";
	$type = "";
}

$w->result( 'encode', 'NA', $value, $type, 'terminal.png', 'np' );
*/
echo $w->toxml();
// ****************
?>