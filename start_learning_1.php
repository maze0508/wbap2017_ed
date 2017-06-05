<?php session_start();
$member_id = $_SESSION['member_id'];
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$team_id = mysql_escape_string($_GET['team_id']);
if ($_GET['anchor_time']) {
	$anchor_time = $_GET['anchor_time'];
}else{
	$anchor_time = 0;
	$anchor_descript = "請輸入您欲註記的內容..";
}
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
<script type="text/javascript" src="m/js/deviceListener.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<script>
//監聽video的各個属性
function settime(tValue) {  
    var video = document.getElementById("MovieShow");
	video.currentTime = tValue;
}
</script>
<script>
function delete_button(obj){
// $(".delete_button").click(function(){
	if(member_id.length>=1){
		var media_anchor_image_id=$(obj).attr('id');
		//var media_anchor_image_id=$(this).attr('id');
		$.post("php/delete_anchor_text.php",{media_anchor_image_id:media_anchor_image_id},function(data) {
			var del_anchor="'li #"+media_anchor_image_id+"'";
			alert("已刪除註記");
			action='刪除圖片註記';
			record(member_id,action);
			$(del_anchor).remove(); 
		});
		var updateTime=self.setInterval(function(){
		$.post("note_ajax.php",{user_media_id:user_media_id},function(data) {
				$("#jcarousel").html(data);
			});
		},10);
		window.setTimeout(function() {
		updateTime = window.clearInterval(updateTime);
		},1000);

		   
	}else
	alert("請先登入");
};	
</script> 

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
	background-color: #95CFF2;
	color: #fff;
	width: 30px;
	height: 100%;
	position: fixed;
	top: 0px;
	right: 0px;
}

#note label{
	color:#69C;	
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
				            echo "<source src=\"user_movie/".$url.".mp4\" type = 'video/mp4'>";
				        else if(strstr($media_type,"ogg"))
				            echo "<source src=\"user_movie/".$url.".ogv\" type = 'video/ogg'>";
				        else if(strstr($media_type,"webm"))
				            echo "<source src=\"user_movie/".$url.".webm\" type = 'video/webm'>";
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
          <!-- 留下註記start -->
            <div id="note"> 
                <input type="hidden" id="anchor_time" value="" /> 
                <label>● 註記內容：</label>           
                <textarea cols="10" id="anchor_descript" style="width:100%;height:100px">
                <?php
			$query ="SELECT media_anchor_image.anchor_descript, media_anchor_image.anchor_time
		FROM member
		LEFT JOIN media_anchor_image ON member.member_id =  media_anchor_image.member_id
		WHERE user_media_id = '$user_media_id'
		AND media_anchor_image.member_id = '$member_id'
        AND anchor_time='$anchor_time'";
				
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $anchor_descript = $row["anchor_descript"];
				}
				echo $anchor_descript;	
	?>
         
