<?php session_start();
if(!$_SESSION['account'])
echo "<script>document.location.href='sign.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
.temp_movie{
cursor:pointer;
width:120px;
float:left;
margin:5px;
border:1px solid #F90;
padding:3px;
text-align: center;
}
.item{
	cursor:pointer;
	border-top:1px solid #333;
	padding:2px;
}
a,a:link,a:visited{text-decoration: none}
a:hover{color:#F4AB25;background-color: #FFECD9;text-decoration: none;}
</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['account']){
		include_once("banner.php");
		include_once("php/root.php");
	}else{
		echo "<h2><input type='button' class='colorbox' style='background-image: url(images/login_btn.jpg);width:90px; height:30px;'/></h2>";
	}
	?>	
</div>
<!----<div id="menu">

	<div id="search">
		<form method="get" action="">
			<fieldset>
			<input id="s" type="text" name="s" value="" />
			<input id="x" type="image" name="imageField" src="images/img10.jpg" />
			</fieldset>
		</form>
	</div>
</div>
<hr />
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>----->
<!-- start page -->
<div id="page" style=" height:500px; background-repeat:no-repeat;
	background-position:right bottom;
	background-size:30%;background-image: url(images/test/tr-fav2.png);">
	<!-- start content -->
	<div id="content">
        <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="sign.php" title="會員功能">會員功能</a> >> <a href="#" title="我的收藏">我的收藏</a></div><br/><br/>
		<div class="post">
			<h2 class="title"></h2>			
			<div class="entry">
			<?php
				include_once("php/root.php");
				$query = "select user_media.title,media_favorite.user_media_id,media_favorite.user_media_id,user_media.description,media_favorite.date from user_media left join media_favorite on media_favorite.user_media_id = user_media.user_media_id where media_favorite.member_id ='$member_id' order by date desc";
				$result = $mysqli->query($query);
				 while($row = $result->fetch_array(MYSQL_ASSOC)){
					$description = $row['description'];  	
					$title = $row['title'];
					$date = $row['date'];	
					$user_media_id = $row['user_media_id'];		
					$i++;
					$col = ($i % 2)? '#CCFFCC' : '#FFFFFF';    					
					//$tr .= "<tr bgcolor='$col'><td width='70px'>$date</td><td><a href='media_player.php?user_media_id=$user_media_id'>$title</a></td></tr>";	$tr .= "<tr bgcolor='$col'><td colspan='2'>$description</td></tr>";		
					$tr .= "<div class='item' style='background-color:$col;'><input type='checkbox'> $date │ <a href='media_player.php?user_media_id=$user_media_id'>【 $title 】</a> $description </div>";		
				}
			  echo $tr;

			?>
			</div>
		</div>

	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<h3 align="center"></h3>
		<div style="width:280px;overflow:auto;">
		</div>		
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";






});

</script>
</body>
</html>
