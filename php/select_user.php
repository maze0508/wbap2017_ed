<?php
include_once("root.php");
$iclass = mysql_escape_string($_POST['iclass']);
$query = "select member_id,name,iclass from  member where iclass='$iclass'  && compet = '1'";
$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
	$member_id = $row["member_id"];
	$name = $row["name"];
	$iclass = $row["iclass"];
	echo "<div id='$member_id' class='stu' style='width:60px;border:1px solid;float:left;margin:3px;text-align:center;cursor:pointer'>$name <br> $iclass</div>";
}


?>