<?php
require 'include.php';
$series=$_GET['series'];
$check=$_GET['check'];
$id=$_GET['id'];
//var_dump($check); die();
if(preg_match("/^true$/",$check)){
	$q="UPDATE serie SET name='$series', enabled='1' WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
}else{
	$q="UPDATE serie SET name='$series', enabled='0' WHERE id='$id'";
	$query=confirm_query($q);var_dump($query);

}

?>