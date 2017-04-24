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
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.datepicker.css" />
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
border:1px solid #666;
padding:3px;
text-align: center;
}
.ibutton{
border:1px solid #999;
cursor:pointer;
margin-right:3px;
padding:2px;
color:#FFF
}
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>----->
<!-- start page -->
<div id="page">
	<!-- start content -->
    <?php
				$user_media_id = mysql_escape_string($_GET['user_media_id']);
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,common.common_account,common.common_unit,common.common_email,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.media_type,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join common on common.common_id = user_media.common_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
					$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $url .= $row["url"];			   
					   $ident_catalog .= $row["ident_catalog"];
					   $media_name .= $row["name"];
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
					   $found .= strstr($url,"youtube");	
                       $media_type .= $row['media_type']; 			   
					}
				}
            ?>
	   <div id="content">
        <div class="Tit"><img src="images/test/pic-Tit.png"/>
        <a href="sign.php" title="會員功能">會員功能</a> >> <a href="books_list.php" title="教材資源列表">教材資源列表</a> >> <a href="#" title="教材資源內容"><?php echo $title;?></a></div><br/><br/>
		<div class="post">
			<div class="entry">
                
            <?php
			if(!$title) //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
			echo "<script>document.location.href='index.php'</script>";
			echo "<label> <a href='media_player.php?user_media_id=$user_media_id  style='color:red'> P.S 本頁為教材頁面，【點我】連結到影片原始頁面</a> </label>"
			?>
				<div id='embed'>
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
				<?php
				echo "<b style='color:#360'>影片上傳： $media_name</b>";
				echo "<div style='height:20px;overflow:hidden;border:1px solid #999;margin-bottom:6px'><img id='down' src='images/down32.png' style='float:left;cursor:pointer'>$description</div>";
				echo "<label class='ibutton' style='background-color:#69C' title='$ccdescript_catalog'>版權 $copyright</label>";
				echo "<label class='ibutton' style='background-color:#CC0'>付費 $cost</label>";
				echo "<label class='ibutton' style='background-color:#99C'>語言 $language</label>";
				if($_SESSION['compet']>1)
				echo "<label class='ibutton' style='background-color:#000;color:#FFF' id='show_learn'><img src='images/tag_blue_add.png' /> 建立學習主題</label>"
				?>	
			</div>
		</div>
		<br/>
			<div id="learning_form" style="display: none; text-align: left; height: auto; padding-left: 10px;">
					<label style="color:red">[建立學習主題]</label><br/>
					<form id='eform' name='edit' method='post' action='php/insert_learning.php'>
						<input type="hidden" name="member_id" value="<?php print $_SESSION['member_id']; ?>">
						<label>主題名稱：</label><input type="text" name="learning_name" id="learning_name" class="required" /><br/>
						<label>是否開放：</label><select name="publish" id="publish"><option value="Y">是</option><option value="N">否</option></select><br/>
						<?php
						$edit_books_id = mysql_escape_string($_GET['edit_books_id']);
						echo "<label>主題學科：</label>";
						$query = "select subject_id,subject_catalog from subject";//*4
						$result = $mysqli->query($query);
						while($row = $result->fetch_array(MYSQL_ASSOC)){
						   $subject_id = $row["subject_id"];
						   $subject_catalog = $row["subject_catalog"];
						   $subject_opt .= "<option value='$subject_id'>$subject_catalog</option>";
						}
						echo "<select name='subject_id' id='subject_id'>$subject_opt</select><br/>";
						?>
						<input type="hidden" name="edit_books_id" value="<?php print $edit_books_id; ?>">
						<label>主題開始時間：</label><input type="text" name="learning_start" id="learning_start" class="required" readonly="readonly" /><br/>
						<label>主題結束時間：</label><input type="text" name="learning_end" id="learning_end" class="required" readonly="readonly" /><br/>
						<label>主題敘述：</label><br/>
						<textarea name="learning_content" id="learning_content" cols="35" rows="5" class="required"></textarea><br/>
						<input class="submit" id="learning_subit" type="submit" value="建立學習主題"/>
					</form>
			</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
			<label style="color:red">[教材參考資訊]</label><p/>
			<?php
				$edit_books_id = mysql_escape_string($_GET['edit_books_id']);
				$query = "select member.name,density.density_catalog,difficulty.difficulty_catalog,edit_books.edit_books_id ,edit_books.slesson,edit_books.learn_source,edit_books.context,edit_books.intended_user,edit_books.learn_time,edit_books.books_target,edit_books.books_content,edit_books.books_concept,edit_books.books_step from edit_books left join density on edit_books.density_id  = density.density_id left join difficulty on edit_books.difficulty_id = difficulty.difficulty_id left join member on edit_books.member_id = member.member_id where edit_books.edit_books_id ='$edit_books_id' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $name .= $row["name"];
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
					}
				echo "<b style='color:#069'>教材製作： $name</b>";
				echo "<br><b>語意密度： </b>$density_catalog";
				echo "<br><b>困難度： </b>$difficulty_catalog";
				echo "<br><b>適用年級： </b>$slesson";				   
				echo "<br><b>情境： </b>$context";				   
				echo "<br><b>基本教學時數： </b>$learn_time";
				echo "<br><b>適用對象： </b>$intended_user";
				echo "<br><b>學習資源類型： </b>$learn_source";		
				echo "<br><b>學習目標： </b>$books_target";
				echo "<br><b>學習內容： </b>$books_content";
				echo "<br><b>學習概念： </b>$books_concept";
				echo "<br><b>學習步驟： </b>$books_step";
			?>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-TW.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
$(function(){ 
 
$('#down').toggle(
function(){
	$(this).attr('src','images/up32.png').parent().css({'height':''});
	return false;
},
function(){
	$(this).attr('src','images/down32.png').parent().css({'height':'20px'});
	return false;
})

$("#show_learn").click(function(){
	$("#learning_form").show();
})

$("#eform").validate(); //驗證註冊資料

$("#learning_start").datepicker({showOn: 'both',dateFormat: 'yy-mm-dd',buttonImageOnly: true,buttonImage: 'images/calendar.gif'});
$("#learning_end").datepicker({showOn: 'both',dateFormat: 'yy-mm-dd',buttonImageOnly: true,buttonImage: 'images/calendar.gif'});

$("#learning_subit").click(function(){
if($("#learning_end").val() < $("#learning_start").val()){
alert("結束日期不能比開始日期早");
return false;
}
else
return true;
})

/*
$("#learning_id").click(function(){
	$("#embed").hide();
	$(this).colorbox({width:"700", height:"300",iframe:true,slideshow:true,onClosed:function(){$("#embed").show()}});
})
*/
})


</script>
</body>
</html>
