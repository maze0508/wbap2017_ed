<?php  
include_once("root.php");
$member_id=mysql_escape_string( $_POST['member_id']);
$user_media_id=mysql_escape_string( $_POST['user_media_id']);
$button=mysql_escape_string( $_POST['button']);
//$url_new=mysql_escape_string( $_POST['url_new']);
$group_image_id=mysql_escape_string( $_POST['group_image_id']);
$src = mysql_escape_string( $_POST['src']);
$image_old =mysql_escape_string( $_POST['image_old']);
$now=md5(gmdate('YmdHis', time()));//MD5（現在時間）避免檔名重複
$image_new =$group_image_id . "_" . $now . ".jpg";
$url_new="../images/anchor/" . $group_image_id . "_" . $now . ".jpg";
$url_old="../images/anchor/" . $image_old;


$targ_w = 320;
$targ_h = 240;  
$jpeg_quality = 90;  
  
if($button=="close"){
	$query="SELECT member.name, group_image.image, group_image.noteColor, group_image.group_image_id, group_image.anchor_time
			FROM member
			LEFT JOIN group_image ON member.member_id = group_image.member_id
			WHERE user_media_id = '$user_media_id'
			AND group_image.member_id = '$member_id'
			ORDER BY group_image.anchor_time
			";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$name = $row['name'];
			$anchor_time = $row['anchor_time'];
			$image = $row['image'];
			$group_image_id = $row['group_image_id'];
			$noteColor = $row['noteColor'];
			
			$s   =   $anchor_time%60;
			$m   =   floor($anchor_time/60);
			//$o   =   floor($m/60);
			$m = ($m < 10)?"0".$m:$m;
			$s = ($s < 10)?"0".$s:$s;
			
			if($noteColor==0){
				echo "
						<table id='$group_image_id' style='border-top:1px solid;cursor:pointer'>
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

}else{
	$img_r = imagecreatefromjpeg($src);  
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );  
	  
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);  
	imagejpeg($dst_r, $url_new, $jpeg_quality);
	unlink($url_old);
	$query="UPDATE group_image SET image = '$image_new' WHERE group_image_id='$group_image_id';";
	$result = $mysqli->query($query);

}
?> 