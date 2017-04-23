<?php session_start();
$member_id = $_SESSION['member_id'];
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$team_id = mysql_escape_string($_GET['team_id']);
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

</style>
</head>
<body>
<div id="logo">
	<?php
	include_once("group_banner.php");
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
<div id="page">
	<!-- start sidebar -->
	<div id="sidebarC" style='margin-right:0px;'>
	
	<div id='Allclass'>
	<div class='Class' id=''><table cellspacing="0">
	<tr>
		<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url(images/test/stu-red.png);padding-right: 0px;padding-left: 0px;'></td>
		<td style='width:215px;background-color:#f6dfe1;'><div id='all_class' class='this_go_class'>All</div></td>
		<td style='width:16px;background-color:#f6dfe1;'><div></div>
		<div></div></td>
	</tr>
	</table></div></div>
	<div id='other_class' style="float: left;">
	
	
	<?php
		$sum=1;	
		$query="SELECT member.name, group_class .group_class_id, group_class .anchor_class_name
				FROM member
				LEFT JOIN group_class ON member.member_id = group_class .member_id
				WHERE user_media_id ='$user_media_id'
				AND group_class.team_id = '$team_id'
				AND group_class .type =  '0'
				ORDER BY group_class .group_class_id
				";
		//$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id' AND anchor_class.type ='0' ORDER BY anchor_class.anchor_class_id ";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
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
		
		$anchor_class_id = $row['group_class_id'];
		$anchor_class_name = $row['anchor_class_name'];
		echo "<div class='Class' id='$group_class_id'><table cellspacing='0'>
					<tr>
						<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url($bg_img);padding-right: 0px;padding-left: 0px;'></td>
						<td class='class_name' style='width:215px;background-color:$bg_color;'>
							<div id='$group_class_id' class='go_class'>$anchor_class_name</div>
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
	<p style="margin-left: 15px;"><input type="text" id="class_name"  size="20" maxlength="6" value="" />
				<button id="add_class">新增</button>
	</p>
	<p> </p>
	
	<a style='text-decoration: none;' href='start_learning_arrange.php?&team_id=<?php print $team_id; ?>'><img style="margin-left: 80px;"src="images/test/stu-Integration3.png" /><br/><!-- 統整 --></a>
	</div>
	
	<!-- end sidebar -->
	<!-- start content -->
	<div id="contentC" style='background-color:#f6dfe1;margin-left:0px;'>
	<?php
		//$anchor_class_id="";
		
		$query="SELECT member.name, media_anchor.media_anchor_id, media_anchor.anchor_descript, media_anchor.noteColor, media_anchor.anchor_time, group_class.group_class_id, group_class.anchor_class_name
				FROM member
				LEFT JOIN team_member ON member.member_id = team_member.member_id
				LEFT JOIN media_anchor ON member.member_id = media_anchor.member_id
				LEFT JOIN group_class ON media_anchor.anchor_class_id = group_class.group_class_id
				WHERE media_anchor.user_media_id ='$user_media_id'
				AND team_member.team_id ='$team_id'
				ORDER BY media_anchor.anchor_time
				";
		
		//$query="select member.name,media_anchor.media_anchor_id,media_anchor.anchor_descript,media_anchor.noteColor,media_anchor.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_anchor on member.member_id =  media_anchor.member_id LEFT JOIN anchor_class ON media_anchor.anchor_class_id= anchor_class.anchor_class_id where media_anchor.user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  order by media_anchor.anchor_time";
		$result = $mysqli->query($query);
		
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		
		
			$group_class_id = $row['group_class_id'];
			$name = $row['name'];
			$anchor_descript = $row['anchor_descript'];
			$media_anchor_id = $row['media_anchor_id'];
			$noteColor = $row['noteColor'];
			$id = $media_anchor_id."_".$member_id;
			if($row['group_class_id']){
			
			$class_name = $row['group_class_id'];
			
			
			}else{
			$class_name = "未分類";
			
			}
			if($noteColor==0){ //黃底註記
			
				echo "<div id='$media_anchor_id' class='Note' name='未分類'>
					<div name='$class_name' class='select_edit'><table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$class_name</div><td style='width:16px;'><td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<div class='note_descript'>$anchor_descript (by $name) </div>
						
					</div>
				</div>";
				
			}else{//藍底註記
				echo "<div id='$media_anchor_id' class='Note_other' name='未分類'>
					<div name='$class_name' class='select_edit'><table><tr><td style='width:135px;'><div name='$group_class_id' class='select_class' >$class_name</div><td style='width:16px;'><img id='del_note' style='width:16px;'src='./images/cancel.png';></img><td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<div class='descript'>$anchor_descript (by $name)</div>
						<div id='descript_textarea' style='display:none;'><textarea class='descript' cols='15' rows='6' maxlength='200'>$anchor_descript</textarea><button id='note_change'>確定</button><button id='note_cancel'>取消</button></div>
					</div>
				</div>";
				}
		}
		echo "<div id='all_class' class='Note_other' name='未分類'>
				<div><div>新增註記</div></div>
				<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
					<div><textarea class='descript_new' cols='15' rows='6' maxlength='200'></textarea><button id='add_note'>新增</button></div>
				</div>
			</div>";
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
<script type="text/javascript" src="js/jquery.jeditable.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var team_id = "<?php print $team_id; ?>";
var user_media_id = "<?php print $user_media_id; ?>";





