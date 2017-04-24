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
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />

<!--<link rel="stylesheet" href="css/bootstrap.min.css"/>---->
<link rel="stylesheet" href="css/jquery.jOrgChart.css"/>
<link rel="stylesheet" href="css/custom.css"/>
<link href="css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="js/prettify.js"></script>
<script src="js/jquery.jOrgChart.js"></script>
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
div.anchor{
    width: 100%;
    border-bottom: 1px solid #000000;
	padding:5px 2px 5px 2px;
	font-size:14px;
}
div.anchorI{
	margin:0 5px 0 5px;
    width: 150px;
    float:left
}
#Edit{
	height:700px
}
</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['account']){
		include_once("banner.php");
		include_once("php/root.php");
	}else{
		echo "<h2><input type='button' class='colorbox' style='background-image: url(images/login_btn.jpg);width:90px; height:30px;'/></h2>";
	}
	?>	
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
		<select id='item'> 
		<option class='change' value='change'>請選擇章節 項目</option>
	</select>
		<select id='media'> 
		<option class='change' value='change'>請選擇章節 影片</option>
	</select>
	</div>
	<!-- end content -->
	<!-- start content -->
	<div id="manager" style="width:100%">
		
	</div>
	<!-- end content -->

</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jcanvas.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  
	var member_id = "<?php print $_SESSION['member_id']; ?>";
	var course_stu_id;

	$("img.youtube").each(function(){
	$(this).attr("src", $.jYoutube($(this).attr("name"), "small")).bind("error.A",handlerA);
	})

	$('select#course').live("change", function(){ 
		var course_id=$(this).val();
		var select_type='course';
		$.post("php/select_manager.php",{select_id:course_id,select_type:select_type},
			function(data) {

				$('select#course_stu').html(data);
				$('select#item option:not(.change)').remove();
				$('select#media option:not(.change)').remove();
			});
		 });
	$('select#course_stu').live("change", function(){ 
		course_stu_id=$(this).val();
		var select_type='course_stu';
		$.post("php/select_manager.php",{select_id:course_stu_id,select_type:select_type},
			function(data) {
				$('select#item').html(data);
				$('select#media option:not(.change)').remove();
			});
		 });
	$('select#item').live("change", function(){ 
		var select_type=$(this).val();
		if(select_type=='change'){
			$('select#media option:not(.change)').remove();
		}else{
			$.post("php/select_manager.php",{select_id:course_stu_id,select_type:select_type},
				function(data) {
					$('select#media').html(data);	
				});
		 }	
	});
		
	$('select#media').live("change", function(){ 
		var user_media_id=$(this).val();
		var select_type=$('select#item').val();
		if(select_type=='item_Nbook'){
			$.post("php/composition_showT.php",{member_id:course_stu_id,compos_book_id:user_media_id},
				function(data) {
					$('#manager').html(data);
					composition=$('div#Edit').attr("class");
					if(composition=='hie'){
						$("#org").jOrgChart({
						});
					}
					if(composition=='mesh'){
						var Edit_ar= new Array();
						var Edit=$('#Edit').offset();//每台電腦不同的位置
						Edit_ar[0]=Edit.left;
						Edit_ar[1]=Edit.top;
						show(Edit_ar);
					}
			});
		}else{
			$.post("php/select_manager2.php",{course_stu_id:course_stu_id,user_media_id:user_media_id,select_type:select_type},
			function(data) {
				$('#manager').html(data);	
			});
		}
	});
	 $('.temp_movie').live("click", function(){
		var user_media_id=$(this).attr('id');	 
		$.post("php/play_media.php",{user_media_id:user_media_id},
			function(data) {
				$('#content').html(data);
				});
	});
	function show(Edit_ar){
		//筆記本顯示
		var x= new Array();
		var y= new Array();
		var point_id= new Array();
		var node;
		var node_x;
		var node_y;
		$('table.composition').each(function(index_new){
			node=$(this).parent().offset();
			node_x=node.left+Edit_ar[0]+'px';
			node_y=node.top+Edit_ar[1]+'px';
			$(this).parent().css('left',node_x);
			$(this).parent().css('top',node_y);
		});
		$('canvas.composition_show').each(function(index_new){
			var point_id=$(this).attr('id').split("_");
			//$('div#'+point_id[0]).find('img.handle').hide();
			//$('div#'+point_id[1]).find('img.handle').hide();
			var point0=$('#Edit').children('div#'+point_id[0]).offset();
			var point1=$('#Edit').children('div#'+point_id[1]).offset();
			x[0]=point0.left;
			y[0]=point0.top;
			x[1]=point1.left;
			y[1]=point1.top;
			drowline(x,y,point_id);
		})			
	}

	function drowline(x,y,point_id){
		var obj = {
		  strokeStyle: "#000",
		  strokeWidth: 2,
		  rounded: true
		};
		if(x[0] > x[1]){
			tmp_x=x[0];x[0]=x[1];x[1]=tmp_x;
			tmp_y=y[0];y[0]=y[1];y[1]=tmp_y;
			//tmp_id=point_id[0];point_id[0]=point_id[1];point_id[1]=tmp_id;
		}
		var line_startX;
		var line_startY;
		(x[0] > x[1])?line_startX=x[1]+75.5:line_startX=x[0]+75.5;
		(y[0] > y[1])?line_startY=y[1]+77:line_startY=y[0]+77;
		var line_width=Math.abs(x[0]-x[1]);
		var line_height=Math.abs(y[1]-y[0]);
		
		var  canvas_id=point_id[0]+"_"+point_id[1];
		
		obj['x1'] =0;
		obj['y1'] =((y[0] < y[1])?0:line_height);
		obj['x2'] =line_width;
		obj['y2'] =((y[0] < y[1])?line_height:0);
		
		//alert("line_start"+line_start+"line_width"+line_width+"line_height"+line_height);
		var new_canvas="<canvas id='"+canvas_id+"' width='"+line_width+"' height='"+line_height+"' style='top:"+line_startY+"px;left:"+line_startX+"px;position: absolute;'></canvas>";
		$("canvas#"+canvas_id).remove();
		$('#Edit').append(new_canvas);
		$("canvas#"+canvas_id).drawLine(obj);
	}	 
})
function playerReady(obj) {($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}
function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};
function show(obj){
	$("#anchor_time").text(Math.floor(obj.position));
	$("div.antime").css("background-color","");
	$("div."+Math.floor(obj.position)).css("background-color","#FC9");

}
</script>
</body>
</html>
