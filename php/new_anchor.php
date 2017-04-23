<?php
include_once("root.php");

$button==mysql_escape_string($_POST['button']);
$user_media_id=mysql_escape_string($_POST['user_media_id']);
$member_id=mysql_escape_string($_POST['member_id']);
$image=mysql_escape_string($_POST['image']);
$script=mysql_escape_string($_POST['anchor_script']);
$start_time=mysql_escape_string($_POST['start_time']);
$stop_time=mysql_escape_string($_POST['stop_time']);
$img_anchor_date=date('Y-m-j');
$privacy = mysql_escape_string($_POST['privacy']);

echo ($user_media_id);
$query="insert into img_anchor(user_media_id,member_id,image,script,start_time,stop_time,img_anchor_date) values('$user_media_id','$member_id','$image','$script','$start_time','$stop_time','$img_anchor_date')";
$result = $mysqli->query($query);

if($privacy)
	$query="select member.name,img_anchor.img_anchor_id,img_anchor.image,img_anchor.script,img_anchor.start_time,img_anchor.stop_time from member left join img_anchor on member.member_id =  img_anchor.member_id where user_media_id = '$user_media_id' AND img_anchor.member_id = '$member_id'  order by img_anchor.start_time";
else
	$query="select member.name,img_anchor.img_anchor_id,img_anchor.image,img_anchor.script,img_anchor.start_time,img_anchor.stop_time from member left join img_anchor on member.member_id =  img_anchor.member_id where user_media_id = '$user_media_id' AND img_anchor.member_id = '$member_id'order by img_anchor.start_time";

	
	
$resultSelect = $mysqli->query($query);
//$row = $result->fetch_array(MYSQLI_ASSOC);

while($row = $resultSelect->fetch_array(MYSQLI_ASSOC)){

$name = $row['name'];
$img_anchor_id = $row['img_anchor_id'];
$image = $row['image'];
$script = $row['script'];
$start_time = $row['start_time'];
$stop_time = $row['stop_time'];


$image = $row['image'];
$start_s   =   $start_time%60;
$start_m   =   floor($start_time/60);
$start_h   =   floor($start_time/360);
//$o   =   floor($m/60);
if($start_h < 10) $start_h = "0".$start_h;
if($start_m < 10) $start_m = "0".$start_m;
if($start_s < 10) $start_s = "0".$start_s;

$stop_s   =   $stop_time%60;
$stop_m   =   floor($stop_time/60);
$stop_h   =   floor($stop_time/360);
//$o   =   floor($m/60);
if($stop_h < 10) $stop_h = "0".$stop_h;
if($stop_m < 10) $stop_m = "0".$stop_m;
if($stop_s < 10) $stop_s = "0".$stop_s;

echo "<div id='$img_anchor_id' title='$start_time' class='antime $start_time'>
			<table style='border:1px solid #000000; width:300px; 'align ='center' valign='middle' frame='border' rules='all'> 
				<tr style=' height:30px;'>
					<td colspan=2 align ='right'>
						<label id='play' class='ibutton' style='background-color:#F60'>播放</label>
						<label id='edit' class='ibutton' style='background-color:#F60'>更改</label>
						<label id='delete' class='ibutton' style='background-color:#F60'>刪除</label>
					</td>
				</tr>
				<tr>
					<td colspan=2 align ='center'><img id='jpg2' style='width:200px;' src='$image'/><br/>
					<textarea id='script' border='1px' cols='25' rows='2' disabled>$script</textarea></td>
				</tr>
				<tr style=' height:30px;'>
					<td align ='center'><a>開始時間</a><input type=text id='startT' value='$start_h:$start_m:$start_s' disabled size='6' ></input></td>
					<td align ='center'><a>結束時間</a><input type=text id='stopT' value='$stop_h:$stop_m:$stop_s' disabled size='6' ></input></td>
				</tr>
				
			</table>
		</div>";
		
}

?>