<?php
require 'include.php';
$id=$_GET['id'];
	$q="DELETE FROM serie WHERE id='$id'";
	$query=confirm_query($q);
	//delete Model
	$idModelAll=getIdModelLinkMS($id);
	var_dump($idModelAll);
	$length=count($idModelAll);
	for($i=0;$i<$length;$i++){
		$idModel=$idModelAll[$i];
		$q="DELETE FROM model WHERE id='$idModel'";
		$query=confirm_query($q);
		//delete product
		$idProductAll=getIdProductLinkPM($idModel);
		var_dump($idProductAll);
		$length2=count($idProductAll);
		for($i=0;$i<$length2;$i++){
			$idProduct=$idProductAll[$i];
			$q="DELETE FROM product WHERE id='$idProduct'";
			$query=confirm_query($q);
		}
		$q="DELETE FROM linkproductmodel WHERE idmodel='$idModel'";
		$query=confirm_query($q);
		//delete gallery:
		$idImageAll=getIdImageLinkGM($idModel);
		var_dump($idImageAll);
		$length2=count($idImageAll);
		for($i=0;$i<$length2;$i++){
			$idImage=$idImageAll[$i];
			$q="DELETE FROM gallery WHERE id='$idImage'";
			$query=confirm_query($q);
		}
		$q="DELETE FROM linkgallerymodel WHERE idmodel='$idModel'";
		$query=confirm_query($q);
	}
	$q="DELETE FROM linkmodelserie WHERE idseries='$id'";
	$query=confirm_query($q);
?>