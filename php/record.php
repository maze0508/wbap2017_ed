<?php

include_once("root.php");
ini_set('date.timezone','Asia/Taipei');
$t=time();
$member_id = mysql_escape_string($_POST['member_id']);

$action = mysql_escape_string($_POST['action']);
$record_date = date('Y-m-d H:i:s',$t);
//$record_date = date('Y-m-j');
$query="insert into record (member_id,action,record_date) values('$member_id','$action','$record_date')";
$result = $mysqli->query($query);


?>