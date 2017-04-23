<?php
include_once("root.php");
//$button_type = mysql_escape_string($_POST['button_type']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$group_class_id = mysql_escape_string($_POST['group_class_id']);
//文字註記區
	if($group_class_id=="all_class"){
		$group_class_id="";
		
		//$query="select member.name,media_anchor.media_anchor_id,media_anchor.anchor_descript,media_anchor.noteColor,media_anchor.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor on member.member_id =  media_anchor.member_id LEFT JOIN anchor_class ON media_anchor.anchor_class_id= anchor_class.anchor_class_id where media_anchor.user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  order by media_anchor.anchor_time";
		//顯示小組所有註記
		$query="SELECT member.name, group_anchor.group_anchor_id, group_anchor.anchor_descript, group_anchor.noteColor, 
					   group_anchor.anchor_time, group_class.group_class_id, group_class.anchor_class_name
				FROM member
				LEFT JOIN group_anchor ON member.member_id = group_anchor.member_id
				LEFT JOIN group_class ON group_anchor.group_class_id = group_class.group_class_id
				WHERE group_anchor.user_media_id = '$user_media_id'
				AND group_anchor.team_id = '$team_id'
				ORDER BY group_anchor.anchor_time
				";
		$result = $mysqli->query($query);
					
		
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		
		
			$group_class_id = $row['group_class_id']; //註記分類編號
			$name = $row['name']; //會員姓名
			$anchor_descript = $row['anchor_descript']; //註記內容
			$group_anchor_id = $row['group_anchor_id']; //文字註記編號
			$noteColor = $row['noteColor']; // 藍OR黃底
			$id = $group_anchor_id."_".$member_id;
			
			if($row['group_class_id']){//註記分類編號
			
			$class_name = $row['anchor_class_name'];
			
			
			}else{
			$class_name = "未分類";
			
			}
			if($noteColor==0){ 
			
				echo "<div id='$group_anchor_id' class='Note' name='未分類'>
					<div name='$class_name' class='select_edit'><table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$class_name</div><td style='width:16px;'><td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$group_anchor_id' class='descript_edit'>
						<div class='note_descript'>$anchor_descript (by $name) </div>
						
					</div>
				</div>";
				
			}else{
				echo "<div id='$group_anchor_id' class='Note_other' name='未分類'>
					<div name='$class_name' class='select_edit'><table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$class_name</div><td style='width:16px;'><img id='del_note' style='width:16px;'src='./images/cancel.png';></img><td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$group_anchor_id' class='descript_edit'>
						<div class='descript'>$anchor_descript (by $name)</div>
						<div id='descript_textarea' style='display:none;'><textarea class='descript' cols='15' rows='6' maxlength='200'>$anchor_descript</textarea><button id='note_change'>確定</button><button id='note_cancel'>取消</button></div>
					</div>
				</div>";
				}
		}
		echo "<div id='all_class' class='Note_other' name='未分類'>
				<div><div>新增註記</div></div>
				<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
					<div><textarea class='descript_new' cols='15' rows='6' maxlength='200'></textarea><button id='add_note'>新增</button></div>
				</div>
			</div>";
	}else{ //  NOT "ALL CLASS"
		$group_class_id=$group_class_id;
	
		//顯示指定分類註記
		$query="SELECT member.name, group_anchor.group_anchor_id, group_anchor.anchor_descript, group_anchor.noteColor, 
					   group_anchor.anchor_time, group_class.group_class_id, group_class.anchor_class_name
				FROM member
				LEFT JOIN group_anchor ON member.member_id = group_anchor.member_id
				LEFT JOIN group_class ON group_anchor.group_class_id = group_class.group_class_id
				WHERE group_anchor.user_media_id =  '$user_media_id'
				AND group_anchor.team_id =  '$team_id'
				AND group_anchor.group_class_id =  '$group_class_id'
				ORDER BY group_anchor.anchor_time
				";
		//$query="select member.name,media_anchor.media_anchor_id,media_anchor.anchor_descript,media_anchor.noteColor,media_anchor.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor on member.member_id =  media_anchor.member_id LEFT JOIN anchor_class ON media_anchor.anchor_class_id= anchor_class.anchor_class_id where media_anchor.user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  AND media_anchor.anchor_class_id= '$group_class_id'  order by media_anchor.anchor_time";
		$result = $mysqli->query($query);
		$class_name = $row['anchor_class_name']; //分類名稱
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		
		
			$name = $row['name'];
			$anchor_descript = $row['anchor_descript'];
			$group_anchor_id = $row['group_anchor_id'];
			$noteColor = $row['noteColor'];
			$class_name = $row['anchor_class_name'];
			$id = $group_anchor_id."_".$member_id;
			if($noteColor==0){
			
			echo "<div id='$group_anchor_id' class='Note' name='$class_name'>
					<div name='$class_name' class='select_edit'><table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$class_name</div><td style='width:16px;'><td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$group_anchor_id' class='descript_edit'>
						<div class='note_descript'>$anchor_descript (by $name)</div>
					</div>
				</div>";
			}else{
			
				echo "<div id='$group_anchor_id' class='Note_other' name='$class_name'>
					<div name='$class_name' class='select_edit'><table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$class_name</div><td style='width:16px;'><img id='del_note' style='width:16px;'src='./images/cancel.png';></img><td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$group_anchor_id' class='descript_edit'>
						<div class='descript'>$anchor_descript (by $name)</div>
						<div id='descript_textarea' style='display:none;'><textarea class='descript' cols='15' rows='6' maxlength='200'>$anchor_descript</textarea><button id='note_change'>確定</button><button id='note_cancel'>取消</button></div>
					</div>
				</div>";
			}
		}
		echo "<div id='$group_class_id' class='Note_other' name='$class_name'>
				<div><div>新增註記</div></div>
				<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
					<div><textarea class='descript_new' cols='15' rows='6' maxlength='200'></textarea><button id='add_note'>新增</button></div>
				</div>
			</div>";
	
}
/* 圖片註記區
if($button_type=="image"){
	if($anchor_class_id=="all_class"){
		$anchor_class_id='';
		echo"<div id='' class='class_anchor'>";
		$query="select member.name,media_image.media_image_id,media_image.image,media_image.noteColor,media_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_image on member.member_id =  media_image.member_id LEFT JOIN anchor_class ON media_image.anchor_class_id= anchor_class.anchor_class_id where media_image.user_media_id = '$user_media_id' AND media_image.member_id = '$member_id'  order by media_image.anchor_time";
		$result = $mysqli->query($query);
		
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		
		
			$anchor_class_id = $row['anchor_class_id'];
			$name = $row['name'];
			$image = $row['image'];
			$media_anchor_id = $row['media_image_id'];
			$noteColor = $row['noteColor'];
			if($row['anchor_class_id']){
			
			$class_name = $row['anchor_class_name'];
			
			
			}else{
			$class_name = "未分類";
			
			}
			if($noteColor==0){
			
				echo "<div id='$media_anchor_id' class='Note' name='未分類'>
					<div name='$class_name' class='select_edit'>
					<table><tr><td style='width:165px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
					<td style='width:16px;'><img class='edit_button' style='width:16px;margin-right: 10px;'src='./images/tag_blue_add.png';></img></td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<p><img class='note_descript' style='width:145px;' src='./images/anchor/$image';/></p>
						
					</div>
				</div>";
				
			}else{
				echo "<div id='$media_anchor_id' class='Note_other' name='未分類'>
					<div name='$class_name' class='select_edit'>
						<table>
							<tr>
								<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
								<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
								<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
							</tr>
						</table>
					</div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<p><img class='note_descript' style='width:145px;' src='./images/anchor/$image';/></p>
						
					</div>
				</div>";
				}
		}
		echo"<div id='all_class' class='Note_other' name='未分類'>
		<div><div>新增註記</div></div>
			<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
			<div class='entry'>
				<div style='text-align:top'>
				<button type='button' name='uploadify' id='uploadify'>Browser</button>
				</div>
				<div id='Queue'></div>
				<div id='filesUploaded'></div>
				
			</div>
			</div>
		
	</div>";
		echo "</div>";
	}else{
		$anchor_class_id=$anchor_class_id;
		echo"<div id=$anchor_class_id class='class_anchor'>";
		$query="select member.name,media_image.media_image_id,media_image.image,media_image.noteColor,media_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_image on member.member_id =  media_image.member_id LEFT JOIN anchor_class ON media_image.anchor_class_id= anchor_class.anchor_class_id where media_image.user_media_id = '$user_media_id' AND media_image.member_id = '$member_id' AND media_image.anchor_class_id= '$anchor_class_id' order by media_image.anchor_time";
		$result = $mysqli->query($query);
		$class_name = $row['anchor_class_name'];
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		
		
			$name = $row['name'];
			$image = $row['image'];
			$media_anchor_id = $row['media_image_id'];
			$noteColor = $row['noteColor'];
			$class_name = $row['anchor_class_name'];
			
			
			if($noteColor==0){
			
				echo "<div id='$media_anchor_id' class='Note' name=$class_name>
					<div name='$class_name' class='select_edit'>
					<table><tr><td style='width:165px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
					<td style='width:16px;'><img class='edit_button' style='width:16px;margin-right: 10px;'src='./images/tag_blue_add.png';></img></td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<p><img class='note_descript' style='width:145px;' src='./images/anchor/$image';/></p>
						
					</div>
				</div>";
				
			}else{
				echo "<div id='$media_anchor_id' class='Note_other' name=$class_name>
					<div name='$class_name' class='select_edit'>
						<table>
							<tr>
								<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
								<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
								<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
							</tr>
						</table>
					</div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<p><img class='note_descript' style='width:145px;' src='./images/anchor/$image';/></p>
						
					</div>
				</div>";
				}
		}
		echo"<div id='$anchor_class_id' class='Note_other' name='$class_name'>
		<div><div>新增註記</div></div>
			<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
			<div class='entry'>
				<div style='text-align:top'>
				<button type='button' name='uploadify' id='uploadify'>Browser</button>
				</div>
				<div id='Queue'></div>
				<div id='filesUploaded'></div>
				
			</div>
			</div>
		
	</div>";
	echo "</div>";
	}
}else{
*/

?>