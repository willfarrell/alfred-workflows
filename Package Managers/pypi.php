<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "pip";
// ****************
$min_query_length = 3;
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_regex('pypi', $query, 'https://crate.io/?has_releases=on&q='.$query, '/<div class="results">([\s\S]*?)<\/div>[\s]*<\/div>[\s]*<\/div>/i', 1);

foreach($pkgs as $item) {
	// name
	preg_match('/<a href="(.*?)">(.*?)<\/a>/i', $item, $matches);
	$title = $matches[2];
	$url = $matches[1];
	
	preg_match('/<em>(.*?)<\/em>/i', $item, $matches);
	$author = $matches[1];
	
	preg_match('/<span class="count">(.*?)<\/span>/i', $item, $matches);
	$downloads = $matches[1];
	
	preg_match('/<div class="span9 summary">([\s\S]*?)$/i', $item, $matches);
	$details = $matches[1];
	
	$w->result( $title, 'https://crate.io'.$url, $title."    ".$author."    ".$downloads, $details, 'icon-cache/pypi.png' );
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