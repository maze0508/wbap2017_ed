<?php
include_once("root.php");

if(isset($_POST['team_member_id'])) {
   	foreach($_POST['team_member_id'] as $key => $value) {
     	$query= "delete from team_member where team_member_id='$value'";
       	$result = $mysqli->multi_query($query);
       	};
};
?>