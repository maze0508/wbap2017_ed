<?php
include_once("root.php");
$member_id = mysql_escape_string($_POST['member_id']);



		echo"<select id='compos_book_select'> <option value='change'>請選擇章節</option>";
		$query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$member_id'";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_book_id = $row['compos_book_id'];
			$compos_book_name = $row['compos_book_name'];
			echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
		}
		echo"</select>";

		
?>