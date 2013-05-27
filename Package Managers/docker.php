<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "h";
// ****************
error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_regex('docker', $query, 'https://index.docker.io/search?q='.$query, '/<li>[\s]*<h3>([\s\S]*?)<\/li>/i', 1); // requires parsing

//$count = 25;
foreach($pkgs as $pkg) {
	preg_match('/<a href="(.*?)">(.*?)<\/a>/i', $pkg, $matches);
	$title = $matches[2];
	$url = 'https://index.docker.io'.$matches[1];
	
	preg_match('/<p>(.*?)<\/p>/i', $pkg, $matches);
	$description = $matches[1];
	if (!$description) {
		$description = $url;
	}
	
	preg_match('/<p class="date">Last updated: (.*?)[\s]*downloaded: (.*?) times<\/p>/i', $pkg, $matches);
	$updated = $matches[1];
	if ($updated == "Not Available") {
		$updated = "";
	}
	$downloads = $matches[2];
	
	$w->result( $title, $url, $title."    ".$updated."    ".$downloads, $description, 'icon-cache/docker.png' );
	
	//if (!--$count) { break; }
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'docker', 'https://index.docker.io/search?q='.$query, 'No plugins were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/docker.png' );
	}
	$w->result( 'docker-www', 'http://www.docker.io/', 'Go to the website', 'http://www.docker.io', 'icon-cache/docker.png' );
}

echo $w->toxml();
// ****************
?>