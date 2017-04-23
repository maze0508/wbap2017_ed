<?php
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);
$density_id = mysql_escape_string($_POST['density_id']);
$intended_user = mysql_escape_string($_POST['intended_user']);
$difficulty_id = mysql_escape_string($_POST['difficulty_id']);
$slesson = mysql_escape_string($_POST['slesson']);
$context = mysql_escape_string($_POST['context']);
$learn_source = mysql_escape_string($_POST['learn_source']);
$learn_time = mysql_escape_string($_POST['learn_time']);
$books_target = mysql_escape_string($_POST['books_target']);
$books_content = mysql_escape_string($_POST['books_content']);
$books_concept = mysql_escape_string($_POST['books_concept']);
$books_step = mysql_escape_string($_POST['books_step']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);

$query = "SELECT edit_books_id from edit_books where member_id = '$member_id' AND user_media_id = '$user_media_id' limit 0,1";
$result = $mysqli->query($query);
$rows = $result->fetch_assoc();
if($rows['edit_books_id'])
{
echo "<script>alert('建立失敗，您已經針對這影片建立過教材')</script>";
echo "<script>history.go(-1)</script>";
return false;
}else
$query="insert into edit_books(user_media_id,member_id,density_id,intended_user,difficulty_id,slesson,context,learn_source,learn_time,books_target,books_content,books_concept,books_step) values('$user_media_id','$member_id','$density_id','$intended_user','$difficulty_id','$slesson','$context','$learn_source','$learn_time','$books_target','$books_content','$books_concept','$books_step')";
$result = $mysqli->query($query);

echo "<script>alert('已加入教材')</script>";
echo "<script>document.location.href='../sign.php'</script>";

?>