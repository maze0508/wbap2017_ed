<?php session_start();
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$member_id = $_SESSION['member_id']; 
if(!$_SESSION['account'] || !$user_media_id || $_SESSION['compet'] < 2)
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
form.cmxform label.error { display: none; }	
a,a:link,a:visited{text-decoration: none}
a:hover{color:#F4AB25;background-color: #FFECD9;text-decoration: none;}
</style>
</head>
<body>
<div id="logo">
    <?php
	include_once("banner.php");
    include_once("php/root.php");
	?>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['user_name'];?></span>
	<?php
	if($_SESSION['account'])
	echo '<a id="logout" href="php/logout.php">，登出</a>';
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>----->
<!-- start page -->
<div id="page">
	<!-- start content -->
    <?php
				include_once("php/root.php");
				$query = "SELECT user_media.url,user_media.title,member.account,member.email from user_media inner join member on member.member_id = user_media.member_id where user_media_id='$user_media_id' && user_media.title !='' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
					$url .= $row['url'];  		
					$title .= $row['title'];
					//$account .= $row['account']; 
					//$email .= $row['email']; 
					$found .= strstr($url,"youtube");
                    $media_type .= $row['media_type']; 		
				}	

			?>
	   <div id="content">
         <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="sign.php" title="會員功能">會員功能</a> >> <a href="my_favorite.php" title="我的收藏">我的收藏</a> >> <a href='media_player.php?user_media_id=<?php echo $user_media_id; ?>' title='教材製作'>教材製作</a> >> <a href='#' value='內容'><?php echo $title;?></a></div><br/><br/>
		<div class="post">
			<div class="entry">
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
				          //  echo "您的瀏覽器不支援HTML5影片播放";
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
					?> />
                <?php
                }
                ?>
				</object>		
			</div>
		</div>
		<div class="post">
			<p>
			<h2 class="title"><a href="#">加入教材</a></h2>
			<div class="entry">
			<form class='cmxform' id='eform' name='edit' method='post' action='php/insert_books.php'>
			<input type='hidden' name='member_id' id='member_id' value='<?php print $member_id ?>' />
			<input type='hidden' name='user_media_id' id='user_media_id' value='<?php print $user_media_id ?>' />
			<?php
				echo "<br><label>語意密度：</label>";
				$query = "select density_id,density_catalog from density";//*4
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $density_id = $row["density_id"];
				   $density_catalog = $row["density_catalog"];
				   $density_opt .= "<option value='$density_id'>$density_catalog</option>";
				}
				echo "<select id='density_id' name='density_id'><option value=''>請選擇</option>$density_opt</select>";
				
				echo "<br><label>適用對象：</label><select id='intended_user' name='intended_user'><option value=''>請選擇</option><option value='學習者'>學習者</option></select>";
				
				echo "<br><label><b style='color:red'>*</b>困難度：</label>";
				$query = "select difficulty_id,difficulty_catalog from difficulty";//*4
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $difficulty_id = $row["difficulty_id"];
				   $difficulty_catalog = $row["difficulty_catalog"];
				   $difficulty_opt .= "<option value='$difficulty_id'>$difficulty_catalog</option>";
				}
				echo "<select id='difficulty_id' name='difficulty_id' class='required'><option value=''>請選擇</option>$difficulty_opt</select>";
								
				echo "<br><label><b style='color:red'>*</b>適用年級：</label><input type='hidden' name='slesson' id='slesson' />";
				$query = "select slesson_id,slesson_catalog from slesson";//*4
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $slesson_id = $row["slesson_id"];
				   $slesson_catalog = $row["slesson_catalog"];
				   $slesson_opt .= "<option value='$slesson_id'>$slesson_catalog</option>";
				}
				echo "<select id='slesson_id' name='slesson_id' class='required' size='5' multiple='multiple'>$slesson_opt</select>";
				
				echo "<br><label>情境：</label><input type='hidden' id='context'  name='context' />";	
				echo "<label for='ad1v'><input type='checkbox' class='checkbox context' name='ad' value='引起動機' id='ad1v' /> 引起動機</label>";
				echo "<label for='ad2v'><input type='checkbox' class='checkbox context' name='ad' value='知識性認知' id='ad2v' /> 知識性認知</label>";
				echo "<label for='ad3v'><input type='checkbox' class='checkbox context' name='ad' value='操作性技能' id='ad3v' /> 操作性技能</label>";
				
				echo "<p><label><b style='color:red'>*</b>學習資源類型：</label><br>";				
				$query = "select source_id,source_catalog from source";//*3
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $source_id = $row["source_id"];
				   $source_catalog = $row["source_catalog"];
				   $source_opt .= "<label for='$source_id'><input type='checkbox' class='required checkbox learn_source' name='spam[]' value='$source_catalog' id='$source_id'> $source_catalog</label>";
				}
				echo "$source_opt<input type='hidden' id='learn_source'  name='learn_source' /><label for='spam[]' class='error'>最少選一種類型</label>";
				/*
				echo "<br><label><b style='color:red'>*</b>學科：</label><br>";
				$query = "select subject_id,subject_catalog from subject";//*4
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $subject_id = $row["subject_id"];
				   $subject_catalog = $row["subject_catalog"];
				   $subject_opt .= "<label for='$subject_id'><input type='checkbox' class='required checkbox subject' name='spamB[]' value='$subject_catalog' id='$subject_id'> $subject_catalog</label>";
				}
				echo "$subject_opt<input type='hidden' id='subject'  name='subject' /><label for='spamB[]' class='error'>最少選一種類型</label>";
				*/
				echo "<p><label>基本教學時數：</label><input type='text' id='learn_time' class='learn_time'  name='learn_time' />";
				echo "<br>以 PTxxHxxMxxS 形式著錄。 ex:(需時1 小時35 分45 秒，則著錄PT01H35M45S)";
				
				echo "<p><label><b style='color:red'>*</b>學習目標：</label><input type='text' id='books_target' name='books_target' class='required' size='40' />";
				echo "<br><label><b style='color:red'>*</b>學習內容：</label><input type='text' id='books_content' name='books_content' class='required' size='40' />";
				echo "<br><label><b style='color:red'>*</b>學習概念：</label><input type='text' id='books_concept' name='books_concept' class='required' size='40' />";
				echo "<br><label>學習步驟：</label><input type='text' id='books_step' name='books_step' size='40' />";				
		


			?>
			<br><input type='submit' name='button' id='edbutton' value='加入' />
			</form>
			</div>
			<p class="meta"></p>
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
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  


$("#eform").validate(); //驗證註冊資料

jQuery.validator.addMethod("learn_time", function(value, element) { //
  return this.optional(element) || /^(PT)\d\d(H)\d\d(M)\d\d(S)$/.test(value);
}, "格式為PTxxHxxMxxS");

$('#slesson_id').click(function(){ //適用年級
    var fruit = "";
     $("#slesson_id option:selected").each(function() {
        fruit += $(this).text()+',';
    });
	$('#slesson').val(fruit.replace(/,$/,''))
})

$('input[type=checkbox].learn_source').click(function(){ //學習資源類型
    showMessage = "";
    $('input.checkbox.learn_source:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#learn_source').val(showMessage.replace(/,$/,''))
})

$('input[type=checkbox].context').click(function(){ //情境
    showMessage = "";
    $('input.checkbox.context:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#context').val(showMessage.replace(/,$/,''))
})

$('input[type=checkbox].subject').click(function(){ //學科
    showMessage = "";
    $('input.checkbox.subject:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#subject').val(showMessage.replace(/,$/,''))
})



});

</script>
</body>
</html>
