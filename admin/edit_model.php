<?php 
include 'header.php';
require '../include/include.php';
?>
		
		<div class='index'>
			<h2><a href='index_model.php'>Edit the model</a></h2>
			<h3 class="thongbao"></h3>
				<?php 
					if($_GET['id']){
						$id=$_GET['id'];
						showEditModel($id);
					}else echo 'lỗi ID';
				
				?>
			<a href='index_model.php'>Return to model list</a>
		</div>
		<script>
			function process(){
				var x = document.getElementById('idSeries').selectedIndex;
				var idSeries = document.getElementById('idSeries').options[x].value;
				var name = document.getElementById('name').value;
				var image = document.getElementById('image').value;
				var video = document.getElementById('video').value;
				var promotion = document.getElementById('promotion').value;
				var check = document.getElementById('check').checked;
				var id = document.getElementById('check').value;
				if(idSeries=='false')
					document.querySelector('.thongbao').innerHTML='You must choose a series.';
				else{
					var data = 'idSeries='+idSeries+'&name='+name+'&image='+image+'&video='+video+'&promotion='+promotion+'&check='+check+'&id='+id;
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if(xmlhttp.readyState==4 && xmlhttp.status==200){
							var temp=xmlhttp.responseText;
							document.location = 'index_model.php';
							console.log(temp);
						}
					}
					xmlhttp.open('GET','../include/doEdit_model.php?'+data,true);
					xmlhttp.send(); 
				}
			}			
			</script>
	</div><!--End container-->
</body>
</html>