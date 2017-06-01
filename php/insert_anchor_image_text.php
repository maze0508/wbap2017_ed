
<?php
include_once("root.php");
date_default_timezone_set("Asia/Taipei");

$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$media_url = mysql_escape_string($_POST['url']);
$media_type = mysql_escape_string($_POST['media_type']);
$anchor_descript = mysql_escape_string($_POST['anchor_descript']); //文字註記輸入內容
$anchor_time = mysql_escape_string($_POST['anchor_time']);
$anchor_date = date('Y-m-d H:i:s');
$privacy = mysql_escape_string($_POST['privacy']);

//節圖
if($anchor_time){

$image_name="$user_media_id"."_"."$anchor_time".".jpg";
shell_exec("ffmpeg -i ../user_movie/".$media_url.".".$media_type." -ss $anchor_time -vframes 1 -y ../images/anchor/$image_name");

$query="INSERT INTO media_anchor_image(user_media_id,member_id,image,anchor_descript,anchor_date,anchor_time) values('$user_media_id','$member_id','$image_name','$anchor_descript','$anchor_date','$anchor_time')";
$result = $mysqli->query($query);
}
?>
