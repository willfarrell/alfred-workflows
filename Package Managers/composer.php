<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "php";
// ****************

require_once('workflows.php');

$w = new Workflows();
$query = urlencode( "{query}" );

if ($query) {
	$data = $w->request('https://packagist.org/search/?search_query[query]='.$query);
	$items = explode('<h1>', $data);
	array_shift($items);
	array_shift($items);
	
	foreach($items as $item) {
		preg_match('/<a(.*?)<\/a>/i', $item, $matches);
		$title = strip_tags($matches[0]);
		
		preg_match('/<p class="package-description">(.*?)<\/p>/i', $item, $matches);
		$details = strip_tags($matches[1]);
		
		$w->result( $title, 'https://packagist.org/packages/'.$title, $title, $details, 'composer.png' );
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'composer', 'https://packagist.org/search/?q='.$query, 'No Repository found', 'No packages were found that match your query', 'composer.png', 'yes' );
}

echo $w->toxml();
// ****************
?>