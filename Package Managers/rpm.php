<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "php";
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_regex('rpm', $query, 'http://rpmfind.net/linux/rpm2html/search.php?query='.$query.'&system=&arch=', '/<tr bgcolor=\'\'>([\s\S]*?)<\/tr>/i');

foreach($pkgs as $item) {
	// title and url
	preg_match('/<a href=[\'"](.*?)[\'"]>(.*?)<\/a>/i', $item, $matches);
	$title = strip_tags($matches[2]);
	$url = strip_tags($matches[1]);
	
	preg_match_all('/<td>([\s\S]*?)<\/td>/i', $item, $matches);
	$dist = trim(strip_tags($matches[1][2]));
	$details = trim(strip_tags($matches[1][1]));
	
	$w->result( $title, $url, $title, $dist.' - '.$details, 'icon-cache/rpm.png' );
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'rpm', 'http://rpmfind.net/linux/rpm2html/search.php?query='.$query.'&system=&arch=', 'No packages were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/rpm.png' );
	}
	$w->result( 'rpm-www', 'http://rpmfind.net/', 'Go to the website', 'http://rpmfind.net', 'icon-cache/rpm.png' );
}

echo $w->toxml();
// ****************
?>