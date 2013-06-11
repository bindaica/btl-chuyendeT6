<?php
$servername='localhost';
	$dbusername='root';
	$dbpassword='';
	$dbname='microshopdb';
	$table_prefix=''; 

	$dbc=mysql_connect($servername,$dbusername,$dbpassword) or die ("Could not connect to localhost");
	if(!$dbc) {
       trigger_error("Could not connect to DB: " . mysql_connect_error());
    }
	$dbn=mysql_select_db($dbname,$dbc) or die("not connect name data base");
?>