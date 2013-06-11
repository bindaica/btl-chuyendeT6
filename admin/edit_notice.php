<?php 
include 'header.php';
require '../include/include.php';
?>
		<div class='index'>
			<h2><a href='index_notice.php'>Enter the new series</a></h2>
		<?php 
			if($_GET['id']){
				$id=$_GET['id'];//die($id);
				showEditNotice($id);
			}else echo 'lỗi ID';
		
		?>
		<div><a href='index_series.php'>Return to series list</a></div>
		</div>
		<script>
			function process(){
				var notice = document.getElementById('notice').value;
				var check = document.getElementById('check').checked;
				var id = document.getElementById('check').value;
				var data = 'notice='+notice+'&check='+check+'&id='+id;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.location = 'index_notice.php';
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doEdit_notice.php?'+data,true);
				xmlhttp.send(); 			
			}			
			</script>
	</div><!--End container-->
</body>
</html>