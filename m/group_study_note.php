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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

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
			 include_once("php/banner_s.php");
		}
?>

</div>
<div id="page">
  <div id="content">
  <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
  <label style="color:#69F">
  <a href="group_study_note.php" title="我的註記" style="border-bottom:hidden;color:#69F">我的註記 </a>
    </label>
    <div id='learning_article' style="width:100%">
		<?php
            echo"<select id='learning_article_select' style='width:50%;'>
				<option value='change'>請選擇學習主題</option>";
            $query="select learning.learning_id,learning.learning_name,user_media.user_media_id,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $learning_name = $row['learning_name'];
				$user_media_id = $row['user_media_id'];
				$team_id = $row['team_id'];
                echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
            }
            echo"</select>";?>		
    </div><br/>  
    
	<?php
	/***********分頁功能還沒弄好
		if(!isset($_GET["page"])){ 
			$_GET["page"] = 1; //設定起始頁 
		} else { 
			$page = intval($_GET["page"]); //確認頁數只能夠是數值資料 
			$page = ($page > 0) ? $page : 1; //確認頁數大於零 
		}*********/
	?> 
      
    <div id='show_learning_article' style="width:100%;">
	</div>       
  </div>
</div>

<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var team_id =  "<?php print $team_id; ?>";
//var page =  "<?php print $page; ?>";
$(function(){
	$('select').live("change", function(){
		var user_media_id = $(this).val();
 		$.post("php/learning_article_show.php",{member_id:member_id,user_media_id:user_media_id,team_id:team_id},function(data){$('#show_learning_article').html(data);});
	 });
});
</script>

<script type='text/jscript'>
$('.delete_button').live('click',function(){
if(member_id.length>=1){
		var media_anchor_image_id=$(this).parents('table').attr('id');
		$.post("../php/delete_anchor_text.php",{media_anchor_image_id:media_anchor_image_id,button:'delete'},function(data) {
			var del_anchor="'table #"+media_anchor_image_id+"'";
			alert('已刪除註記');
			action='刪除圖片註記';
			record(member_id,action);
			 $(del_anchor).remove();  
		});
}else
	alert('請先登入');
})

function record(member_id,action){
	$.post('../php/record.php',{member_id:member_id,action:action},function(data) {
	});
}
</script>
</body>
</html>
