<?php
include_once("root.php");
date_default_timezone_set( "Asia/Taipei" );
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$compet = mysql_escape_string($_POST['compet']);
$edit_books_id = mysql_escape_string($_POST['edit_books_id']);
$date = date('Y-m-j');

if($compet==1){
$query="insert into my_favorite(user_media_id,member_id,edit_books_id,date) values('$user_media_id','$member_id','$edit_books_id','$date')";
}else{
$query="insert into media_favorite(user_media_id,member_id,date) values('$user_media_id','$member_id','$date')";
}
$result = $mysqli->query($query);
?>