<?php
include_once("root.php");
$button_type = mysql_escape_string($_POST['button_type']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$anchor_class_name = mysql_escape_string($_POST['anchor_class_name']);

if($button_type=="image"){
	$query="insert into anchor_class(member_id,user_media_id,anchor_class_name,type) values('$member_id','$user_media_id','$anchor_class_name','1')";
	$result = $mysqli->query($query);
	$query="SELECT member.name,  anchor_class.type,anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id' AND anchor_class.type ='1' ORDER BY anchor_class.anchor_class_id ";
	$result = $mysqli->query($query);
}else{
	$query="insert into group_class(member_id,user_media_id,team_id,anchor_class_name) values('$member_id','$user_media_id','$team_id','$anchor_class_name')";
	$result = $mysqli->query($query);


	//$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id' AND anchor_class.type ='0' ORDER BY anchor_class.anchor_class_id ";
	$query="SELECT member.name, group_class .group_class_id, group_class .anchor_class_name
				FROM member
				LEFT JOIN group_class ON member.member_id = group_class .member_id
				WHERE user_media_id ='$user_media_id'
				AND group_class.team_id = '$team_id'
				AND group_class .type =  '0'
				ORDER BY group_class .group_class_id
				";
	$result = $mysqli->query($query);
}		
		$sum=1;	
		while($row = $result->fetch_array(MYSQL_ASSOC)){

		$group_class_id = $row['group_class_id'];
		$anchor_class_name = $row['anchor_class_name'];
		
		$an=$sum%5;
		
		if($an==0){
			$bg_img='images/test/stu-red.png';
			$bg_color='#f4b4b9';}
		if($an==1){
			$bg_img='images/test/stu-oran.png';
			$bg_color='#f7dcae';}
		if($an==2){
			$bg_img='images/test/stu-green.png';
			$bg_color='#cef5b8';}
		if($an==3){
			$bg_img='images/test/stu-blue.png';
			$bg_color='#bae3f5';}
		if($an==4){
			$bg_img='images/test/stu-pur.png';
			$bg_color='#e0c8dd';}
		
		//echo "<div id='$group_class_id' class='Class'>$anchor_class_name<button id='del_class'>d</button></div>";
		echo "<div class='Class' id='$group_class_id'><table cellspacing='0'>
					<tr>
						<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url($bg_img);padding-right: 0px;padding-left: 0px;'></td>
						<td class='class_name' style='width:215px;background-color:$bg_color;'>
							<div id='$group_class_id' class='go_class'>$anchor_class_name</div>
							<div id='class_textarea'style='display:none;'><input type='text' id='class_name_new'  size='10' maxlength='6' value='$anchor_class_name' /><button id='class_change'>確定</button><button id='class_cancel'>取消</button></div>
						</td>
						<td style='width:16px;background-color:$bg_color;'>
							<div><img id='del_class' style='width:16px;'src='./images/cancel.png';></img></div>
							<div><img id='edit_class' style='width:16px;'src='./images/tag_blue_add.png';></img></div>
						</td>
					</tr>
					</table></div>";
		$sum++;			
		}
		
?>