<?php
require 'include.php';
$id=$_GET['id'];
	$q="DELETE FROM product WHERE id='$id'";
	$query=confirm_query($q);
	$q="DELETE FROM linkproductmodel WHERE idmodel='$id'";
	$query=confirm_query($q);
?>