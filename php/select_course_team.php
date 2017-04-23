<?php
include_once("root.php");
$course_id = mysql_escape_string($_POST['course_id']);
$query = "select team.team_id,team.team_name from course_team left join team on course_team.team_id = team.team_id where course_team.course_id = '$course_id'";
$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
	$team_id = $row["team_id"];
	$team_name = $row["team_name"];
	echo "<div id='$team_id' class='team'>$team_name</div>";
}


?>