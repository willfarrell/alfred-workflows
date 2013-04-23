<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "angular";
// ****************

require_once('workflows.php');

$w = new Workflows();
$query = urlencode( "{query}" );

if ($query) {
	$list = $w->request('https://bower.herokuapp.com/packages/search/'.$query);

	$items = json_decode( $list );
	
	foreach($items as $item ) {
		
		$w->result( $item->url, $item->url, $item->name, $item->url, 'bower.png' );
	}
}


if ( count( $w->results() ) == 0 ) {
	$w->result( 'bower', 'na', 'No Repository found', 'No components were found that match your query', 'bower.png', 'no' );
}

echo $w->toxml();
// ****************
?>