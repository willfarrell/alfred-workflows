<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "csscs";
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_regex('gems', $query, 'http://rubygems.org/search?utf8=%E2%9C%93&query='.$query, '/<li>([\s\S]*?)<\/li>/i');

foreach($pkgs as $item) {
	// name
	preg_match_all('/<strong>(.*?)<\/strong>/i', $item, $matches);
	if (isset($matches[1][1])) {
		$title = strip_tags($matches[1][1]);
	} else { continue; }
	
	// url
	preg_match('/<a href="(.*?)">([\s\S]*?)<\/a>/i', $item, $matches);
	$url = $matches[1];
	
	$details = trim(strip_tags(substr($matches[2], strpos($matches[2], "</strong>")+9)));
	
	if ($title && $details) { // filter out nav links
		$w->result( $title, 'http://rubygems.org'.$url, $title, $details, 'icon-cache/gems.png' );
	}
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'gems', 'http://rubygems.org/search?utf8=%E2%9C%93&query='.$query, 'No gems were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/gems.png' );
	}
	$w->result( 'gems-www', 'http://rubygems.org/', 'Go to the website', 'http://rubygems.org', 'icon-cache/gems.png' );
}

echo $w->toxml();
// ****************
?>