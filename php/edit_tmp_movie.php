<?php
include_once("root.php");
date_default_timezone_set( "Asia/Taipei" );
$user_media_id = $_POST['user_media_id'];
$source_id = $_POST['source_id'];
$title = $_POST['title'];
$arr_language = $_POST['spam'];
$description = $_POST['description'];
$keyword = $_POST['keyword'];
$coverage = $_POST['coverage'];
$version = $_POST['version'];
$role_id = $_POST['role_id'];

$common_id;
if(empty($_POST['common_id'])){
    $common_id=0;
}else{
   $common_id = $_POST['common_id'];
}
$copyright = $_POST['copyright'];
$cost = $_POST['cost'];
$ccdescription_id = $_POST['ccdescription_id'];
$public_date = date('Y-m-j');
$design_date = $_POST['design_date'];

foreach ($arr_language as $_value) {
    $lan_val.=$_value." ";
}

$query="UPDATE wbap2017.user_media SET source_id='$source_id',title='$title',language='$lan_val',description='$description',common_id='$common_id',keyword='$keyword',coverage='$coverage',version='$version',role_id='$role_id',public_date='$public_date',copyright='$copyright',design_date='$design_date',cost='$cost',ccdescription_id='$ccdescription_id' WHERE user_media_id = $user_media_id";
$result = $mysqli->query($query);


$member_id = $_POST['member_id'];
$density_id;
if(empty($_POST['density_id'])){
    $density_id=0;
}else{
   $density_id = $_POST['density_id'];
}
$intended_user = $_POST['intended_user'];
$difficulty_id = $_POST['difficulty_id'];
$subject_id = $_POST['subject_id'];
$slesson = $_POST['slesson'];
$context = $_POST['context'];
$learn_source = $_POST['learn_source'];
$learn_time = $_POST['learn_time'];
$books_target = $_POST['books_target'];
$books_content = $_POST['books_content'];
$books_concept = $_POST['books_concept'];
$books_step = $_POST['books_step'];
$query="insert into wbap2017.edit_books(user_media_id,member_id,density_id,intended_user,difficulty_id,subject_id,slesson,context,learn_source,learn_time,books_target,books_content,books_concept,books_step) values('$user_media_id','$member_id','$density_id','$intended_user','$difficulty_id','$subject_id','$slesson','$context','$learn_source','$learn_time','$books_target','$books_content','$books_concept','$books_step');";
$result = $mysqli->query($query);
//echo "<script>alert('資料已發佈，本影片將移轉到[會員功能-已分享影片]')</script>";
echo "<script>document.location.href='../my_media.php'</script>";
echo "<p>上傳成功，自動跳轉至已分享影片。</p>";
//$uurl="../my_media.php";

?>
