<?php

//header ("Content-Type:text/xml");
//syslog(LOG_ERR, );
// http://search.maven.org/#artifactdetails%7Corg.jibx.schema.org.opentravel._2011A%7Copentravel-2011A-reactor%7C1.1.0%7Cpom
// http://search.maven.org/#artifactdetails%7Corg.jibx.schema.org.opentravel._2011A%7Copentravel-2011A-reactor%7C.pom

$query = "ap";
// ****************
require_once('workflows.php');

$w = new Workflows();
//$query = urlencode( "{query}" );

if ($query) {
	$data = $w->request('http://search.maven.org/solrsearch/select?q='.$query.'&rows=10&wt=json');
	$json = json_decode($data);
	
	foreach($json->response->docs as $item) {
		$title = $item->a.' ('.$item->latestVersion.')';
		$url = 'http://search.maven.org/#artifactdetails%7C'.$item->g.'%7C'.$item->a.'%7C'.$item->latestVersion.'%7C'.$item->p;
		$details = 'GroupId: '.$item->id;
		$w->result( $title, $url, $title, $details, 'maven.png' );
	}
}

if ( count( $w->results() ) == 0 ) {
	$w->result( 'maven', 'http://mvnrepository.com/search.html?query='.$query, 'No Library found', 'No libraries were found that match your query', 'maven.png', 'yes' );
}

echo $w->toxml();
// ****************
?>