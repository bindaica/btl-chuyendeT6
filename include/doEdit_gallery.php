<?php
require 'include.php';
$image=$_GET['image'];
$check=$_GET['check'];
$idModel=$_GET['idModel'];
$id=$_GET['id'];
if(preg_match("/^true$/",$check)){
	$q="UPDATE gallery SET image='$image', enabled='1' 
	WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
	$q="UPDATE linkgallerymodel SET idmodel='$idModel'
	WHERE idimage='$id' And idmodel!='$idModel'";
	$query=confirm_query($q); var_dump($query);
}else{
	$q="UPDATE gallery SET image='$image', enabled='0' 
	WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
	$q="UPDATE linkgallerymodel SET idmodel='$idModel'
	WHERE idimage='$id' And idmodel!='$idModel'";
	$query=confirm_query($q); var_dump($query);
}

?>