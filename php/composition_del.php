<?php
include_once("root.php");
$del_child = $_POST['del_child'];
$composition = mysql_escape_string($_POST['composition']);
$book_id = mysql_escape_string($_POST['book_id']);
/*if($composition==hie){
	$composition='compos_hie';
	$composition_id='compos_hie_id';
}else{
	$composition='compos_list';
	$composition_id='compos_list_id';
}*/

$compos_table='compos_'.$composition;
$compos_id='compos_'.$composition.'_id';
if($book_id){
	$query= "delete from $compos_table where compos_book_id=$book_id ";
	$result = $mysqli->query($query);
	if($composition=='mesh'){
		$query= "delete from compos_meshline where compos_book_id=$book_id ";
		$result = $mysqli->query($query);
	}
}else{
	$length = count($del_child);
	for($i=0 ; $i<$length ; $i++){
	$query= "delete from $compos_table where $compos_id='$del_child[$i]' ";
	$result = $mysqli->query($query);

	}
}
?>