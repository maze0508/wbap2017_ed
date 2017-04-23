<?php
include_once("root.php");
$button = mysql_escape_string($_POST['button']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$group_anchor_id = mysql_escape_string($_POST['group_anchor_id']);
//$group_class_id = mysql_escape_string($_POST['group_class_id']);
$anchor_descript_new = mysql_escape_string($_POST['anchor_descript_new']);
if($button==note){
$query="UPDATE group_anchor SET member_id = '$member_id' , anchor_descript = '$anchor_descript_new'  WHERE group_anchor_id='$group_anchor_id';";
		$result = $mysqli->query($query);
$query1="SELECT name FROM member WHERE member_id='$member_id'";
$result1 = $mysqli->query($query1);		
		while ($row = $result1->fetch_array(MYSQL_ASSOC)) {
		$name = $row['name'];
		
		echo "<div class='descript'>$anchor_descript_new (by $name)</div>
		<div id='descript_textarea' style='display:none;'><textarea class='descript' cols='15' rows='6'>$anchor_descript_new</textarea><button id='note_change'>確定</button><button id='note_cancel'>取消</button></div>";
		}
}else{
//$query="UPDATE anchor_class SET anchor_class_name = '$anchor_descript_new' WHERE anchor_class_id='$media_anchor_id';";

$query="UPDATE group_class SET anchor_class_name = '$anchor_descript_new' WHERE group_class_id = '$group_anchor_id';";
		$result = $mysqli->query($query);
echo "<div id='$group_anchor_id' class='go_class'>$anchor_descript_new</div>
	  <div id='class_textarea'style='display:none;'><input type='text' id='class_name_new'  size='10' maxlength='20' value='$anchor_descript_new' /><button id='class_change'>確定</button><button id='class_cancel'>取消</button></div>";

}
?>