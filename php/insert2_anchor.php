<?php
include_once("root.php");

$button = mysql_escape_string($_POST['button']);
$anchor_time = mysql_escape_string($_POST['anchor_time']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$img_anchor_id = mysql_escape_string($_POST['img_anchor_id']);
$media_url = mysql_escape_string($_POST['media_url']);

$s   =   $anchor_time%60;
$m   =   floor($anchor_time/60);
$h	 =	 floor($anchor_time/360);
//$o   =   floor($m/60);
if($h < 10) $h = "0".$h;
if($m < 10) $m = "0".$m;
if($s < 10) $s = "0".$s;

if($button == img){
	//$anchor_time=($anchor_time-0.2);
	$image_name="$user_media_id"."_"."$anchor_time".".jpg";
	
	shell_exec("ffmpeg -i ../user_movie/$media_url.flv -ss $anchor_time -vframes 1 -y ../images/anchor/$image_name");
	
	echo "images/anchor/$image_name";
	//echo "<div id='msg' class='antime3 $anchor_time'><img src ='2.jpg'/></div>";


}else if($button == delete){
	
	$query="DELETE from img_anchor WHERE img_anchor_id='$img_anchor_id'";
	
	$result = $mysqli->query($query);

}else{

	echo "$h:$m:$s";
	
}

?>