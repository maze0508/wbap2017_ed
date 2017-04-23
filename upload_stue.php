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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
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
	background-size:40%;background-image: url(images/test/adm-addstu2.png);">
	<!-- start content -->
	<div id="content">
	<div class="Tit"><img src="images/test/pic-Tit.png"/>學生匯入/新增</div><br/><br/>
		<div class="post">
			<h2 class="title"><a href="#">學生檔案上傳</a></h2>
			<div class="entry">
				<a href="excel_stu.xls">*excel檔案格式_範例下載</a>
				<div id="fileQueue"></div>
				<div id="filesUploaded"></div>
				<div style="text-align:top">
				<input type="file" name="uploadify" id="uploadify" />
				<input type="button" onclick="javascript:$('#uploadify').uploadifyUpload();" value="開始上傳">
				<input type="button" onclick="javascript:$('#uploadify').uploadifyClearQueue()" value="清空佇列">
				</div>
			</div>
			<p class="meta">目前僅支援Office97-2003檔案格式(*.xls)</p>
		</div>
		<div class="post">
			<h2 class="title"><a href="#"></a></h2>
			<div class="entry">
				<h3></h3>
			</div>
			<p class="meta"></p>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<h2 class="title"><a href="#">建立學生檔案</a></h2>
				<form class="cmxform" id="commentForm" method="post" action="php/register.php">
				<input type="hidden" class="required" minlength="1" value="test"  /><p>
                <label>帳號：</label><input type="text" name="account" class="required account" minlength="5"  /><p>
                <label>密碼：</label><input type="password" name="pwd" class="required" minlength="5"  /><p>
                <label>姓名：</label><input type="text" name="name" class="required" minLength="2" /><p>
                <label>學校：</label><input type="text" name="unit" class="required" minlength="3" /><p>
				<label>班級：</label><input type="text" name="iclass" class="required" minlength="3" /><p>
                <label>電子郵件：</label><input type="text" name="email" class="required email"  /><p>
				<input type="hidden" name="addcompet" value="1"  />
				<input class="submit" type="submit" value="註冊"/>
                </form>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
$("#uploadify").uploadify({
		'buttonText'	 : 'Browser',
		'uploader'       : 'swf/uploadify.swf',
		'script'         : 'php/import_excel.php',
		'cancelImg'      : './images/cancel.png',
		'queueID'        : 'fileQueue',
		'fileDesc'    	 : 'excel97-2003',
		'fileExt'  		 : '*.xls',
		'sizeLimit'		 : '8925684',	//8925684--8.8MB
		'scriptData'	 : {'addcompet':'1'},    /*這行是可以帶value到後端，但會有亂碼，所以前面才要base64編碼*/
		'auto'           : false,
		'multi'          : true,
		'queueSizeLimit' :'5',
		'onSelect'       :function(e, queueId, fileObj){
		if(fileObj.size > 8925684){
		alert(fileObj.name+"檔案太大，限制為8mb");
		$('#uploadify').fileUploadClearQueue(e);}
		},
		'onComplete'    :function(event,queueId,fileObj,response,data){
			$("#log").html(response)
		},
		'onAllComplete'  :function(e, queueId, fileObj){
			alert('上傳完成，匯入失敗的使用者將列在下方');
		}
});

	$("#commentForm").validate(); //驗證註冊資料
	
jQuery.validator.addMethod("account", function(value, element) { //
  return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);
}, "用戶名只能包括中文字、英文字母、數字和下劃線");





});

</script>
</body>
</html>
