<?php
include_once("root.php");
$member_id = mysql_escape_string($_GET['member_id']);
$common_account = mysql_escape_string($_GET['common_account']);
$common_unit = mysql_escape_string($_GET['common_unit']);
$common_email = mysql_escape_string($_GET['common_email']);


$query="insert into common(member_id,common_account,common_unit,common_email) values('$member_id','$common_account','$common_unit','$common_email')";
$result = $mysqli->query($query);

$query="select common_id,common_account from common where member_id='$member_id' order by common_id desc limit 0,1";
$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
$common_id = $row["common_id"];
$common_account = $row["common_account"];
echo $common_id."#".$common_account;
}
mysqli_free_result($result);

?>