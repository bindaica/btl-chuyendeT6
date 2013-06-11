<?php
require 'include.php';
$id=$_GET['id'];
	$q="DELETE FROM model WHERE id='$id'";
	$query=confirm_query($q);
	//delete product
	$idProductAll=getIdProductLinkPM($id);
	var_dump($idProductAll);
	$length=count($idProductAll);
	for($i=0;$i<$length;$i++){
		$idProduct=$idProductAll[$i];
		$q="DELETE FROM product WHERE id='$idProduct'";
		$query=confirm_query($q);
	}
	$q="DELETE FROM linkproductmodel WHERE idmodel='$id'";
	$query=confirm_query($q);
	//delete gallery:
	$idImageAll=getIdImageLinkGM($id);
	var_dump($idImageAll);
	$length=count($idImageAll);
	for($i=0;$i<$length;$i++){
		$idImage=$idImageAll[$i];
		$q="DELETE FROM gallery WHERE id='$idImage'";
		$query=confirm_query($q);
	}
	$q="DELETE FROM linkgallerymodel WHERE idmodel='$id'";
	$query=confirm_query($q);
?>