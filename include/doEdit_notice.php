<?php
require 'include.php';
$notice=$_GET['notice'];
$check=$_GET['check'];
$id=$_GET['id'];
if(preg_match("/^true$/",$check)){
	$q="UPDATE notice SET content='$notice', enabled='1' WHERE id='$id'";
}else{
	$q="UPDATE notice SET content='$notice', enabled='1' WHERE id='$id'";
}
	$query=confirm_query($q);var_dump($query);

?>