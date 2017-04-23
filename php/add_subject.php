<?php
include_once("root.php");
$subject_name = mysql_escape_string($_POST['subject_name']);


//$query="INSERT subject SET subject_catalog='$subject_name' WHERE subject_id ='$subject_id'";
$query="INSERT INTO subject (subject_catalog,subject_code) VALUES ('$subject_name','$subject_name')";
$result = $mysqli->query($query);
echo "$query";


?>

