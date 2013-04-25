<?php
// ****************
require_once('workflows.php');

$json = array(
	"alcatraz" => "https://raw.github.com/mneorr/alcatraz-packages/master/packages.json",
	//"apple" => "http://cocoadocs.org/apple_documents.jsonp",
	"cocoa" => "http://cocoadocs.org/documents.jsonp",
	"grunt" => "http://gruntjs.com/plugin-list",
);

$w = new Workflows();
$query = urlencode( "{query}" );

foreach($json as $key => $url) {
	$data = $w->request( $url );
	
	// clean jsonp
	$data = preg_replace('/.+?({.+}).+/','$1',$data);
	
	$w->write($data, $key.'.json');
}

//$w->result( 'cachedb', 'NA', 'Downloading... ', 'You\'ll get a notification when it\'s done. It should be soon.', 'icon.png', 'no' );
// ****************
?>