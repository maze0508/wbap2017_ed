<?php
include_once("root.php");
$del_line = $_POST['del_line'];
$compos_book_id = mysql_escape_string($_POST['compos_book_id']);
$length = count($del_line);
echo $length;		
for($i=0 ; $i<$length ; $i++){
	$query= "delete from compos_meshline where (point1=".$del_line[$i][0]." AND point2=".$del_line[$i][1].") OR (point1=".$del_line[$i][1]." AND point2=".$del_line[$i][0].")  AND compos_book_id=".$compos_book_id;
	//$query= "delete from compos_meshline where point1=".$del_line[$i][0]." AND point2=".$del_line[$i][1]." AND compos_book_id=".$compos_book_id;
	$result = $mysqli->query($query);
}


?>