<?php 
include 'header.php';
require '../include/include.php';
?>
		
		<div class='index'>
			<h2><a href='index_gallery.php'>Edit the Gallery</a></h2>
			<h3 class="thongbao"></h3>
				<?php 
					if($_GET['id']){
						$id=$_GET['id'];//die($id);
						showEditGallery($id);
					}else echo 'lỗi ID';
				
				?>
			<div><a href='index_gallery.php'>Return to gallery list</a></div>
		</div>
		<script>
			function process(){
				var image = document.getElementById('image').value;
				var check = document.getElementById('check').checked;
				var id = document.getElementById('check').value;
				var x = document.getElementById('idModel').selectedIndex;
				var idModel = document.getElementById('idModel').options[x].value;
				if(idModel=='false')
					document.querySelector('.thongbao').innerHTML='You must choose a model.';
				else{	
					var data = 'image='+image+'&check='+check+'&idModel='+idModel+'&id='+id;
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if(xmlhttp.readyState==4 && xmlhttp.status==200){
							var temp=xmlhttp.responseText;
							document.location = 'index_gallery.php';
							console.log(temp);
						}
					}
					xmlhttp.open('GET','../include/doEdit_gallery.php?'+data,true);
					xmlhttp.send(); 
				}
			}				
			</script>
	</div><!--End container-->
</body>
</html>