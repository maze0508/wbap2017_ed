<!-- 註記部分使用自動更新功能 -->
<?php 
session_start();
$member_id = $_SESSION['member_id'];
$user_media_id = $_GET['user_media_id'];
if ($_GET['anchor_time']) {
	$anchor_time = $_GET['anchor_time'];
}else{
	$anchor_time = 0;
	$anchor_descript = "請輸入您欲註記的內容..";
}
if(!$_SESSION['account']) {
	echo "<script>document.location.href='index.php'</script>;";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1,user-scalabl e=0">
<title>Video Learning</title>

<link href="css/mobile_css.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" type="text/css" href="css/jcarousel.ajax.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="js/jcarousel.ajax.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".menu").click(function() {
        $(this).toggleClass("active");
        $(".nav").slideToggle();
    });
    $(".nav > ul > li:has(ul) > a").append('<div class="arrow-bottom"></div>');
});

</script>

<script>
//監聽video的各個属性
function settime(tValue) {  
    var video = document.getElementById("MovieShow");
	video.currentTime = tValue;
}
</script>
<script>
//記錄註記時間
function recordNote(){
    if (document.getElementById("MovieShow")) {
   		 Media =  document.video = document.getElementById("MovieShow");
		 $("#anchor_time").val(Math.floor(Media.currentTime));
    }else{
		
		 var hour =  $("#hour").val();	
		 var minute = $("#minute").val();
		 var second =  $("#second").val(); 	
		 var time = hour*3600+minute*60+second*1;
		 $("#anchor_time").val(time);

		 }
}

 </script>
<script>
function delete_button(obj){
// $(".delete_button").click(function(){
	if(member_id.length>=1){
		var media_anchor_image_id=$(obj).attr('id');
		//var media_anchor_image_id=$(this).attr('id');
		$.post("../php/delete_anchor_text.php",{media_anchor_image_id:media_anchor_image_id},function(data) {
			var del_anchor="'li #"+media_anchor_image_id+"'";
			alert("已刪除註記");
			action='刪除圖片註記';
			record(member_id,action);
			$(del_anchor).remove(); 
		});
		var updateTime=self.setInterval(function(){
		$.post("note_ajax_m.php",{user_media_id:user_media_id},function(data) {
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
#note label{
	color:#69C;	
}
</style>

</head>

<body>
<!---選單與LOGO-->
<div id="banner" style="top:0px">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
	include_once("../php/root.php");
	if($_SESSION['account']){
		include_once("php/banner_s.php");
	}
?>

</div>
<!---主內容-->
<div id="page">
  <div id="content">
  <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
   <a href="group_study.php" title="學習主題" style="border-bottom:hidden;color:#69F">學習主題 </a>>>
			<?php 
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
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
					}
				}	
			if(!$title) //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
			echo "<script>document.location.href='index.php'</script>";
			$query = "select user_media.url,user_media.title,user_media.media_type,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id' AND user_media.user_media_id = '$user_media_id'";
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
				   $media_type .= $row['media_type']; 	
				   $title = $row["title"];					   
				   	echo "<label style='color:#69F'>$learning_name</label>";					
				}
				?>	
                
	<div style="width:100%;overflow:auto;border:1px solid #DEF;">
               		<?php
                    if($title && $found){
				        $UrlArray = explode("=" , $url);
                        $youtube_name = $UrlArray[1];
				    ?>	
				        <iframe id="ytplayer" width="100%" height="350"  src="https://www.youtube.com/embed/<?php 
						if($anchor_time){
							echo "$youtube_name?start=".$anchor_time;}else{
								echo "$youtube_name";}
						 ?>" frameborder="0" denyfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
						?>
				        <video id="MovieShow" preload="auto" controls width="100%" height="100%" playsinline webkit-playsinline="false" allowfullscreen="false">
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
           
<!-- 播放器end / 留下註記start -->
<div id="note"> 
    <input type="hidden" id="anchor_time" value="" /> 
	<label>● 註記內容：</label>    
    <textarea cols='10' id='anchor_descript' style='width:100%;height:100px'>  
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
				   	echo $anchor_descript;					
				}
				echo $anchor_descript;	
	?>
         
 </textarea><br/>
    <button id="anchor" style='border-bottom: hidden; background-color: #95CFF2; color: #FFF; width: 100%;'>留下註記</button>
</div>          
<!-- 留下註記end -->
</div>

<!--隱藏/顯示註記-->
<div class="cbp-spmenu-push">
<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-bottom" id="cbp-spmenu-s4">
<!--水平滑動-->
<div class="wrapper">
 <div class="jcarousel-wrapper">
 <!--註記內容start-->
  <div class="jcarousel" id="jcarousel">
<ul>
<?php
   $query="SELECT member.name, media_anchor_image.media_anchor_image_id, media_anchor_image.anchor_descript, media_anchor_image.noteColor, media_anchor_image.anchor_time, media_anchor_image.image
				FROM member
				LEFT JOIN media_anchor_image ON member.member_id =  media_anchor_image.member_id
				WHERE user_media_id = '$user_media_id'
				AND media_anchor_image.member_id = '$member_id'  
				ORDER BY media_anchor_image.anchor_date DESC";
				
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
					
					if($noteColor==0){
					//Youtube影片的註記內容，因為無法截圖，故不顯示圖片	
   					  if($title && $found){
						  echo "<li id='$media_anchor_image_id'>
							<div style='width:50%;color:#69C;'><a style='text-decoration: none;' href='../m/start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'><div id='$anchor_time' class='antime $anchor_time' >註記時間：[$h:$m:$s]</div><div>註記內容：$anchor_descript</div></a>
							<div><img class='delete_button' style='width:16px;'src='../images/cancel.png';></img></div></div>
						</li>";
					  }else{
						echo "<li id='$media_anchor_image_id'>
							<div style='width:90%;height:80%;color:#69C;float:left;padding-bottom:10%;'>
							<a style='text-decoration: none;height:80%;' href='../m/start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id&anchor_time=$anchor_time'>
							<div id='$anchor_time' class='antime $anchor_time' style='font-size:12pt;'>註記時間：[$h:$m:$s]</div><br/>
							<div id='$anchor_descript' style='font-size:12pt;'>註記內容：$anchor_descript</div><br/>
							<div><img class='image' style='width:80%;height:80%;float:left;' src='../images/anchor/$image'/></div></a></div>
							<button id='$media_anchor_image_id' class='delete_button' style='background-image:url(../images/cancel.png);width:15px;height:15px;' onclick='delete_button(this)'> </button>
							</li>";
					}}
					$row = $result->fetch_array(MYSQL_ASSOC);
				}
				
			}
   ?>   </ul>
   </div>
  <!--註記內容end-->
  <a href="#" class="jcarousel-control-prev">＜</a>
  <a href="#" class="jcarousel-control-next">＞</a>
  </div>
