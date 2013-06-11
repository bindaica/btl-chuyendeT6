<?php
require 'include/include.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<link rel="stylesheet" href="css/default.css" />
	<title>Bài tập tốt nghiệp Tháng 6</title>
	<!-- include jQuery + carouFredSel plugin -->
	<script type="text/javascript" language="javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/slide/jquery.carouFredSel-6.2.1-packed.js"></script>

	<!-- optionally include helper plugins -->
	<script type="text/javascript" language="javascript" src="js/slide/helper-plugins/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/slide/helper-plugins/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/slide/helper-plugins/jquery.transit.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/slide/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

	
</head>
<body>
	<div id="wrapper">
		<header id="header"></header>
		<div id="main">
		<?php
			$q = "SELECT id,name FROM serie WHERE enabled='1'";
			$query=confirm_query($q);
			$temp=0;
			while($series = mysql_fetch_array($query)){
			$temp++;
			 echo "<section class='product_box' >
					<header>
						<h1>".$series['name']."</h1>
					</header>
					<div class='left-pane'id='scroll-left".$temp."'></div>
					<div class='right-pane' id='scroll-right".$temp."'></div>
					<div class='product-slider' >
						<div class='slide slide".$temp."' >";
				$idSeries = $series['id'];
				$idModelAll = getIdModelLinkMS($idSeries);
				$length=count($idModelAll);
				for($i=0;$i<$length;$i++){
					$idModel=$idModelAll[$i];
					$q1 = "SELECT id,name,image,video,promotion,enabled FROM model
							WHERE id='$idModel' AND enabled = '1'";
					$query1=confirm_query($q1);	
					while($model = mysql_fetch_array($query1)){
						$idModel = $model['id'];
						$idProductAll=getIdProductLinkPM($idModel);
						$length2=count($idProductAll);
						for($j=0;$j<$length2;$j++){
							$idProduct=$idProductAll[$j];
							$q2 = "SELECT id,name,price,info,enabled FROM product
									WHERE id='$idProduct' AND enabled = '1'";
							$query2=confirm_query($q2);	
							while($product = mysql_fetch_array($query2)){
								echo"<article>
								<a href='index_detail.php?idModel=".$model['id']."&idProduct=".$product['id']."'><img src='".$model['image']."' /></a>
								<a href='index_detail.php?idModel=".$model['id']."&idProduct=".$product['id']."'>".$model['name']."</a>
								<span>".$product['price']."</span>
								</article>";
							}													
						}
					}
				}
				echo"</div>
					</div><!--End product-slider-->
				</section><!--End ".$series['name']."-->
				<script type='text/javascript' language='javascript'>
					$('.slide".$temp."').carouFredSel({
						scroll : {
							items : 1,
							pauseOnHover: true
						},
						prev : '#scroll-left".$temp."',

						next : '#scroll-right".$temp."'				
					});
				</script>
				";
			}					
		?>		
		</div><!--End main-->
		<footer>
			<img src="images/border_colors.png" />
			<div id='notice'>
				<div id='notice2' class='slide'>
			<?php
				$q = "SELECT content FROM notice WHERE enabled = '1'";
				$query=confirm_query($q);
				while($notice = mysql_fetch_array($query)){
					echo"<p>
					".$notice['content']."
					</p>";
				}
			?>
				</div>
			</div>
			<script type='text/javascript' language='javascript'>
					$('#notice2').carouFredSel({
						scroll : {
							items : 1,
							easing : "elastic",
							duration : 2000,  
							pauseOnHover: true
						}		
					});
			</script>
		</footer>
	</div><!--End wrapper-->
</body>
</html>