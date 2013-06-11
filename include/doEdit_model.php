<?php
require 'include.php';
$idSeries=$_GET['idSeries'];
$name=$_GET['name'];
$image=$_GET['image'];
$video=$_GET['video'];
$promotion=$_GET['promotion'];
$check=$_GET['check'];
$id=$_GET['id'];
//var_dump($check); die();
if(preg_match("/^true$/",$check)){
	$q="UPDATE model SET name='$name',image='$image',video='$video',promotion='$promotion', enabled='1' 
	WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
	$q="UPDATE linkmodelserie SET idSeries='$idSeries'
	WHERE idmodel='$id' And idseries!='$idSeries'";
	$query=confirm_query($q); var_dump($query);
}else{
	$q="UPDATE model SET name='$name',image='$image',video='$video',promotion='$promotion', enabled='0' 
	WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
	$q="UPDATE linkmodelserie SET idSeries='$idSeries'
	WHERE idmodel='$id' And idseries!='$idSeries'";
	$query=confirm_query($q); var_dump($query);
}

?>