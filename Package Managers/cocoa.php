<?php

//header ("Content-Type:text/xml");

$query = "ab";
// ****************
$apple_docs = true;

//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_db('cocoa');
if ($apple_docs) {
	$apple = $cache->get_db('apple');
	$pkgs = array_merge((array)$pkgs, (array)$apple);
}

function search($plugin, $query) {
	if (strpos($plugin->name, $query) !== false) {
		return true;
	} else if (isset($plugin->summary) && strpos($plugin->summary, $query) !== false) {
		return true;
	}
	return false;
}

$count = 25;
foreach($pkgs as $library ) {
	if (search($library,  $query)) {
		$title = $library->name;
		if (isset($library->main_version)) { $title .= ' ('.$library->main_version.')'; }
		if (isset($library->user)) { $title .= ' ~ '.$library->user; }
		
		$url = (isset($library->url)) ? $library->url : $library->doc_url;
		$details = (isset($library->summary)) ? $library->summary : $library->framework;
		
		$icon = (isset($library->url)) ? 'xcode.png' : 'cocoa.png';
		$w->result( $library->name, $url, $title, $details, 'icon-cache/'.$icon );
		if (!--$count) { break; }
	}
}
/*
// query
if ($query) {
	$data = $w->request('http://cocoapods.org/search?query='.$query.'&ids=20&offset=0');
	$json = json_decode($data);
	//print_r($json);
	foreach($json->allocations as $group) {
		$name = $group[4];
		$html = $group[5];
		for($i = 0; $i < count($name); $i++) {
			print_r($name[$i]);
			print_r($html[$i]);
			// name
			//preg_match('/<a(.*?)>(.*?)<\/a>/i', $item, $matches);
			//$title = strip_tags($matches[0]);
			
			// url
			//preg_match('/Homepage: <a(.*?)>(.*?)<\/a>/i', $item, $matches);
			//$details = strip_tags(substr($item, strpos($item, ":")+2));
			
			//$w->result( $title, 'http://pear.php.net/package/'.$title, $title, $details, 'cocoa.png' );
			
			$url = ''; // parsed grom $html[5]
			$w->result( $title, $url, $name[$i], '', 'cocoa.png' );
		}
	}
}*/


if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'cocoa', 'http://cocoadocs.org/?q='.$query, 'No libraries were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/cocoa.png' );
	}
	$w->result( 'cocoa-www', 'http://cocoadocs.org/', 'Go to the website', 'http://cocoadocs.org', 'icon-cache/cocoa.png' );
}

echo $w->toxml();
// ****************
?>