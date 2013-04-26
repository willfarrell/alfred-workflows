<?php

//header ("Content-Type:text/xml");

$query = "X";
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_db('alcatraz');

function search($item, $query) {
	if (strpos($item->name, $query) !== false) {
		return true;
	} else if (strpos($item->description, $query) !== false) {
		return true;
	}
	return false;
}

foreach($pkgs->packages as $package ) {
	// plugins, color_scheme, project_templates, file_templates
	for( $i = 0; $i < count($package); $i++ ) {
		
		if (search($package[$i], $query)) {
			$w->result( $package[$i]->url, $package[$i]->url, $package[$i]->name, $package[$i]->description, 'icon-cache/alcatraz.png' );
		}
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'alcatraz', 'http://mneorr.github.io/Alcatraz/'.$query, 'No Repository found', 'No packages were found that match your query', 'icon-cache/alcatraz.png', 'no' );
}

echo $w->toxml();
// ****************
?>