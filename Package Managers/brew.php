<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, "message to send to log");

$query = "p";
// ****************

require_once('workflows.php');

$w = new Workflows();
//$query = urlencode( "{query}" );

if ($query) {
	$data = $w->request('http://braumeister.org/search/'.$query);
	preg_match_all('/<div class="formula (odd|even)">([\s\S]*?)<\/div>/i', $data, $matches);
	
	foreach($matches[2] as $item) {
		// name
		preg_match('/<a(.*?) class="formula">(.*?)<\/a>/i', $item, $matches);
		$title = strip_tags($matches[0]);
		
		// version
		preg_match('/<strong class="version">(.*?)<\/strong>/i', $item, $matches);
		$version = strip_tags($matches[0]);
		
		// url
		preg_match('/Homepage: <a(.*?)>(.*?)<\/a>/i', $item, $matches);
		$details = strip_tags($matches[2]);
		
		$w->result( $title, 'http://braumeister.org/formula/'.$title, $title.' ~ '.$version, $details, 'terminal.png' );
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'homebrew', 'http://braumeister.org/search/'.$query, 'No Repository found', 'No packages were found that match your query', 'terminal.png', 'yes' );
}

echo $w->toxml();
// ****************
?>