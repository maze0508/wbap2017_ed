<?php
	include_once('paginator.class.php');
	include_once('root2.php');
	
	$member_id = mysql_escape_string($_POST['member_id']);	
	
	$query = "SELECT COUNT(`record_id`='$member_id') FROM record";
	$result = mysql_query($query) or die(mysql_error());
	$num_rows = mysql_fetch_row($result);
	$pages = new Paginator;
	$pages->items_total = $num_rows[0];
	$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
	$pages->paginate();

	echo $pages->display_pages();
	echo "<span class=\"\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";

	$query = "select record_id,action,record_date FROM record WHERE member_id ='$member_id' ORDER BY record_date ASC $pages->limit";
	$result = mysql_query($query) or die(mysql_error());

	echo "<table width='70%'>";
	echo "<tr><th width='200px'>時間點</th><th width='400px'>歷史紀錄</th></tr>";
	while($row = mysql_fetch_row($result))
		{
		echo "<tr >
			<td align='center'>
			<div>$row[2]</div>
			</td>
			<td><div>$row[1]</div></td>
			</tr>\n";
		}
	echo "</table>";

	echo $pages->display_pages();
	echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
?>
