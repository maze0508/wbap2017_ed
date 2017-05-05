<?php
session_start();
$member_id = $_SESSION['member_id'];
include_once("../php/root.php");
$user_media_id = $_POST['user_media_id'];

$query="SELECT member.name, media_anchor_image.media_anchor_image_id, media_anchor_image.anchor_descript, media_anchor_image.noteColor, media_anchor_image.anchor_time, media_anchor_image.image
		FROM member
		LEFT JOIN media_anchor_image ON member.member_id =  media_anchor_image.member_id
		WHERE user_media_id = '".$user_media_id."'
		AND media_anchor_image.member_id = '".$member_id." ' 
		ORDER BY media_anchor_image.anchor_time";

$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQL_ASSOC);
if(empty($row)){
					echo "<p>此學習主題目前尚無註記</p>";
					}else{
						while($row) { 
							$name = $row['name'];
							$anchor_time = $row['anchor_time'];
							$image = $row['image'];
							$anchor_descript = $row['anchor_descript'];//文字
							$media_anchor_image_id = $row['media_anchor_image_id'];//文字
							$noteColor = $row['noteColor'];
							$h   =   floor($anchor_time/3600);
							$temp = $anchor_time%3600;
							$m   =   floor($temp/60);
							$temp = $temp%60;
							$s   =  $temp;
							
							$h = ($h < 10)?"0".$h:$h;
							$m = ($m < 10)?"0".$m:$m;
							$s = ($s < 10)?"0".$s:$s;
							
							if($noteColor==0){
							//Youtube影片的註記內容，因為無法截圖，故不顯示圖片	
							  if($title && $found){
								  echo "<ul><li id='$media_anchor_image_id'>
									<div style='width:50%;color:#69C;'><a style='text-decoration: none;' href='../m/start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'><div id='$anchor_time' class='antime $anchor_time' >註記時間：[$h:$m:$s]</div><div>註記內容：$anchor_descript</div></a>
									<button id='$media_anchor_image_id' class='delete_button' style='background-image:url(../images/cancel.png);width:15px;height:15px;' onclick='delete_button(this)'> </button>
</div>
								</li></ul>";
							  }else{
								echo "<ul><li id='$media_anchor_image_id'>
									<div style='width:90%;height:80%;color:#69C;float:left;padding-bottom:10%;'>
									<a style='text-decoration: none;height:80%;' href='../m/start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'>
									<div id='$anchor_time' class='antime $anchor_time' style='font-size:12pt;'>註記時間：[$h:$m:$s]</div><br/>
									<div id='$anchor_descript' style='font-size:12pt;'>註記內容：$anchor_descript</div><br/>
									<div><img class='image' style='width:80%;height:80%;float:left;' src='../images/anchor/$image'/></div></a></div>
									<button id='$media_anchor_image_id' class='delete_button' style='background-image:url(../images/cancel.png);width:15px;height:15px;' onclick='delete_button(this)'> </button>
									</li></ul>";
							}}
							$row = $result->fetch_array(MYSQL_ASSOC);
						}
						
					}

//$result->free();
/*if(empty($row)){
	echo json_encode(null);
}else{
	echo json_encode($row);
}*/
?> 

