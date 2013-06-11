<?php
	require 'include.php';
	$id = $_GET['id'];
	$image = getImage($id);
	echo $image;
?>