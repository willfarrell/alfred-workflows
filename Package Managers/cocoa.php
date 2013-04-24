<?php

//header ("Content-Type:text/xml");

$query = "ios";
// ****************
$apple_docs = false;

require_once('workflows.php');

function search($plugin, $query) {
	if (strpos($plugin->name, $query) !== false) {
		return true;
	} else if (isset($plugin->summary) && strpos($plugin->summary, $query) !== false) {
		return true;
	}
	return false;
}

$w = new Workflows();
//$query = urlencode( "{query}" );

// cache package database
$liabraries = $w->read('cocoa.json');
$timestamp = $w->filetime('cocoa.json');
if (!$liabraries || ($timestamp && $timestamp < (time() - 14 * 86400)) ) {
	if ($apple_docs) {
		$url = "http://cocoadocs.org/apple_documents.jsonp";
		$data_a = $w->request( $url );
		$data_a = substr($data_a, 16, -21);
	} else {
		$data_a = "[]";
	}
	//
	
	$data_a = "[]";
	
	// cocoa docs
	$url = "http://cocoadocs.org/documents.jsonp";
	$data_c = $w->request( $url );
	$data_c = substr($data_c, 12, -21);
	
	$data = array_merge(json_decode( $data_a ), json_decode( $data_c ));
	$w->write($data, 'cocoa.json');
	$liabraries = $data;
	
	$w->result( 'cocoa-update', 'na', 'CoacaDocs Updated', 'The cache for CocoaDocs has been updated', 'cocoa.png', 'no' );
}

$count = 20;
foreach($liabraries as $library ) {
	if (search($library,  $query)) {
		$title = $library->name;
		if (isset($library->main_version)) { $title .= ' ('.$library->main_version.')'; }
		if (isset($library->user)) { $title .= ' ~ '.$library->user; }
		
		$url = (isset($library->url)) ? $library->url : $library->doc_url;
		$details = (isset($library->summary)) ? $library->summary : $library->framework;
		
		$icon = (isset($library->url)) ? 'xcode.png' : 'cocoa.png';
		$w->result( $library->name, $url, $title, $details, $icon );
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

if ( count( $w->results() ) == 0 ) {
	$w->result( 'cocoa', 'http://cocoadocs.org/?q='.$query, 'No Library found', 'No libraries were found that match your query', 'cocoa.png', 'yes' );
}

echo $w->toxml();
// ****************
?>