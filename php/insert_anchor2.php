<?php
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
?>