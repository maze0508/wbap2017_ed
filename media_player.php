<?php session_start();?>
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>
<!-- start page -->
<div id="page">
	<!-- start content -->
    <?php
				$user_media_id = mysql_escape_string($_GET['user_media_id']);
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,user_media.media_type,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
				//$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,common.common_account,common.common_unit,common.common_email,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join common on common.common_id = user_media.common_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
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
        <a href='sign.php' title='會員功能'>會員功能</a> >> <a href='my_favorite.php' title='我的收藏'>我的收藏</a> >> <a href='#' title='收藏內容'><?php echo $title; ?></a></div><br/><br/>
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

			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<div id="comment" style="height:700px;overflow:auto">
	<?php
		$query="select member.name,media_anchor.anchor_descript,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' order by media_anchor.anchor_time";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		$name = $row['name'];
		$anchor_time = $row['anchor_time'];
		$anchor_descript = $row['anchor_descript'];
		$s   =   $anchor_time%60;
		$m   =   floor($anchor_time/60);
		//$o   =   floor($m/60);
		$m = ($m < 10)?"0".$m:$m;
		$s = ($s < 10)?"0".$s:$s;
		echo "<div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer'>[$m:$s] $name 說：<br> $anchor_descript</div>";
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



$("#add_fav").click(function(){
if(member_id.length>=1){
$.post("php/favorite_add.php",{member_id:member_id,user_media_id:user_media_id},function(data) {alert('已加入收藏!!'); });
}else
alert("請先登入");
})

$("#bkbutton").click(function(){
location.href='./my_favorite.php'; 
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


</script>
</body>
</html>
