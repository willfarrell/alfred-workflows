<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "contrib";
// ****************
error_reporting(0);
require_once('workflows.php');

// sample search of object
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

$w = new Workflows();
$query = urlencode( "{query}" );

// cache package database sample
$plugins = $w->read('cocoa.json');
$timestamp = $w->filetime('grunt.json');
if ( !$plugins || ($timestamp && $timestamp < (time() - 14 * 86400)) ) {
	$url = "http://gruntjs.com/plugin-list";
	$pluginlist = $w->request( $url );
	
	$w->write($pluginlist, 'grunt.json');
	$plugins = json_decode( $pluginlist );
	$w->result( 'grunt-update', 'na', 'Grunt Updated', 'The cache for Grunt has been updated', 'cocoa.png', 'no' );
}

$count = 20;
foreach($plugins as $plugin ) {
	
	if (search($plugin,  $query)) {
		$title = str_replace('grunt-', '', $plugin->name); // remove grunt- from title
	
		// add author to title
		if (isset($plugin->author) && isset($plugin->author->name)) {
			$title .= " by " . $plugin->author->name;
		}
		$url = str_replace("git://", "https://", $plugin->github);
		$w->result( $plugin->name, $url, $title, $plugin->description, 'cocoa.png' );
	}
	if (!--$count) { break; }
}

// search API sample
if ($query) {
	$data = $w->request('http://pear.php.net/search.php?q='.$query);
	preg_match_all('/<li>([\s\S]*?)<\/li>/i', $data, $matches);
	$items = $matches[1];
	array_shift($items);
	
	foreach($items as $item) {
		// name
		preg_match('/<a(.*?)>(.*?)<\/a>/i', $item, $matches);
		$title = strip_tags($matches[0]);
		
		// url
		preg_match('/Homepage: <a(.*?)>(.*?)<\/a>/i', $item, $matches);
		$details = strip_tags(substr($item, strpos($item, ":")+2));
		
		$w->result( $title, 'http://pear.php.net/package/'.$title, $title, $details, 'pear.png' );
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'cocoa', 'http://gruntjs.com/plugins/'.$query, 'No Library found', 'No libraries were found that match your query', 'cocoa.png', 'yes' );
}

echo $w->toxml();
// ****************
?>