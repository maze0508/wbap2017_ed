<?php
include_once("root.php");
$select_id = mysql_escape_string($_POST['select_id']);
$select_type = mysql_escape_string($_POST['select_type']);

switch($select_type){
	case "course":
		echo "<option class='change' value='change'>請選擇章節 學生</option>";
		$query = "select member.name,course_stu.member_id,course_stu.course_stu_id from member left join course_stu on course_stu.member_id = member.member_id where course_stu.course_id = '$select_id' order by member.name";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$name = $row["name"];
			$member_id = $row["member_id"];
			$course_stu_id = $row["course_stu_id"];
			echo '<option value="' . $member_id . '">' . $name . '</option>' . "\n";
		}
	break;
	case "course_stu":
		echo "<option class='change' value='change'>請選擇章節 項目</option>";
		echo '<option value="item_Danchor">文字註記</option>' . "\n";
		echo '<option value="item_Ianchor">圖片註記</option>' . "\n";
		echo '<option value="item_Dclass">文字分類</option>' . "\n";
		echo '<option value="item_Iclass">圖片分類</option>' . "\n";
		echo '<option value="item_Nbook">筆記本</option>' . "\n";

	break;
	case "item_Danchor":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}

	break;
	case "item_Ianchor":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}
	break;
	case "item_Dclass":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}
	break;
	case "item_Iclass":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}
	break;
	case "item_Nbook":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$select_id'";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_book_id = $row['compos_book_id'];
			$compos_book_name = $row['compos_book_name'];
			echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
		}

	break;
}
		
?>