</div>
<!--水平滑動end-->

</nav>

<!--隱藏/顯示註記的按鈕start-->       
<div class="container">
	<div class="main">
	<section>
		<button id="showBottom" class="cbp-spmenu-bottom">顯示我的註記</button>
	</section>
	</div>
</div>
<!--隱藏/顯示註記的按鈕end-->       

<script src="js/classie.js"></script>
<script>
	var menuBottom = document.getElementById( 'cbp-spmenu-s4' ),
		showBottom = document.getElementById( 'showBottom' ),
		body = document.body;
		showBottom.onclick = function() {
			classie.toggle( this, 'active' );
			classie.toggle( showBottom, 'cbp-spmenu-open' );
			classie.toggle( menuBottom, 'cbp-spmenu-open' );
		};
</script>
</div>
<!--隱藏/顯示註記end-->
</div>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/JavaScript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var url = "<?php print $url; ?>";
var media_type = "<?php print $media_type; ?>";
function record(member_id,action){
	$.post("../php/record.php",{member_id:member_id,action:action},function(data) {	
		 });
};
$(document).ready(function() {

$("#anchor").click(function(){	
	if(member_id.length>=1){
		
		/*如果是html播放器，以下紀錄目前時間*/
		if (document.getElementById("MovieShow")) {
		Media =  document.video = document.getElementById("MovieShow");
		 $("#anchor_time").val(Math.floor(Media.currentTime));
		}
		/*按下留下註記按鈕以新增註記*/
		$.post("../php/insert_anchor_image_text.php",{member_id:member_id,user_media_id:user_media_id,url:url,media_type:media_type,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").val(),privacy:"privacy"},function(data) {
		alert("已新增註記");
		action='新增圖文註記'+$("#anchor_descript").val();
		record(member_id,action);
		$("#anchor_descript").html(data); 
		$("#anchor_descript").val(' '); 
		$("#anchor_time").val(' ');
		});
		var updateTime=self.setInterval(function(){
			$.post("note_ajax_m.php",{user_media_id:user_media_id},function(data) {
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

function thisMovie(movieName) {
	if(navigator.appName.indexOf("Microsoft") != -1){
		return window[movieName];
	} else {
		return document[movieName];
	}
};
 
 
});
</script>
</body>
</html>

