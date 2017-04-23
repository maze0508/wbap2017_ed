<?php session_start();
$member_id = $_SESSION['member_id'];
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
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.datepicker.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
form.cmxform label.error { display: none; }	
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>
<!-- start page -->
<div id="page" style=" height:500px; background-repeat:no-repeat;
	background-position:right bottom;
	background-size:40%;background-image: url(images/test/adm-estclass2.png);">
	<!-- start content -->
	<div id="content">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>建立課程</div><br/><br/>
		<div class="post">

			<div class="entry">
			<form class='cmxform' id='eform' name='edit' method='post' action='php/insert_course.php'>
			<label><b style='color:red'>*</b>學年度：</label><input type="text" name="course_year" id="course_year" class="required" maxlength="3" size="3" />
			<br/>(請填入完整學年度：101，102..)
			<p/><label><b style='color:red'>*</b>課程名稱：</label><input type="text" name="course_name" id="course_name" class="required" />
			<p/><label><b style='color:red'>*</b>授課教師：</label>
			<?php

			$query = "select member_id,name,unit from member where compet='2' order by name";//*4
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
			$member_id = $row["member_id"];
			$unit = $row["unit"];
			$name = $row["name"];
			$member_opt .= "<option value='$member_id' id='$member_id'>$name / $unit</option>";
			}
			echo "<select name='member_id' id='teacher'>$member_opt</select>";
			?>
			<p/><label><b style='color:red'>*</b>課程開始時間：</label><input type="text" name="course_start" id="course_start" class="required" readonly="readonly" />
			<p/><label><b style='color:red'>*</b>課程結束時間：</label><input type="text" name="course_end" id="course_end" class="required" readonly="readonly" />
			<p/><label><b style='color:red'>*</b>課程資訊：</label>
			<p/><textarea name="course_info" id="course_info" cols="45" rows="5" class="required"></textarea>
			<br/><input class="submit" id="insert_class" type="submit" value="建立"/>
			</form>
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
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-TW.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$("#eform").validate(); //驗證註冊資料

$("#course_start").datepicker({showOn: 'both',dateFormat: 'yy-mm-dd',buttonImageOnly: true,buttonImage: 'images/calendar.gif'});
$("#course_end").datepicker({showOn: 'both',dateFormat: 'yy-mm-dd',buttonImageOnly: true,buttonImage: 'images/calendar.gif'});

$("#insert_class").click(function(){
if($("#course_end").val() < $("#course_start").val()){
alert("結束日期不能比開始日期早");
return false;
}
else
return true;
})







});

</script>
</body>
</html>
