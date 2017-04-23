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
        if($_SESSION['account']){
			 include_once("php/banner_t.php");
		}
?>

</div>
<div id="page">
  <div id="content">
  <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
  <label style="color:#69F">
  <a href="sign.php" title="我的教材" style="border-bottom:hidden;color:#69F">我的教材 </a>>>
			<?php 
				if($user_media_id){
                    $query = "SELECT user_media.title,user_media.url from user_media inner join edit_books on edit_books.user_media_id = user_media.user_media_id where user_media.user_media_id='$user_media_id' && edit_books.member_id='$member_id'";
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
                    if($title && $found){
                        //echo $url;
				        $UrlArray = explode("=" , $url);
                        $youtube_name = $UrlArray[1];
				        //print_r($UrlArray); 
				    ?>
				        <iframe width="100%" height="350" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
						/*else
						echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; */
						?>
				        <video id="MovieShow" preload="auto" controls loop width="100%" height="350">
				    <?php
				        if(strstr($media_type,"mp4"))
				            echo "<source src=\"../user_movie/".$url.".mp4\" type = 'video/mp4'>";
				        else if(strstr($media_type,"ogg"))
				            echo "<source src=\"../user_movie/".$url.".ogv\" type = 'video/ogg'>";
				        else if(strstr($media_type,"webm"))
				            echo "<source src=\"../user_movie/".$url.".webm\" type = 'video/webm'>";
				        //else
				            //echo "您的瀏覽器不支援HTML5影片播放";
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
    <form class='cmxform' id='eform' name='edit' method='post' action='../php/edit_mybooks.php'>
			<input type='hidden' name='member_id' id='member_id' value='<?php print $member_id ?>' />
				<?php
				if($url){
				echo "<input type='hidden' class='required' minlength='1' value='$user_media_id' name='user_media_id'  />";
				$query = "select density.density_catalog,difficulty.difficulty_catalog,edit_books.edit_books_id ,edit_books.slesson,edit_books.learn_source,edit_books.context,edit_books.intended_user,edit_books.learn_time,edit_books.books_target,edit_books.books_content,edit_books.books_concept,edit_books.books_step from edit_books left join density on edit_books.density_id  = density.density_id left join difficulty on edit_books.difficulty_id = difficulty.difficulty_id where edit_books.user_media_id ='$user_media_id' && edit_books.member_id ='$member_id' limit 0,1";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $density_catalog .= $row["density_catalog"];
				   $difficulty_catalog .= $row["difficulty_catalog"];
				   $slesson .= $row["slesson"];
				   $learn_source .= $row["learn_source"];
				   $context .= $row["context"];
				   $intended_user .= $row["intended_user"];
				   $learn_time .= $row["learn_time"];
				   $books_target .= $row["books_target"];
				   $books_content .= $row["books_content"];
				   $books_concept .= $row["books_concept"];
				   $books_step .= $row["books_step"];	
				   $edit_books_id .= $row["edit_books_id"];				   
				}
				$query1 = "select source_id,source_catalog from source";//*3
				$result = $mysqli->query($query1);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $source_id = $row["source_id"];
				   $source_catalog = $row["source_catalog"];
				   $source_opt .= "<label for='$source_catalog' style='color:#666'><input type='checkbox' class='required checkbox learn_source' name='spam[]' value='$source_catalog' id='$source_catalog'> $source_catalog</label>";
				}
				if(!empty($density_catalog))
					echo"<br><label><b>語意密度：<b/></label>$density_catalog";
				   echo "<br><label><b>困難度：<b/></label>$difficulty_catalog";
				   echo "<br><label><b>適用年級：<b/></label>$slesson";				   				if(!empty($context))
				   echo "<br><label><b>情境：<b/></label>$context";				      			if(!empty($learn_time))
				   echo "<br><label><b>基本教學時數：<b/></label>$learn_time";
				if(!empty($intended_user))
				   echo "<br><label><b>適用對象：<b/></label>$intended_user<br/>";
				   echo "<hr/><br><label><b style='color:red'>*</b><b>學習資源類型：<b/></label><br>";
				   echo "$source_opt<input type='hidden' id='learn_source'  name='learn_source' value='$learn_source' /><label for='spam[]' class='error' style='color:#F00;font-size:10px'> ( 最少選一種類型 )</label>";
				   echo "<br><label><b style='color:red'>*</b>學習目標：</label><input type='text' id='books_target' name='books_target' class='required' size='40' value='$books_target' />";
				   echo "<br><label><b style='color:red'>*</b>學習內容：</label><input type='text' id='books_content' name='books_content' class='required' size='40' value='$books_content' />";
				   echo "<br><label><b style='color:red'>*</b>學習概念：</label><input type='text' id='books_concept' name='books_concept' class='required' size='40' value='$books_concept' />";
				if(!empty($books_step))
				   echo "<br><label>學習步驟：</label><input type='text' id='books_step' name='books_step' size='40' value='$books_step' />";
				   
				   echo "<input type='hidden' name='edit_books_id' id='edit_books_id' value='$edit_books_id'><br/>";
				   echo "<br><input type='submit' name='button' id='edbutton' value='修改' />";
				   echo " <input type='button' name='button' id='del' value='刪除' />";
				}	
				?>
				
			</form>
            </div>
  </div>
</div>
<script type="text/javascript" src="../js/jyuotube.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";



$("#eform").validate(); //驗證註冊資料

$('input.checkbox.learn_source').click(function(){ //學習資源類型
    showMessage = "";
    $('input.checkbox.learn_source:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#learn_source').val(showMessage.replace(/,$/,''))
})

if($("#learn_source").length > 0){ //判斷物件是否存在
if($("#learn_source").val() != ''){
var x = $("#learn_source").val().split(",");
$.each(x, function (key, value) {
	$("#" + value).attr("checked", true);
});
}}

$("img.youtube").each(function(){
$(this).attr("src", $.jYoutube($(this).attr("name"), "small"));
})

$("#del").click(function(){
$.post("../php/del_books.php",{edit_books_id:$("#edit_books_id").val()},function(data) {
alert('已刪除'); 
location.reload();
});
})


});

</script>
</body>
</html>
