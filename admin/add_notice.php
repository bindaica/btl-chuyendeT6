<?php 
include 'header.php';
require '../include/include.php';
?>
		<div class="index" >
			<h2><a href='index_notice.php'>Enter the new Notices</a></h2>
			<h3 class="thongbao"></h3>
			<form class='form'>
				<label>Notice content *</label>
				<textarea id='content'></textarea>
				<div class='checkbox'>
					<input id='check' type='checkbox' checked value='ok' /><span>Enable</span>
				</div>
				<input onclick='process()' type='button' value='submit'/>
			</form>
			<a href='index_notice.php'>Return to Notices list</a>
		<script>
			function process(){
				var content = document.getElementById('content').value;
				var check = document.getElementById('check').checked;
				var data = 'content='+content+'&check='+check;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						var temp=xmlhttp.responseText;
						document.querySelector('.thongbao').innerHTML="Complete add content!";
						document.getElementById('content').value="";
						document.getElementById('check').checked='true';
						console.log(temp);
					}
				}
				xmlhttp.open('GET','../include/doCreate_notice.php?'+data,true);
				xmlhttp.send(); 
			}			
			</script>
	</div><!--End container-->
</body>
</html>