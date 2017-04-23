<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!---<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">---->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="m/js/deviceListener.js"></script>
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
margin-right:2px;
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
.groupmember{
margin-left:5px;
}
.single_line{
display: inline;
width:300px;}


</style>
</head>
<body >
<div id="logo">
	<?php
	include_once("banner1_1.php");
	?>	
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['user_name'];?></span>
	<?php
	include_once("php/root.php");
	
	if($_SESSION['account'])
	include_once("banner_logout.php");//登出按鈕
	?>	
	</h2>
</div>
<!-- start page -->
<div id="page" style="height:500px; background-repeat:no-repeat;
	background-position:right bottom;background-size:26%;background-image: url(images/pagebk.png);">

	<!-- start content -->
	<div id="content" style="width:100%">
        <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="index.php" title="個人書房">個人書房</a> >> <a href="#" title="小組學習主題">小組學習主題</a></div><br/><br/>
		<div class="post">
			<div class="entry" >
			<br/>
			<br/>
			<img  style="width:450px; " src="images/group_learn_theme.png"/>
				<!-- <label style="color:red">【小組共同學習主題】</label> -->
				<br/>
				<?php
				$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id'";
				//$query01 = "SELECT name FROM  team_member,member WHERE  team_member.member_id = member.member_id AND team_id = '$team_id'";
				$result = $mysqli->query($query);
				//$result01 = $mysqli->query($query01);
				while($row = $result->fetch_array(MYSQL_ASSOC) ){
				   $learning_name = $row["learning_name"];
				   $learning_id = $row["learning_id"];
				   $user_media_id = $row["user_media_id"];
				   
					$_SESSION['user_media_id'] = $user_media_id;
				   
				   $learning_start = $row["learning_start"];				   
				   $team_id = $row["team_id"];
				   $learning_end = $row["learning_end"];
				   $learning_content = $row["learning_content"];
				   $edit_books_id = $row["edit_books_id"];
				   $name = $row["name"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];	 
				   $found = strstr($url,"youtube");	
					
                 //  $group_member= mysql_fetch_array($mysql_query("SELECT name FROM  team_member,member
											  // WHERE  team_member.member_id = member.member_id
											//   AND team_id = '$team_id'"));				   
				   ($found)? $aimgs = "<img src='' class='youtube imgs' name='$url' align='top' />" : $aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
								   echo "
					<div class='temp_movie'>
						<div style='width:140px;float:left;'>
							$aimgs
						</div>
						<div style='width:100%;height:100px;'>
							<label>【 $subject_catalog 】 <a style='text-decoration: none;' href='group_study_note_3.php?user_media_id=$user_media_id&team_id=$team_id'>$learning_name</a></label><br>
							<label>主題作者：$name</label><br>
							
							<label>學期期限：$learning_start ~ $learning_end</label><br>
							<label>學習概念：$learning_content</label><br/>
							<label>學習組別：$team_id</label>
							<label class='groupmember'>小組成員：</label>";
							
				$query01 = "SELECT name FROM  team_member,member WHERE  team_member.member_id = member.member_id AND team_id = '$team_id'";
				$result01 = $mysqli->query($query01);
				while($row01 = $result01->fetch_array(MYSQL_ASSOC) ){
				$group_member = $row01["name"];	 
				echo"
				
				<div class='single_line'>
				<label id='line' >$group_member</label>
				</div>
				";
				}
				mysqli_free_result($result01);
				echo"
						</div>
						<div style='width:100%;height:50px;display:none;overflow:auto'></div>
					</div>					
					";
					
					
				}
				mysqli_free_result($result);
				
				
				?>
					
				
				
			<br/>
					
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
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
var handlerA = function(){ $(this).attr("src","images/remove.jpg") };

$("img.youtube").each(function(){
$(this).attr("src", $.jYoutube($(this).attr("name"), "small")).bind("error.A",handlerA);
})





})
</script>
</body>
</html>
