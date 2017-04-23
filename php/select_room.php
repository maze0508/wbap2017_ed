<?php
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
$step = mysql_escape_string($_POST['step']);

if($step == "3")
$query = "select name,speak from room where user_media_id='$user_media_id' AND team_id='$team_id' ";
else if($step == "4")
$query = "select name,speak from children_room where user_media_id='$user_media_id' AND team_id='$team_id' ";
else
$query = "select name,speak from answer_room where user_media_id='$user_media_id' AND team_id='$team_id' ";

$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
	$speak = $row["speak"];
	$name = $row["name"];
	echo "$name 說：$speak <br/>";
}

?>