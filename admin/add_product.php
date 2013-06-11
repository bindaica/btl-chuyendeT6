<?php 
include 'header.php';
require '../include/include.php';
?>
			<div class="index model" >
				<h2><a href='index_product.php'>Enter the new product</a></h2>
				<h3 class="thongbao"></h3>
				<form class='form'>
					<label>Model *</label>
					<select id='idModel'>
					<?php
						$q = "SELECT name,id FROM model";
						$query = mysql_query($q);
						echo "<option value='false' selected>Select One</option>
							  <option value='false'>----------------------------</option>";
						while($row=mysql_fetch_array($query)){
							echo "<option value='".$row['id']."'>".$row['name']."</option>";
						}
					?>
					</select>
					<label>Product code *</label>
					<input id='name' type='text' />
					<label>Price</label>
					<input id='price' type='text' />
					<label>Configuaration Info</label>
					<textarea id='info' rows='10' cols='50' ></textarea>
					<div class='checkbox'>
						<input id='check' type='checkbox' checked /><span>Enable</span>
					</div>
					
					<input onclick='process()' type='button' value='submit' />
				</form>
				<div><a href='index_product.php'>Return to product list</a><div>
			</div>
		</div><!--End container-->
		<script>
			function process(){
				var name = document.getElementById('name').value;
				var price = document.getElementById('price').value;
				var info = document.getElementById('info').value;
				var check = document.getElementById('check').checked;
				var x = document.getElementById('idModel').selectedIndex;
				var idModel = document.getElementById('idModel').options[x].value;
			if(idModel=='false')
				document.querySelector('.thongbao').innerHTML='You must choose a model.';
			else{	
				var data = 'name='+name+'&price='+price+'&info='+info+'&check='+check+'&idModel='+idModel;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.querySelector('.thongbao').innerHTML='Complete add product!';
						document.getElementById('name').value='';
						document.getElementById('price').value='';
						document.getElementById('info').value='';
						document.getElementById('check').checked=true; 
						document.getElementById('idModel').options[0].selected=true;
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doCreate_product.php?'+data,true);
				xmlhttp.send(); 
			}
			}				
			</script>
	</div><!--End container-->
</body>
</html>