<?php session_start();
if(!isset($_SESSION['member_id'])) {
	$_SESSION['member_id'] = 0;
	$_SESSION['compet'] = 0;
	$_SESSION['account'] = 0;
}
$member_id = $_SESSION['member_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<!---<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>---->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<script type="text/javascript" src="m/js/deviceListener.js"></script>

<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
#search {
	float: right;
}
img {
     height: auto;
     max-width: 100%;
 }
</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['compet']==2 || $_SESSION['compet']==3){
		include_once("banner.php");
	}else if($_SESSION['compet']==1) {
		include_once("banner_stu.php");
	}else{
		echo "<ul id='logo1'>
		<li class='first'><a href='index.php' accesskey='1' title=''><img title='回首頁' src='images/logo1.png'/></a></li>
	</ul>";
		echo "<h2><input type='button' class='colorbox' style='background-image: url(images/login_btn.jpg);width:90px; height:30px;'/></h2>";
	}
	
	include_once("php/root.php");
	?>
	
</div>
<!-- start page -->
<div id="page"  >
	<!-- start content -->
	<div id="contentI"  >

		<div id="media" >
		<?php
			$query="select subject_id,subject_catalog FROM subject ORDER BY subject_id";
			$result = $mysqli->query($query);
            $sum=0;
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				$subject_id = $row['subject_id'];
				$subject_name = $row['subject_catalog'];
				
				$query2 = "SELECT * FROM edit_books WHERE subject_id=$subject_id";
				$result2 = $mysqli->query($query2);
				$row2 = $result2->fetch_array(MYSQL_ASSOC);
				if($row2 != null){
					if(($sum%2)==0){
							$bg_color='#e8f5fd';
						}else{
							$bg_color='#f5e7ea';}
					echo"<div style='background-image:url(images/test/home-tit.png);background-size:auto 30px;padding:0px 0px 2px 30px;'><h3 >".$subject_name."</h3></div>";
					echo"<div id='$subject_id ' style='background-color:$bg_color;width: 700px;min-height: 120px;padding: 25px 0px 25px 25px;border-radius:10px;-mos-border-radius:10px;'>";	
					$query3 = "select edit_books.edit_books_id,user_media.user_media_id,user_media.url,user_media.title from edit_books left join user_media on edit_books .user_media_id =  user_media.user_media_id WHERE subject_id='$subject_id' order by edit_books.edit_books_id DESC LIMIT 4";
					$result3 = $mysqli->query($query3);
					
					while($row3 = $result3->fetch_array(MYSQL_ASSOC)){
						
					   $user_media_id = $row3["user_media_id"];
					   $url = $row3["url"];				   
					   $edit_books_id = $row3["edit_books_id"];				   
					   //$title = iconv_substr($row3["title"], 0, 10, 'utf-8');
					   $title = $row3["title"];
					   $found = strstr($url,"youtube");		
                    
					   if($found){
                            $UrlArray = explode("=" , $url);
							$youtube_name = $UrlArray[1];
							echo "<div class='temp_movie' style='float: left;margin: 25px;'><a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'><img style='width: 120px;' src='http://img.youtube.com/vi/$youtube_name/2.jpg'/><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div><br/>";
                       }else{
							echo "<div class='temp_movie' style='float: left;margin-right: 25px;'><a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'><img style='width: 120px;' src='user_pics/$url.jpg' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					}
                    }
					$sum++;
					echo"</div><br/><br/>";	
				}
			}
		?>
		</div>
		<!-- end content -->
	</div>
	
<!-- end page -->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>

</div>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $member_id; ?>";
$(function(){  
	$('.colorbox').live("click",function(){
		$(this).colorbox({href:"index2.php",width:"600", height:"500",iframe:true,slideshow:true});
	})

})
</script>
</body>
</html>