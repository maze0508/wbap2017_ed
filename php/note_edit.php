<?php
include_once("root.php");
$button = mysql_escape_string($_POST['button']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$media_anchor_id = mysql_escape_string($_POST['media_anchor_id']);
$anchor_descript_new = mysql_escape_string($_POST['anchor_descript_new']);
if($button==note){
$query="UPDATE media_anchor SET anchor_descript = '$anchor_descript_new' WHERE media_anchor_id='$media_anchor_id';";
		$result = $mysqli->query($query);
		
echo "<div class='descript'>$anchor_descript_new</div>
		<div id='descript_textarea' style='display:none;'><textarea class='descript' cols='15' rows='6'>$anchor_descript_new</textarea><button id='note_change'>確定</button><button id='note_cancel'>取消</button></div>";
}else{
$query="UPDATE anchor_class SET anchor_class_name = '$anchor_descript_new' WHERE anchor_class_id='$media_anchor_id';";
		$result = $mysqli->query($query);
echo "<div id='$media_anchor_id' class='go_class'>$anchor_descript_new</div>
							<div id='class_textarea'style='display:none;'><input type='text' id='class_name_new'  size='10' maxlength='20' value='$anchor_descript_new' /><button id='class_change'>確定</button><button id='class_cancel'>取消</button></div>";

}
?>