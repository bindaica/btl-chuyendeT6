<?php
	define('1', TRUE);
	define('0', FALSE);
    define('LIVE', FALSE); // FALSE la dang trong qua trinh phat trien | TRUE la dang trong production
// Kiem tra xem ket qua tra ve co dung hay khong?
	function confirm_query($q) {
		$query=mysql_query($q);
			if(!$query && !LIVE) {
				return ("Query {$q} \n<br/> MySQL Error: " .mysql_error());
			} 
		return $query;
	} 
//Series:
	//GET:
	function getIdSeries($name){
		$q = "SELECT id FROM serie WHERE name='$name' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['id'];
	}
	//showseries:
	function showSeries(){
		$q = "SELECT id,name,enabled FROM serie ";//die($q);
		$query=confirm_query($q);//var_dump($query);
		echo "<table border='1'>";
		echo "<tr><th>Series</th><th>Enabled</th><th>Options</th>";
		while($row = mysql_fetch_array($query)){	
			if($row['enabled']=='0'){
				echo "<tr><td>".$row['name']."</td><td><input  value='".$row['id']."'
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}else{
				echo "<tr><td>".$row['name']."</td><td><input  value='".$row['id']."' 
				checked onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}
			echo "<td><a href='edit_series.php?id=".$row['id']."'>Edit</a>&#124;
			<input type='button' onclick='del(name)' name='".$row['id']."' class='delete' value='Delete' /></td></tr>";
		}
		echo "</table>";
	}
	//End: showseries
	//show edit Series
	function showEditSeries($id){
		$q = "SELECT id,name,enabled FROM serie WHERE id='$id' LIMIT 1";
		$query=confirm_query($q);
		while($row = mysql_fetch_array($query)){	
			
			echo "<form id='formEditSeries'>
				<label>Series Name *</label>
				<input id='series' type='text' value='".$row['name']."' />
				<div class='checkbox'>";
			if($row['enabled']=='0')
				echo "<input id='check' type='checkbox' value='".$row['id']."' /><span>Enable</span>";
			else	
				echo "<input id='check' type='checkbox' checked value='".$row['id']."' /><span>Enable</span>";
			echo "</div>			
				<input onclick='process()' type='button' value='submit'/>
			</form>";
		}
	}
	//End: show edit Series
