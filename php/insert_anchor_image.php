<?php
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$media_url = mysql_escape_string($_POST['url']);
$anchor_time = mysql_escape_string($_POST['anchor_time']);
$anchor_date = date('Y-m-j');
$privacy = mysql_escape_string($_POST['privacy']);

//節圖
if($anchor_time){
	$image_name="$user_media_id"."_"."$anchor_time".".jpg";
	shell_exec("ffmpeg -i ../user_movie/$media_url.flv -ss $anchor_time -vframes 1 -y ../images/anchor/$image_name");


	$query="insert into media_image(user_media_id,member_id,image,anchor_date,anchor_time) values('$user_media_id','$member_id','$image_name','$anchor_date','$anchor_time')";
	$result = $mysqli->query($query);
}
if($privacy)
	$query="select member.name,media_image.image,media_image.noteColor,media_image.media_image_id,media_image.anchor_time from member left join media_image on member.member_id =  media_image.member_id where user_media_id = '$user_media_id' AND media_image.member_id = '$member_id'  order by media_image.anchor_time";
else
	$query="select member.name,media_image.image,media_image.anchor_time from member left join media_image on member.member_id =  media_image.member_id where user_media_id = '$user_media_id' order by media_image.anchor_time";


$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
$name = $row['name'];
$anchor_time = $row['anchor_time'];
$media_image_id = $row['media_image_id'];
$image = $row['image'];
$noteColor = $row['noteColor'];
$s   =   $anchor_time%60;
$m   =   floor($anchor_time/60);
//$o   =   floor($m/60);
if($m < 10) $m = "0".$m;
if($s < 10) $s = "0".$s;
if($noteColor==0){
				echo "
						<table id='$media_image_id' style='border-top:1px solid;cursor:pointer'>
						<tr>
							<td style='width:205px;'><div id='$anchor_time' class='antime $anchor_time' >[$m:$s] $name 說：<br> <img class='image' style='width:200px;' src='./images/anchor/$image'/></div></td>
							<td style='width:16px;'>
								<div><img class='delete_button' style='width:16px;'src='./images/cancel.png';></img></div>
								<div><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></div>
							</td>
						</tr>
						<table>
					";
			}
}
?>