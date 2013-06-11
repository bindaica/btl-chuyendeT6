<?php 
include 'header.php';
require '../include/include.php';
?>
		<div class='index'>
			<h2><a href='index_model.php'>Enter the add new model</a></h2>
			<h3 class="thongbao"></h3>
			<form class='form'>
				<label>Series *</label>
				<select id='idSeries' ">
				<?php
					$q = "SELECT name,id FROM serie";
					$query = mysql_query($q);
					echo "<option value='false' selected >Select One</option>
						  <option value='false' >----------------------------</option>";
					while($row=mysql_fetch_array($query)){
						echo "<option value='".$row['id']."'>".$row['name']."</option>";
					}
				?>
				</select>
				<label>Model Name *</label>
				<input id='name' type='text' />
				<label >Image URL</label>
				<input id='image' type='url' value='http://localhost/PHP2/Microshop/images/name.jpg'/>
				<label>Video URL</label>
				<input id='video' type='url' value='http://www.youtube.com/embed/'/>
				<label>Promotion Info</label>
				<textarea id='promotion' rows='10' cols='50' ></textarea>
				<div class='checkbox'>
					<input id='check' checked type='checkbox' /><span>Enable</span>
				</div>
				<input onclick='process()'  type='button' value='submit'/>
			</form>
			<a href='index_model.php'>Return to model list</a>
		</div>
	</div><!--End container-->
	<script>
			function process(){
				var name = document.getElementById('name').value;
				var image = document.getElementById('image').value;
				var video = document.getElementById('video').value;
				var promotion = document.getElementById('promotion').value;
				var check = document.getElementById('check').checked;
				var x = document.getElementById('idSeries').selectedIndex;
				var idSeries = document.getElementById('idSeries').options[x].value;
			if(idSeries=='false')
				document.querySelector('.thongbao').innerHTML='You must choose a series.';
			else{	
				var data = 'name='+name+'&image='+image+'&video='+video+'&promotion='+promotion+'&check='+check+'&idSeries='+idSeries;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.querySelector('.thongbao').innerHTML='Complete add model!';
						document.getElementById('name').value='';
						document.getElementById('image').value='http://localhost/PHP2/Microshop/images/name.jpg';
						document.getElementById('video').value='http://www.youtube.com/embed/';
						document.getElementById('promotion').value='';
						document.getElementById('check').checked=true;
						document.getElementById('idModel').options[0].selected=true;
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doCreate_model.php?'+data,true);
				xmlhttp.send(); 
			}
			}			
		</script>
</body>
</html>