<?php
require 'include.php';
$series=$_GET['series'];
$check=$_GET['check'];
//var_dump($check); die();
if(preg_match("/^true$/",$check)){
	$q="INSERT INTO serie (name,enabled) VALUES('$series','1')";
	$query=confirm_query($q);
}else{
	$q="INSERT INTO serie (name,enabled) VALUES('$series','0')";
	$query=confirm_query($q);

}

?>