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

$pkgs = $cache->get_query_regex('composer', $query, 'https://packagist.org/search/?search_query[query]='.$query, '/<li data-url="(.*?)">([\s\S]*?)<\/li>/i', 2);

foreach($pkgs as $item) {
	preg_match('/<a(.*?)<\/a>/i', $item, $matches);
	$title = strip_tags($matches[0]);
	
	preg_match('/<p class="package-description">([\s\S]*?)<\/p>/i', $item, $matches);
	$details = strip_tags(substr($matches[1], 2));
	
	$w->result( $title, 'https://packagist.org/packages/'.$title, $title, $details, 'icon-cache/composer.png' );
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'composer', 'https://packagist.org/search/?q='.$query, 'No packages were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/composer.png' );
	}
	$w->result( 'composer-www', 'http://getcomposer.org/', 'Go to the website', 'http://getcomposer.org', 'icon-cache/composer.png' );
}

echo $w->toxml();
// ****************
?>