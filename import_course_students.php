<?php session_start();
if(!$_SESSION['account'] || $_SESSION['compet'] < 3)
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
width:120px;
float:left;
margin:5px;
border:1px solid #F90;
padding:3px;
text-align: center;
}
.yello{
background-color : yellow;
}
</style>
</head>
<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr align="center" height="30px">
    <td width="50%">已選課名單
	<label id="delall" style="border:1px solid;padding:2px;cursor:pointer">全選/取消</label>
	<label id="del" style="border:1px solid;padding:2px;cursor:pointer">刪除</label>
	</td>
    <td>待選名單
	<?php
	include_once("php/root.php");
	$query = "select iclass from  member where compet = '1' group by iclass";
	$result = $mysqli->query($query);
	while($row = $result->fetch_array(MYSQL_ASSOC)){
	$iclass = $row["iclass"];
	$opt_iclass .= "<option value='$iclass'>$iclass</option>";
	}
	echo "<select id='iclass'><option>請選擇班級</option>$opt_iclass</select>";
	?>，
	<label id="selectall" style="border:1px solid;padding:2px;cursor:pointer">全選/取消</label>
	<label id="save" style="border:1px solid;padding:2px;cursor:pointer">儲存</label>
	</td>
  </tr>
  <tr height="400px">
    <td valign="top">
<div id="this_area" style="height:380px;overflow:auto">
	<?php
	$course_id = mysql_escape_string($_GET['course_id']);
	$query = "select member.name,member.iclass,course_stu.member_id,course_stu.course_stu_id from member left join course_stu on course_stu.member_id = member.member_id where course_stu.course_id = '$course_id' order by member.iclass,member.name";
	$result = $mysqli->query($query);
	while($row = $result->fetch_array(MYSQL_ASSOC)){
	$name = $row["name"];
	$iclass = $row["iclass"];
	$member_id = $row["member_id"];
	$course_stu_id = $row["course_stu_id"];
	echo "<div id='$course_stu_id' id2='$member_id' class='stu' style='width:60px;border:1px solid;float:left;margin:3px;text-align:center;cursor:pointer'>$name <br> $iclass</div>";
	//id是用來刪除，id2是用來避免重複選課
	}
	?>
	</div></td>
    <td valign="top"><div id="stud_area" style="height:380px;overflow:auto"></div></td>
  </tr>
</table>
 P.S 移到 [已選課名單] 區域時，再次點選可移除該學生 

<script type="text/javascript">

$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
var course_id = "<?php print $course_id; ?>";


$("#iclass").change(function(){
$.post("php/select_user.php",{iclass:this.value},function(data) {
$("#stud_area").html(data);
});
})

$("#this_area div.stu").live("click",function(){
($(this).hasClass("yello"))? $(this).removeClass("yello"):$(this).addClass("yello");
})

$("#stud_area div.stu").live("click",function(){
if($(this).hasClass("yello") || $("#this_area div[id2="+this.id+"]").size() > 0){ //避免重複選課
$(this).removeClass("yello")
return false;
}
else
$(this).addClass("yello")
})

$("#save").click(function(){
var member_id = $('#stud_area div.yello').map(function(i,n) { return $(n).attr('id'); }).get(); 
if(member_id.length == 0) { alert('未選擇學生'); return false;}
$.post("php/insert_course_stu.php",{course_id:course_id,'member_id[]':member_id},function(data) {
	alert("修該門課的學生異動完成");
	location.reload();
});  
})

$("#selectall").toggle(function(){
$("#stud_area div.stu").each(function(){
($("#this_area div[id2="+this.id+"]").size() > 0)?$(this).removeClass("yello"):$(this).addClass("yello")})
},function(){
$("#stud_area div.stu").removeClass("yello")
})

$("#delall").toggle(function(){
$("#this_area div.stu").addClass("yello")
},function(){
$("#this_area div.stu").removeClass("yello")
})


$("#del").click(function(){
var course_stu_id = $('#this_area div.yello').map(function(i,n) { return $(n).attr('id'); }).get(); 
if(course_stu_id.length == 0) { alert('未選擇學生'); return false;}
$.post("php/del_course_stu.php",{'course_stu_id[]':course_stu_id},function(data) {
	alert("已從該學生刪除這門課");
	location.reload();
}); 
})



 
});



</script>
</body>
</html>
