
<?php
include_once("../../php/root2.php");
$member_id = $con->real_escape_string($_POST['member_id']);
$user_media_id = $con->real_escape_string($_POST['user_media_id']);
$team_id = $con->real_escape_string($_POST['team_id']);
//$page = $con->real_escape_string($_POST['page']);


$query="SELECT member.name, media_anchor_image.media_anchor_image_id, media_anchor_image.anchor_descript, media_anchor_image.noteColor, media_anchor_image.anchor_time, media_anchor_image.image
				FROM member
				LEFT JOIN media_anchor_image ON member.member_id =  media_anchor_image.member_id
				WHERE user_media_id = '$user_media_id'
				AND media_anchor_image.member_id = '$member_id'  
				ORDER BY media_anchor_image.anchor_time";
				
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($result);
			/*檢查此學習主題是否為空*/
			if(empty($row)){
				echo "<p>此學習主題目前尚無註記</p>";
			}else{
				/*
				//將註記分頁,每5個註記一頁
				$query2 = "SELECT count(*) as total from (".$query.")as temp;";
				$result2 = mysqli_query($con,$query2);
				$row2 = mysqli_fetch_assoc($result2);
				echo "筆數".$row2['total'];
				echo "page:".$page;
				
				$per = 5; //每頁顯示5個註記 
				$pages = ceil($row2['total']/$per);//總頁數
				$start = ($page-1)*$per; //每頁起始資料序號
				$query = $query.' LIMIT '.$start.', '.$per;
				$result = mysqli_query($con,$query); 
				$row = mysqli_fetch_assoc($result);
				*/
				
				while($row) { 
					$name = $row['name'];
					$anchor_time = $row['anchor_time'];
					$image = $row['image'];
					$anchor_descript = $row['anchor_descript'];//文字
					$media_anchor_image_id = $row['media_anchor_image_id'];//文字
					$noteColor = $row['noteColor'];
					
					$s   =   $anchor_time%60;
					$m   =   floor($anchor_time/60);
					//$o   =   floor($m/60);
					$m = ($m < 10)?"0".$m:$m;
					$s = ($s < 10)?"0".$s:$s;
					
					if($noteColor==0){
						echo "<table id='$media_anchor_image_id' style='border-top:1px solid;cursor:pointer;color:#FFF'>
								<tr>
									<td style='width:90%;color:#69C'><div id='$anchor_time' class='antime $anchor_time' ><a style='text-decoration: none;' href='../m/start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'>[$m:$s] $name 說：<br> <img class='image' style='width:90%;' src='../images/anchor/$image'/><br> $anchor_descript</a></div></td>
									<td style='width:10%;'>
										<div><img class='delete_button' style='width:16px;'src='../images/cancel.png';></img></div> 
									</td>
								</tr>
								</table>
							";
					}
					$row = mysqli_fetch_assoc($result);
				}
			}

		?>	
