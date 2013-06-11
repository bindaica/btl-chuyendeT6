<?php
require 'include.php';
$image=$_GET['image'];
$check=$_GET['check'];
$idModel=$_GET['idModel'];
if(preg_match("/^true$/",$check)){
	$q="INSERT INTO gallery (image,enabled) VALUES
	('$image','1')";
	$query=confirm_query($q);
	$idImage = getIdImage($image);
	$q="INSERT INTO linkgallerymodel (idmodel,idimage) VALUES
	('$idModel','$idImage')";
	$query=confirm_query($q);
}else{
	$q="INSERT INTO gallery (image,enabled) VALUES
	('$image','0')";
	$query=confirm_query($q);
	$idImage = getIdImage($image);
	$q="INSERT INTO linkgallerymodel (idmodel,idimage) VALUES
	('$idModel','$idImage')";
	$query=confirm_query($q);
}

?>