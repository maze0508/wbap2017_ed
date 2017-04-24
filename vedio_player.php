<?php session_start();
$member_id = $_SESSION['member_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
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

float:left;
margin:5px;
border:1px solid #666;
padding:3px;

}
.ibutton{
border:1px solid #999;
cursor:pointer;
margin-right:3px;
padding:2px;
color:#FFF
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

<!-- start page -->
<div id="page">
	<!-- start content -->
    <?php
				$user_media_id = mysql_escape_string($_GET['user_media_id']);
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.media_type,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
				$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $url .= $row["url"];			   
					   $ident_catalog .= $row["ident_catalog"];
					   $name .= $row["name"];
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
        <div class='Tit'><img src='images/test/pic-Tit.png'/>
         <?php
            $subject_id = mysql_escape_string($_GET['subject_id']);
            $query ="SELECT subject_catalog FROM subject WHERE subject_id=$subject_id";
            $result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
                    $subject_catalog = $row["subject_catalog"];
                }
        ?>
        <a href='index.php' title='教材科目'><?php echo $subject_catalog; ?></a> >> <a href='#' title='收藏內容'><?php echo $title; ?></a>
        </div><br/><br/>
		<div class="post">
			<div class="entry">
			<?php
			if(!$title) //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
			echo "<script>document.location.href='index.php'</script>";
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
				echo "<b style='color:#360'>影片上傳： $name</b>";
				echo "<div style='height:20px;overflow:hidden;border:1px solid #999;margin-bottom:6px'><img id='down' src='images/down32.png' style='float:left;cursor:pointer'>$description</div>";
				echo "<label class='ibutton' style='background-color:#69C' title='$ccdescript_catalog'>版權 $copyright</label>";
				echo "<label class='ibutton' style='background-color:#CC0'>付費 $cost</label>";
				echo "<label class='ibutton' style='background-color:#99C'>語言 $language</label>";
				echo "<label id='add_fav' class='ibutton' style='background-color:#C30'><img src='images/favorite16.png' align='top' />加入收藏</label>";
				if($_SESSION['compet']>1)
					echo "<a href='fav_books.php?user_media_id=$user_media_id' class='ibutton' style='background-color:#969'><img src='images/book16.png' align='top' />教材製作</a>";
				?>	
			<?php
				$edit_books_id = mysql_escape_string($_GET['edit_books_id']);
				$query = "select member.name,density.density_catalog,difficulty.difficulty_catalog,edit_books.edit_books_id ,edit_books.slesson,edit_books.learn_source,edit_books.context,edit_books.intended_user,edit_books.learn_time,edit_books.books_target,edit_books.books_content,edit_books.books_concept,edit_books.books_step from edit_books left join density on edit_books.density_id  = density.density_id left join difficulty on edit_books.difficulty_id = difficulty.difficulty_id left join member on edit_books.member_id = member.member_id where edit_books.edit_books_id ='$edit_books_id' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $difficulty_catalog .= $row["difficulty_catalog"];
					   $slesson .= $row["slesson"];
					   $learn_source .= $row["learn_source"];
					   $books_target .= $row["books_target"];
					   $books_content .= $row["books_content"];
					   $books_concept .= $row["books_concept"];
					   $books_step .= $row["books_step"];				   
					}
				echo "<br/><div style='margin: 10px 10px 2px 0;font-size: 15px;'>【學習參考資料】</div>";
				echo "<div style='border:1px solid #999;padding: 5px;'>";
				echo "<b>困難度： </b>$difficulty_catalog";
				echo "<br><b>適用年級： </b>$slesson";	
				echo "<br><b>學習目標： </b>$books_target";
				echo "<br><b>學習內容： </b>$books_content";
				echo "<br><b>學習概念： </b>$books_concept";
				echo "<br><b>學習步驟： </b>$books_step";
				echo "</div>";
			?>
				<!---<textarea class='message' style="width:100%" cols='60' rows='6'>回應這部影片....</textarea>
				<label id="anchor" class='ibutton' style='background-color:#F60'>留言</label>--->
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<div id="comment" style="height:700px;overflow:auto">
	<?php
		//$query = "select edit_books.edit_books_id,user_media.user_media_id,user_media.url,user_media.title,user_media.member_id from edit_books left join user_media on edit_books .user_media_id =  user_media.user_media_id WHERE subject_id='$subject_id' ORDER BY RAND() LIMIT 10";
		$query = "select edit_books.edit_books_id,edit_books.slesson,user_media.user_media_id,user_media.url,user_media.title from edit_books inner join user_media on edit_books.user_media_id = user_media.user_media_id WHERE subject_id='$subject_id' ORDER BY RAND() LIMIT 10";
				
		      $result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $user_media_id = $row["user_media_id"];
				   $url = $row["url"];				   
				   //$title = iconv_substr($row["title"], 0, 10, 'utf-8');
				   $title = $row["title"];
				   $edit_books_id = $row["edit_books_id"];
				   $slesson = $row["slesson"];
				   $found = strstr($url,"youtube");		
				   ($found)? $aimgs = "<img src='' style='width: 120px;' class='youtube' name='$url' align='top' />" : $aimgs = "<img style='width: 120px;' src='user_pics/$url.jpg' align='top' />";
					echo "
					<div class='temp_movie'>
						<div style='width:132px;float:left;'>
							$aimgs
						</div>
						<div style='float:left;margin: 25px 1px 1px 0;width: 143px;'>
							<label>片名：<a style='text-decoration: none;' href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id'>$title</a></label><br/>
							<label>適用年級：$slesson</label><br>
							
						</div>
					</div>";
					
				}
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
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print mysql_escape_string($_GET['user_media_id']); ?>";
var edit_books_id = "<?php print mysql_escape_string($_GET['edit_books_id']); ?>";
$(function(){  
	$('.colorbox').live("click",function(){
		$(this).colorbox({href:"index2.php",width:"600", height:"500",iframe:true,slideshow:true});
	})


$('#down').toggle(
function(){
	$(this).attr('src','images/up32.png').parent().css({'height':''});
	return false;
},
function(){
	$(this).attr('src','images/down32.png').parent().css({'height':'20px'});
	return false;
})



$("#add_fav").click(function(){
if(member_id.length>=1){

$.post("php/favorite_add.php",{member_id:member_id,user_media_id:user_media_id,compet:compet,edit_books_id:edit_books_id},function(data) {alert('已加入收藏!!'); });
}else
alert("請先登入");
})

$("#anchor").click(function(){
if(member_id.length>=1){
$.post("php/insert_anchor.php",{member_id:member_id,user_media_id:user_media_id,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").text()},function(data) {
($.browser.msie)?thisMovie('player').sendEvent('play','true'):thisMovie('player2').sendEvent('play','true')
alert('已留下註記!!'); $("#comment").html(data); $("#anchor_descript").val('')
});
}else
alert("請先登入");
})

$("#anchor_descript").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')}).one("click",function(){
$(this).val("")
})

$('body').keydown(function(){
    var keycode = window.event.keyCode;
    if( keycode == 13 )
    {
		if(member_id.length>=1){
			$.post("php/insert_anchor.php",{member_id:member_id,user_media_id:user_media_id,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").text()},function(data) {
			($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')
			alert('已留下註記!!'); $("#comment").html(data); $("#anchor_descript").val('')
		});
		}else
			alert("請先登入");
    }
});

$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})

/*
$("#learning_id").click(function(){
	$("#embed").hide();
	$(this).colorbox({width:"700", height:"300",iframe:true,slideshow:true,onClosed:function(){$("#embed").show()}});
})
*/
})

function playerReady(obj) {($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
$("#anchor_time").text(Math.floor(obj.position));
$("div."+Math.floor(obj.position)).siblings('div.antime').css("background-color","").end().css("background-color","#FC9");
}
</script>
</body>
</html>
