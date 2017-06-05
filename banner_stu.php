
<?php
	echo 
	"<ul id='logo1'>
		<li class='first'><a href='index.php' accesskey='1' title=''><img title='回首頁' src='images/logo1.png'/></a></li>
	</ul>
	<ul id='menu2'>
		<li><a href='group_study.php' accesskey='2' title='學習主題'><img id='course_stu' class='logo2' magrin-top=5px src='images/course_stu1.png'/></a></li>
		<li><a href='start_learning_0_3.php' accesskey='2' title='我的收藏'><img id='stu-video' class='logo2' src='images/stu-video1.png'/></a>
		</li>
		<li><a href='start_learning_class.php' accesskey='4' title='註記分類'><img id='stu-cf' class='logo2' src='images/stu-cf1.png'/></a></li>
		<li><a href='start_learning_arrange.php' accesskey='3' title=''><img id='stu-Integration' class='logo2' src='images/stu-Integration1.png'/></a></li>
		<li><a href='learning_books_list.php' accesskey='4' title=''><img id='stu-nbook' class='logo2' src='images/stu-nbook1.png'/></a></li>
		
	</ul>";
	echo"<div id='login'>
		<h2>歡迎光臨_<span id='ald'>".$_SESSION['user_name']."</span>	<a id='logout' href='php/logout.php'><img src='images/logout.png' width='109' height='70'></a></h2>
		</div>";
?>