<?php
include_once("root.php");
$course_id = mysql_escape_string($_POST['course_id']);
$course_name = mysql_escape_string($_POST['course_name']);
$course_start = mysql_escape_string($_POST['course_start']);
$course_end = mysql_escape_string($_POST['course_end']);
$course_info = mysql_escape_string($_POST['course_info']);
$course_year = mysql_escape_string($_POST['course_year']);

if($course_id){
$query="UPDATE course SET course_name='$course_name',course_start='$course_start',course_end='$course_end',course_info='$course_info',course_year='$course_year' WHERE course_id ='$course_id'";
$result = $mysqli->query($query);
}
?>