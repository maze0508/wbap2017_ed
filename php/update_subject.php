<?php
include_once("root.php");
$subject_id = mysql_escape_string($_POST['subject_id']);
$subject_name = mysql_escape_string($_POST['subject_name']);

if($subject_id){
$query="UPDATE subject SET subject_catalog='$subject_name' WHERE subject_id ='$subject_id'";
$result = $mysqli->query($query);
//echo "$result";
}
?>