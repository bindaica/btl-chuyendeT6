<?php
require 'include.php';
$name=$_GET['name'];
$image=$_GET['image'];
$video=$_GET['video'];
$promotion=$_GET['promotion'];
$check=$_GET['check'];
$idSeries=$_GET['idSeries'];
//var_dump($idSeries); die();
if(preg_match("/^true$/",$check)){
	$q="INSERT INTO model (name,image,video,promotion,enabled) VALUES
	('$name','$image','$video','$promotion','1')";
	$query=confirm_query($q);
	$idModel = getIdModel($name);
	$q="INSERT INTO linkmodelserie (idmodel,idseries) VALUES
	('$idModel','$idSeries')";
	$query=confirm_query($q);
}else{
	$q="INSERT INTO model (name,image,video,promotion,enabled) VALUES
	('$name','$image','$video','$promotion','0')";
	$query=confirm_query($q);
	$idModel = getIdModel($name);
	$q="INSERT INTO linkmodelserie (idmodel,idseries) VALUES
	('$idModel','$idSeries')";
	$query=confirm_query($q);
}

?>