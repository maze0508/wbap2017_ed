<?php
include_once("root.php");
//$composition_type = mysql_escape_string($_POST['composition_type']);
$compos_book_id = mysql_escape_string($_POST['compos_book_id']);
$member_id = mysql_escape_string($_POST['member_id']);

$query="SELECT composition_type FROM compos_book WHERE compos_book_id ='$compos_book_id'";
$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)) {
	$composition_type = $row['composition_type'];
}
?>	
<?php
switch($composition_type){
	//--------------------------------------------
	case "list":	    
		echo"<div id='Edit' class='list' name='$compos_book_id' style='float:left;'>
		<ul>";
		$query="SELECT  media_anchor_image.image,media_anchor_image.anchor_descript,compos_list.compos_list_id,compos_list.media_anchor_image_id FROM compos_list LEFT JOIN media_anchor_image ON compos_list.media_anchor_image_id = media_anchor_image .media_anchor_image_id WHERE compos_book_id ='$compos_book_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_list_id = $row['compos_list_id'];
			$media_anchor_image_id = $row['media_anchor_image_id'];
			$media_anchor_image_id = $row['media_anchor_image_id'];
			$image = $row['image'];
			$anchor_descript = $row['anchor_descript'];
			if($image){
				$image_url = "./images/anchor/$image";
			}else{
				$image_url = "";
			}
		echo"
			<table id='$compos_list_id' class='composition' CELLPADDING='10'>
				<tr>
					<td><li style='vertical-align:middle;'></li></td>
					<td class='image'>
						<div id='image_old_$compos_list_id' class='image_choose' style='width:200px;height:150px;box-shadow:5px 5px 10px #777777;'><img id='$media_anchor_image_id' class='image_url' style='width:200px;' src='$image_url'/></div>
					</td>
					<td class='descript'>
						<div id='descript_old_$compos_list_id' class='descript_choose' style='border-bottom:1px solid;height:50px;width:400px;'><div id='$media_anchor_image_id' class='descript_text'>$anchor_descript</div></div>
					</td>
				</tr>
			</table>";
		}	
			echo"</ul>
			</div>	
		
		<div id='sidebar'>
			<div style='width:200px;overflow:auto;margin_right:0px;'>";
				$query = "SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_list LEFT JOIN media_anchor_image ON compos_list.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' UNION SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_list LEFT JOIN media_anchor_image ON compos_list.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id'";
				
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$user_media_id = $row["user_media_id"];
					$url = $row["url"];
					//$title =  iconv_substr($row["title"], 0, 8, 'utf-8');
					$found .= strstr($url,"youtube");
					if(strstr($url,"youtube")){
						$youtubeid = explode("=" , $url);
						$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' />";
					}else{			
				   	 $aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
				   }
				 	 echo "<a href='start_learning_1.php?user_media_id=$user_media_id'>$aimgs</a>";

				 }

		echo"</div></div>";
		
		
	break;
	
	//--------------------------------------------
	case "sequence":

		echo"<div id='Edit' class='sequence' name='$compos_book_id' style='float:left;'>
				<ol>";
		$query="SELECT  media_anchor_image.image,media_anchor_image.anchor_descript,compos_sequence.compos_sequence_id,compos_sequence.media_anchor_image_id FROM compos_sequence LEFT JOIN media_anchor_image ON compos_sequence.media_anchor_image_id = media_anchor_image .media_anchor_image_id WHERE compos_book_id ='$compos_book_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)) {

			$compos_sequence_id = $row['compos_sequence_id'];
			$media_anchor_image_id = $row['media_anchor_image_id'];
			$image = $row['image'];
			$anchor_descript = $row['anchor_descript'];
			if($image){
				$image_url = "./images/anchor/$image";
			}else{
				$image_url = "";
			}
		echo"
			
			<table id='$compos_sequence_id' class='composition' CELLPADDING='10'>
				<tr>
					<td><li style='vertical-align:middle;'></li></td>
					<td class='image'>
						<div id='image_old_$compos_sequence_id' class='image_choose' style='width:200px;height:150px;box-shadow:5px 5px 10px #777777;'><img id='$media_anchor_image_id' class='image_url' style='width:200px;' src='$image_url'/></div>
					</td>
					<td class='descript'>
						<div id='descript_old_$compos_sequence_id' class='descript_choose' style='border-bottom:1px solid;height:50px;width:400px;'><div id='$media_anchor_image_id' class='descript_text'>$anchor_descript</div></div>
					</td>
					<td >
						
					</td>
				</tr>
			</table>";
		}	
			echo"	</ol>
			</div>		

		<div id='sidebar'>
			<div style='width:200px;overflow:auto'>";
			$query = "SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_sequence LEFT JOIN media_anchor_image ON compos_sequence.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' UNION SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_sequence LEFT JOIN media_anchor_image ON compos_sequence.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' ";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$user_media_id = $row["user_media_id"];
					$url = $row["url"];
					$title =  iconv_substr($row["title"], 0, 8, 'utf-8');
					if(strstr($url,"youtube")){
						$youtubeid = explode("=" , $url);
						$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' />";
					}else{			
				   	 $aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
				   }
				 	 echo "<a href='start_learning_1.php?user_media_id=$user_media_id'>$aimgs</a>";

				 }
		echo"</div></div>";
		
			
	break;
	
	//----------------------------------------------
	case "hie":
	
	echo"<div id='Edit' class='hie' name='$compos_book_id' style='width:70%;float:left;'>";
		function tree($parent_id,$compos_book_id) { 
			//echo"$parent_id";
			if($parent_id=='0'){
				echo "<ul id='org' style='display:none'>";
			}else{
				echo "<ul>";
			}
			$query="SELECT  media_anchor_image.image,media_anchor_image.anchor_descript,compos_hie.compos_hie_id,compos_hie.media_anchor_image_id FROM compos_hie LEFT JOIN media_anchor_image ON compos_hie.media_anchor_image_id = media_anchor_image .media_anchor_image_id WHERE compos_book_id ='$compos_book_id' AND parent_id='$parent_id'";
			global $mysqli;
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
				//$compos_hie_id = "1";
				$compos_hie_id = $row['compos_hie_id'];
				$media_anchor_image_id = $row['media_anchor_image_id'];
				$image = $row['image'];
				$anchor_descript = $row['anchor_descript'];
				if($image){
					$image_url = "./images/anchor/$image";
				}else{
					$image_url = "";
				}
				echo"<li>
						<table id='$compos_hie_id' class='composition' style='width:155px;border:1px solid;margin:auto;'>
							<tr>
								<td class='image'>
									<br/>
									<div id='image_$compos_hie_id' class='image_choose' style='width:145px;height:109px;border:1px solid;'><img id='$media_anchor_image_id' class='image_url' style='width:145px;' src='$image_url'/></div>
								</td>
							</tr>
							<tr>
								<td class='descript'>
									<div id='descript_$compos_hie_id' class='descript_choose' style='border-bottom:1px solid;height:30px;width:145px;'><div id='$media_anchor_image_id' class='descript_text'>$anchor_descript</div></div>
								</td>
							</tr>
							<tr>
								<td>
									<br/>
								</td>
							</tr>
						</table>";
					
			/* 遞歸調用 */ 
			
				//tree($compos_hie_id,$compos_book_id);
				echo(" </li>"); 
			} 
			echo("</ul>"); 
		} 
		tree('0',$compos_book_id);
		echo "</div>
		 <div id='sidebar'>
			<div style='width:200px;overflow:auto'>";
				$query = "SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_hie LEFT JOIN media_anchor_image ON compos_hie.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' UNION SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_hie LEFT JOIN media_anchor_image ON compos_hie.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' ";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$user_media_id = $row["user_media_id"];
					$url = $row["url"];
					$title =  iconv_substr($row["title"], 0, 8, 'utf-8');
					$found .= strstr($url,"youtube");
					if(strstr($url,"youtube")){
						$youtubeid = explode("=" , $url);
						$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' />";
					}else{
						$aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
				   }
				 	 echo "<a href='start_learning_1.php?user_media_id=$user_media_id'>$aimgs</a>";

				 }
		echo"</div></div>";
		
		
	break;
