<?php
include_once("root.php");
$course_name = mysql_escape_string($_POST['course_name']);
$member_id = mysql_escape_string($_POST['member_id']);
$course_start = mysql_escape_string($_POST['course_start']);
$course_end = mysql_escape_string($_POST['course_end']);
$course_info = mysql_escape_string($_POST['course_info']);
$course_year = mysql_escape_string($_POST['course_year']);

$query = "SELECT course_id from course where member_id='$member_id' && course_name='$course_name' limit 0,1";
$result = $mysqli->query($query);
$rows = $result->fetch_assoc();
if($rows['course_id'])
{
echo "<script>alert('建立失敗，已有相同課程名稱與老師')</script>";
echo "<script>document.location.href='../create_course.php'</script>";
return false;
}else
$query="insert into course(course_name,course_year,member_id,course_start,course_end,course_info) values('$course_name','$course_year','$member_id','$course_start','$course_end','$course_info')";
$result = $mysqli->query($query);
echo "<script>alert('課程新增完畢')</script>";
echo "<script>document.location.href='../create_course.php'</script>";


?>