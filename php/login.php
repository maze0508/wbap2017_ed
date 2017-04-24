<?php
session_start();
include_once("root.php");
$account = mysql_escape_string($_POST['account']);
$pwd = mysql_escape_string($_POST['pwd']);

$query = "SELECT account,member_id,compet,name FROM member WHERE account='$account' && pwd='$pwd' limit 0,1";
$result = $mysqli->query($query);
$rows = $result->fetch_assoc();
$account = $rows['account'];
$member_id = $rows['member_id'];
$compet = $rows['compet'];
$name = $rows['name'];

if($member_id){
$_SESSION['account'] = $account;
$_SESSION['member_id'] = $member_id;
$_SESSION['compet'] = $compet;
$_SESSION['user_name'] = $name;

    echo "<script>alert('登入成功');</script>";
	
 	if($_SESSION['compet'] == 1){
		echo "<script>
				var urlPath ='index';
				var urlHref = location.href;
				var arrUrl_webgolds = ['index','post'];
				for(i in arrUrl_webgolds) {
				  if(arrUrl_webgolds[i] == urlPath) {
					if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
					  urlHref = urlHref.replace(urlPath,'m/'+urlPath);
					  if(location.pathname === '/') {//特殊情況首頁
						urlHref='/m'
					  }
					  urlHref ='../m/group_study.php'; //直接轉到行動版首頁
					  window.location = urlHref; //轉址
					  break;
					 }else{
						parent.location.href='../group_study.php';
					}
				  }}</script>";
	}else if($_SESSION['compet'] == 2){
		echo "<script>
				var urlPath ='index';
				var urlHref = location.href;
				var arrUrl_webgolds = ['index','post'];
				for(i in arrUrl_webgolds) {
				  if(arrUrl_webgolds[i] == urlPath) {
					  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
					  urlHref = urlHref.replace(urlPath,'m/'+urlPath);
					  if(location.pathname === '/') {//特殊情況首頁
						urlHref='/m'
					  }
					  urlHref ='../m/sign.php'; //直接轉到行動版首頁
					  window.location = urlHref; //轉址
					  break;
					  }else{
						parent.location.href='../sign.php';
					}
				  }}</script>";
	}else if($_SESSION['compet'] == 3){
		echo "<script>
				var urlPath ='index';
				var urlHref = location.href;
				var arrUrl_webgolds = ['index','post'];
				for(i in arrUrl_webgolds) {
				  if(arrUrl_webgolds[i] == urlPath) {
					  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
					  urlHref = urlHref.replace(urlPath,'m/'+urlPath);
					  if(location.pathname === '/') {//特殊情況首頁
						urlHref='/m'
					  }
				  urlHref ='../m/admin.php'; //直接轉到行動版首頁
				  window.location = urlHref; //轉址
				  break;
				}else{
					parent.location.href='../admin.php';
					}
				  }}</script>";
	}
}else{
   echo "<script>alert('登入失敗')</script>";
   echo "<script>var urlPath ='index';
			var urlHref = location.href;
			var arrUrl_webgolds = ['index','post'];
			for(i in arrUrl_webgolds) {
			  if(arrUrl_webgolds[i] == urlPath) {
				if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
				  urlHref = urlHref.replace(urlPath,'m/'+urlPath);
				  if(location.pathname === '/') {//特殊情況首頁
					urlHref='/m'
				  }
				  urlHref ='../m/index.php'; //直接轉到行動版首頁
				  window.location = urlHref; //轉址
				  break;
				}else{
				parent.$.colorbox.close();
				}
			  }
			}</script>"; 
}
?>