<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "php";
// ****************

require_once('workflows.php');

$w = new Workflows();
//$query = urlencode( "{query}" );


if ($query) {
	$data = $w->request('http://rpmfind.net/linux/rpm2html/search.php?query='.$query.'&system=&arch=');
	preg_match_all('/<tr bgcolor=\'\'>([\s\S]*?)<\/tr>/i', $data, $matches);
	
	foreach($matches[1] as $item) {
		// title and url
		preg_match('/<a href=[\'"](.*?)[\'"]>(.*?)<\/a>/i', $item, $matches);
		$title = strip_tags($matches[2]);
		$url = strip_tags($matches[1]);
		
		preg_match_all('/<td>([\s\S]*?)<\/td>/i', $item, $matches);
		$dist = trim(strip_tags($matches[1][2]));
		$details = trim(strip_tags($matches[1][1]));
		
		$w->result( $title, $url, $title, $dist.' - '.$details, 'rpm.png' );
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'rpm', 'http://rpmfind.net/linux/rpm2html/search.php?query='.$query.'&system=&arch=', 'No Repository found', 'No packages were found that match your query', 'rpm.png', 'yes' );
}

echo $w->toxml();
// ****************
?>