//Model:
	function getIdModel($name){
		$q = "SELECT id FROM model WHERE name='$name' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['id'];
	}
	//Show Model:
	function showModel(){
	//Phan trang:
	$nLine= 4;
	$p=0;
	if(isset($_GET['p'])) $p=$_GET['p'];
	$start = $p*$nLine;
	$q = "SELECT COUNT(id) FROM model";
	$query = confirm_query($q);
	$total = mysql_fetch_array($query);
	$total = $total[0];
	$nPage = floor($total/$nLine)+1;
	echo "Page: ";
	for($i=0;$i<$nPage;$i++) 
		echo "<a href='index_model.php?p=".$i."'>".($i+1) ."</a>";
	
		$q1 = "SELECT id,name,image,video,promotion,enabled FROM model LIMIT $start,$nLine";
		$query1=confirm_query($q1);//var_dump($query);		
		echo "<table border='1'>";
		echo "<tr><th>Series</th><th>Model</th><th>Image</th><th>Video</th><th>Promotion</th><th>Enabled</th><th>Options</th>";
		while($row = mysql_fetch_array($query1)){
			$idSeries=getIdSeriesLinkMS($row['id']);			
			$q2 = "SELECT name FROM serie WHERE id='$idSeries'";
			$query2=confirm_query($q2);
			$series = mysql_fetch_array($query2);
			$series = $series['name'];
			if(!empty($row['video'])){
				$row['video']="<img src='../images/youtube.jpg' />";
			}else $row['video']="Not exits";
			if($row['enabled']=='0'){
				echo "<tr><td>".$series."</td><td>".$row['name']."</td>
				<td><img class='image_model' src='".$row['image']."' /></td><td>".$row['video']."</td>
				<td>".$row['promotion']."</td><td><input  value='".$row['id']."'
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}else{
				echo "<tr><td>".$series."</td><td>".$row['name']."</td>
				<td><img class='image_model' src='".$row['image']."' /></td><td>".$row['video']."</td>
				<td>".$row['promotion']."</td><td><input  value='".$row['id']."'
				checked onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}
			echo "<td><a href='edit_model.php?id=".$row['id']."'>Edit</a>&#124;
			<input type='button' onclick='del(name)' name='".$row['id']."' class='delete' value='Delete' /></td></tr>";
		}
		echo "</table>";
		echo "</br>Page: ";
	for($i=0;$i<$nPage;$i++) 
		echo "<a href='index_model.php?p=".$i."'>".($i+1) ."</a>";
	}
	//End Show Model
	//show edit Model
	function showEditModel($idModel){
		$idSeries=getIdSeriesLinkMS($idModel);
		$q2 = "SELECT name,id FROM serie";
		$query2 = mysql_query($q2);		
		echo "<form class='form'>
			<label>Series *</label>
			<select id='idSeries' >
				<option value='false'>Select One</option>
				<option value='false'>----------------------------</option>";
		while($row2=mysql_fetch_array($query2)){
			if($row2['id']==$idSeries){
				echo "<option value='".$row2['id']."' selected>".$row2['name']."</option>";
			}
			else
			echo "<option value='".$row2['id']."'>".$row2['name']."</option>";
			
		}
		echo "</select>";
		$q = "SELECT id,name,image,video,promotion,enabled FROM model WHERE id='$idModel'";
		$query=confirm_query($q);
		$row = mysql_fetch_array($query);				
			echo "<label>Model Name *</label>
				<input id='name' type='text' value='".$row['name']."' />
				<label>Image Url </label>
				<input id='image' type='url' value='".$row['image']."' />
				<label>Video Url </label>
				<input id='video' type='url' value='".$row['video']."' />
				<label>Promotion Info</label>
				<textarea id='promotion' rows='10' cols='50' >".$row['promotion']."</textarea>
				<div class='checkbox'>";
			if($row['enabled']=='0')
				echo "<input id='check' type='checkbox' value='".$row['id']."' /><span>Enable</span>";
			else	
				echo "<input id='check' type='checkbox' checked value='".$row['id']."' /><span>Enable</span>";
			echo "</div>			
				<input onclick='process()' type='button' value='submit'/>
			</form>";
		
	}
	//End: show edit Model
//End: Model
//Product:
	//get ID product:
	function getIdProduct($name){
		$q = "SELECT id FROM product WHERE name='$name' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['id'];
	}
	//Show Product:
	function showProduct(){
	//Phan trang:
	$nLine= 4;
	$p=0;
	if(isset($_GET['p'])) $p=$_GET['p'];
	$start = $p*$nLine;
	$q = "SELECT COUNT(id) FROM product";
	$query = confirm_query($q);
	$total = mysql_fetch_array($query);
	$total = $total[0];
	$nPage = floor($total/$nLine)+1;
	echo "Page: ";
	for($i=0;$i<$nPage;$i++) 
		echo "<a href='index_product.php?p=".$i."'>".($i+1) ."</a>";
		
		$q1 = "SELECT id,name,price,info,enabled FROM product LIMIT $start,$nLine";
		$query1=confirm_query($q1);//var_dump($query);		
		echo "<table border='1'>";
		echo "<tr><th>Model</th><th>Code</th><th>Price</th><th>Configuration Info</th><th>Enabled</th><th>Options</th>";
		while($row = mysql_fetch_array($query1)){
			$idModel=getIdModelLinkPM($row['id']);			
			$q2 = "SELECT name FROM model WHERE id='$idModel' LIMIT 1";
			$query2=confirm_query($q2);
			$model = mysql_fetch_array($query2);
			$model = $model['name'];
			if(!empty($row['video'])){
				$row['video']="<img src='../images/youtube.jpg' />";
			}else $row['video']="Not exits";
			if($row['enabled']=='0'){
				echo "<tr><td>".$model."</td><td>".$row['name']."</td>
				<td>".$row['price']."</td><td>".$row['info']."</td>
				<td><input  value='".$row['id']."'
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}else{
				echo "<tr><td>".$model."</td><td>".$row['name']."</td>
				<td>".$row['price']."</td><td>".$row['info']."</td>
				<td><input  value='".$row['id']."' checked
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}
			echo "<td><a href='edit_product.php?id=".$row['id']."'>Edit</a>&#124;
			<input type='button' onclick='del(name)' name='".$row['id']."' class='delete' value='Delete' /></td></tr>";
		}
		echo "</table>";
		echo "</br>Page: ";
	for($i=0;$i<$nPage;$i++) 
		echo "<a href='index_product.php?p=".$i."'>".($i+1) ."</a>";
	}
	//End: Show Product:
	//show edit Product
	function showEditProduct($idProduct){
		$idModel=getIdModelLinkPM($idProduct);
		$q2 = "SELECT name,id FROM model";
		$query2 = mysql_query($q2);		
		echo "<form class='form'>
			<label>Model *</label>
			<select id='idModel' >
				<option value='false'>Select One</option>
				<option value='false'>----------------------------</option>";
		while($row2=mysql_fetch_array($query2)){
			if($row2['id']==$idModel){
				echo "<option value='".$row2['id']."' selected>".$row2['name']."</option>";
			}
			else
			echo "<option value='".$row2['id']."'>".$row2['name']."</option>";
			
		}
		echo "</select>";
		$q = "SELECT id,name,price,info,enabled FROM product WHERE id='$idProduct'";
		$query=confirm_query($q);
		$row = mysql_fetch_array($query);				
			echo "<label>Product code *</label>
					<input id='name' type='text' value='".$row['name']."'/>
					<label>Price</label>
					<input id='price' type='text' value='".$row['price']."'/>
					<label>Configuaration Info</label>
					<textarea id='info' rows='10' cols='50' >".$row['info']."</textarea>
				<div class='checkbox'>";
			if($row['enabled']=='0')
				echo "<input id='check' type='checkbox' value='".$row['id']."' /><span>Enable</span>";
			else	
				echo "<input id='check' type='checkbox' checked value='".$row['id']."' /><span>Enable</span>";
			echo "</div>			
				<input onclick='process()' type='button' value='submit'/>
			</form>";
	}
	//End: show edit Product
