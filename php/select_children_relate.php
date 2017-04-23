<?php
include_once("root.php");
$children_id = mysql_escape_string($_POST['children_id']);

$query = "select name,relate,children_relate_date from children_relate where children_id ='$children_id'";
$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
	$name = $row["name"];
	$relate = $row["relate"];
	$children_relate_date = $row["children_relate_date"];
	echo "<label>$name 說: $relate</label><br/>";	
}

?>