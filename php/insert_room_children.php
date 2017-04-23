<?php
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
$name = mysql_escape_string($_POST['name']);
$children_content = mysql_escape_string($_POST['children_content']);
$date = date('Y-m-j H:i:s');

$query="insert into children (user_media_id,team_id,name,children_content,date) values('$user_media_id','$team_id','$name','$children_content','$date')";
$result = $mysqli->query($query);

?>