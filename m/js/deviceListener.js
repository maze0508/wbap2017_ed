// JavaScript Document
//判斷目前裝置是否為手機，若是則跳到行動版網址
var urlPath ='index';
var urlHref = location.href;
var urlHrefArray = urlHref.split("/"); //抓取檔名
// 如果是手機端訪問首頁， 跳至行動手機版網頁
var arrUrl_webgolds = ['index','post'];  // 緩存頁面做跳轉
for(i in arrUrl_webgolds) {
  if(arrUrl_webgolds[i] == urlPath) {
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
			  urlPath = urlHref.split(urlHrefArray[4]); //抓取前面的網址
			  urlHref = urlPath[0]+ "m/" + urlHrefArray[4]; 
			  window.location = urlHref; //轉址
			  break;
    }
  }
}