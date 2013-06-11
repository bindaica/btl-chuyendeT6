<?php 
require 'header.php';
require '../include/include.php';

?>
		<div class="index" >
			<h2><a href='index_notice.php'>Manage Notices</a></h2>
			<h3 class="thongbao"></h3>
			<div class='show'><?php showNotice() ?></div>
			<div><a href='add_notice.php'>Add new Notices </a></div>
			<div><a href='index_admin.php'>Return to Management System</a></div>
		</div>
	</div><!--End container-->
	<script>
		function process(id,check){
			var data = 'id='+id+'&check='+check;
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					var temp=xmlhttp.responseText;
					document.querySelector('.thongbao').innerHTML='Complete enable';
					console.log(temp);
				}
			}
			xmlhttp.open('GET','../include/doEnabled_notice.php?'+data,true);
			xmlhttp.send(); 
		}	
		function del(id){
			var data = 'id='+id;
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					var temp=xmlhttp.responseText;
					show();
					console.log(temp);
				}
			}
			xmlhttp.open('GET','../include/doDelete_notice.php?'+data,true);
			xmlhttp.send(); 
		}
		function show(){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					document.querySelector('.show').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','../include/showNotice.php',true);
			xmlhttp.send(); 
		}
	</script>
</body>
</html>