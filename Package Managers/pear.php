<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "p";
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_regex('pear', $query, 'http://pear.php.net/search.php?q='.$query, '/<li>([\s\S]*?)<\/li>/i');

array_shift($pkgs); // remove first item

foreach($pkgs as $item) {
	// name
	preg_match('/<a(.*?)>(.*?)<\/a>/i', $item, $matches);
	$title = strip_tags($matches[0]);
	
	// url
	$details = strip_tags(substr($item, strpos($item, ":")+2));
	
	$w->result( $title, 'http://pear.php.net/package/'.$title, $title, $details, 'icon-cache/pear.png' );
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'pear', 'http://pear.php.net/search.php?q='.$query, 'No packages were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/pear.png' );
	}
	$w->result( 'pear-www', 'http://pear.php.net/', 'Go to the website', 'http://pear.php.net', 'icon-cache/pear.png' );
}

echo $w->toxml();
// ****************
?>