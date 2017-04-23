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
border-bottom:1px solid #DEF;
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
<label style="color:#69F">教材資源</label>
	<div style="width:100%;overflow:auto;border:1px solid #DEF;">
    <ul>
				<?php
				$query = "select edit_books.edit_books_id,edit_books.books_target,edit_books.books_content,edit_books.books_concept,edit_books.slesson,user_media.user_media_id,user_media.url,user_media.title from edit_books inner join user_media on edit_books.user_media_id = user_media.user_media_id";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $user_media_id = $row["user_media_id"];
				   $url = $row["url"];				   
				   //$title = iconv_substr($row["title"], 0, 10, 'utf-8');
				   $title = $row["title"];
				   $edit_books_id = $row["edit_books_id"];
				   $books_target = $row["books_target"];
				   $books_content = $row["books_content"];				   
				   $books_concept = $row["books_concept"];
				   $slesson = $row["slesson"];
				    if(strstr($url,"youtube")){
					$youtubeid = explode("=" , $url);
					$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' / style='width:196px;height:110px;'>";
					}else{			
				   $aimgs = "<img class='imgs' src='../user_pics/$url.jpg' align='top' style='width:196px;height:110px;'/>";}
					echo "
					<li style='list-style:none;'>
					<div class='temp_movie'>
						<div style='width:196px;float:left;'>
							$aimgs
						</div>
						<div style='float:left;width:100%;'>
							<label class='movie_title'>片名：<a style='text-decoration: none;color:#69C' href='books_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id'>$title</a></label><br/>
							<label class='movie_title'>適用年級：$slesson</label><br>
							<label class='movie_title'>學習目標：$books_target</label>
						</div></div></li>";
					
				}
				mysqli_free_result($result);
				?>	
		</ul></div>
  </div>
</div>
</body>
</html>
