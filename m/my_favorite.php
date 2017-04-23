<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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

.item{
	cursor:pointer;
	border-top:1px solid #FFF;
	padding:2px;
	font-family:"微軟正黑體";
}
.item p{
	font-size:12px;
}
a,a:link,a:visited{text-decoration: none}
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
  <label style="color:#69F">我的收藏</label>
			<?php
				$query = "select user_media.title,media_favorite.user_media_id,media_favorite.user_media_id,user_media.description,media_favorite.date from user_media left join media_favorite on media_favorite.user_media_id = user_media.user_media_id where media_favorite.member_id ='$member_id' order by date desc";
				$result = $mysqli->query($query);
				 while($row = $result->fetch_array(MYSQL_ASSOC)){
					$description = $row['description'];  	
					$title = $row['title'];
					$date = $row['date'];	
					$user_media_id = $row['user_media_id'];		
					$i++;
					$col = ($i % 2)? '#CEE4FF' : '#FFFFFF';    					
					$tr .= "<div class='item' style='background-color:$col;width:100%;'><ol><a href='../media_player.php?user_media_id=$user_media_id'>【 $title 】</a><p>  $date │$description </p></ol></div>";		
				}
			  echo $tr;

			?>
	</div>
	<!-- end content -->
</div>
<!-- end page -->

<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
});

</script>
</body>
</html>
