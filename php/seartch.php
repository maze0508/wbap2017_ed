<?php
include_once("root2.php");
$search_key = mysql_escape_string($_POST['search_key']);

$query3 = "select edit_books.edit_books_id,user_media.user_media_id,user_media.url,user_media.title,edit_books.subject_id from edit_books left join user_media on edit_books .user_media_id =  user_media.user_media_id WHERE user_media.title like '%$search_key%' order by edit_books.subject_id";
					$result3 = mysql_query($query3);
					while($row3 = mysql_fetch_array($result3)){
					   $subject_id = $row3["subject_id"];
					   $edit_books_id = $row3["edit_books_id"];
					   $user_media_id = $row3["user_media_id"];
					   $url = $row3["url"];				   
					   $title = iconv_substr($row3["title"], 0, 10, 'utf-8');
					   $found = strstr($url,"youtube");				   
					   if($found)
							echo "<div class='temp_movie' style='float: left;margin: 25px;'>
								<a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'>
									<img src='' style='width: 120px;' class='youtube' name='$url' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					   else
							echo "<div class='temp_movie' style='float: left;margin-right: 25px;'>
									<a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'>
										<img style='width: 120px;' src='user_pics/$url.jpg' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					}
?>