<?php
include_once("root.php");

$anchor_class_id = mysql_escape_string($_POST['class_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$anchor_type = mysql_escape_string($_POST['anchor_type']);

if($anchor_type==image){
	$query="select member.name,media_image.media_image_id,media_image.image,media_image.noteColor,media_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_image on member.member_id =  media_image.member_id LEFT JOIN anchor_class ON media_image.anchor_class_id= anchor_class.anchor_class_id where media_image.user_media_id = '$user_media_id' AND media_image.member_id = '$member_id' AND media_image.anchor_class_id= '$anchor_class_id' order by media_image.anchor_time";
	$result = $mysqli->query($query);
	echo"<div class='anchor_show'>";
	while($row = $result->fetch_array(MYSQL_ASSOC)){

		$image_id = $row['media_image_id'];
		$image = $row['image'];
		echo"<img id='$image_id' class='image_new' style='width:80px;' src='./images/anchor/$image';/>&nbsp;";
	}
	echo"</div>";
}else{
	$query="select member.name,media_anchor.media_anchor_id,media_anchor.anchor_descript,media_anchor.noteColor,media_anchor.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor on member.member_id =  media_anchor.member_id LEFT JOIN anchor_class ON media_anchor.anchor_class_id= anchor_class.anchor_class_id where media_anchor.user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  AND media_anchor.anchor_class_id= '$anchor_class_id'  order by media_anchor.anchor_time";
	$result = $mysqli->query($query);
	echo"<div class='anchor_show'>";
	while($row = $result->fetch_array(MYSQL_ASSOC)){

		$media_anchor_id = $row['media_anchor_id'];
		$anchor_descript = $row['anchor_descript'];
		echo"<div id='$media_anchor_id' class='descript_new' style='font-family:微軟正黑體;font-size:10px;border:1px solid;'>$anchor_descript</div><br/>";
	}
	echo"</div>";


}
?>