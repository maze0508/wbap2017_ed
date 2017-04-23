<?php
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);
$account = mysql_escape_string($_POST['account']);
$pwd = mysql_escape_string($_POST['pwd']);
$name = mysql_escape_string($_POST['name']);
$unit = mysql_escape_string($_POST['unit']);
$iclass = mysql_escape_string($_POST['iclass']);
$email = mysql_escape_string($_POST['email']);

if($member_id){
$query="UPDATE member SET account='$account',pwd='$pwd',name='$name',unit='$unit',email='$email',iclass='$iclass' WHERE member_id ='$member_id'";
$result = $mysqli->query($query);
}
?>