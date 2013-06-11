<?php 
include 'header.php';
require '../include/include.php';
?>
		<h2>Enter the new series</h2>
		<?php 
			if($_GET['id']){
				$id=$_GET['id'];//die($id);
				showEditSeries($id);
			}else echo 'lỗi ID';
		
		?>
		<a href='index_series.php'>Return to series list</a>
		<script>
			function process(){
				var series = document.getElementById('series').value;
				var check = document.getElementById('check').checked;
				var id = document.getElementById('check').value;
				var data = 'series='+series+'&check='+check+'&id='+id;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.location = 'index_series.php';
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doEdit_series.php?'+data,true);
				xmlhttp.send(); 			
			}			
			</script>
	</div><!--End container-->
</body>
</html>