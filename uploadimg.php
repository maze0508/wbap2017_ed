<?php
include_once('php/root.php');
$member_id = mysql_escape_string($_POST['member_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$anchor_date = date('Y-m-j');
$anchor_time = date('H:i:s');
$now = mysql_escape_string($_POST['now']);
//$now=md5(gmdate('YmdHis', time()));//MD5（現在時間）避免檔名重複

$targetFolder = '/wbap2017_ed/images/anchor';
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile =  rtrim($targetPath,'/') . '/' .$now.substr($_FILES['Filedata']['name'],-4);
	$image_name = $now.substr($_FILES['Filedata']['name'],-4);//把檔名變成時間+檔名
	//$targetFile =  rtrim($targetPath,'/') . '/' .$now. $_FILES['Filedata']['name'];
	//$image_name = $now.$_FILES['Filedata']['name'];
	
	$pos = strrpos($_FILES["Filedata"]["name"], ".");
	if ($pos === false) {
		$ext = "";
	}else{
		$ext = substr($_FILES["Filedata"]["name"], $pos);
	}
	move_uploaded_file($tempFile,$targetFile);  //原始檔案
	//echo $image_name;

}


/*if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}*/

?>