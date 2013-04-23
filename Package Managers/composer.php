<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "php";
// ****************

require_once('workflows.php');

$w = new Workflows();
$query = urlencode( "{query}" );


if ($query) {
	$data = $w->request('https://packagist.org/search/?search_query%5Bquery%5D=_'.$query);
	
	/*$items = explode('<li class="search-result package">', $data);
	array_shift($items);
	
	foreach($items as $item) {
		preg_match('/<h2>(.*?)<\/h2>/i', $item, $matches);
		$title = strip_tags($matches[1]);
		
		preg_match_all('/<p[^>]*>([\s\S]*?)<\/p>/i', $item, $matches);
		$author = trim(strip_tags($matches[1][0]));
		$author = preg_replace("/[\s]+/", " ", $author);
		$details = trim(strip_tags($matches[1][1]));
		
		$w->result( $title, 'https://npmjs.org/package/'.$title, $title.' ~ '.$author, $details, 'npm.png' );
	}*/
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'composer', 'https://packagist.org/search/?q='.$query, 'No Repository found', 'No packages were found that match your query', 'composer.png', 'yes' );
}

echo $w->toxml();
// ****************
?>