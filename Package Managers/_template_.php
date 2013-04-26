<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "contrib";
// ****************
//$min_query_length = 3; // use when loading in large DBs
error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
$query = urlencode( "{query}" );

// use one of
$pkgs = $cache->get_db('grunt'); // entire db is provided in json, add to cache.php $dbs array
$pkgs = $cache->get_query_json('bower', $query, 'https://bower.herokuapp.com/packages/search/'.$query); // has json API
$pkgs = $cache->get_query_regex('brew', $query, 'http://braumeister.org/search/'.$query, '/<div class="formula (odd|even)">([\s\S]*?)<\/div>/i', 2); // requires parsing

//array_shift($pkgs); // remove first item

// sample search of object - use when provied with entire db
function search($plugin, $query) {
	if (strpos($plugin->name, $query) !== false) {
		return true;
	} else if (strpos($plugin->description, $query) !== false) {
		return true;
	} else {
		foreach($plugin->keywords as $keyword) {
			if (strpos($keyword, $query) !== false) {
				return true;
			}
		}
	}
	return false;
}

//$count = 25;
foreach($pkgs as $pkg ) {
	if (search($pkg,  $query)) {
		$title = str_replace('grunt-', '', $pkg->name); // remove grunt- from title
	
		// add author to title
		if (isset($pkg->author) && isset($pkg->author->name)) {
			$title .= " by " . $pkg->author->name;
		}
		$url = str_replace("git://", "https://", $pkg->github);
		$w->result( $pkg->name, $url, $title, $pkg->description, 'icon-cache/cocoa.png' );
	}
	//if (!--$count) { break; }
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'cocoa', 'http://gruntjs.com/plugins/'.$query, 'No Library found', 'No libraries were found that match your query', 'icon-cache/cocoa.png', 'yes' );
}

echo $w->toxml();
// ****************
?>