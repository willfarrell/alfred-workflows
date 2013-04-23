<?php

//header ("Content-Type:text/xml");

$query = "contrib";
// ****************

require_once('workflows.php');

$w = new Workflows();
//$query = urlencode( "{query}" );

// cache package database
$cache_timestamp = 0;
try {
	$cache_timestamp = $w->get( 'grunt.timestamp', 'settings.plist' );
} catch(Exception $e) {}


if (!$cache_timestamp || $cache_timestamp < (time() - 14 * 86400)) {
	$url = "http://gruntjs.com/plugin-list";
	$pluginlist = $w->request( $url );
	
	$w->write($pluginlist, 'grunt.json');
	$plugins = json_decode( $pluginlist );
	
	$w->set( 'grunt.timestamp', time(), 'settings.plist' );
} else {
	$plugins = $w->read('grunt.json');
}

foreach($plugins as $plugin ) {
	// search for keyword
	$found = false;
	if (strpos($plugin->name, $query) !== false) {
		$found = true;
	} else if (strpos($plugin->description, $query) !== false) {
		$found = true;
	} else {
		foreach($plugin->keywords as $keyword) {
			if (strpos($keyword, $query) !== false) {
				$found = true;
				break;
			}
		}
	}
	
	if ($found) {
		//print_r($plugin);
		$title = str_replace('grunt-', '', $plugin->name); // remove grunt- from title
		
		// add author to title
		if (isset($plugin->author) && isset($plugin->author->name)) {
			$title .= " by " . $plugin->author->name;
		}
		$w->result( $plugin->name, $plugin->github, $title, $plugin->description, 'grunt.png' );
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'grunt', 'na', 'No Repository found', 'No plugins were found that match your query', 'grunt.png', 'no' );
}

echo $w->toxml();
// ****************
?>