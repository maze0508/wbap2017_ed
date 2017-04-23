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
<style type="text/css">

.temp_movie{
cursor:pointer;
width:50%;
float:left;
margin-top:15px;
}
.movie_title{
	font-size: 15px;
    margin-bottom: 1px;
    max-width: 196px;
	margin-right: 20px;
	font-weight: 500;
}
</style>

</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
        include_once("../php/root.php");
        if($_SESSION['account']){
			 include_once("php/banner_t.php");
		}
?>

</div>
<div id="page">
  <div id="content">
  <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
<label style="color:#69F">我的教材</label>
	<div style="width:100%;overflow:auto;border:1px solid #DEF;">
    <ul>
				<?php
				$query = "SELECT user_media.user_media_id,user_media.url,user_media.title from user_media left join edit_books on user_media.user_media_id = edit_books.user_media_id where edit_books.member_id = '$member_id' ORDER BY user_media_id ";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $user_media_id = $row["user_media_id"];
				   $url = $row["url"];
				   $title =  iconv_substr($row["title"], 0, 8, 'utf-8');
				   $found = strstr($url,"youtube");
                    shell_exec ("ffmpeg -i ../user_movie/$url.$media_type -ss 00:00:00 -vframes 1 -y user_pics/$user_media_id.jpg");
				 if($found){
                    $UrlArr = explode("=" , $url);
				    $youtube_n = $UrlArr[1];
					echo "<li style='list-style:none;'><div class='temp_movie'><a href='../my_books.php?user_media_id=$user_media_id'><div><img src='http://img.youtube.com/vi/$youtube_n/0.jpg' class='youtube' name='$url' style='width:196px;height:110px;'/></div></a><h3 class='movie_title'><a href='my_books.php?user_media_id=$user_media_id' style='text-decoration:none;color:#69C'>$title</a></h3></div></li>";
				}else{
					echo "<li style='list-style:none;'><div class='temp_movie'><a href='../my_books.php?user_media_id=$user_media_id' style='text-decoration:none;'><div><img src='../user_pics/$url.jpg' style='width:196px;height:110px;'/></div></a><h3 class='movie_title'><a href='my_books.php?user_media_id=$user_media_id' style='text-decoration:none;color:#69C'>$title</a></h3></div></li>";
				}
                }
				mysqli_free_result($result);
				?>
		</ul></div>
  </div>
</div>
</body>
</html>
