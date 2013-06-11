<?php 
include 'header.php';
require '../include/include.php';
?>
		
		<div class='index'>
			<h2><a href='index_product.php'>Edit the Product</a></h2>
			<h3 class="thongbao"></h3>
				<?php 
					if($_GET['id']){
						$id=$_GET['id'];//die($id);
						showEditProduct($id);
					}else echo 'lỗi ID';
				
				?>
			<a href='index_product.php'>Return to product list</a>
		</div>
		<script>
			function process(){
				var name = document.getElementById('name').value;
				var price = document.getElementById('price').value;
				var info = document.getElementById('info').value;
				var check = document.getElementById('check').checked;
				var id = document.getElementById('check').value;
				var x = document.getElementById('idModel').selectedIndex;
				var idModel = document.getElementById('idModel').options[x].value;
				if(idModel=='false')
					document.querySelector('.thongbao').innerHTML='You must choose a model.';
				else{	
					var data = 'name='+name+'&price='+price+'&info='+info+'&check='+check+'&idModel='+idModel+'&id='+id;
						xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function(){
							if(xmlhttp.readyState==4 && xmlhttp.status==200){
								var temp=xmlhttp.responseText;
								document.location = 'index_product.php';
								console.log(temp);
							}
						}
						xmlhttp.open('GET','../include/doEdit_product.php?'+data,true);
						xmlhttp.send(); 
				}
			}			
			</script>
	</div><!--End container-->
</body>
</html>