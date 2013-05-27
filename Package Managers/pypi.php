<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "lib";
// ****************
$min_query_length = 3;
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_regex('pypi', $query, 'https://crate.io/?has_releases=on&q='.$query, '/<tr class="(.*?)">([\s\S]*?)<\/tr>/i', 2);

$count = 25;
foreach($pkgs as $item) {
	// name
	preg_match('/<a href="(.*?)">(.*?)<\/a>/i', $item, $matches);
	$title = str_replace("&nbsp;", " ", strip_tags($matches[0]));
	$url = strip_tags($matches[1]);
	
	preg_match_all('/<td>([\s\S]*?)<\/td>/i', $item, $matches);
	$details = strip_tags($matches[1][2]);
	
	$w->result( $title, 'https://pypi.python.org'.$url, $title, $details, 'icon-cache/pypi.png' );
	if (!--$count) { break; }
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'pypi', 'https://crate.io/?has_releases=on&q='.$query, 'No packages were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/pypi.png' );
	}
	$w->result( 'pypi-www', 'https://pypi.python.org/', 'Go to the website', 'https://pypi.python.org', 'icon-cache/pypi.png' );
}


echo $w->toxml();
// ****************
?>