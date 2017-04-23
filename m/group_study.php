<!--此為我的學習主題頁面-->
<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Video Learning</title>

<link href="css/mobile_css.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".menu").click(function() {
        $(this).toggleClass("active");
        $(".nav").slideToggle();
    });
    $(".nav > ul > li:has(ul) > a").append('<div class="arrow-bottom"></div>');
});
</script>


</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
        include_once("../php/root.php");
        if($_SESSION['account']){
			include_once("php/banner_s.php");
		 }
?>

</div>
<div id="page">
  <div id="content">
			<img  style="width:450px; " src="../images/test/stu-mytheme.png"/>
			<?php
				$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id'";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $learning_name = $row["learning_name"];
				   $learning_id = $row["learning_id"];
				   $user_media_id = $row["user_media_id"];
				   
					$_SESSION['user_media_id'] = $user_media_id;
				   
				   $learning_start = $row["learning_start"];				   
				   $team_id = $row["team_id"];
				   $learning_end = $row["learning_end"];
				   $learning_content = $row["learning_content"];
				   $edit_books_id = $row["edit_books_id"];
				   $name = $row["name"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];
				   if(strstr($url,"youtube")){
					$youtubeid = explode("=" , $url);
					$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' />";
					}else{			
				   $aimgs = "<img class='imgs' src='../user_pics/$url.jpg' align='top' />";}
				   	echo "<div style='width:100%;margin-left:15px;'>
						<div style='width:100px;float:left;margin-top:15px;'>
							$aimgs
						</div>
						<div style='width:100%;height:100px;margin-left:10px;'><br>
							<ul>
							<li style='list-style: none;'><label style='color:#69F;';>【 $subject_catalog 】 <a style='text-decoration: none;' href='../m/start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id'>$learning_name</a></label></li>
							<label style='font-size:12px;color:#49C;'>　期限：$learning_start ~ $learning_end</label>

						</div></div><hr>";
				}
				mysqli_free_result($result);
				?>
			

  </div>
</div>
  
</body>
</html>