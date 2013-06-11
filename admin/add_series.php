<?php 
include 'header.php';
require '../include/include.php';
?>
		<div class="index" >
			<h2><a href='index_series.php'>Enter the new Series</a></h2>
			<h3 class="thongbao"></h3>
			<form id='formAddserie'>
				<label>Series Name *</label>
				<input id='series' type='text' />
				<div class='checkbox'>
					<input id='check' type='checkbox' checked='true' value='ok' /><span>Enable</span>
				</div>
				
				<input onclick='process()' type='button' value='submit'/>
			</form>
			<a href='index_series.php'>Return to Series list</a>
		<script>
			function process(){
				var series = document.getElementById('series').value;
				var check = document.getElementById('check').checked;
				var data = 'series='+series+'&check='+check;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.querySelector('.thongbao').innerHTML="Đã add series!";
						document.getElementById('series').value="";
						document.getElementById('check').checked='true';
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doCreate_series.php?'+data,true);
				xmlhttp.send(); 
			
			}			
			</script>
	</div><!--End container-->
</body>
</html>