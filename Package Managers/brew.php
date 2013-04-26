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


$pkgs = $cache->get_query_regex('brew', $query, 'http://braumeister.org/search/'.$query, '/<div class="formula (odd|even)">([\s\S]*?)<\/div>/i', 2);

foreach($pkgs as $item) {
	// name
	preg_match('/<a href="(.*?)" class="formula">(.*?)<\/a>/i', $item, $matches);
	$title = strip_tags($matches[0]);
	
	// version
	preg_match('/<strong class="version">(.*?)<\/strong>/i', $item, $matches);
	$version = strip_tags($matches[0]);
	
	// url
	preg_match('/Homepage: <a href="(.*?)">(.*?)<\/a>/i', $item, $matches);
	$details = strip_tags($matches[1]);
	
	$w->result( $title, 'http://braumeister.org/formula/'.$title, $title.' ~ '.$version, $details, 'icon-cache/brew.png' );
}


if ( count( $w->results() ) == 0 ) {
	$w->result( 'homebrew', 'http://braumeister.org/search/'.$query, 'No Repository found', 'No packages were found that match your query', 'icon-cache/brew.png', 'yes' );
}

echo $w->toxml();
// ****************
?>