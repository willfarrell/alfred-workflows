<?php

// Apache
$name = "Apache";
$id = "apache";
$commands = array(
	"start" => "sudo apachectl start",
	"stop" => "sudo apachectl stop",
	"restart" => "sudo apachectl restart",
	"status" => "sudo apachectl status"
);

// MySQL
$name = "MySQL";
$id = "mysql";
$commands = array(
	"start" => "sudo mysqld start",
	"stop" => "sudo mysqld stop",
	"restart" => "sudo mysqld restart",
	"status" => "sudo mysqld status",
	"install" => "sudo mysqld status"
);


// ****************
require_once("print.php");
// ****************
?>