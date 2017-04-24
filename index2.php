<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
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
<!----background-color:#d4eaf9;---->
<body class="loginbody " style="background-size:100%;background-image: url(images/login1.jpg);background-position:top center;">

	
	<div style=" margin-left: 75px; margin-top: 180px;">
	  <form  class="cmxform" method="post"  action="php/login.php">
		  <label>帳號：</label><input type="text" name="account"/><p>
		  <label>密碼：</label><input type="password" name="pwd"/><p>
		  <input class="submit" type="submit" value="登入"/>
	  </form>
	 
	</div>  

<!-----<center style="position:relative;height:709px; background-image: url(images/login2.png);background-position:center center;margin-top: 15%;">
	
	<div style=" position:absolute; left:50%;top:50%; margin-top:-123px;margin-left:-150px">
	  <form  class="cmxform" method="post"  action="php/login.php">
		  <label>帳號：</label><input type="text" name="account"/><p>
		  <label>密碼：</label><input type="password" name="pwd"/><p>
		  <input class="submit" type="submit" value="登入"/>
	  </form>
	 
	</div>  
</center>----->


<!-- end page -->

</body>
</html>