//End: Product
//Gallery (image):
	//get ID gallery:
	function getIdImage($image){
		$q = "SELECT id FROM gallery WHERE image='$image' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['id'];
	}
	function getImage($id){
		$q = "SELECT image FROM gallery WHERE id='$id' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['image'];
	}
	//Show Gallery:
	function showGallery(){
	//Phan trang:
	$nLine= 5;
	$p=0;
	if(isset($_GET['p'])) $p=$_GET['p'];
	$start = $p*$nLine;
	$q = "SELECT COUNT(id) FROM gallery";
	$query = confirm_query($q);
	$total = mysql_fetch_array($query);
	$total = $total[0];
	$nPage = floor($total/$nLine)+1;
	echo "Page: ";
	for($i=0;$i<$nPage;$i++) 
		echo "<a href='index_gallery.php?p=".$i."'>".($i+1) ."</a>";
		
		$q1 = "SELECT id,image,enabled FROM gallery LIMIT $start,$nLine";
		$query1=confirm_query($q1);//var_dump($query);		
		echo "<table border='1'>";
		echo "<tr><th>Model</th><th>Image</th><th>Enabled</th><th>Options</th>";
		while($row = mysql_fetch_array($query1)){
			$idModel=getIdModelLinkGM($row['id']);			
			$q2 = "SELECT name FROM model WHERE id='$idModel' LIMIT 1";
			$query2=confirm_query($q2);
			$model = mysql_fetch_array($query2);
			$model = $model['name'];
			echo "<tr><td>".$model."</td>
				<td><img class='image_model' src='".$row['image']."' /></td>";
			if($row['enabled']=='0'){
				echo "<td><input  value='".$row['id']."'
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}else{
				echo "<td><input  value='".$row['id']."' checked
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}
			echo "<td><a href='edit_gallery.php?id=".$row['id']."'>Edit</a>&#124;
			<input type='button' onclick='del(name)' name='".$row['id']."' class='delete' value='Delete' /></td></tr>";
		}
		echo "</table>";
	echo "</br>Page: ";
	for($i=0;$i<$nPage;$i++) 
		echo "<a href='index_gallery.php?p=".$i."'>".($i+1) ."</a>";
	}
	//End: Show Gallery
	//show edit Gallery:
	function showEditGallery($idImage){
		$idModel=getIdModelLinkGM($idImage);
		$q2 = "SELECT name,id FROM model";
		$query2 = mysql_query($q2);		
		echo "<form class='form'>
			<label>Model *</label>
			<select id='idModel' >
				<option value='false'>Select One</option>
				<option value='false'>----------------------------</option>";
		while($row2=mysql_fetch_array($query2)){
			if($row2['id']==$idModel){
				echo "<option value='".$row2['id']."' selected>".$row2['name']."</option>";
			}
			else
			echo "<option value='".$row2['id']."'>".$row2['name']."</option>";
			
		}
		echo "</select>";
		$q = "SELECT id,image,enabled FROM gallery WHERE id='$idImage'";
		$query=confirm_query($q);
		$row = mysql_fetch_array($query);				
			echo "<label >Image URL</label>
				<input id='image' type='url' value='".$row['image']."'/>
				<div class='checkbox'>";
			if($row['enabled']=='0')
				echo "<input id='check' type='checkbox' value='".$row['id']."' /><span>Enable</span>";
			else	
				echo "<input id='check' type='checkbox' checked value='".$row['id']."' /><span>Enable</span>";
			echo "</div>			
				<input onclick='process()' type='button' value='submit'/>
			</form>";
	}
	//End: show edit Gallery
