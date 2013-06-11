<?php
require 'include.php';
$id=$_GET['id'];
	$q="DELETE FROM gallery WHERE id='$id'";
	$query=confirm_query($q);
	$q="DELETE FROM linkgallerymodel WHERE idmodel='$id'";
	$query=confirm_query($q);
?>