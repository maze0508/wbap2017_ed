<?php session_start();
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'] || $_SESSION['compet'] < 2)
echo "<script>document.location.href='index.php'</script>";
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>--->
<!-- start page -->
<div id="page" style="height:500px; background-repeat:no-repeat;
	background-position:right bottom;background-size:20%;background-image: url(images/test/tr-myvideo2.png);">
	<!-- start content -->
	<div id="content">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="sign.php" title="會員功能">會員功能</a> >> <a href="#" title="我的教材">我的教材</a></div><br/><br/>
		<div class="post">
			<h2 class="title">
			<?php
				include_once("php/root.php");
				if($user_media_id){
                    $query = "SELECT  user_media.title,user_media.url,user_media.media_type from user_media inner join edit_books on edit_books.user_media_id = user_media.user_media_id where user_media.user_media_id='$user_media_id' && edit_books.member_id='$member_id'";
                    $result = $mysqli->query($query);
                   // print $query;
                     while($row = $result->fetch_array(MYSQL_ASSOC)){
                        $url .= $row['url'];  	
                        $title .= $row['title'];	
                        $found .= strstr($url,"youtube");	
                        $media_type .= $row['media_type']; 					
                    }

                }
			  echo $title ;
			?>
			</h2>
			<div class="entry">
				<?php
				if($title)
				    echo "<a href='media_player.php?user_media_id=$user_media_id'>點我連結 [多媒體影片位置]</a>";
				?>
				<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="100%" height="350">
					<param name="movie" value="player.swf" />
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
               		<?php
                    if($title && $found){
                        //echo $url;
				        $UrlArray = explode("=" , $url);
                        $youtube_name = $UrlArray[1];
				        //print_r($UrlArray); 
				    ?>
				        <iframe width="550" height="350" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
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
				        //else
				            //echo "您的瀏覽器不支援HTML5影片播放";
				    ?>
				        </video>
				    <?php
						}else{
                    ?>   
                            <embed type="application/x-shockwave-flash" id="player2" name="player2" src="player.swf" width="100%" height="350" allowscriptaccess="always"  allowfullscreen="true"
                            <?php
                                if($user_media_id && $found)
                                echo "flashvars='file=$url'";
                                else if($user_media_id)	
                                echo "flashvars='file=user_movie/$url.flv&image=user_pics/$url.jpg'";
                            ?>/>
                    <?php    
                    }				
				    ?>
				</object>
			</div>
		</div>
		<div class="post">
			<p>
			<h2 class="title"><a href="#">教材資訊</a></h2>
			<div class="entry">
				<h3>*下方資訊在點選影片後才會顯示</h3>
			<form class='cmxform' id='eform' name='edit' method='post' action='php/edit_mybooks.php'>
			<input type='hidden' name='member_id' id='member_id' value='<?php print $member_id ?>' />
				<?php
				if($url){
				echo "<input type='hidden' class='required' minlength='1' value='$user_media_id' name='user_media_id'  />";
				$query = "select density.density_catalog,difficulty.difficulty_catalog,edit_books.edit_books_id ,edit_books.slesson,edit_books.learn_source,edit_books.context,edit_books.intended_user,edit_books.learn_time,edit_books.books_target,edit_books.books_content,edit_books.books_concept,edit_books.books_step from edit_books left join density on edit_books.density_id  = density.density_id left join difficulty on edit_books.difficulty_id = difficulty.difficulty_id where edit_books.user_media_id ='$user_media_id' && edit_books.member_id ='$member_id' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $density_catalog .= $row["density_catalog"];
				   $difficulty_catalog .= $row["difficulty_catalog"];
				   $slesson .= $row["slesson"];
				   $learn_source .= $row["learn_source"];
				   $context .= $row["context"];
				   $intended_user .= $row["intended_user"];
				   $learn_time .= $row["learn_time"];
				   $books_target .= $row["books_target"];
				   $books_content .= $row["books_content"];
				   $books_concept .= $row["books_concept"];
				   $books_step .= $row["books_step"];	
				   $edit_books_id .= $row["edit_books_id"];				   
				}
				   echo "<labedl>[固定資訊]</label>";
				   echo "<br><label>語意密度：</label>$density_catalog";
				   echo "<br><label>困難度：</label>$difficulty_catalog";
				   echo "<br><label>適用年級：</label>$slesson";				   
				   echo "<br><label>情境：</label>$context";				   
				   echo "<br><label>基本教學時數：</label>$learn_time";
				   echo "<br><label>適用對象：</label>$intended_user";
				   
				echo "<P><labedl>[可變更資訊]</label>";	
				echo "<br><label><b style='color:red'>*</b>學習資源類型：</label><br>";
				$query = "select source_id,source_catalog from source";//*3
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $source_id = $row["source_id"];
				   $source_catalog = $row["source_catalog"];
				   $source_opt .= "<label for='$source_catalog'><input type='checkbox' class='required checkbox learn_source' name='spam[]' value='$source_catalog' id='$source_catalog'> $source_catalog</label>";
					}
				echo "$source_opt<input type='hidden' id='learn_source'  name='learn_source' value='$learn_source' /><label for='spam[]' class='error'>最少選一種類型</label>";
				
				   
				   echo "<br><label><b style='color:red'>*</b>學習目標：</label><input type='text' id='books_target' name='books_target' class='required' size='40' value='$books_target' />";
				   echo "<br><label><b style='color:red'>*</b>學習內容：</label><input type='text' id='books_content' name='books_content' class='required' size='40' value='$books_content' />";
				   echo "<br><label><b style='color:red'>*</b>學習概念：</label><input type='text' id='books_concept' name='books_concept' class='required' size='40' value='$books_concept' />";
				   echo "<br><label>學習步驟：</label><input type='text' id='books_step' name='books_step' size='40' value='$books_step' />";
				   echo "<input type='hidden' name='edit_books_id' id='edit_books_id' value='$edit_books_id'>";
				   echo "<br><input type='submit' name='button' id='edbutton' value='修改' />";
				   echo " <input type='button' name='button' id='del' value='刪除' />";
				}	
				?>
				
			</form>	
			</div>
			<p class="meta">Media info</p>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<h3 align="center">我製作的教材</h3>
		<div style="width:280px;overflow:auto">
				<?php
				//$query = "SELECT user_media_id,url,title from user_media where user_media.member_id='$member_id' && title is not null ";
				$query = "SELECT user_media.user_media_id,user_media.url,user_media.title from user_media left join edit_books on user_media.user_media_id = edit_books.user_media_id where edit_books.member_id = '$member_id' ORDER BY user_media_id ";
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
					echo "<div class='temp_movie'><a href='my_books.php?user_media_id=$user_media_id'>$title<img src='http://img.youtube.com/vi/$youtube_n/0.jpg' class='youtube' name='$url' /></a></div>";
				}else{
					echo "<div class='temp_movie'><a href='my_books.php?user_media_id=$user_media_id'>$title<img src='user_pics/$url.jpg' /></a></div>";
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
<script type="text/javascript" src="js/jyuotube.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";



$("#eform").validate(); //驗證註冊資料

$('input.checkbox.learn_source').click(function(){ //學習資源類型
    showMessage = "";
    $('input.checkbox.learn_source:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#learn_source').val(showMessage.replace(/,$/,''))
})

if($("#learn_source").length > 0){ //判斷物件是否存在
if($("#learn_source").val() != ''){
var x = $("#learn_source").val().split(",");
$.each(x, function (key, value) {
	$("#" + value).attr("checked", true);
});
}}

$("img.youtube").each(function(){
$(this).attr("src", $.jYoutube($(this).attr("name"), "small"));
})

$("#del").click(function(){
$.post("php/del_books.php",{edit_books_id:$("#edit_books_id").val()},function(data) {
alert('已刪除'); 
location.reload();
});
})


});

</script>
</body>
</html>
