<?php
session_start();

unset($_SESSION['account']);
unset($_SESSION['member_id']);
unset($_SESSION['compet']);
unset($_SESSION['name']);
ini_set('default_charset','utf-8');
echo "<script>alert('已登出')</script>";
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
				document.location.href='../index.php';
				}
			  }
			}</script>"; 
?>