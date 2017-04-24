<?php session_start();
$member_id = $_SESSION['member_id'];
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$team_id = mysql_escape_string($_GET['team_id']);
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
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
#cboxLoadedContent{
		background:#000000;
		}
#showRight{
	background-color: rgb(187,217,223);
	color: #fff;
	width: 30px;
	height: 100%;
	position: fixed;
	top: 0px;
	right: 0px;
}
</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['account']){
	include_once("banner_stu.php");
	include_once("php/root.php");
	}else{
		echo "<h2><input type='button' class='colorbox' style='background-image: url(images/login_btn.jpg);width:90px; height:30px;'/></h2>";
	}
	?>	
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
         <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="index.php" title="個人書房">個人書房</a> >> <a href="group_study.php" title="我的學習主題">我的學習主題</a></div><br/><br/>
		<div class="post">
			<div class="entry">
			<?php
				//$user_media_id = mysql_escape_string($_GET['user_media_id']);
				//$team_id = mysql_escape_string($_GET['team_id']);
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,common.common_account,common.common_unit,common.common_email,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,user_media.media_type,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join common on common.common_id = user_media.common_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
					$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $url .= $row["url"];			   
					   $ident_catalog .= $row["ident_catalog"];
					   $name .= $row["name"];
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
					   $media_type .= $row['media_type']; 
					   $copyright .= $row["copyright"];
					   $ccdescript_catalog .= $row["ccdescript_catalog"];	
					   $found .= strstr($url,"youtube");			   
					}
				}	
			if(!$title) //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
			echo "<script>document.location.href='index.php'</script>";
			?>
				<?php
				$query = "SELECT user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id' AND user_media.user_media_id = '$user_media_id'";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $learning_name = $row["learning_name"];
				   $learning_id = $row["learning_id"];
				   $user_media_id = $row["user_media_id"];
				   $learning_start = $row["learning_start"];				   
				   $learning_end = $row["learning_end"];
				   $learning_content = $row["learning_content"];
				   $edit_books_id = $row["edit_books_id"];
				   $name = $row["name"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];	
				   $found = strstr($url,"youtube");					   
				    	echo "
						<div style='width:100%;'>
                            <h2>$learning_name</h2>
							<h3>● 學習概念：$learning_content</h3>
						</div>					
					";						
				}
				mysqli_free_result($result);
				?>	
                
				<div id='embed'>
				<div style="width:150%;overflow:auto;border:1px solid #DEF;">
               		<?php
                    if($title && $found){
				        $UrlArray = explode("=" , $url);
                        $youtube_name = $UrlArray[1];
				    ?>	
				        <iframe id="ytplayer" width="800px" height="600px"  src="https://www.youtube.com/embed/<?php 
						if($anchor_time){
							echo "$youtube_name?start=".$anchor_time;}else{
								echo "$youtube_name";}
						 ?>" frameborder="0" denyfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
						?>
				        <video id="MovieShow" preload="auto" controls width="800px" height="600px" playsinline webkit-playsinline="false" allowfullscreen="false">
				    <?php
				        if(strstr($media_type,"mp4"))
				            echo "<source src=\"../user_movie/".$url.".mp4\" type = 'video/mp4'>";
				        else if(strstr($media_type,"ogg"))
				            echo "<source src=\"../user_movie/".$url.".ogv\" type = 'video/ogg'>";
				        else if(strstr($media_type,"webm"))
				            echo "<source src=\"../user_movie/".$url.".webm\" type = 'video/webm'>";
						if($anchor_time){
					?>
							 <script>
							 var anchor_time = <?php print $anchor_time; ?> ;
							 settime(anchor_time);
                             </script>
                     <?php 
						}
				        //else
				            //echo "您的瀏覽器不支援HTML5影片播放";
				    ?>
				        </video>
				    <?php
						}
                    ?>   
           </div>
				</div>
				<span type="text" id="anchor_time">0</span>
				<input type="text" id="anchor_descript"  size="50" maxlength="200" value=" 請將影片暫停在您欲註記的時間點.." />
				<label id="anchor" class='ibutton' style='background-color:#F60'>留下註記</label>
			<div style="float:right;width:120px">
				<a style='text-decoration: none;' href='start_learning_class_2.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>'><img src="images/test/stu-cf3.png" /><!-- 整理註記 --></a>
           </div>
		</div>
      </div>
	<!-- end content -->
   	</div>
    <!-- end page -->
	<!-- start 右側滑動選單 start-->
    <div class="cbp-spmenu-push">
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>我的註記</h3>
	<?php
		$query="SELECT member.name, media_anchor_image.media_anchor_image_id, media_anchor_image.anchor_descript, media_anchor_image.noteColor, media_anchor_image.anchor_time, media_anchor_image.image
				FROM member
				LEFT JOIN media_anchor_image ON member.member_id =  media_anchor_image.member_id
				WHERE user_media_id = '$user_media_id'
				AND media_anchor_image.member_id = '$member_id'  
				ORDER BY media_anchor_image.anchor_time
			";
			$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$name = $row['name'];
			$anchor_time = $row['anchor_time'];
			$image = $row['image'];
			$anchor_descript = $row['anchor_descript'];//文字
			$media_anchor_image_id = $row['media_anchor_image_id'];//文字
			$noteColor = $row['noteColor'];
			
			$s   =   $anchor_time%60;
			$m   =   floor($anchor_time/60);
			//$o   =   floor($m/60);
			$m = ($m < 10)?"0".$m:$m;
			$s = ($s < 10)?"0".$s:$s;
			
			if($noteColor==0){
				echo "<table id='$media_anchor_image_id' style='border-top:1px solid;cursor:pointer'>
						<tr>
							<td style='width:150px;'><div id='$anchor_time' class='antime $anchor_time' >[$m:$s] $name 說：<br><br> $anchor_descript</div>
							</td>
							<td style='width:50px;'>
								<div><img class='delete_button' style='width:16px;'src='images/cancel.png';></img></div> 
								<div><img class='edit_button' style='width:16px;'src='images/tag_blue_add.png';></img></div>
							</td>
						</tr>
						</table>
					";
			}
		}
		
	?>
		</nav>
		<div class="container">
        <button id="showRight" class="cbp-spmenu-vertical cbp-spmenu-right cbp-spmenu-open"> 我的註記 </button>
	  </div>
  </div>

		<script src="js/classie.js"></script>
		<script>
			var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRight = document.getElementById( 'showRight' );
				body = document.body;
				showRight.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( menuRight, 'cbp-spmenu-open' );
					disableOther( 'showRight' );
			};
			function disableOther( button ) {
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
			}
		</script>			
      <!-- end 右側滑動選單-->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var title = "<?php print $title; ?>";
