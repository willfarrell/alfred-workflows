<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "contrib";
// ****************
error_reporting(0);
require_once('workflows.php');

$w = new Workflows();
$query = urlencode( "{query}" );

// search API sample
if ($query) {
	$data = $w->request('https://pypi.python.org/pypi?%3Aaction=search&term='.$query.'&submit=search');
	preg_match_all('/<tr class="(.*?)">([\s\S]*?)<\/tr>/i', $data, $matches);
	$items = $matches[2];
	
	$count = 25;
	foreach($items as $item) {
		// name
		preg_match('/<a href="(.*?)">(.*?)<\/a>/i', $item, $matches);
		$title = str_replace("&nbsp;", " ", strip_tags($matches[0]));
		$url = strip_tags($matches[1]);
		
		preg_match_all('/<td>([\s\S]*?)<\/td>/i', $item, $matches);
		$details = strip_tags($matches[1][2]);
		
		$w->result( $title, 'https://pypi.python.org'.$url, $title, $details, 'pypi.png' );
		if (!--$count) { break; }
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'pypi', 'https://pypi.python.org/pypi?%3Aaction=search&term='.$query.'&submit=search', 'No Packages found', 'No packages were found that match your query', 'pypi.png', 'yes' );
}

echo $w->toxml();
// ****************
?>