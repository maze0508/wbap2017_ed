<?php
include_once("root.php");
$team_id = mysql_escape_string($_POST['team_id']);
$course_id = mysql_escape_string($_POST['course_id']);

if($team_id)
$query = "select member.member_id,member.name,member.iclass,team_member.team_member_id from member left join team_member on team_member.member_id = member.member_id WHERE  team_member.team_id = $team_id";
else
$query = "select member.member_id,member.name,member.iclass,team_member.team_member_id from ((member left join team_member on team_member.member_id = member.member_id) inner join course_stu on course_stu.member_id = member.member_id) where team_member.team_id is null AND course_stu.course_id = '$course_id'";

$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
	$member_id = $row["member_id"];
	$name = $row["name"];
	$iclass = $row["iclass"];
	$team_member_id = $row["team_member_id"];
	echo "<div id='$member_id' class='member'><input type='checkbox' class='memberbox' id='$member_id' name='$team_member_id'>$name ($iclass)</div>";
}

?>