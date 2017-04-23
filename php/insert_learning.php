<?php
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);
$learning_name = mysql_escape_string($_POST['learning_name']);
$publish = mysql_escape_string($_POST['publish']);
$subject_id = mysql_escape_string($_POST['subject_id']);
$edit_books_id = mysql_escape_string($_POST['edit_books_id']);
$learning_start = mysql_escape_string($_POST['learning_start']);
$learning_end = mysql_escape_string($_POST['learning_end']);
$learning_content = mysql_escape_string($_POST['learning_content']);

$query = "SELECT learning_id from learning where member_id = '$member_id' AND edit_books_id = '$edit_books_id' limit 0,1";
$result = $mysqli->query($query);
$rows = $result->fetch_assoc();
if($rows['learning_id'])
{
echo "<script>alert('建立失敗，您已經針對這教材建立過主題')</script>";
echo "<script>history.go(-1)</script>";
return false;
}else
$query="INSERT INTO learning (learning_name, learning_start, learning_end, learning_content, publish, member_id, edit_books_id, subject_id) VALUES ('$learning_name', '$learning_start', '$learning_end', '$learning_content', '$publish', '$member_id', '$edit_books_id', '$subject_id')";
$result = $mysqli->query($query);
echo "<script>alert('建立成功')</script>";
echo "<script>history.go(-1) </script>";

?>
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>