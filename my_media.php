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
width:122px;
float:left;
margin:5px;
border:1px solid #F90;
border-right:none;
padding:3px;
text-align: center;
height:115px
}
.temp_movie img{
	width:80%;
	height:80%;
}
.readonly{border:none}
form.cmxform label.error { display: none; }	
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
	</h2>
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>
<!-- start page -->
<div id="page" style=" height:500px; background-repeat:no-repeat;
	background-position:right bottom;
	background-size:40%;background-image: url(images/test/tr-skvideo2.png);">
	<!-- start content -->
	<div id="content">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="sign.php" title="會員功能">會員功能</a> >> <a href="#" title="已分享影片">已分享影片</a></div><br/><br/>
		<div class="post">

			<div class="entry">
				<h3>請點選右方影片，影片將開始播放</h3>
				<h3>*下方資訊在點選影片後才會顯示</h3>
                <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="100%" height="350">
					<param name="movie" value="player.swf" />
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
					<?php
					include_once("php/root.php");
					$member_id = $_SESSION['member_id']; 
					$user_media_id = mysql_escape_string($_GET['user_media_id']);
					if($user_media_id){
					$query = "SELECT url , media_type from user_media where user_media_id='$user_media_id' && member_id='$member_id'";
					$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
						$url .= $row['url'];
						$found .= strstr($url,"youtube");	
						$media_type .= $row['media_type']; 					
					}
						if($found){
								$UrlArray = explode("=" , $url);
								$youtube_name = $UrlArray[1];
								//echo "<param name='flashvars' value='file=$url' />"; 

						?>
						<iframe width="550" height="350" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
						<?php	
						}else if($media_type){
						/*else
						echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; */
						?>
							<video id="MovieShow" preload="auto" controls loop width="550" height="350">
						<?php
								if(strstr($media_type,"mp4"))
									echo "<source src=\"user_movie/".$url.".mp4\" type = 'video/mp4'>";
								else if(strstr($media_type,"ogg"))
									echo "<source src=\"user_movie/".$url.".ogv\" type = 'video/ogg'>";
								else if(strstr($media_type,"webm"))
									echo "<source src=\"user_movie/".$url.".webm\" type = 'video/webm'>";
								else
									echo "您的瀏覽器不支援HTML5影片播放";

						?>
							</video>
						<?php
						}else{
                        ?>
                            <embed
                                type="application/x-shockwave-flash"
                                id="player2"
                                name="player2"
                                src="player.swf" 
                                width="100%" 
                                height="350"
                                allowscriptaccess="always" 
                                allowfullscreen="true"
                            />
                        <?php
                        }
					}					
						?>
				</object>
			</div>
		</div>
		<div class="post">
			<p>
			<h2 class="title">影片數位資訊</h2>
			<div class="entry">
				<?php
				if($url){
				echo "<form class='cmxform' id='eform' name='edit' method='post' action='php/update_movie.php'>";
				echo "<input type='hidden' class='required' minlength='1' value='$user_media_id' name='user_media_id'  />";
				$query = "SELECT identifier.ident_catalog,source.source_catalog,common.common_account,common.common_unit,common.common_email,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join common on common.common_id = user_media.common_id where user_media.user_media_id='$user_media_id' && user_media.member_id='$member_id' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $ident_catalog .= $row["ident_catalog"];
				   $common_account .= $row["common_account"];
				   $common_unit .= $row["common_unit"];
				   $common_email .= $row["common_email"];
				   $source_catalog .= $row["source_catalog"];
				   $title .= $row["title"];
				   $language .= $row["language"];
				   $description .= $row["description"];
				   $keyword .= $row["keyword"];
				   $coverage .= $row["coverage"];
				   $version .= $row["version"];
				   $role_catalog .= $row["role_catalog"];
				   $design_date .= $row["design_date"];
				   $cost .= $row["cost"];
				   $copyright .= $row["copyright"];
				   $ccdescript_catalog .= $row["ccdescript_catalog"];
				   //echo $ident_catalog.$source_catalog.$title.$language_catalog.$description.$keyword.$coverage.$version.$role_catalog.$design_date.$cost.$copyright.$ccdescript_catalog		   
				}
				   echo "<labedl>[固定資訊]</label>";
				   echo "<br><label>共同作者：</label>$common_account $common_unit $common_email";
				   echo "<br><label>影片版本：</label>$version";
				   echo "<br><label>影片標題：</label>$title";
				   echo "<br><label>創作日期：</label>$design_date";
				   echo "<br><label>提供單位：</label>$ident_catalog";
				   echo "<br><label>資源類別：</label>$source_catalog";
				   echo "<br><label>您的角色：</label>$role_catalog";
				   echo "<br><label>為付費影片：</label>$cost";
				   echo "<br><label>版權及限制：</label>$copyright";
				   echo "<br><label>授權描述：</label>$ccdescript_catalog";
				   echo "<P><labedl>[可變更資訊]</label>";
				   
				   
				   echo "<br><label>影片語言：</label><input type='text' name='language' id='language' value='$language' size='50' readonly='readonly' class='readonly' /><br>";
				   
					$query = "select language_id,language_catalog from language"; //*1
					$result = $mysqli->query($query);
					while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $language_id = $row["language_id"];
					   $language_catalog = $row["language_catalog"];				   
					   if($language_id==1)
					   $language_opt = "<label for='$language_id'><input type='checkbox' class='required checkbox'  name='spam[]' value='$language_catalog' id='$language_catalog'> $language_catalog</label>";
					   else
					   $language_opt .= "<label for='$language_id'><input type='checkbox' class='required checkbox' name='spam[]' value='$language_catalog' id='$language_catalog'> $language_catalog</label>";
					}
					echo "$language_opt<label for='spam[]' class='error'>最少選一種語言</label>";		
				   
				   echo "<br><label>關鍵字：</label><input type='text' name='keyword' id='keyword' size='30' value='$keyword' />(請以小寫逗點分隔)";
				   echo "<br><label>涵蓋範圍：</label><input type='text' name='coverage' id='coverage' size='60' value='$coverage' />";
				   echo "<br>(學習物件所適用的時間、文化、地理或地區)";
				   echo "<p><label>影片內容描述：</label><br><textarea name='description' id='description' cols='45' rows='5' class='account'>$description</textarea>";
				   echo "<br><input type='submit' name='button' id='edbutton' value='修正' />";
                   echo " <input type='button' name='button' id='del' value='刪除' />";
				   echo "</form>";
								
				}	
				?>
			</div>
			<p class="meta">Media info</p>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<h3 align="center">已發佈影片</h3>
		<div style="width:280px;overflow:auto;">
				<?php
				$query = "SELECT user_media_id,url,title from user_media where member_id='$member_id' && title is not null ";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $user_media_id = $row["user_media_id"];
				   $url = $row["url"];
				   $title =  iconv_substr($row["title"], 0, 8, 'utf-8');
				   $found = strstr($url,"youtube");
                   shell_exec ("ffmpeg -i user_movie/$url.$media_type -ss 00:00:00 -vframes 1 -y user_pics/$user_media_id.jpg");

				 if($found){
                    $UrlArr = explode("=" , $url);
				    $youtube_n = $UrlArr[1];
					echo "<div class='temp_movie'><a href='my_media.php?user_media_id=$user_media_id'>$title<img src='http://img.youtube.com/vi/$youtube_n/0.jpg' class='youtube' name='$url' /></a></div>";
				}else{
				    echo "<div class='temp_movie'><a href='my_media.php?user_media_id=$user_media_id'>$title<img src='user_pics/$url.jpg' /></a></div>";
                    }
				}
				mysqli_free_result($result);
				?>
		</div>		
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
var handlerA = function(){ $(this).attr("src","images/remove.jpg") };


$("#eform").validate(); //驗證註冊資料

if($("#language").length > 0){ //判斷物件是否存在
if($("#language").val() != ''){
var x = $("#language").val().split(",");
$.each(x, function (key, value) {
	$("#" + value).attr("checked", true);
});
}}

$('input.checkbox').click(function(){
    showMessage = [];
    $('input.checkbox:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	if(showMessage.length > 2)
	$('#language').val(showMessage.replace(/,$/,''))
	else
	$('#language').val('')
})


$("#del").click(function(){
$.post("php/del_books.php",{user_media_id:<?php echo $media_id;?>},function(data) {
alert("已刪除!"); 
location.reload();
});
})

$('img.youtube').each(function(){
$(this).attr('src', $.jYoutube($(this).attr('name', 'smallImage'))).bind("error.A",handlerA);

})

});
    



</script>
</body>
</html>
