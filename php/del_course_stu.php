<?php
include_once("root.php");

if(isset($_POST['course_stu_id'])) {
    foreach($_POST['course_stu_id'] as $key => $value) {
		$query= "delete from course_stu where course_stu_id='$value'";
		$result = $mysqli->query($query);
    };
};

?>