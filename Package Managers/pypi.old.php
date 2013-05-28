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
		$downloads = strip_tags($matches[1][1]);
		$details = strip_tags($matches[1][2]);
		
		$w->result( $title, 'https://crate.io'.$url, $title."    ".$downloads, $details, 'icon-cache/pypi.png' );
		if (!--$count) { break; }
	}
	
	if ( count( $w->results() ) == 0) {
		if($query) {
			$w->result( 'pypi', 'https://pypi.python.org/pypi?%3Aaction=search&term='.$query.'&submit=search', 'No packages were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/pypi.png' );
		}
		$w->result( 'pypi-www', 'https://pypi.python.org/', 'Go to the website', 'https://pypi.python.org', 'icon-cache/pypi.png' );
	}
} else {
	$w->result( 'pypi', null, 'Query too short', 'Due to drawbacks in the API, the minimum query length is '.$min_query_length.'.', 'icon-cache/pypi.png', 'no' );
	$w->result( 'pypi-www', 'https://pypi.python.org/', 'Go to the website', 'https://pypi.python.org', 'icon-cache/pypi.png' );
}

echo $w->toxml();
// ****************
?>