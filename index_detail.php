<?php
require 'include/include.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<link rel="stylesheet" href="css/default.css" />
	<script type="text/javascript" language="javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/slide/jquery.carouFredSel-6.2.1-packed.js"></script>
	<title>Bài tập tốt nghiệp Tháng 6</title>
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<a href='index.php'><img src="images/back.png" /></a>
		</header>
		<div id="main">
			<section class='product_detail'>
		<?php
			$idModel = $_GET['idModel'];
			$idProduct = $_GET['idProduct'];
			$q1 = "SELECT id,name,image,video,promotion,enabled FROM model
							WHERE id='$idModel' AND enabled = '1' LIMIT 1";
			$query1=confirm_query($q1);	
			$model = mysql_fetch_array($query1);
			$q2 = "SELECT id,name,price,info,enabled FROM product
					WHERE id='$idProduct' AND enabled = '1' LIMIT 1";
			$query2=confirm_query($q2);	
			$product = mysql_fetch_array($query2);
			echo "<div id='changeImage'>
					<img src='".$model['image']."' />
				</div>
				<p class='product_model'>".$model['name']." ".$product['name']."</p>
				<span>".$product['price']."<a href='http://www.vatgia.com'>Mua ngay</a></span>
				<div id='left-pane'></div>
				<div id='right-pane'></div>
				<nav id='nav'>
					<ul>
						<li><a onclick=\"load('info','ainfo')\" id='ainfo'>Cấu hình</a></li>
						<li><a onclick=\"load('image','aimage')\" id='aimage'>Gallery</a></li>
						<li><a onclick=\"load('video','avideo')\" id='avideo'>Video</a></li>
						<li><a onclick=\"load('promotion','apromotion')\" id='apromotion'>Khuyến mãi</a></li>
					</ul>
				</nav>
				<script type='text/javascript'>
				$(document).ready(function () {
					$('#right-pane').click(function() {
						$('nav ul').css('left', '-80px');
					});
					$('#left-pane').click(function() {
						$('nav ul').css('left', '0');
					});
					$('.info').addClass('show');
				});
				</script>	
					
				
				<div class='box'>
					<div class='box_product'>
						<p class='product info'>
							".$product['info']."
						</p>
						<p class='product image'>";
				$idImageAll = getIdImageLinkGM($idModel);
				$length=count($idImageAll);
				for($i=0;$i<$length;$i++){
					$idImage=$idImageAll[$i];
					$q3 = "SELECT id,image FROM gallery
						WHERE id='$idImage' AND enabled = '1' LIMIT 1";
					$query3=confirm_query($q3);
					while($gallery = mysql_fetch_array($query3)){
						echo "<a onclick=\"changeImage('".$gallery['image']."')\"> <img src='".$gallery['image']."' /></a>";
					}
				}
						echo"</p>";
					if (empty($model['video']) || !isset($model['video'])){
						echo "<p class='product video'>
							Không có video
						</p>";
					}
					else echo"</p>
						<p class='product video'>
							<iframe width='225' height='135'
							src='".$model['video']."'
							frameborder='0' allowfullscreen></iframe>
						</p>";
						echo "<p class='product promotion'>
							".$model['promotion']."
						</p>
					</div>
				</div>";
		?>	
			</section><!--End Dell Series-->
			
				<script type='text/javascript'>
					function load(divketqua, aid) {
						clickmenu(aid);
						showdiv('product', divketqua);
					}
					function clickmenu(menuid) {
						$("nav a").each(function () {
						$("nav a").css('color', '#838383');
						});
						$('#' + menuid).css({'color': '#6da111','font-weight':'bold'});
					} 
					function showdiv(classdiv, divketqua) {
						$('.' + classdiv).each(function () {
							$('.' + classdiv).removeClass('show');
						});
							$('.' + divketqua).addClass('show');
					}
					function changeImage(id){
						//$('#changeImage img').css('background','url('+id+') no-repeat');
						document.querySelector('#changeImage').innerHTML='<img src='+id+' />';
					}
				</script>
		</div><!--End main-->
		<footer>
			<img src="images/border_colors.png" />
			<div id='notice'>
				<div id='notice2' class='slide'>
		<?php
			$q3 = "SELECT content FROM notice WHERE enabled = '1'";
			$query3=confirm_query($q3);	
			while($notice = mysql_fetch_array($query3)){		
				echo "<p>
					".$notice['content']."
					</p>";
			}
		?>
				</div>
			</div>
			<script type='text/javascript' language='javascript'>
					$('#notice2').carouFredSel({
						scroll: 1,
						easing : "elastic",
						duration : 1000,  
						pauseOnHover: true,
						items: "variable"
					});
			</script>
		</footer>
	</div><!--End wrapper-->
</body>
</html>