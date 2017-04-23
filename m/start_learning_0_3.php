<!--此為我的學習主題頁面-->
<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Video Learning</title>

<link href="css/mobile_css.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".menu").click(function() {
        $(this).toggleClass("active");
        $(".nav").slideToggle();
    });
    $(".nav > ul > li:has(ul) > a").append('<div class="arrow-bottom"></div>');
});
</script>


</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
        include_once("../php/root.php");
        if($_SESSION['account']){
			include_once("php/banner_s.php");
		 }
?>

</div>
<div id="page">
  <div id="content">
			<img  style="width:450px; " src="../images/test/stu-myfavorites.png"/>
			<?php
				$query = "SELECT user_media.url,user_media.title,user_media.description,member.name,user_media.member_id,subject.subject_catalog,my_favorite.date,edit_books.edit_books_id,edit_books.user_media_id FROM (my_favorite LEFT JOIN edit_books ON my_favorite.edit_books_id=edit_books.edit_books_id) LEFT JOIN user_media ON edit_books.user_media_id=user_media.user_media_id LEFT JOIN subject ON edit_books.subject_id=subject.subject_id LEFT JOIN member ON user_media.member_id=member.member_id WHERE my_favorite.member_id = $member_id ORDER BY my_favorite.date";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $user_media_id = $row["user_media_id"];
					$_SESSION['user_media_id'] = $user_media_id;
				   $title = $row["title"];
				   $edit_books_id = $row["edit_books_id"];
				   $user_media_member_id = $row["member_id"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];	
				   $date = $row["date"];	
				   $description = $row["description"];	
				   $found = strstr($url,"youtube");		
                    $name = $row["name"];
					if($url){	 
				   if(strstr($url,"youtube")){
					$youtubeid = explode("=" , $url);
					$aimgs = "<img src='http://img.youtube.com/vi/".$youtubeid[1]."/default.jpg' name='$url' align='top' />";
					}else{			
				   $aimgs = "<img class='imgs' src='../user_pics/$url.jpg' align='top' />";}
				 echo "<div style='width:100%;height:100px;margin-left:15px;'>
				<div style='width:100px;float:left;margin-top:15px;'>
						$aimgs
				</div>
				<div style='width:100%;height:100px;margin-left:10px;'><br/>
					<label style='color:#69F;'>【 $subject_catalog 】 <a style='text-decoration: none;' href='../m/start_learning_1.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id'>$title</a></label><br/>
				<label style='font-size:12px;color:#49C;'>　主題作者：$name</label><br/>
				<label style='font-size:12px;color:#49C;'>　收藏時間：$date</lable><br/></div></div><hr>";
				}}
				mysqli_free_result($result);
				?>		
  </div>
</div>
  
</body>
</html>