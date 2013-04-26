<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "csscs";
// ****************
error_reporting(0);
require_once('workflows.php');

$w = new Workflows();
//$query = urlencode( "{query}" );

// search API sample
if ($query) {
	$data = $w->request('http://rubygems.org/search?utf8=%E2%9C%93&query='.$query);
	preg_match_all('/<li>([\s\S]*?)<\/li>/i', $data, $matches);
	$items = $matches[1];
	//array_shift($items);
	
	foreach($items as $item) {
		//echo $item;
		// name
		preg_match_all('/<strong>(.*?)<\/strong>/i', $item, $matches);
		//print_r($matches);
		$title = strip_tags($matches[1][1]);
		
		// url
		preg_match('/<a href="(.*?)">([\s\S]*?)<\/a>/i', $item, $matches);
		$url = $matches[1];
		
		$details = trim(strip_tags(substr($matches[2], strpos($matches[2], "</strong>")+9)));
		
		if ($title && $details) { // filter out nav links
			$w->result( $title, 'http://rubygems.org'.$url, $title, $details, 'gems.png' );
		}
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'gems', 'http://rubygems.org/search?utf8=%E2%9C%93&query='.$query, 'No Gems found', 'No gems were found that match your query', 'gems.png', 'yes' );
}

echo $w->toxml();
// ****************
?>