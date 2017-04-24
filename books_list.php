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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="m/js/deviceListener.js"></script>
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
width:350px;
float:left;
margin:5px;
border:1px solid #666;
padding:3px;
text-align: left;
height:95px;
text-overflow: ellipsis;overflow: hidden;white-space:nowrap
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
<div id="page">
	<!-- start content -->
	<div id="content" style="width:100%">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="sign.php" title="會員功能">會員功能</a> >> <a href="#" title="教材資源列表">教材資源列表</a></div><br/><br/>
		<div class="post">
			<div class="entry" >

				<br/>
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
				   $found = strstr($url,"youtube");		
				   ($found)? $aimgs = "<img src='' style='width: 120px;' class='youtube' name='$url' align='top' />" : $aimgs = "<img style='width: 120px;' src='user_pics/$url.jpg' align='top' />";
					echo "
					<div class='temp_movie'>
						<div style='width:132px;float:left;'>
							$aimgs
						</div>
						<div style='float:left;width:210px'>
							<label>片名：<a style='text-decoration: none;' href='books_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id'>$title</a></label><br/>
							<label>適用年級：$slesson</label><br>
							<label>學習目標：$books_target</label><br>
							<label>學習內容：$books_content</label><br>
							<label>學習概念：$books_concept</label>
						</div>
					</div>";
					
				}
				mysqli_free_result($result);
				?>	
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
var handlerA = function(){ $(this).attr("src","images/remove.jpg") };

$("img.youtube").each(function(){
$(this).attr("src", $.jYoutube($(this).attr("name"), "small")).bind("error.A",handlerA);
})





})
</script>
</body>
</html>
