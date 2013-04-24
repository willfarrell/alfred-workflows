<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "p";
// ****************

require_once('workflows.php');

$w = new Workflows();
//$query = urlencode( "{query}" );

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
	$w->result( 'pear', 'http://pear.php.net/search.php?q='.$query, 'No Repository found', 'No packages were found that match your query', 'pear.png', 'yes' );
}

echo $w->toxml();
// ****************
?>