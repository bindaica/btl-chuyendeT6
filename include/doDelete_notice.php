<?php
require 'include.php';
$id=$_GET['id'];
	$q="DELETE FROM notice WHERE id='$id'";
	$query=confirm_query($q);
?>