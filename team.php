<?php session_start();
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
</head>
<style>
.course{
width:60px;height:60px;float:left;border:1px solid #F30;margin:3px;text-align:center;cursor:pointer;color:#000
}
.course-click{
background-color:#FFD2C8;
}
.team{
width:60px;height:60px;float:left;border:1px solid #96F;margin:3px;text-align:center;cursor:pointer;color:#000
}
.team-click{
background-color:#99F;
}
.team_end{
width:60px;height:60px;float:left;border:1px solid #FFF;margin:3px;text-align:center;cursor:pointer;color:#FFF;background-color:#000
}
.member{
width:60px;height:60px;float:left;border:1px solid #360;margin:3px;text-align:center;cursor:pointer;color:#000
}
</style>
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
	background-position:right bottom;background-size:20%;background-image: url(images/test/tr-group2.png);">
	<!-- start content -->
	<div id="content" style="width:100%">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>課程分組</div><br/><br/>
		<div class="post">
			<div class="entry">
			<table width="100%" border="0">
				<tr>
					<td>
						<label style=" color:#F30">我的授課清單</label>
						<div style="margin-left:20px;height:120px;">
						<?php
							include_once("php/root.php");
							$member_id = $_SESSION['member_id'];
							$query = "select course_id,course_name from course where member_id = '$member_id'";//*4
							$result = $mysqli->query($query);
							while($row = $result->fetch_array(MYSQL_ASSOC)){
								$course_id = $row["course_id"];
								$course_name = $row["course_name"];
								echo "<div class='course' id='$course_id'> $course_name </div>";
							}
						?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<label style=" color:#96F">課堂組別</label>
						<div id="team_list" style="margin-left:20px;height:120px;border-top:1px solid;"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label style=" color:#660">組別學生</label>
							<div id="team_end" class="tmp" style="margin-left:20px"></div>
							<div id="team_stu" class="tmp" style="margin-left:20px;height:120px;border-top:1px solid;"></div>					
					</td>
				</tr>
			</table>	
			</div>
			<br/>
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
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$("div.course").click(function(){
course_id = $(this).attr("id");
$("div.tmp").html(null);
$(this).addClass("course-click").siblings("div.course").removeClass("course-click")
	$.post("php/select_course_team.php",{course_id:course_id},function(data) {
		temp_box = data; //temp起來給要加入群組時使用
		$("#team_list").html(
		"<input type='text' id='team_name' value='輸入新建立組別名稱' style='color:#666'><input type='button' value='建立分組' id='addteam' /><label> (P.S 在此建立的組別僅隸屬於上面所選的課程)</label><br><div id='' class='team' >該門課未分組的學生</div>"
		+data);
	});
})

$("#addteam").live("click",function(){
	$.post("php/insert_team.php",{course_id:course_id,team_name:$("#team_name").val()},function(data) {
		alert('已在該課程建立分組');
		location.reload();
	});
})

$("#team_list div.team").live("click",function(){
	team_id = $(this).attr("id");
	$("div.tmp").html(null);
	$(this).addClass("team-click").siblings("div.team").removeClass("team-click");
	$.post("php/select_team_member.php",{team_id:team_id,course_id:course_id},function(data) {
		if(data && !team_id)
			$("#team_stu").html("<input type='button' id='c-team' value='進行分組' style='float:left;width:65px;height:65px' />"+data);	
		else if(data && team_id)	
			$("#team_stu").html("<input type='button' id='d-team' value='分組移除' style='float:left;width:65px;height:65px' />"+data);	
		else
			$("#team_stu").html(null)
	});
})

$('input:checkbox.memberbox').live("click",function(){
if($(this).attr("checked") == true)
	$(this).parent("div").css("background-color","#690")
else
	$(this).parent("div").css("background-color","#FFF")
})

$("#c-team").live("click",function(){
   	var member_ids = $('input[type=checkbox]:checked').map(function(i,n) {
           	return $(n).attr('id');
   	}).get(); //get converts it to an array
	if(member_ids.length == 0) {
		alert('請勾選學生才能進行分組');
		return false;
	}	
	else if($("input[type=radio]:checked").length > 0 ){ //代表該堂課有分組，且有選擇
		$.post("php/insert_team_stu.php",{team_id:$("input[type=radio]:checked").parent("div.team_end").attr("id"),'member_id[]':member_ids},function(data) {
			alert("分組成功")
			location.reload();
		});
	}else if($("#team_list div.team").length < 2){ //代表該堂課都未分組
		alert("請先在上方建立組別，才能將學生匯入");
	}	
	else{ // //代表該堂課有分組，且未選擇
		alert("要將學生分到哪個組別呢 ? 左方選擇後再次點選【進行分組】按鈕")
		$("#team_end").html(temp_box).find("div.team").append("<br><input type='radio' name='radio' class='radios' / >").removeClass("team").addClass("team_end")
	}
})

$("#d-team").live("click",function(){
   	var team_member_id = $('input[type=checkbox]:checked').map(function(i,n) {
   	//var team_member_id = $('input:checkbox.memberbox[checked=true]').map(function(i,n) {
           	//return $(n).attr('id');
           	return $(n).attr('name');
   	}).get(); //get converts it to an array
	if(team_member_id.length == 0) {
		alert('請勾選學生才能從這群組中移除');
		return false;
	}else{
		$.post("php/del_team_stu.php",{'team_member_id[]':team_member_id},function(data) {
			alert("已將該學生從此群組移除")
			location.reload();
		});
	}

})




})
</script>
</body>
</html>
