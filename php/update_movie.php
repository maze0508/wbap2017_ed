<?php
include_once("root.php");

$user_media_id = mysql_escape_string($_POST['user_media_id']);
$description = mysql_escape_string($_POST['description']);
$keyword = mysql_escape_string($_POST['keyword']);
$coverage = mysql_escape_string($_POST['coverage']);
$language = mysql_escape_string($_POST['language']);

$query="UPDATE user_media SET language='$language',description='$description',keyword='$keyword',coverage='$coverage' WHERE user_media_id = '$user_media_id'";
$result = $mysqli->query($query);

echo "<script>alert('資料已更新')</script>";
echo "<script>document.location.href='../my_media.php'</script>";

?>