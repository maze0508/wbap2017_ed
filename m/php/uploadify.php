<!---手機版-->
<?php
include_once('../../php/root.php');
$member_id =$_POST['member_id'];
$now=md5(gmdate('YmdHis', time()));//MD5（現在時間）避免檔名重複
if (!empty($_FILES)) {
	$tempFile = $_FILES['fileField']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . '/wbap2017/user_movie/';
	$targetFile =  rtrim($targetPath,'/') . '/' . $_FILES['fileField']['name'];
	//$targetFile =  str_replace('//','/',$targetPath) . $_FILES['fileField']['name'];
	
	$pos = strrpos($_FILES["fileField"]["name"], ".");
	if ($pos === false) {
		$ext = "";
	}else{
		$ext = substr($_FILES["fileField"]["name"], 0,$pos);
		$media_type = substr($_FILES["fileField"]["name"],$pos+1,strlen($_FILES["fileField"]["name"]));
	}
    if($media_type){
	$image_name = $now.'.jpg';	
    shell_exec("ffmpeg -i ../../user_movie/$ext.$media_type -ss 0 -vframes 1 -y ../../images/anchor/$image_name");
    }
	if(file_exists($targetFile)){
		?><script>alert("檔案已經存在，請勿重覆上傳相同檔案");</script><?php
		header("Refresh:0; url= ../upload_media.php");
		exit();
	}else{
		move_uploaded_file($tempFile,$targetFile);//原始檔案
		$public_date = date("Y-m-d",time()); 
		$query = "INSERT INTO user_media(member_id,url,public_date,media_type)values('$member_id','$ext','$public_date','$media_type')";
		$result = $mysqli->query($query);
		header("Location: ../temp_media.php");
}
}
	
/*		
$ffmpegPath = "ffmpeg.exe";
//來源影片路徑
$srcFile = $tempFile;
//輸出影片路徑

//$outFile = "C:\AppServ\www\wba\user_movie\\".$now.".flv";
$outFile = "C:\AppServ\www\wba\user_movie\\".$ext.".flv";
//輸出縮圖路徑
//$outImg = "C:\AppServ\www\wba\user_pics\\".$now.".jpg";
$outImg = "C:\AppServ\www\wba\user_pics\\".$ext.".jpg";


//取得影片資訊
$ffmpegObj = new ffmpeg_movie($srcFile);
//取得音頻比特率
$srcAB = intval($ffmpegObj->getAudioBitRate()/1000);

$movie = "$ffmpegPath -i $srcFile -f flv -s 436x324 -acodec libmp3lame -ar 22050 -ac 2 -ab $srcAB -y $outFile"; //影片
shell_exec($movie);

$sound = "$ffmpegPath -itsoffset -10  -i $srcFile -vcodec mjpeg -vframes 1 -an -f rawvideo -s 120x90 $outImg"; //縮圖
shell_exec($sound);
*/
//$query = "insert into user_media(member_id,url) values('$member_id','$now')";

?>
