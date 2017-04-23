<?php
include_once("root.php");
$team_name = mysql_escape_string($_POST['team_name']);
$course_id = mysql_escape_string($_POST['course_id']);
//$query="insert into team(team_name) values('$team_name')";
//$result = $mysqli->query($query);

$query  = "insert into team(team_name) values('$team_name');";
$query .= "insert into course_team (course_id,team_id) values('$course_id',(select max(team_id) from team) )";



$result = $mysqli->multi_query($query)
?>