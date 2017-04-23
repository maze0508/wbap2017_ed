<?php
include_once("root.php");
$edit_books_id = mysql_escape_string($_POST['edit_books_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$query= "delete from ";
if($edit_books_id){
    $query.= "edit_books where edit_books_id='$edit_books_id'";
}else if($user_media_id){
    $query.= "user_media where user_media_id='$user_media_id'";
}
$result = $mysqli->query($query);
?>