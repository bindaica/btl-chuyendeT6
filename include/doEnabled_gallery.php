<?php
require 'include.php';
$check=$_GET['check'];
$id=$_GET['id'];
if($check=='false'){
	$q="UPDATE gallery SET enabled = '0' WHERE id='$id'";
}else{
	$q="UPDATE gallery SET enabled = '1' WHERE id='$id'";
}
	$query=confirm_query($q);var_dump($query);
?>