//---------------------------------------------------------------
	case "mesh":
	echo"
		<div id='Edit' class='mesh' name='$compos_book_id' style='width:70%;float:left;'>";
		$query="SELECT  media_anchor_image.image,media_anchor_image.anchor_descript,compos_mesh.compos_mesh_id,compos_mesh.x,compos_mesh.y,compos_mesh.media_anchor_image_id FROM compos_mesh LEFT JOIN media_anchor_image ON compos_mesh.media_anchor_image_id = media_anchor_image .media_anchor_image_id WHERE compos_book_id ='$compos_book_id' ORDER BY compos_mesh_id";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_mesh_id = $row['compos_mesh_id'];
			$media_anchor_image_id = $row['media_anchor_image_id'];
			$image = $row['image'];
			$anchor_descript = $row['anchor_descript'];
			$x = $row['x']+$Edit_ar[0];
			$y = $row['y']+$Edit_ar[1];
			if($image){
					$image_url = "./images/anchor/$image";
				}else{
					$image_url = "";
				}
		
			echo"<div id='$compos_mesh_id' style='top: ".$y."px; left: ".$x."px;position: absolute;'>
					<table id='$compos_mesh_id' class='composition' style='width:155px;border:1px solid;margin:auto;'>
						<tr>
							<td class='image'>
								<div><img  class='del_new' style='width:14px;float:right;visibility:hidden; 'src='./images/cancel.png';></img>
								<img  class='Select' style='width:14px;visibility:hidden; 'src='./images/test/pic-click.png';></img>
								<img  class='handle' style='width:14px;visibility:hidden;'src='./images/test/pic-drag.png';></img></div>
								<div id='image_$compos_mesh_id' class='image_choose' style='width:145px;height:109px;border:1px solid;'><img class='$image_url' style='width:145px;' src='$image_url'/></div>
							</td>
						</tr>
						<tr>
							<td class='descript'>
								<div id='descript_$compos_mesh_id' class='descript_choose' style='border-bottom:1px solid;height:30px;width:145px;'><div class='descript_text'>$anchor_descript</div></div>
							</td>
						</tr>
						
					</table>
				</div></div>
				";
		
		}
		$query="SELECT  compos_meshline_id,point1,point2 FROM compos_meshline WHERE compos_book_id ='$compos_book_id' ORDER BY compos_meshline_id";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_meshline_id = $row['compos_meshline_id'];
			$point1 = $row['point1'];
			$point2 = $row['point2'];
			
			echo"<canvas class='composition_show' id='".$point1."_".$point2."' style='position: absolute;'></canvas>";
		}
		echo"<div id='sidebar'>
			<div style='width:200px;overflow:auto'>";
				$query = "SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_mesh LEFT JOIN media_anchor_image ON compos_mesh.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' UNION SELECT media_anchor_image.user_media_id,user_media.title,user_media.url FROM (compos_mesh LEFT JOIN media_anchor_image ON compos_mesh.media_anchor_image_id = media_anchor_image.media_anchor_image_id ) INNER JOIN user_media ON media_anchor_image.user_media_id=user_media.user_media_id  WHERE compos_book_id ='$compos_book_id' ";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$user_media_id = $row["user_media_id"];
					$url = $row["url"];
					$title =  iconv_substr($row["title"], 0, 8, 'utf-8');
					$found .= strstr($url,"youtube");
					if(strstr($url,"youtube")){
						$youtubeid = explode("=" , $url);
						$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' />";
					}else{
						$aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
				   }
				 	 echo "<a href='start_learning_1.php?user_media_id=$user_media_id'>$aimgs</a>";

				 }
		echo"</div></div>";

	break;
}
		
?>