$(function(){  
//新增註記
$("#add_note").live("click",function(){
	var anchor_descript=$(this).siblings('textarea.descript_new').val();
	var group_class_id=$(this).parents('div.Note_other').attr('id');

	
	if(member_id.length>=1){
		$.post("php/group_class_note.php",{member_id:member_id,user_media_id:user_media_id,team_id:team_id,group_class_id:group_class_id,anchor_descript:anchor_descript}
		,function(data) {
			action='新增額外文字註記-'+anchor_descript;
			record(member_id,action);
			 $("#contentC").html(data); 
			 $("#descript_new").val('')
		});
	}else
		alert("請先登入");
})
//刪除註記
$("#del_note").live("click",function(){

	var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
	var anchor_descript=$(this).parents('[class*=Note]').find('div.descript').text();

	$.post("php/delete_anchor.php",{member_id:member_id,user_media_id:user_media_id,media_anchor_id:media_anchor_id},	
		function(data) {});
		action='刪除額外文字註記-'+anchor_descript;
		record(member_id,action);
		$(this).parents('[class*=Note]').remove();

})
 $('div.descript').live("click",function(){
	$(this).hide();
	$(this).siblings('#descript_textarea').show();
	
})
 $('button#note_change').live("click",function(){
	
	var button="note";
	var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
	var descript_old=$(this).parent().siblings('div.descript').text();
	var anchor_descript_new=$(this).siblings('textarea.descript').val();
	action='編輯額外文字註記-「'+descript_old+'」改成「'+anchor_descript_new+'」';
	record(member_id,action);
	
	$.post("php/group_note_edit.php",{button:button,member_id:member_id,user_media_id:user_media_id,media_anchor_id:media_anchor_id,anchor_descript_new:anchor_descript_new},
	
		function(data) {
		var anchor_id="div#"+media_anchor_id+" .descript_edit";
		$(anchor_id).html(data);});
	
})
 $('button#note_cancel').live("click",function(){

	var descript_old=$(this).parent().siblings('div.descript').text();
	//alert(descript_old);
	$(this).siblings('textarea.descript').val(descript_old);
	$(this).parent().hide();
	$(this).parent().siblings('div.descript').show();
})


 $('div.select_class').live("click",function(){
	var group_class_id=$(this).attr("name");
	//alert(anchor_class_id);
	var anchor_class_name=$(this).parents('div.select_edit').attr("name");
	//alert(anchor_class_name);
	var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
	//alert(media_anchor_id);

	$.post("php/group_class_select.php",{member_id:member_id,user_media_id:user_media_id,group_class_id:group_class_id,anchor_class_name:anchor_class_name},
	
		function(data) {
		var anchor_id="div#"+media_anchor_id+" .select_edit";
		//alert(anchor_id);
		$(anchor_id).html(data);});
})
 $('button#select_change').live("click",function(){
	var select_val=$(this).siblings('select').attr("value");
	var select_text=$(this).siblings('select').find("option:selected").text();
	var class_name=$(this).parents('[class*=Note]').attr("name");
	var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
	var note_type=$(this).parents('[class*=Note]').attr("class");
	var note_descript=$(this).parents('[class*=Note]').find('div.descript_edit').children('div').text();
	alert(note_descript);
	action='編輯文字註記分類-在類別「'+select_text+'」加入此註記「'+note_descript+'」';
	record(member_id,action);
	if(class_name=="未分類"){
		$.post("php/group_class_select.php",{note_type:note_type,button:"class_change",member_id:member_id,user_media_id:user_media_id,group_class_id:select_val,anchor_class_name:select_text,media_anchor_id:media_anchor_id},
	
			function(data) {
				var anchor_id="div#"+media_anchor_id+" .select_edit";
				//alert(anchor_id);
				$(anchor_id).html(data);});
			
	}else{
	
		$.post("php/group_class_select.php",{note_type:note_type,button:"class_change",member_id:member_id,user_media_id:user_media_id,group_class_id:select_val,anchor_class_name:select_text,media_anchor_id:media_anchor_id},
	
			function(data) {
				var anchor_id="div#"+media_anchor_id+" .select_edit";
				//alert(anchor_id);
				$(anchor_id).html(data);});
			if(select_text!=class_name){
			$(this).parents('[class*=Note]').remove();
			}
	
	}

})
 $('button#select_canncel').live("click",function(){
	var select_val=$(this).siblings('button#select_change').attr("name");
	var select_text=$(this).attr("name");
	var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
	var note_type=$(this).parents('[class*=Note]').attr("class");
	//alert(select_text);
	$.post("php/group_class_select.php",{note_type:note_type,button:"canncel",member_id:member_id,user_media_id:user_media_id,group_class_id:select_val,anchor_class_name:select_text,media_anchor_id:media_anchor_id},
	
		function(data) {
			var anchor_id="div#"+media_anchor_id+" .select_edit";
			//alert(anchor_id);
			$(anchor_id).html(data);});

	

})
/*$("div.go_class").live("click",function(){
	var anchor_class_id=$(this).attr("id");
	var bg_color=$(this).parent('td').css('background-color');
	$.post("php/class_go.php",{member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		function(data) {
			$("#contentC").css('background-color',bg_color);
			$("#contentC").html(data);});

})*/
$("div.go_class").live({
	click:
		function(){
			var group_class_id=$(this).attr("id");
			var this_bg_color=$(this).parent('td').css('background-color');
			var bg_color=$("div.this_go_class").parent().css('background-color');
			bg_color=rgb2hex(bg_color);
			bg_color=colorch(bg_color);
			$("div.this_go_class").parent().css('background-color',bg_color);
			$("div.this_go_class").parent().next('td').css('background-color',bg_color);
			$("div.this_go_class").attr('class','go_class');
			$(this).attr('class','this_go_class');
			$.post("php/group_class_go.php",{member_id:member_id,user_media_id:user_media_id,group_class_id:group_class_id},
				function(data) {
					$("#contentC").css('background-color',this_bg_color);
					$("#contentC").html(data);});

		},
	mouseenter:
		function(){
			var anchor_class_id="div.go_class#"+$(this).attr("id");
			//alert(anchor_class_id);
			var bg_color=$(this).parent().css('background-color');
			bg_color=rgb2hex(bg_color);
			bg_color=colorch(bg_color);
			$(this).parent().css('background-color',bg_color);
			$(this).parent().next('td').css('background-color',bg_color);
		},
	mouseleave:
		function(){
			var anchor_class_id="div#"+$(this).attr("id");
			var bg_color=$(this).parent().css('background-color');
			bg_color=rgb2hex(bg_color);
			bg_color=colorch(bg_color);
			$(this).parent().css('background-color',bg_color);
			$(this).parent().next('td').css('background-color',bg_color);
		}
});
function colorch(bg_color) {
	switch(bg_color){
	case "#f4b4b9":
		return '#f6dfe1';
		break;
	case "#f7dcae":
		return '#f7efdf';
		break;
	case "#cef5b8":
		return '#eef3e2';
		break;
	case "#bae3f5":
		return '#dfeff7';
		break;
	case "#e0c8dd":
		return '#f2ecf1';
		break;
	//---
	case "#f6dfe1":
		return '#f4b4b9';
		break;
	case "#f7efdf":
		return '#f7dcae';
		break;
	case "#eef3e2":
		return '#cef5b8';
		break;
	case "#dfeff7":
		return '#bae3f5';
		break;
	case "#f2ecf1":
		return '#e0c8dd';
		break;
	}

}
function rgb2hex(rgb) {
 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
 function hex(x) {
  return ("0" + parseInt(x).toString(16)).slice(-2);
 }
 return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
//新增分類
$("#add_class").live("click",function(){
	if(member_id.length>=1){
		$.post("php/group_class_add.php",{member_id:member_id,user_media_id:user_media_id,team_id:team_id,anchor_class_name:$("#class_name").val()}
		,function(data) {
			action='新增文字註記類別-'+$("#class_name").val();
			record(member_id,action);
			 $("#other_class").html(data); 
			 $("#class_name").val('');
		});
	}else
		alert("請先登入");
})
//刪除分類
$("#del_class").live("click",function(){

	var class_name=$(this).parents('div.Class').find('td.class_name').children('[class*=go_class]').text();
	var anchor_class_id=$(this).parents("div.Class").attr("id");
	//alert(anchor_class_id);
	$.post("php/class_del.php",{member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		function(data) {
		action='刪除文字註記類別-'+class_name;
		record(member_id,action);
		$("div#Allclass").find('td:nth(1)').css('background-color','#f6dfe1');
		$("div#Allclass").find('td:nth(2)').css('background-color','#f6dfe1');
		$("div#Allclass").find('div.go_class').attr('class','this_go_class');
		$("#contentC").css('background-color','#f6dfe1');
		$("#contentC").html(data);});
		
		$(this).parents("div.Class").remove();

})

 $('img#edit_class').live("click",function(){

 	$(this).parents('.Class').find('div[class*=go_class]').hide();
	$(this).parents('.Class').find('div#class_textarea').show();

})
 $('button#class_change').live("click",function(){
	var button="class";
	var anchor_class_id=$(this).parents("div.Class").attr("id");
	var class_name_new=$(this).siblings('input#class_name_new').val();
	var class_name_old=$(this).parents('td.class_name').children('[class*=go_class]').text();
	var anchor_id="div.Class#"+anchor_class_id;
	action='修改文字註記類別名稱-「'+class_name_old+'」改成「'+class_name_new+'」';
	record(member_id,action);
	//alert(class_name_new);
	$.post("php/note_edit.php",{button:button,member_id:member_id,user_media_id:user_media_id,media_anchor_id:anchor_class_id,anchor_descript_new:class_name_new},
		
		function(data) {

		$(anchor_id).find('td.class_name').html(data);});
		
	$.post("php/class_go.php",{member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
	
		function(data) {
		$("#contentC").html(data);
		var bg_color=$("div.this_go_class").parent().css('background-color');
		bg_color=rgb2hex(bg_color);
		bg_color=colorch(bg_color);
		$("div.this_go_class").parent().css('background-color',bg_color);
		$("div.this_go_class").parent().next('td').css('background-color',bg_color);
		$("div.this_go_class").attr('class','go_class');
		
		$('div#'+anchor_class_id).find('.go_class').attr('class','this_go_class');
		bg_color=$("div.this_go_class").parent().css('background-color');
		bg_color=rgb2hex(bg_color);
		bg_color=colorch(bg_color);
		$("div.this_go_class").parent().css('background-color',bg_color);
		$("div.this_go_class").parent().next('td').css('background-color',bg_color);
	
		$("#contentC").css('background-color',bg_color)
		});

})
 $('button#class_cancel').live("click",function(){

	var class_name_old=$(this).parent().siblings('div.go_class').text();
	//alert(class_name_old);
	$(this).siblings('input#class_name_new').val(class_name_old);
	$(this).parent().hide();
	$(this).parent().siblings('[class*=go_class]').show();
})



})
function record(member_id,action){
	$.post("php/record.php",{member_id:member_id,action:action},function(data) {
	});
}
</script>
</body>
</html>
