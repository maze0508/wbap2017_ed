<?php
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
$name = mysql_escape_string($_POST['name']);
$speak = mysql_escape_string($_POST['speak']);
$step = mysql_escape_string($_POST['step']);
$date = date('Y-m-j H:i:s');

if($step == "3")
$query="insert into room(user_media_id,team_id,name,speak,date) values('$user_media_id','$team_id','$name','$speak','$date')";
else if($step == "4")
$query="insert into children_room (user_media_id,team_id,name,speak,date) values('$user_media_id','$team_id','$name','$speak','$date')";
else
$query="insert into answer_room (user_media_id,team_id,name,speak,date) values('$user_media_id','$team_id','$name','$speak','$date')";

$result = $mysqli->query($query);

?>