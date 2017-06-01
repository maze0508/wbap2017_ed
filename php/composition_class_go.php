<?php
//顯示註記內容
include_once("root.php");

$anchor_class_id = mysql_escape_string($_POST['class_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$anchor_type = mysql_escape_string($_POST['anchor_type']);

if($anchor_type==image){//若是點選新增 >> 選擇註記圖片
	$query="select member.name,media_anchor_image.media_anchor_image_id,media_anchor_image.image,media_anchor_image.noteColor,media_anchor_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor_image on member.member_id =  media_anchor_image.member_id LEFT JOIN anchor_class ON media_anchor_image.anchor_class_id= anchor_class.anchor_class_id where media_anchor_image.user_media_id = '$user_media_id' AND media_anchor_image.member_id = '$member_id' AND media_anchor_image.anchor_class_id= '$anchor_class_id' order by media_anchor_image.anchor_time";
	$result = $mysqli->query($query);
	echo"<div class='anchor_show'>";

	while($row = $result->fetch_array(MYSQL_ASSOC)){
		$media_anchor_image_id = $row['media_anchor_image_id'];
		if($row['image']!=""){//有圖片註記就顯示
			$image = $row['image'];
			echo"<img id='$media_anchor_image_id' class='image_new' style='width:80px;' src='./images/anchor/$image';/>&nbsp;";
		}
		if($row['anchor_descript']!=""){//有文字註記就顯示
			$anchor_descript = $row['anchor_descript'];
			echo"<div id='$media_anchor_image_id' class='descript_new' style='font-family:微軟正黑體;font-size:10px;border:1px solid;'>$anchor_descript</div><br/>";
		}
	}
	
	echo"</div>";
}else{//若是點選新增 >> 選擇註記內容
	$query="select member.name,media_anchor_image.media_anchor_image_id,media_anchor_image.anchor_descript,media_anchor_image.noteColor,media_anchor_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor_image on member.member_id =  media_anchor_image.member_id LEFT JOIN anchor_class ON media_anchor_image.anchor_class_id= anchor_class.anchor_class_id where media_anchor_image.user_media_id = '$user_media_id' AND media_anchor_image.member_id = '$member_id'  AND media_anchor_image.anchor_class_id= '$anchor_class_id'  order by media_anchor_image.anchor_time";
	$result = $mysqli->query($query);
	echo"<div class='anchor_show'>";
	while($row = $result->fetch_array(MYSQL_ASSOC)){
	
		$media_anchor_image_id = $row['media_anchor_image_id'];
		$anchor_descript = $row['anchor_descript'];
		echo"<div id='$media_anchor_image_id' class='descript_new' style='font-family:微軟正黑體;font-size:10px;border:1px solid;'>$anchor_descript</div><br/>";
	}
	echo"</div>";


}
?>