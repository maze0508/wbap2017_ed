<?php
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$anchor_descript = $_POST['anchor_descript'];
$anchor_date = date('Y-m-j');
$image_id = mysql_escape_string($_POST['image_id']);
	/*轉換編碼
	$enc = mb_detect_encoding($image_id);
	$data = mb_convert_encoding($image_id, "ASCII", $enc);
	$data = substr($data,1);
	*/
	$data = $image_id;
	if($image_id!="null"){
		$query="insert into media_anchor_image(user_media_id,member_id,anchor_descript,image,anchor_date,noteColor) values('$user_media_id','$member_id','$anchor_descript','$data','$anchor_date',1)";
	}else{
		$query="insert into media_anchor_image(user_media_id,member_id,anchor_descript,anchor_date,noteColor) values('$user_media_id','$member_id','$anchor_descript','$anchor_date',1)";
	}
	$result = $mysqli->query($query);
	include_once("class_go.php");
		
		
?>