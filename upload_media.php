<?php session_start();
if(!$_SESSION['account'])
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
<script type="text/javascript" src="m/js/deviceListener.js"></script>

<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style>
a,a:link,a:visited{text-decoration: none}
a:hover{color:#F4AB25;background-color: #FFECD9;text-decoration: none;}
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
	background-size:36%;background-image: url(images/test/tr-addvideo2.png);">
	<!-- start content -->
	<div id="content" >
		<div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="sign.php" title="會員功能">會員功能</a> >> <a href="#" title="新增影片">新增影片</a></div><br/><br/>

		<div class="post">
			<h2 class="title"><a href="#">上傳影片檔案</a></h2>    
			<div class="entry">
				<div id="fileQueue"></div>
				<div id="filesUploaded"></div>
				<div style="text-align:top">
				<input type="file" name="uploadify" id="uploadify" /><br/>
                <p>檔名請勿使用中文!<br/>僅接受 *.mp4、*.ogg、*.webm之檔案格式<br/></p>
				<input type="button" onclick="javascript:$('#uploadify').uploadifyUpload();" value="開始上傳">
				<input type="button" onclick="javascript:$('#uploadify').uploadifyClearQueue()" value="清空佇列">
				</div>
			</div>
			<p class="meta">批次上傳的檔案數上限為[5]</p>
		</div>
        <hr>
		
            <h3>--------------------------------------------------------------------------------------</h3>
            <div class="post">
            <h2 class="title">匯入Youtube影片</h2><br/>
			<div class="entry">
				<form name="insertmedia" method="post" action="php/insert_tube.php">
					<input type="text" id="beurl" name="url" value="請在這裡貼上Youtube影片的網址列" size="50">
					<input type="hidden" name="member_id" value=<?php echo($_SESSION['member_id']); ?>>
					<input type="hidden" name="public_date" value=<?php echo(date("Y-m-d",time())); ?>>
					<button type="submit" value="貼上" name="btn" id="download">貼上</button>
				</form>

			</div>
			<p class="meta">請直接將網址列貼在上方欄位內即可</p>
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
<script type="text/javascript" src="js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$("#uploadify").uploadify({
		'buttonText'	 : 'Browser',
		'uploader'       : 'swf/uploadify.swf',
		'script'         : 'uploadify.php',
		'cancelImg'      : './images/cancel.png',
		'queueID'        : 'fileQueue',
		'sizeLimit'		 : '8925684',	//8925684--8.8MB
		'fileDesc'    	 : '影片檔',
		'fileExt'  		 : '*.mp4;*.webm;*.ogg',
		'scriptData'	 : {'member_id':member_id},    /*這行是可以帶value到後端，但會有亂碼，所以前面才要base64編碼*/
		'auto'           : false,
		'multi'          : true,
		'queueSizeLimit' :'5',
		'onSelect'       :function(e, queueId, fileObj){
		if(fileObj.size > 8925684){
		alert(fileObj.name+"檔案太大，限制為8mb");
		$('#uploadify').fileUploadClearQueue(e);}
		},
		'onAllComplete'  :function(e, queueId, fileObj){
			alert('上傳成功，請至草稿夾發佈');
			window.location = 'uploadify.php';
		}
});
    

$("#download").click(function(){
	//var test = /http:\/\/www.youtube.com/.test($('#beurl').val());
	if($('#beurl').val()=="")
		alert("格式錯誤");
})

})

</script>
</body>
</html>
