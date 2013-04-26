<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );

$query = "lib";
// ****************
$min_query_length = 3;
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

// http://wiki.python.org/moin/PyPIXmlRpc
if (strlen($query) >= $min_query_length) {
	$pkgs = $cache->get_query_regex('pypi', $query, 'https://pypi.python.org/pypi?%3Aaction=search&term='.$query.'&submit=search', '/<tr class="(.*?)">([\s\S]*?)<\/tr>/i', 2);
	
	$count = 25;
	foreach($pkgs as $item) {
		// name
		preg_match('/<a href="(.*?)">(.*?)<\/a>/i', $item, $matches);
		$title = str_replace("&nbsp;", " ", strip_tags($matches[0]));
		$url = strip_tags($matches[1]);
		
		preg_match_all('/<td>([\s\S]*?)<\/td>/i', $item, $matches);
		$details = strip_tags($matches[1][2]);
		
		$w->result( $title, 'https://pypi.python.org'.$url, $title, $details, 'icon-cache/pypi.png' );
		if (!--$count) { break; }
	}
	
	if ( count( $w->results() ) == 0 ) {
		$w->result( 'pypi', 'https://pypi.python.org/pypi?%3Aaction=search&term='.$query.'&submit=search', 'No Packages found', 'No packages were found that match your query', 'icon-cache/pypi.png', 'yes' );
	}
} else {
	$w->result( 'pypi', 'https://pypi.python.org/pypi?%3Aaction=search&term='.$query.'&submit=search', 'Query too short', 'Due to drawbacks in the API, the minimum query length is '.$min_query_length.'.', 'icon-cache/pypi.png', 'yes' );
}

echo $w->toxml();
// ****************
?>