<?php
include_once("root.php");
$button = mysql_escape_string($_POST['button']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$media_anchor_id = mysql_escape_string($_POST['anchor_descript_id']);
$anchor_descript_new = mysql_escape_string($_POST['anchor_descript_new']);


echo "<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
		<div class='descript'>$anchor_descript_new</div>
		<div id='descript_textarea' style='display:none;'><textarea class='descript' cols='15' rows='6'>$anchor_descript_new</textarea><button id='note_change'>確定</button><button id='note_cancel'>取消</button></div>
	</div>";
/*
if($button=="class_change"){
$query="UPDATE media_anchor SET anchor_class_id = '$anchor_class_id' WHERE media_anchor_id='$media_anchor_id';";
		$result = $mysqli->query($query);
		echo "<div name='$anchor_class_id' class='select_class'>$anchor_class_name</div>";
}else if($button==canncel){

		echo "<div name='$anchor_class_id' class='select_class'>$anchor_class_name</div>";
}else{
		
	echo"<textarea  id='$media_anchor_id' cols='15' rows='6'>$media_anchor_val</textarea><button id='note_change'>確定</button><button id='note_canncel'>取消</button>";
}
*/
?>