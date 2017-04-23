<!--此為我的學習主題頁面-->
<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<link rel="stylesheet" href="../css/jquery.jOrgChart.css"/>
<link rel="stylesheet" href="../css/custom.css"/>
<link href="../css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/prettify.js"></script>
<script src="../js/jquery.jOrgChart.js"></script>
<link href='css/mobile_css.css' rel='stylesheet' type='text/css' media='screen'/>


<script type="text/javascript">
$(document).ready(function() {
    $(".menu").click(function() {
        $(this).toggleClass("active");
        $(".nav").slideToggle();
    });
    $(".nav > ul > li:has(ul) > a").append('<div class="arrow-bottom"></div>');
});
</script>


</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
        include_once("../php/root.php");
        if($_SESSION['account']){
			include_once("php/banner_s.php");
		 }
?>
</div>
<div id="page">
  <div id="content">
<img  style="width:20px;" src="../images/test/pic-Tit.png"/>
<label style="color:#69F">筆記本</label>
	<div id='compos_book' style="width:100%">
		<?php
            echo"<select id='compos_book_select' style='width:50%;'>
				<option value='change'>請選擇章節</option>";
            $query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$member_id'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $compos_book_id = $row['compos_book_id'];
                $compos_book_name = $row['compos_book_name'];
                echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
            }
            echo"</select>";?>		
    </div>         
    <div id='show_book' style="width:100%;">
	</div>
  </div>
</div>

<script type="text/javascript" src="js/jcanvas.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";

$(function(){
	$('#compos_book_select').live("change", function(){
		var book_name=$('select#compos_book_select :selected').text();
	
		
		var compos_book_id=$(this).val();
		$.post("php/composition_show2.php",{compos_book_id:compos_book_id,member_id:member_id},
			function(data) {
				$('#show_book').html(data);
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
});
</script>

</body>
</html>