</textarea><br/>
                <button id="anchor" style='border-bottom: hidden; background-color: #95CFF2; color: #FFF; width: 100%;'>留下註記</button>
            </div>    
                  
            <!-- 留下註記end -->
			</div>

			<div style="float:right;width:120px">
				<a style='text-decoration: none;' href='start_learning_class.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>'><img src="images/test/stu-cf3.png" /><!-- 整理註記 --></a>
           </div>
		</div>
      </div>
	<!-- end content -->
   	</div>
    </div>
    <!-- end page -->
	<!-- start 右側滑動選單 start-->
    <div class="cbp-spmenu-push" style="overflow:scroll;overflow-X:hidden;">
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2" style="overflow:scroll;overflow-X:hidden;">
			<h3>我的註記</h3>
            <div id="jcarousel" style="padding:20px;overflow:scroll;overflow-X:hidden;">
	<?php
	   $query="SELECT member.name, media_anchor_image.media_anchor_image_id, media_anchor_image.anchor_descript, media_anchor_image.noteColor, media_anchor_image.anchor_time, media_anchor_image.image
				FROM member
				LEFT JOIN media_anchor_image ON member.member_id =  media_anchor_image.member_id
				WHERE user_media_id = '$user_media_id'
				AND media_anchor_image.member_id = '$member_id'  
				ORDER BY media_anchor_image.anchor_time";
				
				$result = $mysqli->query($query);
				$row = $result->fetch_array(MYSQL_ASSOC);
			/*檢查此學習主題是否為空*/
			if(empty($row)){
				echo "<p>此學習主題目前尚無註記</p>";
			}else{

				while($row) { 
					$name = $row['name'];
					$anchor_time = $row['anchor_time'];
					$image = $row['image'];
					$anchor_descript = $row['anchor_descript'];//文字
					$media_anchor_image_id = $row['media_anchor_image_id'];//文字
					$noteColor = $row['noteColor'];
					$h   =   floor($anchor_time/3600);
					$temp = $anchor_time%3600;
					$m   =   floor($temp/60);
					$temp = $temp%60;
					$s   =  $temp;
					
					$h = ($h < 10)?"0".$h:$h;
					$m = ($m < 10)?"0".$m:$m;
					$s = ($s < 10)?"0".$s:$s;
					
			
					//Youtube影片的註記內容，因為無法截圖，故不顯示圖片	
   					if($title && $found){
						  echo "<li id='$media_anchor_image_id'  style='margin-bottom:100px;margin-left:20px;list-style-type:none;'>
							<div>
							<a style='text-decoration: none;' href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'>
							<div id='$anchor_time' class='antime $anchor_time' >註記時間：[$h:$m:$s]</div><div>註記內容：$anchor_descript</div>
							</a>
							<button id='$media_anchor_image_id' class='delete_button' style='background-image:url(images/cancel.png);background-size:100%;width:15px;height:15px;margin-left:10px; border: 0;' onclick='delete_button(this)'> </button>
							</div>
						</li>";
					  }else{
						echo "<li id='$media_anchor_image_id' style='margin-bottom:100px;margin-left:20px;list-style-type:none;'>
							<div>
							<a style='text-decoration:none;height:80%;' href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'>
							<div id='$anchor_time' class='antime $anchor_time' style='font-size:12pt;'>註記時間：[$h:$m:$s]</div><br/>
							<div id='$anchor_descript' style='font-size:12pt;'>註記內容：$anchor_descript</div><br/>
							<div><img class='image' style='width:40%;height:40%;float:left;' src='images/anchor/$image'/></div>
							</a>
							<button id='$media_anchor_image_id' class='delete_button' style='background-image:url(images/cancel.png);background-size:100%;width:15px;height:15px;margin-left:10px; border: 0;' onclick='delete_button(this)'> </button>
							</div>
							</li>";
					}
					$row = $result->fetch_array(MYSQL_ASSOC);
					
		}
	}
		
	?>
    	</div>
		</nav>
	  </div>
<div class="container">
        <button id="showRight" class="cbp-spmenu-vertical cbp-spmenu-right cbp-spmenu-open"> 我的註記 </button>
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
jQuery.browser={};(function(){jQuery.browser.msie=false; jQuery.browser.version=0;if(navigator.userAgent.match(/msie ([0-9]+)./)){ jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;}})();
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var title = "<?php print $title; ?>";
var url = "<?php print $url; ?>";
var media_type = "<?php print $media_type; ?>";
var edit_media_image_id;

function record(member_id,action){
	$.post("php/record.php",{member_id:member_id,action:action},function(data) {	
		 });
};

$(document).ready(function(){
  $("#anchor").click(function(){
	if(member_id.length>=1){
		/*如果是html播放器，以下紀錄目前時間*/
		if (document.getElementById("MovieShow")) {
			 Media = document.video = document.getElementById("MovieShow");
			 $("#anchor_time").val(Math.floor(Media.currentTime));
		}
		/*按下留下註記按鈕以新增註記*/
		$.post("php/insert_anchor_image_text.php",{member_id:member_id,user_media_id:user_media_id,url:url,media_type:media_type,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").val(),privacy:"privacy"},
		function(data) {
			alert("已新增註記");
			action='新增圖文註記'+$("#anchor_descript").val();
			record(member_id,action);
			$("#anchor_descript").html(data); 
			$("#anchor_descript").val(' '); 
			$("#anchor_time").val(' ');
		});
		var updateTime=self.setInterval(function(){
			$.post("note_ajax.php",{user_media_id:user_media_id},function(data) {
				$("#jcarousel").html(data);
			});
		},10);
		window.setTimeout(function() {
		updateTime = window.clearInterval(updateTime);
		},1000);
	}else{
		alert("請先登入");
	}
	
 });
});

/*$('.edit_button').click(function(){
	if(member_id.length>=1){
		var edit_anchor_image_id=$(this).parents('li').attr('id');
		action='編輯圖片註記';
		record(member_id,action);
		$(this).colorbox({href:"crop_1.php?media_anchor_image_id="+edit_anchor_image_id+"",width:"600", height:"500",iframe:true,slideshow:true});
	}
})*/

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



/*$("#anchor_descript").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')}).one("click",function(){
$(this).val("");
})*/

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


//$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})


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
}

</script>
</body>
</html>
