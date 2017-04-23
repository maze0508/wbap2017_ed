<?php
include_once("root.php");

if(isset($_POST['course_id'])) {
    foreach($_POST['course_id'] as $key => $value) {
		$query= "delete from course where course_id='$value'";
		$result = $mysqli->query($query);
    };
};

?>