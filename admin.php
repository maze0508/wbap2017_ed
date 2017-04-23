<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account']){
echo "<script>alert('請先登入帳號');</script>";
echo "<script>document.location.href='index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="m/js/deviceListener.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />

<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
a{text-decoration:none};	
</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['account'])
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
	<!-- start content -->
	<div id="content" style="margin: 20px 0 3% 10%;">
		<div class="post">
		<?php
		if($_SESSION['account']){
			if($_SESSION['compet']==1){
				echo "<script>document.location.href='group_study.php'</script>";
				/*echo '
				<table width="100%">
					<tr align="center">
						<td width="25%"><div style="width:130px"><a href="start_learning_0.php"><img src="images/start128.png">開始學習</a></div></td>
						<td width="25%"><div style="width:130px"></div></td>
						<td width="25%"><div style="width:130px"></div></td>				
						<td width="25%"><div style="width:130px"></div></td>
					</tr>
				</table>';*/
			}
			if($_SESSION['compet']==2){ //老師權限
				echo '<table class="sign" cellspacing="5">';
				
				echo '<tr align="center" >
						<td class="title" style="background-color:#fffab3;"><div>學<br/>習<br/>區</div></td>
						<td class="function" style="background-color:#fffbcd;"><div ><a href="manager_learning_list.php"><img src="images/test/tr-study.png"/><br/>管理學習</a></div></td>
						<td class="function" style="background-color:#ebf4d0;"><div></div></td>
						<td class="function" style="background-color:#fffbcd;"><div ></div></td>				
						<td class="function" style="background-color:#fffbcd;"><div ></div></td>
					</tr>';
				echo '<tr align="center">
						<td class="title" style="background-color:#f2dbe9;"><div>教<br/>材<br/>區</div></td>
						<td class="function" style="background-color:#f3e4ef;"><div><a href="my_books.php"><img src="images/test/tr-myvideo.png"><br/>我的教材</a></div></td>
						<td class="function" style="background-color:#f3e4ef;"><div><a href="team.php"><img src="images/test/tr-group.png"><br/>課堂分組</a></div></td>
						<td class="function" style="background-color:#f3e4ef;"><div><a href="my_learning_list.php"><img src="images/test/tr-manth.png"><br/>管理主題 / 分組關聯</a></div></td>
						<td class="function" style="background-color:#f3e4ef;"><div><a href="books_list.php"><img src="images/test/adm-vanalysis.png"/><br/>教材資源</a></div></td>
					</tr>';
				echo '<tr align="center">
						<td class="title" style="background-color:#dfd7e9;"><div>影<br/>片<br/>區</div></td>
						<td class="function" style="background-color:#dfe0ef;"><div ><a href="upload_media.php"><img src="images/test/tr-addvideo.png"><br/>新增影片</a></div></td>
						<td class="function" style="background-color:#dfe0ef;"><div ><a href="temp_media.php"><img src="images/test/tr-skvideo.png"><br/>影片草稿夾</a></div></td>
						<td class="function" style="background-color:#dfe0ef;"><div ><a href="my_media.php"><img src="images/test/tr-shvideo.png"><br/>已分享影片</a></div></td>				
						<td class="function" style="background-color:#dfe0ef;"><div ><a href="my_favorite.php"><img src="images/test/tr-fav.png"><br/>我的收藏</a></div></td>
					 </tr>';
				
				echo '</table>';
			}
			if($_SESSION['compet']==3){ //管理員
				echo '<table class="sign" cellspacing="5">';
				echo '<tr align="center">
						<td class="title" style="background-color:#ddf0d6;"><div>學<br/>習<br/>管<br/>理</div></td>
						<td class="function" style="background-color:#ebf4d0;"><div><a href="manager_learning_list.php"><img src="images/test/adm-stulearning.png"><br/>學生學習歷程</a></div></td>	
						<td class="function" style="background-color:#ebf4d0;"><div><a href="record.php"><img src="images/test/adm-vanalysis.png"><br/>影片關聯分析</a></div></td>		
						<td class="function" style="background-color:#ebf4d0;"><div></div></td>
						<td class="function" style="background-color:#ebf4d0;"><div></div></td>
					</tr>';	
				echo '<tr align="center">
						<td class="title" style="background-color:#f6d0da;"><div>課<br/>程<br/>管<br/>理</div></td>
						<td class="function" style="background-color:#f7e6cf;"><div><a href="create_course.php"><img src="images/test/adm-estclass.png"><br/>建立課程</a></div></td>
						<td class="function" style="background-color:#f7e6cf;"><div><a href="manger_course.php"><img src="images/test/adm-adclass.png"><br/>課程管理</a></div></td>
						<td class="function" style="background-color:#f7e6cf;"><div><a href="subject.php"><img src="images/test/adm-subject.png"><br/>科目管理</a></div></td>	
						<td class="function" style="background-color:#f7e6cf;"><div></div></td>
					</tr>';	
				echo '<tr align="center">
						<td class="title" style="background-color:#ddf0d6;"><div>影<br/>片<br/>管<br/>理</div></td>
						<td class="function" style="background-color:#ebf4d0;"><div ><a href="upload_media.php"><img src="images/test/tr-addvideo.png"><br/>新增影片</a></div></td>
						<td class="function" style="background-color:#ebf4d0;"><div ><a href="temp_media.php"><img src="images/test/tr-skvideo.png"><br/>影片草稿夾</a></div></td>
						<td class="function" style="background-color:#ebf4d0;"><div ><a href="my_media.php"><img src="images/test/tr-shvideo.png"><br/>已分享影片</a></div></td>				
						<td class="function" style="background-color:#ebf4d0;"><div ><a href=""><img src="images/test/adm-sysvideo.png"><br/>系統影片</a></div></td>
					</tr>';		
				echo '<tr align="center">
						<td class="title" style="background-color:#f6d0da;"><div>帳<br/>號<br/>管<br/>理</div></td>
						<td class="function" style="background-color:#f7e6cf;"><div><a href="upload_teach.php"><img src="images/test/adm-addtr.png"><br/>教師匯入/新增</a></div></td>	
						<td class="function" style="background-color:#f7e6cf;"><div><a href="upload_stue.php"><img src="images/test/adm-addstu.png"><br/>學生匯入/新增</a></div></td>
						<td class="function" style="background-color:#f7e6cf;"><div><a href="manger_data.php"><img src="images/test/adm-adstutr.png"><br/>教師/學生 管理</a></div></td>
						<td class="function" style="background-color:#f7e6cf;"><div></div></td>
					</tr>';
				
				echo '</table>';	
			}
		}else{
			echo "此功能區必須登入才會開放";
		}
		?>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
		<?php
		if(!$_SESSION['account']){
		echo '
			<li>
				<h2>學生註冊</h2>
				<p>
				<form class="cmxform" id="commentForm" method="post" action="php/register.php">
				<input type="hidden" class="required" minlength="1" value="test"  /><p>
                <label>帳號：</label><input type="text" name="account" class="required account" minlength="5"  /><p>
                <label>密碼：</label><input type="password" name="pwd" class="required" minlength="5"  /><p>
                <label>姓名：</label><input type="text" name="name" class="required" minLength="2" /><p>
                <label>學校：</label><input type="text" name="unit" class="required" minlength="3" /><p>
				<label>班級：</label><input type="text" name="iclass" class="required" minlength="3" /><p>
                <label>電子郵件：</label><input type="text" name="email" class="required email"  /><p>
				<input class="submit" type="submit" value="註冊"/>
                </form>
				</p>
			</li>
			<li>
				<h2>Login</h2>
				<ul>
				<form class="cmxform" method="post"  action="php/login.php">
				<label>帳號：</label><input type="text" name="account"  /><p>
                <label>密碼：</label><input type="password" name="pwd"  /><p>
				<input class="submit" type="submit" value="登入"/>
				</form>
				</ul>
			</li>';
		}
		?>
		</ul>
	</div>
    
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer" >
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
$(function(){
	$("#commentForm").validate(); //驗證註冊資料
	
jQuery.validator.addMethod("account", function(value, element) { //
  return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);
}, "用戶名只能包括中文字、英文字母、數字和下劃線");

});
</script>
</body>
</html>
