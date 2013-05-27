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

foreach($pkgs as $pkg) {
	// name
	preg_match('/<a href="(.*?)" class="formula">(.*?)<\/a>/i', $pkg, $matches);
	$title = strip_tags($matches[0]);
	
	// version
	preg_match('/<strong class="version">(.*?)<\/strong>/i', $pkg, $matches);
	$version = strip_tags($matches[0]);
	
	// url
	preg_match('/Homepage: <a href="(.*?)">(.*?)<\/a>/i', $pkg, $matches);
	$details = strip_tags($matches[1]);
	
	$w->result( $title, 'http://braumeister.org/formula/'.$title, $title.' ~ '.$version, $details, 'icon-cache/brew.png' );
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'brew', 'http://braumeister.org/search/'.$query, 'No plugins were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/brew.png' );
	}
	$w->result( 'brew-www', 'http://braumeister.org/', 'Go to the website', 'http://braumeister.org', 'icon-cache/brew.png' );
}

echo $w->toxml();
// ****************
?>