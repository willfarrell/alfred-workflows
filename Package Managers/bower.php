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
		$url = str_replace("git://", "https://", $item->url);
		$w->result( $item->url, $url, $item->name, $url, 'bower.png' );
	}
}


if ( count( $w->results() ) == 0 ) {
	$w->result( 'bower', 'http://sindresorhus.com/bower-components/#!/search/'.$query, 'No Repository found', 'No components were found that match your query', 'bower.png', 'yes' );
}

echo $w->toxml();
// ****************
?>