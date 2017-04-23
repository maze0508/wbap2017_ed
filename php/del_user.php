<?php
include_once("root.php");

if(isset($_POST['member_id'])) {
    foreach($_POST['member_id'] as $key => $value) {
		$query= "delete from member where member_id='$value'";
		$result = $mysqli->query($query);
    };
};

?>