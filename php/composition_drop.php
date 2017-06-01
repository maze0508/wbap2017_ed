<?php
include_once("root.php");
$del_compos_id = mysql_escape_string($_POST['del_compos_id']);


	$query= "delete from compos_book where compos_book_id = $del_compos_id ";
	$result = $mysqli->query($query);
	echo "已刪除章節";
?>