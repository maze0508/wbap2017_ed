<?php
include_once("root.php");

$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$anchor_class_id = mysql_escape_string($_POST['anchor_class_id']);
$anchor_descript = mysql_escape_string($_POST['anchor_descript']);
$anchor_date = date('Y-m-j');

	if($anchor_class_id=="all_class"){
		$anchor_class_id="";
	}else{
		$anchor_class_id=$anchor_class_id;
	}

	$query="insert into media_anchor(user_media_id,member_id,anchor_descript,anchor_class_id,anchor_date,noteColor) values('$user_media_id','$member_id','$anchor_descript','$anchor_class_id','$anchor_date',1)";
	$result = $mysqli->query($query);
	
	
	include_once("class_go.php");
		
		
?>