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

$pkgs = $cache->get_query_regex('npm', $query, 'https://npmjs.org/search?q='.$query, '/<li class="search-result package">([\s\S]*?)<\/ul>/i');

foreach($pkgs as $item) {
	preg_match('/<h2>(.*?)<\/h2>/i', $item, $matches);
	$title = strip_tags($matches[1]);
	
	preg_match_all('/<p[^>]*>([\s\S]*?)<\/p>/i', $item, $matches);
	$author = trim(strip_tags($matches[1][0]));
	$author = preg_replace("/[\s]+/", " ", $author);
	$details = trim(strip_tags($matches[1][1]));
	
	$w->result( $title, 'https://npmjs.org/package/'.$title, $title.' ~ '.$author, $details, 'icon-cache/npm.png' );
}


if ( count( $w->results() ) == 0 ) {
	$w->result( 'npm', 'https://npmjs.org/search?q='.$query, 'No Repository found', 'No packages were found that match your query', 'icon-cache/npm.png', 'yes' );
}

echo $w->toxml();
// ****************
?>