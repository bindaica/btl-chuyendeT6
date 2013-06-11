<?php
require 'include.php';
$content=$_GET['content'];
$check=$_GET['check'];
if(preg_match("/^true$/",$check)){
	$q="INSERT INTO notice (content,enabled) VALUES('$content','1')";
}else{
	$q="INSERT INTO notice (content,enabled) VALUES('$content','0')";
}
	$query=confirm_query($q);
?>