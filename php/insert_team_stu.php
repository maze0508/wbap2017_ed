<?php
include_once("root.php");
$team_id = mysql_escape_string($_POST['team_id']);

if(isset($_POST['member_id'])) {
   	foreach($_POST['member_id'] as $key => $value) {
     	$query="insert into team_member (team_id,member_id) values ('$team_id','$value')";
       	$result = $mysqli->multi_query($query);
       	};
};
?>