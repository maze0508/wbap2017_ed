<?php
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$media_url = mysql_escape_string($_POST['url']);
$anchor_descript = mysql_escape_string($_POST['anchor_descript']);
$anchor_time = mysql_escape_string($_POST['anchor_time']);
$anchor_date = date('Y-m-d H:i:s');
$privacy = mysql_escape_string($_POST['privacy']);

//節圖
$image_name="$user_media_id"."_"."$anchor_time".".jpg";
shell_exec("ffmpeg -i ../user_movie/$media_url.flv -ss $anchor_time -vframes 1 -y ../images/anchor/$image_name");


$query="insert into media_anchor(user_media_id,member_id,image,anchor_descript,anchor_date,anchor_time) values('$user_media_id','$member_id','$image_name','$anchor_descript','$anchor_date','$anchor_time')";
$result = $mysqli->query($query);

if($privacy)
	$query="select member.name,media_anchor.media_anchor_id,media_anchor.anchor_descript,media_anchor.noteColor,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  order by media_anchor.anchor_time";
else
	$query="select member.name,media_anchor.anchor_descript,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' order by media_anchor.anchor_time";


$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
$name = $row['name'];
$anchor_time = $row['anchor_time'];
$anchor_descript = $row['anchor_descript'];
$media_anchor_id = $row['media_anchor_id'];
$noteColor = $row['noteColor'];

$s   =   $anchor_time%60;
$m   =   floor($anchor_time/60);
//$o   =   floor($m/60);
if($m < 10) $m = "0".$m;
if($s < 10) $s = "0".$s;
if($noteColor==0){
echo "
					<table id='$media_anchor_id'>
					<tr>
						<td style='width:235px;'><div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer;word-break: break-all;'>[$m:$s] $name 說：<br> $anchor_descript</div></td>
						<td style='width:16px;'><div><img id='delete_button' style='width:16px;'src='./images/cancel.png';></img></div></td>
					</tr>
					<table>
				";
}
}
?>