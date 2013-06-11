<?php 
include 'header.php';
require '../include/include.php';
?>
		<div class="index" >
			<h2><a href='index_gallery.php'>Enter the add new image</a></h2>
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
				<label >Image URL</label>
				<input id='image' type='url' value='http://localhost/PHP2/Microshop/images/hinh1.jpg'/>
				<div class='checkbox'>
					<input id='check' checked type='checkbox' /><span>Enable</span>
				</div>
				<input onclick='process()'  type='button' value='submit'/>
			</form>
			<div><a href='index_gallery.php'>Return to gallery list</a></div>
		</div>
		<script>
			function process(){
				var image = document.getElementById('image').value;
				var check = document.getElementById('check').checked;
				var x = document.getElementById('idModel').selectedIndex;
				var idModel = document.getElementById('idModel').options[x].value;
			if(idModel=='false')
				document.querySelector('.thongbao').innerHTML='You must choose a model.';
			else{	
				var data = 'image='+image+'&check='+check+'&idModel='+idModel;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.querySelector('.thongbao').innerHTML='Complete add gallery!';
						document.getElementById('image').value='http://localhost/PHP2/Microshop/images/hinh1.jpg';
						document.getElementById('check').checked=true;
						document.getElementById('idModel').options[0].selected=true;
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doCreate_gallery.php?'+data,true);
				xmlhttp.send(); 
			}
			}			
			</script>
	</div><!--End container-->
</body>
</html>