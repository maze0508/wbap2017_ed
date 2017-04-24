<?php

	echo 
	"<ul id='logo1'>
		<li class='first'><a href='index.php' accesskey='1' title=''><img title='回首頁' src='images/logo1.png'/></a></li>
	</ul>
	<ul id='menu2'>";
	if( $_SESSION['compet']==2 ){//老師
		echo"
	<li><a href='sign.php' accesskey='2' title='會員功能'><img id='add-Personal' class='logo-t' src='images/add-Personal1.png' style='width:80px;height:80px;'/></a></li>
	";
	}else if($_SESSION['compet']==3){//管理者
		echo"
	<li><a href='admin.php' accesskey='3' title='會員功能'><img id='add-Personal' class='logo-t' src='images/add-Personal1.png' style='width:80px;height:80px;'/></a></li>
	";
	}
	echo"</ul>";
	echo"<div id='login'>
		<h2>歡迎光臨_<span id='ald'>".$_SESSION['user_name']."</span>	<a id='logout' href='php/logout.php'><img src='images/logout.png' width='109' height='70'></a></h2>
		</div>";
?>