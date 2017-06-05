<?php
include_once("root.php");
//$button_type = mysql_escape_string($_POST['button_type']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
if($_POST['anchor_class_id']){
	$anchor_class_id = mysql_escape_string($_POST['anchor_class_id']);
}else{
	$anchor_class_id = "all_class";
}
	//如果按全部註記的按鈕
	if($anchor_class_id=="all_class"){
		$anchor_class_id='';
		echo"<div id=$anchor_class_id class='class_anchor'>";
		$query="select member.name,media_anchor_image.media_anchor_image_id,media_anchor_image.image,media_anchor_image.anchor_descript,media_anchor_image.noteColor,media_anchor_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor_image on member.member_id =  media_anchor_image.member_id LEFT JOIN anchor_class ON media_anchor_image.anchor_class_id= anchor_class.anchor_class_id where media_anchor_image.member_id = '$member_id'  order by media_anchor_image.anchor_time";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$anchor_class_id = $row['anchor_class_id'];
			$name = $row['name'];
			if($row['image']){
				$image = $row['image'];
			}else {
				$image = null;	
			}
			$media_anchor_image_id = $row['media_anchor_image_id'];
			$anchor_descript = $row['anchor_descript'];
			$noteColor = $row['noteColor'];
			if($row['anchor_class_id']){
				$class_name = $row['anchor_class_name'];
			}else{
				$class_name = "未分類";
			}
				echo "<div id='$media_anchor_image_id' class='Note_other' name='未分類'>
					<div name='$class_name' class='select_edit'>
						<table>
							<tr>
								<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
								<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
								<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
							</tr>
						</table>
					</div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_image_id' class='descript_edit'>
						";
						if($image!=null){
							/*$enc = mb_detect_encoding($image);
							$data = mb_convert_encoding($image, "ASCII", $enc);
							$data = substr($data,1);
							echo "<p><img class='note_descript' style='width:50%;height:50%;' src='./images/anchor/".$data."'/></p>";
							*/
							echo "<p><img class='note_descript' style='width:50%;height:50%;' src='./images/anchor/".$image."'/></p>";
						}
						echo"<p>$anchor_descript</p></div>
				</div>";
		}
		echo"<div id='all_class' class='Note_other' name='未分類'>
		<div><div>新增註記</div></div>
			<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
			<div class='entry'>
				<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
					<div><textarea class='descript_new' cols='18' rows='4' maxlength='200'></textarea>
					</div>
				</div>
				<div id='Queue'  style='display:hidden;'></div>
				<div id='filesUploaded'  style='display:hidden;'></div>
				<div style='text-align:top;float:left;width:100%;'>
				<button type='button' name='uploadify' id='uploadify'>Browser</button>
				<input type='button' id='add_note'  style='background-image:url(images/add_note.jpg);width:30px; height: 30px; border: 0; background-size: 100%;margin-left:80%; cursor:pointer;'/>
				</div>
			</div>
			</div>
			</div>
		
	</div>";
		echo "</div>";
	}else{
		//如果按其他的分類名稱
		$anchor_class_id=$anchor_class_id;
		echo"<div id=$anchor_class_id class='class_anchor'>";
		$query="select member.name,media_anchor_image.media_anchor_image_id,media_anchor_image.image,media_anchor_image.anchor_descript,media_anchor_image.noteColor,media_anchor_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor_image on member.member_id =  media_anchor_image.member_id LEFT JOIN anchor_class ON media_anchor_image.anchor_class_id= anchor_class.anchor_class_id where media_anchor_image.user_media_id = '$user_media_id' AND media_anchor_image.member_id = '$member_id' AND media_anchor_image.anchor_class_id= '$anchor_class_id' order by media_anchor_image.anchor_time";
		$result = $mysqli->query($query);
		$class_name = $row['anchor_class_name'];
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$name = $row['name'];
			if($row['image'])
				$image = $row['image'];
			else 
				$image = null;	
			$media_anchor_id = $row['media_anchor_image_id'];
			$anchor_descript = $row['anchor_descript'];
			$noteColor = $row['noteColor'];
			$class_name = $row['anchor_class_name'];
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
						";
						if($image!=null){
							/*$enc = mb_detect_encoding($image);
							$data = mb_convert_encoding($image, "ASCII", $enc);
							$data = substr($data,1);
							echo "<p><img class='note_descript' style='width:50%;height:50%;' src='./images/anchor/".$data."'/></p>";
							*/
							echo "<p><img class='note_descript' style='width:50%;height:50%;' src='./images/anchor/".$image."'/></p>";
						}
					echo"<p>$anchor_descript</p></div>
				</div>";
		}
		echo"
		<div id='all_class' class='Note_other' name='未分類'>
		<div><div>新增註記</div></div>
			<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
			<div class='entry'>
				<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
					<div><textarea class='descript_new' cols='18' rows='4' maxlength='200'></textarea>
					</div>
				</div>
				<div id='Queue'  style='display:hidden;'></div>
				<div id='filesUploaded'  style='display:hidden;'></div>
				<div style='text-align:top;float:left;width:100%;'>
				<button type='button' name='uploadify' id='uploadify'>Browser</button>
				<input type='button' id='add_note'  style='background-image:url(images/add_note.jpg);width:30px; height: 30px; border: 0; background-size: 100%;margin-left:80%; cursor:pointer;'/>
				</div>
			</div>
			</div>
			</div>
		
	</div>";
		
	}
//ob_end_clean();
?>