<?php
include_once("root.php");
$learning_id = mysql_escape_string($_POST['learning_id']);

if(isset($_POST['team_id'])) {
   	foreach($_POST['team_id'] as $key => $value) {
		$query = "SELECT learning_team_id from learning_team where learning_id = '$learning_id' AND team_id = '$value'";
		$result = $mysqli->query($query);
		$rows = $result->fetch_assoc();
		if(!$rows['learning_team_id']){		
     	$query="insert into learning_team (learning_id,team_id) values ('$learning_id','$value')";
       	$result = $mysqli->multi_query($query);
		}       	
}};

?>