var url = "<?php print $url; ?>";
var media_type = "<?php print $media_type; ?>";
var edit_media_image_id;
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




$("#anchor").click(function(){
if(member_id.length>=1){
$.post("php/insert_anchor_image_text.php",{member_id:member_id,user_media_id:user_media_id,url:url,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time",media_type:media_type).text(),privacy:"privacy"},function(data) {
action='新增圖文註記'+$("#anchor_descript").val();;
record(member_id,action);
alert('已留下註記!!'); $("#comment").html(data); $("#anchor_descript").val('')
});
}else
alert("請先登入");
})



$('body').keydown(function(){
    var keycode = window.event.keyCode;
    if( keycode == 13 )
    {
	if(member_id.length>=1){
		$.post("php/insert_anchor_image_text.php",{member_id:member_id,user_media_id:user_media_id,url:url,anchor_time:$("#anchor_time").text(),privacy:"privacy"},function(data) {
		($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')
		alert('已留下註記!!'); $("#comment").html(data); 
	});
	}else
		alert("請先登入");
    }
});



$("#anchor_descript").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')}).one("click",function(){
$(this).val("");
})


$(".delete_button").live("click",function(){
	//alert("ok");
	if(member_id.length>=1){
		//var button_type="image";
		var media_anchor_id=$(this).parents('table').attr('id');
		//alert(media_anchor_id);
		//$.post("php/delete_anchor.php",{button_type:button_type,media_anchor_id:media_anchor_id,button:"delete"},function(data) {
		$.post("php/delete_anchor_text.php",{media_anchor_id:media_anchor_id,button:"delete"},function(data) {
			var del_anchor="table#"+media_anchor_id;
			action='刪除圖片註記';
			record(member_id,action);
			 $(del_anchor).remove();  
		});
	}else
	alert("請先登入");
})

$('.edit_button').live("mouseover",function(){
	action='編輯圖片註記';
	record(member_id,action);
	edit_media_image_id=$(this).parents('table').attr('id');
	$(this).colorbox({href:"crop_1.php?media_anchor_image_id="+edit_media_image_id+"",width:"600", height:"500",iframe:true,slideshow:true});
})
$(document).bind('cbox_closed', function(){
		$.post("php/insert_anchor_image_text.php",{member_id:member_id,user_media_id:user_media_id,privacy:"privacy"},
			function(data) {//alert(data);
			$("#sidebar").html(data);});
	});
/*$("#cboxClose").live("click",function(){
	var button="close";
	//var id=$('.article').attr('id');
	//var id2=$('div[class*=antime]').attr('id');
	//alert(id2);
	//alert(edit_media_image_id);
	$.post("./php/crop_archive.php",{button:button,member_id:member_id,user_media_id:user_media_id},function(data) {
	
			$("#comment").html(data); 
	});
})*/

})


$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})


function playerReady(obj) {
action='觀看影片-'+title;
record(member_id,action);
($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
	$("#anchor_time").text(Math.floor(obj.position));
	$("div.antime").parents('table').css("background-color","");
	$('#sidebar').scrollTop();
	$("div."+Math.floor(obj.position)).parents('table').css("background-color","#FC9");
//$("#anchor_time").text(Math.floor(obj.position));
//$("div."+Math.floor(obj.position)).siblings('div.antime').css("background-color","").end().css("background-color","#FC9");
}

function record(member_id,action){
	$.post("php/record.php",{member_id:member_id,action:action},function(data) {
	});
}

</script>
</body>
</html>
