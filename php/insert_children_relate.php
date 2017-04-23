<?php
include_once("root.php");
$children_id = mysql_escape_string($_POST['children_id']);
$name = mysql_escape_string($_POST['name']);
$relate = mysql_escape_string($_POST['relate']);
$children_relate_date = date('Y-m-j');

$query="insert into children_relate (children_id,name,relate,children_relate_date) values('$children_id','$name','$relate','$children_relate_date')";
$result = $mysqli->query($query);

?>