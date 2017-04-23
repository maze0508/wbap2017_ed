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
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
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
.paginate {
	font-family: Arial, Helvetica, sans-serif;
}

a.paginate {
	border: 1px solid #000080;
	padding: 2px 6px 2px 6px;
	text-decoration: none;
	color: #000080;
}


a.paginate:hover {
	background-color: #000080;
	color: #FFF;
	text-decoration: underline;
}

a.current {
	border: 1px solid #000080;
	font: bold .7em Arial,Helvetica,sans-serif;
	padding: 2px 6px 2px 6px;
	cursor: default;
	background:#000080;
	color: #FFF;
	text-decoration: none;
}

span.inactive {
	border: 1px solid #999;
	font-family: Arial, Helvetica, sans-serif;
	padding: 2px 6px 2px 6px;
	color: #999;
	cursor: default;
}

table {
	margin: 8px;
}

th {
	font-family: Arial, Helvetica, sans-serif;
	background: #666;
	color: #FFF;
	padding: 2px 6px;
	border-collapse: separate;
	border: 1px solid #000;
}

td {
	font-family: Arial, Helvetica, sans-serif;
	border: 1px solid #DDD;
}
.temp_movie{
cursor:pointer;
width:120px;
float:left;
margin:5px;
border:1px solid #F90;
padding:3px;
text-align: center;
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
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>
<!-- start page -->
<div id="page" style=" height:500px; background-repeat:no-repeat;
	background-position:right bottom;
	background-size:40%;background-image: url(images/test/adm-adclass2.png);">
	<!-- start content -->
	<div id="content" style="width:100%">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>管理課程</div><br/><br/>
		<div class="post">

			<div class="entry">			
			<?php
			include_once('php/paginator.class.php');
			include_once('php/root2.php');

			$query = "SELECT COUNT(*) FROM course";
			$result = $mysqli->query($query);
			$num_rows = $result->fetch_array(MYSQL_ASSOC);

			$pages = new Paginator;
			$pages->items_total = $num_rows[0];
			$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
			$pages->paginate();

			echo $pages->display_pages();
			echo "<span class=\"\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";

			$query = "select course.course_id,member.name,course.course_name,course.course_start,course.course_end,course.course_info,course.course_year from member inner join course where member.member_id = course.member_id ORDER BY course.course_name ASC";
				$result = $mysqli->query($query);
			echo "<table width='100%'>";
			echo "<tr><th width='70px'><input type='button' id='all' value='全選'><input type='button' id='del' value='刪除'></th><th width='40px'>教師</th><th width='50px'>學年度</th><th width='150px'>課堂名稱</th><th  width='70px'>起始日</th><th width='70px'>結束日</th><th>授課內容</th><th>學生群</th></tr>";
				while($row = $result->fetch_array(MYSQL_ASSOC))
			{				
					   $course_id = $row['course_id'];			   
					   $name = $row['name'];			   
					   $course_year = $row['course_year'];			   
					   $course_name = $row['course_name'];
					   $course_start = $row['course_start'];
					   $course_end = $row['course_end'];
					   $course_info = $row['course_info'];
				echo "<tr onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\">
				<td align='center'>
				<input type='checkbox' class='checkbox' value='$course_id'> <img title='儲存' name='$course_id' id='save' style='cursor:pointer' src='images/table_save.png'> <img src='images/unlock16.png' class='unlock' style='cursor:pointer' title='編輯此列'>
				</td>
				<td>$name</td>
				<td><input type='text' class='edit'  disabled='disabled' value='$course_year' maxlength='3' size='3'/></td>
				<td><input type='text' class='edit'  disabled='disabled' value='$course_name'></td>
				<td><input type='text' class='edit date'  disabled='disabled' size='10' readOnly value='$course_start'/></td>
				<td><input type='text' class='edit date'  disabled='disabled' size='10' readOnly value='$course_end'/></td>
				<td><input type='text' class='edit'  disabled='disabled' size='30' value='$course_info'/></td>
				<td><a class='colorbox' id='$course_id' style='cursor:pointer'>(管理學生)</a></td>
				</tr>\n";
			}
			echo "</table>";

			echo $pages->display_pages();
			echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
			?>
			</div>
		</div>

	</div>
	<!-- end content -->
	<!-- start sidebar -->

	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-TW.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>

<script type="text/javascript">

$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";



$('a.colorbox').live("mouseover",function(){
$(this).colorbox({href:"import_course_students.php?course_id="+this.id+"",width:"600", height:"500",iframe:true,slideshow:true});
})




$("#all").toggle(function(){
$("input[type=checkbox].checkbox").attr("checked", true);
},function(){
$("input[type=checkbox].checkbox").attr("checked", false);
})

$("#del").live("click",function(){
if (confirm("你確定要刪除此筆資料?") ){
var courses = $('input[type=checkbox].checkbox:checked').map(function(i,n) {return $(n).attr('value');}).get(); //get converts it to an array
if(courses.length == 0) {alert('請勾選方塊'); return false;}
$.post("php/del_course.php",{'course_id[]':courses},function(data) {alert("該會員已刪除");location.reload();}); 
}
})

$("img.unlock").live("click",function(){
$(this).parent().nextAll().children("input[type=text].edit").removeAttr("disabled")
});


$("#save").live("click",function(){
var stat = $(this).parent().nextAll();
var course_year = stat.eq(1).children("input[type=text].edit").val();
var course_name = stat.eq(2).children("input[type=text].edit").val();
var course_start = stat.eq(3).children("input[type=text].edit").val();
var course_end = stat.eq(4).children("input[type=text].edit").val();
var course_info = stat.eq(5).children("input[type=text].edit").val();
if (confirm("更新此列資料?") ){
	$.post("php/update_course.php",{course_id:$(this).attr("name"),course_year:course_year,course_name:course_name,course_start:course_start,course_end:course_end,course_info:course_info},function(data) {
		alert('資料已更新完成');
		stat.find("input[type=text].edit").attr("disabled", true);
	});
}
})

$("input.date").live("mouseover",function(){
$(this).datepicker({dateFormat: 'yy-mm-dd'});
})


});
function hilite(elem)
{
	elem.style.background = '#FFC';
}

function lowlite(elem)
{
	elem.style.background = '';
}

</script>
</body>
</html>
