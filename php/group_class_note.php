<?php
include_once("root.php");

$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$group_class_id = mysql_escape_string($_POST['group_class_id']);
$anchor_descript = mysql_escape_string($_POST['anchor_descript']);
$anchor_date = date('Y-m-j');

	if($group_class_id=="all_class"){
		$group_class_id="";
	}else{
		$group_class_id=$group_class_id;
	}

	$query="insert into group_anchor(user_media_id,member_id,team_id,anchor_descript,group_class_id,anchor_date,noteColor) values('$user_media_id','$member_id','$team_id','$anchor_descript','$group_class_id','$anchor_date',1)";
	$result = $mysqli->query($query);
	
	
	include_once("group_class_go.php");
		
		
?>