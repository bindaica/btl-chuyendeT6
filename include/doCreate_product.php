<?php
require 'include.php';
$name=$_GET['name'];
$price=$_GET['price'];
$info=$_GET['info'];
$check=$_GET['check'];
$idModel=$_GET['idModel'];
//var_dump($idSeries); die();
if(preg_match("/^true$/",$check)){
	$q="INSERT INTO product (name,price,info,enabled) VALUES
	('$name','$price','$info','1')";
	$query=confirm_query($q);
	$idProduct = getIdProduct($name);
	$q="INSERT INTO linkproductmodel (idmodel,idproduct) VALUES
	('$idModel','$idProduct')";
	$query=confirm_query($q);
}else{
	$q="INSERT INTO product (name,price,info,enabled) VALUES
	('$name','$price','$info','0')";
	$query=confirm_query($q);
	$idProduct = getIdProduct($name);
	$q="INSERT INTO linkproductmodel (idmodel,idproduct) VALUES
	('$idModel','$idProduct')";
	$query=confirm_query($q);
}

?>