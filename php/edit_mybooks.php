<?php
include_once("root.php");
$edit_books_id = mysql_escape_string($_POST['edit_books_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$learn_source = mysql_escape_string($_POST['learn_source']);
$books_target = mysql_escape_string($_POST['books_target']);
$books_content = mysql_escape_string($_POST['books_content']);
$books_concept = mysql_escape_string($_POST['books_concept']);
$books_step = mysql_escape_string($_POST['books_step']);


$query="UPDATE edit_books SET learn_source='$learn_source',books_target='$books_target',books_content='$books_content',books_concept='$books_concept',books_step='$books_step' WHERE edit_books_id ='$edit_books_id' && member_id='$member_id' ";
$result = $mysqli->query($query);

echo "<script>alert('資料已更新完成')</script>";
echo "<script>document.location.href='../my_books.php'</script>";

?>