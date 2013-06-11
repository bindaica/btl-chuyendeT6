<?php
require 'include.php';
$check=$_GET['check'];
$id=$_GET['id'];
if($check=='false'){
	$q="UPDATE serie SET Enabled = '0' WHERE id='$id'";
}else{
	$q="UPDATE serie SET Enabled = '1' WHERE id='$id'";
}
	$query=confirm_query($q);
?>