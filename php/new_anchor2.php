<?php
$s = $_POST['s'];
$m = $_POST['m']*60;
$h = $_POST['h']*360;
$start_time = $_POST['start_time'];
$stop_time = $_POST['stop_time'];
$anchor_pic = $_POST['anchor_pic'];

$id_startT=$s+$m+$h;
//echo "'$start_time'";
/*
$s   =   $anchor_time%60;
$m   =   floor($anchor_time/60);
$h	 =	 floor($anchor_time/360);
//$o   =   floor($m/60);
if($h < 10) $h = "0".$h;
if($m < 10) $m = "0".$m;
if($s < 10) $s = "0".$s;

$s2   =   $anchor2_time%60;
$m2   =   floor($anchor2_time/60);
$h2	 =	 floor($anchor2_time/360);
//$o   =   floor($m/60);
if($h2 < 10) $h2 = "0".$h2;
if($m2 < 10) $m2 = "0".$m2;
if($s2 < 10) $s2 = "0".$s2;
*/

echo "<div id='$id_startT' class='antime $id_startT'>
			<table style='border:1px solid #000000; width:300px;height:250px; 'align ='center' valign='middle' frame='border' rules='all'> 
				<tr style=' height:30px;'>
					<td colspan=2 align ='right'>
						<label id='play' class='ibutton' style='background-color:#F60'>播放</label>
						<label id='edit' class='ibutton' style='background-color:#F60'>更改</label>
						<label id='delete' class='ibutton' style='background-color:#F60'>刪除</label>
					</td>
				</tr>
				<tr>
					<td colspan=2 align ='center'><img id='jpg2' style='width:200px;' src='2.jpg'/></td>
				</tr>
				<tr style=' height:30px;'>
					<td align ='center'><a>開始時間</a><input type=text id='startT' value='$start_time' disabled size='6' ></input></td>
					<td align ='center'><a>結束時間</a><input type=text id='stopT' value='$stop_time' disabled size='6' ></input></td>
				</tr>
				
			</table>
		</div>";
		

//shell_exec("ffmpeg -i video.mp4 -an -ss $h:$m:$s -r 10 -vframes 1 -y 2.jpg");
//echo "<div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer'>[$h:$m:$s] <img src ='2.jpg'/></div>";
/*
include_once("root.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$anchor_descript = mysql_escape_string($_POST['anchor_descript']);
$anchor_time = mysql_escape_string($_POST['anchor_time']);
$anchor_date = date('Y-m-j');
$privacy = mysql_escape_string($_POST['privacy']);


$query="insert into media_anchor(user_media_id,member_id,anchor_descript,anchor_date,anchor_time) values('$user_media_id','$member_id','$anchor_descript','$anchor_date','$anchor_time')";
$result = $mysqli->query($query);

if($privacy)
	$query="select member.name,media_anchor.anchor_descript,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  order by media_anchor.anchor_time";
else
	$query="select member.name,media_anchor.anchor_descript,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' order by media_anchor.anchor_time";


$result = $mysqli->query($query);
while($row = $result->fetch_array(MYSQL_ASSOC)){
$name = $row['name'];
$anchor_time = $row['anchor_time'];
$anchor_descript = $row['anchor_descript'];
$s   =   $anchor_time%60;
$m   =   floor($anchor_time/60);
//$o   =   floor($m/60);
if($m < 10) $m = "0".$m;
if($s < 10) $s = "0".$s;
echo "<div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer'>[$m:$s] $name 說：<br> $anchor_descript</div>";
}
*/
?>