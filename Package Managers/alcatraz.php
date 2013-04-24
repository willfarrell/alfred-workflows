<?php

//header ("Content-Type:text/xml");

$query = "contrib";
// ****************

require_once('workflows.php');

function search($item, $query) {
	if (strpos($item->name, $query) !== false) {
		return true;
	} else if (strpos($item->description, $query) !== false) {
		return true;
	}
	return false;
}

$w = new Workflows();
$query = urlencode( "{query}" );

// cache package database
$packages = $w->read('alcatraz.json');
$timestamp = $w->filetime('alcatraz.json');
if ( !$packages || ($timestamp && $timestamp < (time() - 14 * 86400)) ) {
	$url = "https://raw.github.com/mneorr/alcatraz-packages/master/packages.json";
	$json = $w->request( $url );
	
	$w->write($json, 'alcatraz.json');
	$packages = json_decode( $json );
	$w->result( 'alcatraz-update', 'na', 'Alcatraz Updated', 'The cache for Alcatraz has been updated', 'alcatraz.png', 'no' );
}

foreach($packages->packages as $package ) {
	// plugins, color_scheme, project_templates, file_templates
	for( $i = 0; $i < count($package); $i++ ) {
		
		if (search($package[$i], $query)) {
			$w->result( $package[$i]->url, $package[$i]->url, $package[$i]->name, $package[$i]->description, 'alcatraz.png' );
		}
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'alcatraz', 'http://mneorr.github.io/Alcatraz/'.$query, 'No Repository found', 'No packages were found that match your query', 'alcatraz.png', 'no' );
}

echo $w->toxml();
// ****************
?>