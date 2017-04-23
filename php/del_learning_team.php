<?php
include_once("root.php");
$learning_team_id = mysql_escape_string($_POST['learning_team_id']);
$query= "delete from learning_team where learning_team_id='$learning_team_id' ";
$result = $mysqli->query($query);
?>