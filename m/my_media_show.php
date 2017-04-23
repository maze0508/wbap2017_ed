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
<style type="text/css">
#eform{
	color:#69C;	
}
#eform label{
	color:#69F;	
}
</style>

</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
        include_once("../php/root.php");
        if($_SESSION['account'] && $_SESSION['compet']==2){
			 include_once("php/banner_t.php");
		}else  if($_SESSION['account'] && $_SESSION['compet']==3){
			 include_once("php/banner_a.php");
		}?>

</div>
<div id="page">
  <div id="content">
  <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
  <label style="color:#69F">
  <a href="my_media.php" title="我的影片" style="border-bottom:hidden;color:#69F">我的影片 </a>　>><?php 
					if($user_media_id){
					 $query = "SELECT url , title , media_type from user_media where user_media_id='$user_media_id' && member_id='$member_id'";
					$result = $mysqli->query($query);
					while($row = $result->fetch_array(MYSQL_ASSOC)){
                        $url .= $row['url'];  	
                        $title .= $row['title'];	
                        $found .= strstr($url,"youtube");	
                        $media_type .= $row['media_type'];
					}
                	}
			  echo $title ; ?>
    </label>
	<div style="width:100%;overflow:auto;border:1px solid #DEF;">
    <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="100%" height="350">
			<param name="movie" value="player.swf" />
			<param name="allowfullscreen" value="true" />
			<param name="allowscriptaccess" value="always" />
            <?php
			if($found){
					$UrlArray = explode("=" , $url);
					$youtube_name = $UrlArray[1];
			?>
			<iframe width="100%" height="350" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
			<?php	
			}else if($media_type){
			?>
			<video id="MovieShow" preload="auto" controls loop width="100%" height="350">
			<?php
				if(strstr($media_type,"mp4"))
				   echo "<source src=\"../user_movie/".$url.".mp4\" type = 'video/mp4'>";
				else if(strstr($media_type,"ogg"))
				   echo "<source src=\"../user_movie/".$url.".ogv\" type = 'video/ogg'>";
				else if(strstr($media_type,"webm"))
				   echo "<source src=\"../user_movie/".$url.".webm\" type = 'video/webm'>";
			?>
			</video>
			<?php
			}else{
            ?>   
            <embed type="application/x-shockwave-flash" id="player2" name="player2" src="../player.swf" width="100%" height="350" allowscriptaccess="always"  allowfullscreen="true"
			<?php
                 if($user_media_id && $found)
                     echo "flashvars='file=$url'";
                 else if($user_media_id)	
                     echo "flashvars='file=../user_movie/$url.flv&image=../user_pics/$url.jpg'";
           ?>/>
    <?php    
    }				
	?>
	</object>
    </div>
   	<div style="width:100%;overflow:auto;border:1px solid #DEF;">
    <h3 style="color:#69A">影片數位資訊</h3>
    <form class='cmxform' id='eform' name='edit' method='post' action='../php/update_movie.php'>
 	 <input type='hidden' class='required' minlength='1' value='<?php echo "$user_media_id"; ?>' name='user_media_id' id='user_media_id' />
     <?php
	  if($url){
	 $query = "SELECT identifier.ident_catalog,source.source_catalog,common.common_account,common.common_unit,common.common_email,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join common on common.common_id = user_media.common_id where user_media.user_media_id='$user_media_id' && user_media.member_id='$member_id' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $ident_catalog .= $row["ident_catalog"];
				   $common_account .= $row["common_account"];
				   $common_unit .= $row["common_unit"];
				   $common_email .= $row["common_email"];
				   $source_catalog .= $row["source_catalog"];
				   $language .= $row["language"];
				   $description .= $row["description"];
				   $keyword .= $row["keyword"];
				   $coverage .= $row["coverage"];
				   $version .= $row["version"];
				   $role_catalog .= $row["role_catalog"];
				   $design_date .= $row["design_date"];
				   $cost .= $row["cost"];
				   $copyright .= $row["copyright"];
				   $ccdescript_catalog .= $row["ccdescript_catalog"];		   
				}
				
				if(!empty($common_account))
				   echo "<br><label><b>共同作者：<b/></label>$common_account $common_unit $common_email";
				if(!empty($version))
				   echo "<br><label><b>影片版本：<b/></label>$version";
				   echo "<br><label><b>影片標題：<b/></label>$title";
				if(!empty($design_date))
				   echo "<br><label><b>創作日期：<b/></label>$design_date";
				   echo "<br><label><b>提供單位：<b/></label>$ident_catalog";
				   echo "<br><label><b>資源類別：<b/></label>$source_catalog";
				if(!empty($role_catalog))
				   echo "<br><label><b>您的角色：<b/></label>$role_catalog";
				if(!empty($cost))
				   echo "<br><label><b>為付費影片：<b/></label>$cost";
				if(!empty($copyright))
				   echo "<br><label><b>版權及限制：<b/></label>$copyright";
				if(!empty($ccdescript_catalog))
				   echo "<br><label><b>授權描述：<b/></label>$ccdescript_catalog<br/>";
				   echo "<hr/><br><label><b>影片語言：<b/></label><input type='text' name='language' id='language' value='$language' size='50' readonly='readonly' class='readonly' /><br>";
				   $query = "select language_id,language_catalog from language";
				   $result = $mysqli->query($query);
					while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $language_id = $row["language_id"];
					   $language_catalog = $row["language_catalog"];			
					   if($language_id==1)
					   $language_opt = "<label for='$language_id'><input type='checkbox' class='required checkbox'  name='spam[]' value='$language_catalog' id='$language_catalog'> $language_catalog</label>";
					   else
					   $language_opt .= "<label for='$language_id'><input type='checkbox' class='required checkbox' name='spam[]' value='$language_catalog' id='$language_catalog'> $language_catalog</label>";
					}
					
				   echo "$language_opt<label for='spam[]' class='error' style='color:#F00;font-size:10px'> ( 最少選一種類型 )</label>";
				   echo "<br><label><b>關鍵字：</b></label><input type='text' name='keyword' id='keyword' size='30' value='$keyword' /><p style='color:#F00;font-size:10px'> ( 請以小寫逗點分隔 ) </p>";
				   echo "<label><b>涵蓋範圍：<b/></label><input type='text' name='coverage' id='coverage' size='60' value='$coverage' />";
				   echo "<br><p style='font-size:10px'> ( 學習物件所適用的時間、文化、地理或地區 ) </p>";
				   echo "<label><b>影片內容描述：<b/></label><br><textarea name='description' id='description' cols='45' rows='5' class='account'>$description</textarea>";

				   echo "<input type='hidden' name='edit_books_id' id='edit_books_id' value='$edit_books_id'><br/>";
				   echo "<br><input type='submit' name='button' id='edbutton' value='修正' />";
                   echo " <input type='button' name='button' id='del' value='刪除' />";} ?>
	  </form>
    </div>
</div>
</div>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
var handlerA = function(){ $(this).attr("src","../images/remove.jpg") };


$("#eform").validate(); //驗證註冊資料

if($("#language").length > 0){ //判斷物件是否存在
if($("#language").val() != ''){
var x = $("#language").val().split(",");
$.each(x, function (key, value) {
	$("#" + value).attr("checked", true);
});
}}

$('input.checkbox').click(function(){
    showMessage = [];
    $('input.checkbox:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	if(showMessage.length > 2)
	$('#language').val(showMessage.replace(/,$/,''))
	else
	$('#language').val('')
})


$("#del").click(function(){
$.post("../php/del_books.php",{user_media_id:<?php echo $media_id;?>},function(data) {
alert("已刪除!"); 
location.reload();
});
})

$('img.youtube').each(function(){
$(this).attr('src', $.jYoutube($(this).attr('name', 'smallImage'))).bind("error.A",handlerA);

})

});
    



</script>

</body>
</html>
