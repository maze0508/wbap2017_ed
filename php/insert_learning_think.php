<?php
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$think = mysql_escape_string($_POST['think']);

$query = "SELECT * from learning_think where user_media_id = '$user_media_id' AND member_id='$member_id'  limit 0,1";
$result = $mysqli->query($query);
$rows = $result->fetch_assoc();
if($rows['learning_think_id'])
{
$query="UPDATE learning_think SET think='$think' WHERE user_media_id = '$user_media_id' AND member_id='$member_id'";
}else
$query="insert into learning_think(member_id,user_media_id,think) values ('$member_id','$user_media_id','$think') ";
$result = $mysqli->query($query);

?>
