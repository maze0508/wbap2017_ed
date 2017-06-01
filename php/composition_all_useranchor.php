<?php
//顯示目前的學習主題
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);
$anchor_type = mysql_escape_string($_POST['anchor_type']);
echo"<div class='all_useranchor' >";
echo"<div><select id='media_select' class='$anchor_type'> <option value='change'>請選擇主題影片</option>";
$query = "select learning.learning_name,user_media.user_media_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id'";
$result = $mysqli->query($query);					
while ($row = $result->fetch_array(MYSQL_ASSOC)) {
	$learning_name = $row["learning_name"];
	$user_media_id = $row["user_media_id"];
	echo '<option value="' . $row['user_media_id'] . '">' . $row['learning_name'] . '</option>' . "\n";
}
echo"</select></div>";
echo"<div id=media_class></div>";
echo"<div id=media_anchor_image></div>";

?>