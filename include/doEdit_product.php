<?php
require 'include.php';
$name=$_GET['name'];
$price=$_GET['price'];
$info=$_GET['info'];
$check=$_GET['check'];
$idModel=$_GET['idModel'];
$id=$_GET['id'];
if(preg_match("/^true$/",$check)){
	$q="UPDATE product SET name='$name',price='$price',info='$info', enabled='1' 
	WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
	$q="UPDATE linkproductmodel SET idmodel='$idModel'
	WHERE idproduct='$id' And idmodel!='$idModel'";
	$query=confirm_query($q); var_dump($query);
}else{
	$q="UPDATE product SET name='$name',price='$price',info='$info', enabled='0' 
	WHERE id='$id'";
	$query=confirm_query($q); var_dump($query);
	$q="UPDATE linkproductmodel SET idmodel='$idModel'
	WHERE idproduct='$id' And idmodel!='$idModel'";
	$query=confirm_query($q); var_dump($query);
}

?>