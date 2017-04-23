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
<link href="css/demo_page.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/demo_table.css" rel="stylesheet" type="text/css" media="screen" />
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
<div id="page">
	<!-- start content -->
	<div id="content" style="width:100%">
		<div class="Tit"><img src="images/test/pic-Tit.png"/>教師/學生管理</div><br/><br/>
		<center><img src="images/test/adm-adstutr2.png"/></center>
		<div class="post">

			<p>
			<div class="entry" style="border:1px solid">		
			<br>
			<table id="example" cellpadding="0" cellspacing="0" border="0" class="display" >
			<thead>
				<tr>
				    <th width="5%"><img src="images/check.png" id="all" title="全選/取消"></th>
				    <th width="10%">身份</th>
					<th width="10%">帳號</th>
					<th width="10%">密碼</th>
					<th width="10%">姓名</th>
					<th width="10%">單位</th>
					<th width="10%">班級</th>
					<th>信箱</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="8"  class="dataTables_empty">資料讀取中...</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8">
						●<input type="button" id="del" value="刪除"> 
					</td>
				</tr>
			</tfoot>
		</table>	
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
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$('#example').dataTable( {
	"bProcessing": true,
	"bServerSide": true,
	"sAjaxSource": "php/manger_user.php",
	"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			$('td:eq(0)', nRow).html(
			"<input type='checkbox' class='checkbox' value='"+aData[0]+"'>|<img title='儲存' name='"+aData[0]+"' id='save' style='cursor:pointer' src='images/table_save.png'>|<img src='images/unlock16.png' class='unlock' style='cursor:pointer' title='編輯此列'>");
		if ( aData[1] == "1" ){
			$('td:eq(1)', nRow).html( '學生' );
		}else if(aData[1] == "2")
			$('td:eq(1)', nRow).html( '老師' );
		else{
			$(nRow).hide();	//如果是admin就hide	
		}
			$('td:eq(2)', nRow).html("<input type='text' class='edit' size='7' disabled value='"+aData[2]+"'>");
			$('td:eq(3)', nRow).html("<input type='text' class='edit' size='10' disabled value='"+aData[3]+"'>");
			$('td:eq(4)', nRow).html("<input type='text' class='edit' size='7' disabled value='"+aData[4]+"'>");
			$('td:eq(5)', nRow).html("<input type='text' class='edit' size='10' disabled value='"+aData[5]+"'>");
			$('td:eq(6)', nRow).html("<input type='text' class='edit' size='10' disabled value='"+aData[6]+"'>");
			$('td:eq(7)', nRow).html("<input type='text' class='edit' disabled value='"+aData[7]+"'>");
		return nRow;},
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 1, "desc" ]], //預設排序，數字代表欄位
		"aoColumns": [{ "bSearchable": false,"bSortable": false,"sWidth": "100px"},null,null,null,null,null,null,null],
		//逗號之間區隔顯示隱藏欄位，bSearchable是說該欄位能否被搜尋到
} )

$("#addteam").click(function(){
	$.post("php/insert_team.php",{team_name:$("#team_name").val(),},function(data) {
		alert('資料已更新完成');
		location.reload();
	});
})


$("#all").toggle(function(){
$("input[type=checkbox].checkbox").attr("checked", true);
},function(){
$("input[type=checkbox].checkbox").attr("checked", false);
})

$("#del").live("click",function(){
if (confirm("你確定要刪除此筆資料?") ){
var members = $('input[type=checkbox].checkbox:checked').map(function(i,n) {return $(n).attr('value');}).get(); //get converts it to an array
if(members.length == 0) {alert('請勾選方塊'); return false;}
$.post("php/del_user.php",{'member_id[]':members},function(data) {alert("該會員已刪除");location.reload();}); 
}
})

//$("input[type=text].edit").live("click",function(){$(this).attr("disabled", false)});

$("#save").live("click",function(){
var stat = $(this).parent().nextAll();
var account = stat.eq(1).children("input[type=text].edit").val();
var pwd = stat.eq(2).children("input[type=text].edit").val();
var name = stat.eq(3).children("input[type=text].edit").val();
var unit = stat.eq(4).children("input[type=text].edit").val();
var iclass = stat.eq(5).children("input[type=text].edit").val();
var email = stat.eq(6).children("input[type=text].edit").val();
if (confirm("更新此列資料?") ){
	$.post("php/update_user.php",{member_id:$(this).attr("name"),account:account,pwd:pwd,name:name,unit:unit,iclass:iclass,email:email},function(data) {
		alert('資料已更新完成');
		stat.find("input[type=text].edit").attr("disabled", true);
	});
}
})

$("img.unlock").live("click",function(){
$(this).parent().nextAll().children("input[type=text].edit").removeAttr("disabled")
});


});

</script>
</body>
</html>
