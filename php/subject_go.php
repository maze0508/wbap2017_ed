<?php
include_once("root.php");
$subject_id = mysql_escape_string($_POST['subject_id']);
$subject_name = mysql_escape_string($_POST['subject_name']);
echo"<div style='background-image:url(images/test/home-tit.png);background-size:auto 30px;padding:0px 0px 2px 30px;'><h3 >".$subject_name."</h3></div>";
					
$query3 = "select edit_books.edit_books_id,user_media.user_media_id,user_media.url,user_media.title from edit_books left join user_media on edit_books .user_media_id =  user_media.user_media_id WHERE subject_id='$subject_id' order by edit_books.subject_id";
					$result3 = $mysqli->query($query3);
					while($row3 = $result3->fetch_array(MYSQL_ASSOC)){
						
					   $user_media_id = $row3["user_media_id"];
					   $url = $row3["url"];				   
					   //$title = iconv_substr($row3["title"], 0, 10, 'utf-8');
					   $title = $row3["title"];
					   $found = strstr($url,"youtube");		
                       $media_type .= $row['media_type']; 		
					   if($found){
                            $UrlArray = explode("=" , $url);
							$youtube_name = $UrlArray[1];
							echo "<div class='temp_movie' style='float: left;margin: 25px;'><a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'><img style='width: 120px;' src='http://img.youtube.com/vi/$youtube_name/2.jpg'/><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div><br/>";
                       }else{
							echo "<div class='temp_movie' style='float: left;margin-right: 25px;'><a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'><img style='width: 120px;' src='user_pics/$url.jpg' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					}
                    }

?>