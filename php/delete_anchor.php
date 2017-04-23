<?php
include_once("root.php");
$button_type = mysql_escape_string($_POST['button_type']);
$media_anchor_id = mysql_escape_string($_POST['media_anchor_id']);
if($button_type=='image'){
	$query= "delete from media_image where media_image_id='$media_anchor_id' ";
}else{
	$query= "delete from media_anchor where media_anchor_id='$media_anchor_id' ";
}
$result = $mysqli->query($query);
?>