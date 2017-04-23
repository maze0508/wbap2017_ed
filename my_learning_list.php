<?php session_start();
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
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
width:100%;
margin:5px;
border-bottom:1px solid #666;
padding:3px;
}
.imgs{
border:1px solid;
padding:2px;
margin-right:2px
width:130px;
}
.team{
width:150px;
border:1px solid #360;
float:left;
margin:2px;
color:#663;
text-align:center;
cursor:pointer
}
.team_B{
width:150px;
border:1px solid;
background-color:#FFC;
float:left;
margin:2px;
color:#663;
text-align:center;
cursor:pointer
}
.showT{
background-color:#99C;
}
</style>
</head>
<body>
<div id="logo">
	<?php
	include_once("banner.php");
	?>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['user_name'];?></span>
	<?php
	include_once("php/root.php");
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>--->
<!-- start page -->
<div id="page" style="height:500px; background-repeat:no-repeat;
	background-position:right bottom;background-size:20%;background-image: url(images/test/tr-manth2.png);">
	<!-- start content -->
	<div id="content" style=" width:100%;">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>管理主題/分組關聯</div><br/><br/>
		<div class="post">
			<div class="entry" >
				<label style="color:blue">【學生組別一覽】</label>
				<div style="border:1px solid;width:100%;height:150px;overflow:auto">
				<input type="button" id="insert_L_team" value="建立學習主題與組別關聯" style="float:left;height:40px;padding:3px">
				<?php
				$query = "select course.course_year,course.course_name,team.team_id,team.team_name from (team inner join course_team on team.team_id = course_team.team_id) inner join course on course_team.course_id = course.course_id where course.member_id = '$member_id' order by course.course_name,team.team_name";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
					$course_year = $row["course_year"];
					$course_name = $row["course_name"];
					$team_id = $row["team_id"];
					$team_name = $row["team_name"];					
					echo "<div class='team'>($course_year) $course_name <br/> <input type='checkbox' class='teambox' id='$team_id' /> $team_name</div>";				
				}
								
				?>
				</div>
				<label style="color:red">【我建立的學習主題】</label>
				<br/>
				<?php
				$query = "select user_media.url,learning.learning_id,learning.learning_name,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id where learning.member_id = '$member_id'";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $learning_name = $row["learning_name"];
				   $learning_id = $row["learning_id"];
				   $learning_start = $row["learning_start"];				   
				   $learning_end = $row["learning_end"];
				   $learning_content = $row["learning_content"];
				   $edit_books_id = $row["edit_books_id"];
				   $name = $row["name"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];	
				   $found = strstr($url,"youtube");					   
				   ($found)? $aimgs = "<img src='' class='youtube imgs' name='$url' align='top' />" : $aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
				   	echo "
					<div class='temp_movie'>
						<div style='width:140px;float:left;'>
							$aimgs
						</div>
						<div style='width:100%;'>
							<label><input type='radio' name='learadio' id='$learning_id' />【 $subject_catalog 】 <a style='text-decoration: none;' href=''>$learning_name</a></label><br>
							<label>主題作者：$name</label><br>
							<label>學期期限：$learning_start ~ $learning_end</label><br>
							<label>學習概念：$learning_content</label> <input type='button' class='showT' id='$learning_id' value='顯示參與這活動之組別'>
						</div>
						<div style='width:100%;height:50px;display:none;overflow:auto'></div>
					</div><br/>					
					";
					
				}
				mysqli_free_result($result);
				?>	
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	</div>
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


$("#insert_L_team").click(function(){
   	var team_id = $('input[type=checkbox]:checked').map(function(i,n) {
   			 return $(n).attr('id');
   	}).get(); //get converts it to an array
   	var learning_id = $('input[type=radio]:checked').attr("id")
	
	 if(team_id.length == 0 || learning_id == undefined) {
   			 alert('組別與學習主題都必須選擇才能建立關聯 !')
   			 return false;
   	 }else{ 
	 $.post("php/insert_learning_team.php",{learning_id:learning_id,'team_id[]':team_id},function(data) {alert("已建立關聯");location.reload();});
     }	
})

$("input:button.showT").live("click",function(){
	var tmp = $(this);
	$.post("php/select_learning_team.php",{learning_id:$(this).attr("id")},function(data) {
		if(data)
		tmp.parent().next("div").html(data+"<label style='color:red'>連點兩下群組，可移除該群組之關聯性</label>").show();
	});
})

$("div.team_B").live("dblclick",function(){
$.post("php/del_learning_team.php",{learning_team_id:$(this).attr("id")},function(data) {alert("已移除關聯性");location.reload();});
})



})
</script>
</body>
</html>