//End: Gallery (image):

//Notice:
	//Show notice:
	function showNotice(){
		$q = "SELECT id,content,enabled FROM notice ";
		$query=confirm_query($q);
		echo "<table border='1'>";
		echo "<tr><th>Notice</th><th>Enabled</th><th>Options</th>";
		while($row = mysql_fetch_array($query)){	
			if($row['enabled']=='0'){
				echo "<tr><td>".$row['content']."</td><td><input  value='".$row['id']."'
				onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}else{
				echo "<tr><td>".$row['content']."</td><td><input  value='".$row['id']."' 
				checked onclick='process(this.value,this.checked)' type='checkbox' /></td>";
			}
			echo "<td><a href='edit_notice.php?id=".$row['id']."'>Edit</a>&#124;
			<input type='button' onclick='del(name)' name='".$row['id']."' class='delete' value='Delete' /></td></tr>";
		}
		echo "</table>";
	
	}
	//End: Show notice
	//show edit Series
	function showEditNotice($id){
		$q = "SELECT id,content,enabled FROM notice WHERE id='$id' LIMIT 1";
		$query=confirm_query($q);
		while($row = mysql_fetch_array($query)){	
			
			echo "<form class='form'>
				<label>Notice Name *</label>
				<textarea id='notice' type='text' rows='5' cols='50'/>".$row['content']."</textarea>
				<div class='checkbox'>";
			if($row['enabled']=='0')
				echo "<input id='check' type='checkbox' value='".$row['id']."' /><span>Enable</span>";
			else	
				echo "<input id='check' type='checkbox' checked value='".$row['id']."' /><span>Enable</span>";
			echo "</div>			
				<input onclick='process()' type='button' value='submit'/>
			</form>";
		}
	}
	//End: show edit Series
//End: notice
//linkgallerymodel:
	function getIdModelLinkGM($idImage){
		$q = "SELECT idmodel FROM linkgallerymodel WHERE idimage='$idImage' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['idmodel'];
	}	
	function getIdImageLinkGM($idModel){
		$q = "SELECT idimage FROM linkgallerymodel WHERE idmodel='$idModel' ";
		$query=confirm_query($q);
		$result = array();
		while($row=mysql_fetch_array($query)){
			$result[]= $row['idimage'];
		}
		return $result;
	}	
//linkmodelseries:
	function getIdSeriesLinkMS($idModel){
		$q = "SELECT idseries FROM linkmodelserie WHERE idmodel='$idModel' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['idseries'];
	}
	function getIdModelLinkMS($idSeries){
		$q = "SELECT idmodel FROM linkmodelserie WHERE idseries='$idSeries'";
		$query=confirm_query($q);
		$result = array();
		while($row=mysql_fetch_array($query)){
			$result[]= $row['idmodel'];
		}
		return $result;
	}
//linkproductmodel:
	function getIdModelLinkPM($idProduct){
		$q = "SELECT idmodel FROM linkproductmodel WHERE idproduct='$idProduct' LIMIT 1";
		$query=confirm_query($q);
		$result=mysql_fetch_array($query);
		return $result['idmodel'];
	}
	function getIdProductLinkPM($idModel){
		$q = "SELECT idproduct FROM linkproductmodel WHERE idmodel='$idModel'";
		$query=confirm_query($q);
		$result = array();
		while($row=mysql_fetch_array($query)){
			$result[]= $row['idproduct'];
		}
		return $result;
	}
?>