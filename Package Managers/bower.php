<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "angular";
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_json('bower', $query, 'https://bower.herokuapp.com/packages/search/'.$query);

foreach($pkgs as $pkg) {
	$url = str_replace("git://", "https://", $pkg->url);
	$w->result( $pkg->url, $url, $pkg->name, $url, 'icon-cache/bower.png' );
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'bower', 'http://sindresorhus.com/bower-components/#!/search/'.$query, 'No Repository found', 'No components were found that match your query', 'icon-cache/bower.png', 'yes' );
}

echo $w->toxml();
// ****************
?>