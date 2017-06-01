<?php session_start();
include_once("php/root.php");
$member_id = $_SESSION['member_id'];
$user_media_id = mysql_escape_string($_GET['user_media_id']);
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
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
border:1px solid #666;
padding:3px;
text-align: center;
}
#del_class{
float:right;
}
#uploadify{
width:110px;
height:30px;
color:#FFFFFF;
background-color:#555555;
border-style:none;
font-weight:bold;

}
#cboxLoadedContent{
background:#000000;
}
</style>
</head>
<body>
<div id="logo">

	<?php
	if($_SESSION['account']){
	include_once("banner_stu.php");
	
	}else{
		echo "<h2><input type='button' class='colorbox' style='background-image: url(images/login_btn.jpg);width:90px; height:30px;'/></h2>";
	}
	?>	
</div>
<!-- start page -->
<div id="page">
        <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="index.php" title="個人書房">個人書房</a> >> <a href="#" title="註記分類">註記分類</a></div><br/><br/>
	<!-- start sidebar -->
	<div id="sidebarC" style='margin-right:0px;'>
	
	
	<div class='Class' id=''><table cellspacing="0" border="0" style="font-family: '微軟正黑體'; color: #BF6062;">
	<tr>
		<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url(images/test/stu-red.png);padding-right: 0px;padding-left: 0px;'></td>
		<td style='width:215px;background-color:#f6dfe1;'><div id='all_class' class='go_class'>全部註記</div></td>
		<td style='width:16px;background-color:#f6dfe1;'><div></div>
		<div></div></td>
	</tr>
	</table></div>
	<div id='other_class'>
	<?php
		$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE anchor_class.member_id ='$member_id' AND anchor_class.type ='0' ORDER BY anchor_class.anchor_class_id ";
		$result = $mysqli->query($query);
		$sum=1;	
		while($row = $result->fetch_array(MYSQL_ASSOC)){

		$anchor_class_id = $row['anchor_class_id'];
		$anchor_class_name = $row['anchor_class_name'];
		
		$an=$sum%5;
		
		if($an==0){
			$bg_img='images/test/stu-red.png';
			$bg_color='#f4b4b9';}
		if($an==1){
			$bg_img='images/test/stu-oran.png';
			$bg_color='#f7dcae';}
		if($an==2){
			$bg_img='images/test/stu-green.png';
			$bg_color='#cef5b8';}
		if($an==3){
			$bg_img='images/test/stu-blue.png';
			$bg_color='#bae3f5';}
		if($an==4){
			$bg_img='images/test/stu-pur.png';
			$bg_color='#e0c8dd';}
		
		//echo "<div id='$anchor_class_id' class='Class'>$anchor_class_name<button id='del_class'>d</button></div>";
		echo "<div class='Class' id='$anchor_class_id'><table cellspacing='0'>
					<tr>
						<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url($bg_img);padding-right: 0px;padding-left: 0px;'></td>
						<td class='class_name' style='width:215px;background-color:$bg_color;'>
							<div id='$anchor_class_id' class='go_class'>$anchor_class_name</div>
							<div id='class_textarea'style='display:none;'><input type='text' id='class_name_new'  size='10' maxlength='6' value='$anchor_class_name' /><button id='class_change'>確定</button><button id='class_cancel'>取消</button></div>
						</td>
						<td style='width:16px;background-color:$bg_color;'>
							<div><img id='del_class' style='width:16px;'src='./images/cancel.png';></img></div>
							<div><img id='edit_class' style='width:16px;'src='./images/tag_blue_add.png';></img></div>
						</td>
					</tr>
					</table></div>";
		$sum++;			
		}
	?>
	</div>
	<p style="margin-left: 15px;margin-top: 0px;"><input type="text" id="class_name"  size="20" maxlength="50" value="" />
				<button id="add_class">新增分類</button>
	</p>
	</div>

	<!-- end sidebar -->
	<!-- start content -->
	<div id="contentC" style='background-color: #f6dfe1; margin-left: 0px; width: 70%; height: 250px;'>
	<?php
		//$anchor_class_id="";
		echo"<div id='' class='class_anchor'>";
		$query="select member.name,media_anchor_image.media_anchor_image_id,media_anchor_image.image,media_anchor_image.anchor_descript,media_anchor_image.noteColor,media_anchor_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor_image on member.member_id =  media_anchor_image.member_id LEFT JOIN anchor_class ON media_anchor_image.anchor_class_id= anchor_class.anchor_class_id where media_anchor_image.user_media_id = '$user_media_id' AND media_anchor_image.member_id = '$member_id'  order by media_anchor_image.anchor_time";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$anchor_class_id = $row['anchor_class_id'];
			$name = $row['name'];
			if($row['image']){
				$image = $row['image'];
			}else {
				$image = null;	
			}
			$media_anchor_image_id = $row['media_anchor_image_id'];
			$anchor_descript = $row['anchor_descript'];
			$noteColor = $row['noteColor'];
			if($row['anchor_class_id']){
				$class_name = $row['anchor_class_name'];
			}else{
				$class_name = "未分類";
			}
				echo "<div id='$media_anchor_image_id' class='Note_other' name='未分類'>
					<div name='$class_name' class='select_edit'>
						<table>
							<tr>
								<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
								<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
								<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
							</tr>
						</table>
					</div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_image_id' class='descript_edit'>
						";
						if($image!=null){
							/*$enc = mb_detect_encoding($image);
							$data = mb_convert_encoding($image, "ASCII", $enc);
							$data = substr($data,1);
							echo "<p><img class='note_descript' style='width:50%;height:50%;' src='./images/anchor/".$data."'/></p>";
							*/
							echo "<p><img class='note_descript' style='width:50%;height:50%;' src='./images/anchor/".$image."'/></p>";
						}
						echo"<p>$anchor_descript</p></div>
				</div>";
		}
		echo"<div id='all_class' class='Note_other' name='未分類'>
		<div><div>新增註記</div></div>
			<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
			<div class='entry'>
				<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
					<div><textarea class='descript_new' cols='18' rows='4' maxlength='200'></textarea>
					</div>
				</div>
				<div id='Queue'  style='display:hidden;'></div>
				<div id='filesUploaded'  style='display:hidden;'></div>
				<div style='text-align:top;float:left;width:100%;'>
				<button type='button' name='uploadify' id='uploadify'>Browser</button>
				<input type='button' id='add_note'  style='background-image:url(images/add_note.jpg);width:30px; height: 30px; border: 0; background-size: 100%;margin-left:80%; cursor:pointer;'/>
				</div>
			</div>
			</div>
			</div>
		
	</div>";
	echo "</div>";
	?>
