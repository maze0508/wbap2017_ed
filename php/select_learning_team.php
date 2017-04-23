<?php
include_once("root.php");
$learning_id = mysql_escape_string($_POST['learning_id']);

$query = "select course.course_year,course.course_name,learning_team.learning_team_id,team.team_name from (team inner join course_team on team.team_id = course_team.team_id) inner join course on course_team.course_id = course.course_id inner join learning_team on learning_team.team_id = team.team_id where learning_team.learning_id = '$learning_id' order by course.course_name,team.team_name";
$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
	$course_year = $row["course_year"];
	$course_name = $row["course_name"];
	$learning_team_id = $row["learning_team_id"];
	$team_name = $row["team_name"];					
	echo "<div class='team_B' id='$learning_team_id'>($course_year) $course_name <br/> $team_name</div>";	
}

?>