<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Video Learning</title>

<link href="css/mobile_css.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<style>
#login{
	width: 100%;
	height: 400px;
	margin-top: 100px;
	text-align: center;
	vertical-align: middle;
	background-image: url(../images/login1.jpg);
	background-repeat: no-repeat;
	display:table;
}
#login_form{
	width: 100%;
	height: 200px;
	text-align: center;
	vertical-align: middle;
	margin-right: 20px;
	margin-left: 20px;
	display:table-cell;
}
#login label{
	font-family:"微軟正黑體";
	color:#369;
}
</style>

</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>

</div>
<div id="page">
  <div id="content">
	<div id="login">
                  <form  method="post" id="login_form" action="../php/login.php">
                      <label>帳號：</label><input type="text" name="account"/><p>
                      <label>密碼：</label><input type="password" name="pwd"/><p>
                      <input class="submit" type="submit" style="background-image:url(../images/login_btn.jpg);width:90px; height:30px;" value=" "/>
                  </form>
            </div>
  </div>
</div>
  
</body>
</html>