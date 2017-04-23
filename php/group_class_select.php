<?php
include_once("root.php");
$button = mysql_escape_string($_POST['button']);
$button_type = mysql_escape_string($_POST['button_type']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$team_id = mysql_escape_string($_POST['team_id']);
//$user_media_id = '20';
$member_id = mysql_escape_string($_POST['member_id']);
//$member_id = '67';
$group_class_id = mysql_escape_string($_POST['group_class_id']);
$anchor_class_name = mysql_escape_string($_POST['anchor_class_name']);
$group_anchor_id = mysql_escape_string($_POST['group_anchor_id']);
$note_type = mysql_escape_string($_POST['note_type']);
if($button_type=="image"){
	if($button=="class_change"){
		$query="UPDATE media_image SET anchor_class_id = '$anchor_class_id' WHERE media_image_id='$media_anchor_id';";
		$result = $mysqli->query($query);
		if($note_type=="Note"){
			echo "<table><tr><td style='width:135px;'><div name='$anchor_class_id' class='select_class' >$anchor_class_name</div></td><td style='width:16px;'></td></tr></table>";
		}else{
			echo "<table>
					<tr>
						<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$anchor_class_name</div></td>
						<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
						<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
					</tr>
				</table>";	
		}
	}else if($button=='canncel'){
		if($note_type=="Note"){
			echo "<table><tr><td style='width:135px;'><div name='$anchor_class_id' class='select_class' >$anchor_class_name</div></td>
							<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
						</tr></table>";
		}else{
			echo "<table>
					<tr>
						<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$anchor_class_name</div></td>
						<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
						<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
					</tr>
				</table>";	
		}
	}else{
			$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id' AND anchor_class.type ='1' ORDER BY anchor_class.anchor_class_id ";
			$result = $mysqli->query($query);
			

			echo'<select id="class_select1"><option value="未分類">未分類</option>';
			
			while ($row = $result->fetch_array(MYSQL_ASSOC)) {

			echo '<option value="' . $row['anchor_class_id'] . '">' . $row['anchor_class_name'] . '</option>' . "\n";

		}
		echo"</select><button id='select_change' name='$anchor_class_id'>確定</button><button id='select_canncel' name='$anchor_class_name'>取消</button>";
	}
}else{
	if($button=="class_change"){
		$query="UPDATE group_anchor SET group_class_id = '$group_class_id' WHERE group_anchor_id='$group_anchor_id';";
		$result = $mysqli->query($query);
		if($note_type=="Note"){
			echo "<table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$anchor_class_name </div><td style='width:16px;'><td></tr></table>";
		}else{
			echo "<table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$anchor_class_name </div><td style='width:16px;'><img id='del_note' style='width:16px;'src='./images/cancel.png';></img><td></tr></table>";
		}
	}else if($button==canncel){
		if($note_type=="Note"){
			echo "<table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$anchor_class_name </div><td style='width:16px;'><td></tr></table>";
		}else{
			echo "<table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$anchor_class_name </div><td style='width:16px;'><img id='del_note' style='width:16px;'src='./images/cancel.png';></img><td></tr></table>";	
		}
	}else{
			$query="SELECT member.name, group_class.group_class_id, group_class.anchor_class_name
					FROM member
					LEFT JOIN group_class ON member.member_id = group_class.member_id
					WHERE user_media_id =  '$user_media_id'
					AND group_class.team_id =  '$team_id'
					AND group_class.type =  '0'
					ORDER BY group_class.group_class_id";
			$result = $mysqli->query($query);
			

			echo'<select id="class_select1"><option value="未分類">未分類</option>';
			
			while ($row = $result->fetch_array(MYSQL_ASSOC)) {

			echo '<option value="' . $row['group_class_id'] . '">' . $row['anchor_class_name'] . '</option>' . "\n";

		}
		echo"</select><button id='select_change' name='$group_class_id'>確定</button><button id='select_canncel' name='$anchor_class_name'>取消</button>";
	}
}
?>