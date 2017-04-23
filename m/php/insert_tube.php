<?php

include_once('../../php/root.php');
//$member_id = mysql_real_escape_string($_POST['member_id']);
//$url = mysql_real_escape_string($_POST['url']);
$member_id = $_POST['member_id'];
$url = $_POST['url'];
$public_date = $_POST['public_date'];
if(strstr($url,"youtu.be")){
	$UrlArray = explode("/" , $url);
	$url = "https://www.youtube.com/watch?v=".$UrlArray[3];
}

$query = "INSERT into user_media(member_id,url,public_date) values('$member_id','$url','$public_date')";
$result = $mysqli->query($query);
echo "<p>上傳成功，自動跳轉至影片草稿夾。</p>";

header("Location: ../temp_media.php"); 
exit;
$uurl="../temp_media.php";


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="1;url=<?php echo $uurl; ?>"> 
</head>
<body>

</body>
</html>

