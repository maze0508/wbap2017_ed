<?php
include_once("root.php");

if(isset($_POST['subject_id'])) {
    foreach($_POST['subject_id'] as $key => $value) {
		$query= "delete from subject where subject_id='$value'";
		$result = $mysqli->query($query);
    };
};

?>