</div>	
				
		
	
	<!-- end content -->
</div>
<!-- end page -->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>

<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $_SESSION['user_media_id']; ?>";
var image_id = null ;
//var edit_media_anchor_image_id;

$(function(){  
$("#add_note").live("click",function(){
	var anchor_descript =$('textarea.descript_new').val();
	if(image_id=="image"){//若有圖片，觸發上傳
		$('#uploadify').uploadifyUpload();
	}else{//若無圖片，僅上傳文字
		if(member_id.length>=1){
			$.post("php/class_note.php",{member_id:member_id,user_media_id:user_media_id,anchor_descript:anchor_descript}
			,function(data) {
				 $("#contentC").html(data); 
				 $(".descript_new").val('');
			});
		}else
		alert("請先登入");
	}
	//var anchor_descript=$(this).siblings('textarea.descript_new').val();
	//var anchor_class_id=$(this).parents('div.Note_other').attr('id');
	/*if(member_id.length>=1){
			$.post("php/class_note.php",{image_id:image_id,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id,anchor_descript:anchor_descript}
			,function(data) {
				 $("#contentC").html(data); 
				 $(".descript_new").val('');
				 image_id = null;
			});
	}else
		alert("請先登入");*/
})
$("#del_note").live("click",function(){

	var media_anchor_image_id=$(this).parents('[class*=Note]').attr("id");
	var anchor_descript=$(this).parents('[class*=Note]').find('div.descript').text();

	$.post("php/delete_anchor.php",{member_id:member_id,user_media_id:user_media_id,media_anchor_image_id:media_anchor_image_id},	
		function(data) {});
		
		$(this).parents('[class*=Note]').remove();

})

$("#uploadify").live("click",function(){
	
var now=<?php echo time()?>;
image_id = "image";
$(this).uploadify({
		'buttonText'	 : 'Browser',
		'uploader'       : 'swf/uploadify.swf',
		'script'         : 'uploadimg.php',
		'cancelImg'      : './images/cancel.png',
		'queueID'        : 'Queue',
		'sizeLimit'		 : '1048576',	//8925684--8.8MB
		'fileExt'  		 : '*.jpg;',
		'scriptData'	 : {'now':now},    //這行是可以帶value到後端，但會有亂碼，所以前面才要base64編碼
		'auto'           : false,
		'multi'          : false,
		'queueSizeLimit' :'5',
		'onSelect'       :function(e, queueId, fileObj){
			if(fileObj.size > 1048576){
				alert(fileObj.name+"檔案太大，限制為1mb");
			$('#uploadify').fileUploadClearQueue(e);
			}
		},
		'onComplete'  :function(e, queueId, fileObj, result){
			var anchor_descript =$('textarea.descript_new').val();
			image_id = now+fileObj.name.substr(-4);
			if(member_id.length>=1){
				$.post("php/class_note.php",{image_id:image_id,member_id:member_id,user_media_id:user_media_id,anchor_descript:anchor_descript}
				,function(data) {
				 $("#contentC").html(data); 
				 $(".descript_new").val('');
				$('#uploadify').fileUploadClearQueue(e);
				 image_id = null;
				});
			}else
				alert("請先登入");
			/*使用這個方法會使圖片出現BOM編碼
			 	image_id = result;*/
		}
});
});


	$("img.del_note").live("click",function(){

		var button_type="image";
		var media_anchor_image_id=$(this).parents('[class*=Note]').attr("id");
		$.post("php/delete_anchor.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,media_anchor_image_id:media_anchor_image_id},
		
			function(data) {});
			
			$(this).parents('[class*=Note]').remove();

	})
	
	$('.edit_button').live("mouseover",function(){
		edit_media_anchor_image_id=$(this).parents('[class*=Note]').attr("id");
		$(this).colorbox({href:"crop.php?media_anchor_image_id="+edit_media_anchor_image_id+"",width:"600", height:"500",iframe:true,slideshow:true});
	})
	
	
	$(document).bind('cbox_closed', function(){
		var edit_note_class_id=$('div.class_anchor').attr('id');
		if(edit_note_class_id==""){
			var anchor_class_id="all_class";
		}else{
			var anchor_class_id=edit_note_class_id;
		}
		//alert(anchor_class_id);
		var button_type="image";
		$.post("php/class_go.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
			function(data) {//alert(data);
			$("#contentC").html(data);});
	});


	 $('div.select_class').live("click",function(){
		var button_type="image";
		var anchor_class_id=$(this).attr("name");
		var anchor_class_name=$(this).parents('div.select_edit').attr("name");
		var media_anchor_image_id=$(this).parents('[class*=Note]').attr("id");

		$.post("php/class_select.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id,anchor_class_name:anchor_class_name},
		
			function(data) {
			var anchor_id="div#"+media_anchor_image_id+" .select_edit";
			$(anchor_id).html(data);
			});
	})

	 $('button#select_change').live("click",function(){
		var button_type="image";
		var select_val=$(this).siblings('select').attr("value");
		var select_text=$(this).siblings('select').find("option:selected").text();
		var class_name=$(this).parents('[class*=Note]').attr("name");
		var media_anchor_image_id=$(this).parents('[class*=Note]').attr("id");
		var note_type=$(this).parents('[class*=Note]').attr("class");
	
		if(class_name=="未分類"){
			$.post("php/class_select.php",{button_type:button_type,note_type:note_type,button:"class_change",member_id:member_id,user_media_id:user_media_id,anchor_class_id:select_val,anchor_class_name:select_text,media_anchor_image_id:media_anchor_image_id},
		
				function(data) {
					var anchor_id="div#"+media_anchor_image_id+" .select_edit";
					$(anchor_id).html(data);});
				
		}else{
		
			$.post("php/class_select.php",{button_type:button_type,note_type:note_type,button:"class_change",member_id:member_id,user_media_id:user_media_id,anchor_class_id:select_val,anchor_class_name:select_text,media_anchor_image_id:media_anchor_image_id},
		
				function(data) {
					var anchor_id="div#"+media_anchor_image_id+" .select_edit";
					$(anchor_id).html(data);});
				if(select_text!=class_name){
				$(this).parents('[class*=Note]').remove();
				}
		
		}

	})
	 $('button#select_canncel').live("click",function(){
		var select_val=$(this).siblings('button#select_change').attr("name");
		var select_text=$(this).attr("name");
		var media_anchor_image_id=$(this).parents('[class*=Note]').attr("id");
		var note_type=$(this).parents('[class*=Note]').attr("class");
		var button_type="image";
		$.post("php/class_select.php",{button_type:button_type,note_type:note_type,button:"canncel",member_id:member_id,user_media_id:user_media_id,anchor_class_id:select_val,anchor_class_name:select_text,media_anchor_image_id:media_anchor_image_id},
		
			function(data) {

				var anchor_id="div#"+media_anchor_image_id+" .select_edit";
				$(anchor_id).html(data);});

		

	})
	
	$("div.go_class").live("click",function(){
		var anchor_class_id=$(this).attr("id");
		var bg_color=$(this).parent('td').css('background-color');
		var button_type="image";
		$.post("php/class_go.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {
			$("#contentC").css('background-color',bg_color);
			$("#contentC").html(data);});

	})

	$("#add_class").live("click",function(){
		var button_type="image";
		if(member_id.length>=1){
			$.post("php/class_add.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_name:$("#class_name").val()}
			,function(data) {
				 $("#other_class").html(data); 
				 $("#class_name").val('')
			});
		}else
			alert("請先登入");
	})

	$("#del_class").live("click",function(){
		
		var button_type="image";
		var anchor_class_id=$(this).parents("div.Class").attr("id");
		var class_name=$(this).parents('div.Class').find('td.class_name').children('[class*=go_class]').text();

		$.post("php/class_del.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {$("#contentC").html(data);});
			
			$(this).parents("div.Class").remove();

	})

	 $('img#edit_class').live("click",function(){

		$(this).parents('.Class').find('div.go_class').hide();
		$(this).parents('.Class').find('div#class_textarea').show();

	})
	 $('button#class_change').live("click",function(){
		var button="class";
		var anchor_class_id=$(this).parents("div.Class").attr("id");
		var class_name_new=$(this).siblings('input#class_name_new').val();
		var class_name_old=$(this).parents('td.class_name').children('[class*=go_class]').text();

		
		$.post("php/note_edit.php",{button:button,member_id:member_id,user_media_id:user_media_id,media_anchor_image_id:anchor_class_id,anchor_descript_new:class_name_new},

			function(data) {
			var anchor_id="div.Class#"+anchor_class_id;
			$(anchor_id).find('td.class_name').html(data);});
			
		$.post("php/class_go.php",{member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {$("#contentC").html(data);});
	});
	
	 $('button#class_cancel').live("click",function(){

		var class_name_old=$(this).parent().siblings('div.go_class').text();
		$(this).siblings('input#class_name_new').val(class_name_old);
		$(this).parent().hide();
		$(this).parent().siblings('div.go_class').show();
	});

	
});

</script>
</body>
</html>
