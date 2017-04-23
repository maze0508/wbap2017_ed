<?php
include_once("root.php");
$course_id = mysql_escape_string($_POST['course_id']);

    if(isset($_POST['member_id'])) {
      foreach($_POST['member_id'] as $key => $value) {
        $query="insert into course_stu (course_id,member_id) values ('$course_id','$value')";
          $result = $mysqli->query($query);
          };
    };


?>