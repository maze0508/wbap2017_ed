<?php
include_once("root.php");
$button_type = mysql_escape_string($_POST['button_type']);
$media_anchor_image_id = mysql_escape_string($_POST['media_anchor_image_id']);

$query= "delete from media_anchor_image where media_anchor_image_id='$media_anchor_image_id' ";

$result = $mysqli->query($query);
?>