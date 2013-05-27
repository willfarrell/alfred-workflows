<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );
// http://search.maven.org/#artifactdetails%7Corg.jibx.schema.org.opentravel._2011A%7Copentravel-2011A-reactor%7C1.1.0%7Cpom
// http://search.maven.org/#artifactdetails%7Corg.jibx.schema.org.opentravel._2011A%7Copentravel-2011A-reactor%7C.pom

$query = "a";
// ****************
//error_reporting(0);
require_once('cache.php');
require_once('workflows.php');

$cache = new Cache();
$w = new Workflows();
//$query = urlencode( "{query}" );

$pkgs = $cache->get_query_json('maven', $query, 'http://search.maven.org/solrsearch/select?q='.$query.'&rows=10&wt=json');

foreach($pkgs->response->docs as $item) {
	$title = $item->a.' ('.$item->latestVersion.')';
	$url = 'http://search.maven.org/#artifactdetails%7C'.$item->g.'%7C'.$item->a.'%7C'.$item->latestVersion.'%7C'.$item->p;
	$details = 'GroupId: '.$item->id;
	$w->result( $title, $url, $title, $details, 'icon-cache/maven.png' );
}

if ( count( $w->results() ) == 0) {
	if($query) {
		$w->result( 'maven', 'http://mvnrepository.com/search.html?query='.$query, 'No libraries were found that matched "'.$query.'"', 'Click to see the results for yourself', 'icon-cache/maven.png' );
	}
	$w->result( 'maven-www', 'http://mvnrepository.com/', 'Go to the website', 'http://mvnrepository.com', 'icon-cache/maven.png' );
}

echo $w->toxml();
// ****************
?>