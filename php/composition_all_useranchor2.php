<?php
//選擇註記的分類
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);
$anchor_type = mysql_escape_string($_POST['anchor_type']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
if($user_media_id!=change){
//if($anchor_type=='image'){	
	$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id'  ORDER BY anchor_class.anchor_class_id ";
/*}else{
	$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id' AND anchor_class.type ='0' ORDER BY anchor_class.anchor_class_id";
}*/
$result = $mysqli->query($query);
while ($row = $result->fetch_array(MYSQL_ASSOC)) {
	$anchor_class_id = $row['anchor_class_id'];
	$anchor_class_name = $row['anchor_class_name'];
	echo "<div id='$anchor_class_id'><div class='open_anchor'>$anchor_class_name</div></div>";
}
echo"</div>";

	}

?>