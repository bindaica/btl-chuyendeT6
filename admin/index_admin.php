<?php 
session_start();
include 'header.php';
require '../include/include.php';
if(!isset($_SESSION['name'])) {	
	header('location: ../index_logged.php'); 
}else if($_SESSION['name']!='admin') header('location: ../index_logged.php'); 
?>

		<div class='index'>
			<h2><a href='index_admin.php'>Microshop Management System</a></h2>
			<nav>
				<ul>
					<li><a href="index_product.php">Manage Products</a></li>
					<li><a href="index_gallery.php">Manage Image Gallery</a></li>
					<li><a href="index_model.php">Manage Models</a></li>
					<li><a href="index_series.php">Manage Series</a></li>
					<li><a href="index_notice.php">Manage Notices</a></li>
				</ul>
			</nav>
		</div>
	</div><!--End container-->
</body>
</html>