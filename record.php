<?php session_start();
$member_id = $_SESSION['member_id'];
$stu_id = mysql_escape_string($_GET['stu_id']);	
if(!$_SESSION['account'] || $_SESSION['compet'] < 2)
echo "<script>document.location.href='index.php'</script>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />


<meta name="description" content="" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="css/ui.datepicker.css" />



<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
td.className{
	font-size: 20px;
	font-weight: bold;
	text-align: center;
}

#Edit{
	height:700px
}
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
	margin: 0 auto;
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

<!-- start page -->
<div id="page">
<!--<div id="page" style="height:500px; background-repeat:no-repeat;
	background-position:center;background-size:20%;background-image: url(images/test/tr-note2.png);">-->
	
	<!-- start select_menu -->
	<div id="select_menu" style="width:100%;margin-bottom:20px;">
	<select id='course'> 
		<option class='change' value='change'>請選擇章節 課程</option>
		<?php
			include_once("php/root.php");
			$member_id = $_SESSION['member_id'];
			$query = "select course_id,course_name from course where member_id = '$member_id'";//*4
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				$course_id = $row["course_id"];
				$course_name = $row["course_name"];
				//echo "<div class='course' id='$course_id'> $course_name </div>";
				echo '<option value="' . $course_id . '">' . $course_name . '</option>' . "\n";
			}
		?>
	</select>
	<select id='course_stu'> 
		<option class='change' value='change'>請選擇章節 學生</option>
	</select>
	
	</div>
	<!-- end content -->
	<!-- start content -->
	<div id="manager" style="width:100%">
	<?php
	if($stu_id){
		include_once('php/paginator.class.php');
		include_once('php/root2.php');
		
		
		
		$query = "SELECT COUNT(`member_id`='$stu_id') FROM record";
		$result = $mysqli->query($query);
		$num_rows = $result->fetch_array(MYSQL_ASSOC);
		$pages = new Paginator;
		$pages->items_total = $num_rows[0];
		$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
		$pages->paginate();

		echo $pages->display_pages();
		echo "<span class=\"\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";

		$query = "select record_id,action,record_date FROM record WHERE member_id ='$stu_id' ORDER BY record_date ASC";
		$result = $mysqli->query($query);

		echo "<table width='70%'>";
		echo "<tr><th width='200px'>時間點</th><th width='400px'>歷史紀錄</th></tr>";
		while($row = $result->fetch_array(MYSQL_ASSOC))
			{
			echo "<tr >
				<td align='center'>
				<div>$row[2]</div>
				</td>
				<td><div>$row[1]</div></td>
				</tr>\n";
			}
		echo "</table>";

		echo $pages->display_pages();
		echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
	}
?>

	</div>
	<!-- end content -->

</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>

<script type="text/javascript" src="js/menu.js"></script>

<script type="text/javascript">
$(function(){  
	var member_id = "<?php print $_SESSION['member_id']; ?>";




	$('select#course').live("change", function(){ 
		var course_id=$(this).val();
		var select_type='course';
		$.post("php/select_manager.php",{select_id:course_id,select_type:select_type},
			function(data) {

				$('select#course_stu').html(data);
			});
		 });
	$('select#course_stu').live("change", function(){ 
		var course_stu_id=$(this).val();

		document.location.href='record.php?stu_id='+course_stu_id;
		/*$.post("php/record_show.php",{member_id:course_stu_id},
			function(data) {
				$('#manager').html(data);
		
			});*/
		 });
});
</script>
</body>
</html>
