<?php
// ****************
//error_reporting(0);
require_once('workflows.php');

$allowed = array("start", "stop", "restart");

$w = new Workflows();
foreach($commands as $key => $command) {
	if (in_array($key, $allowed)) {
		$w->result( "$id-$key", $command, ucfirst($key)." $name", "Run `$command`", "icon-cache/$id.png" );
	} else if ($key == 'status') {
		//system($command, $status);
		//print_r($status);
		// echo status
		$status = "GOOD";
		$w->result( "$id-$key", "$command 2>&1", "Status: $status", "Ran `$command`", "icon-cache/$id.png" );
	} else if ($key == 'install') {
		$w->result( "$id-$key", $command, "Install $name", $command, "icon-cache/$id.png" );
	}
}


echo $w->toxml();
// ****************
?>