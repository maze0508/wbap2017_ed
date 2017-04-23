<?php
include_once("root.php");
$children_id = mysql_escape_string($_POST['children_id']);
$children_area = mysql_escape_string($_POST['children_area']);

$query="UPDATE children SET children_area='$children_area' WHERE children_id ='$children_id'";
$result = $mysqli->query($query);

?>