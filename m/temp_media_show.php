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
  <a href="temp_media.php" title="影片草稿夾" style="border-bottom:hidden;color:#69F">影片草稿夾 </a><?php 
                 	$member_id = $_SESSION['member_id']; 
					$user_media_id = mysql_escape_string($_GET['user_media_id']);
					if($user_media_id){
					$query = "SELECT url , media_type from user_media where user_media_id='$user_media_id' && member_id='$member_id'";
					$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
						$url .= $row['url'];
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
    <form class='cmxform' id='eform' name='edit' method='post' action='../php/edit_tmp_movie.php'>
 	 <input type='hidden' class='required' minlength='1' value='<?php echo "$user_media_id"; ?>' name='user_media_id' id='user_media_id' />
	 <input type='hidden' name='member_id' id='member_id' value='<?php echo "$member_id"; ?>' />
     <?php
	  if($url){
	 ?>
		<table width="100%" height="73" align="left" cellspacing="8">
        <tr>
		<th align="left" scope="row" width="25%"><b style='color:red'>*</b>影片標題：</th>
		<td><input type='text' id='title' name='title' size='30' class='required account' minlength='2' /></td>
        </tr>
        <tr>
        <th align="left"><b style='color:red'>*</b>影片語言：</th><td> 
        <?php		
			$query = "select language_id,language_catalog from language"; //*1
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
			 	$language_id = $row["language_id"];
			 	$language_catalog = $row["language_catalog"];				   
			 echo "<label for='$language_id'><input type='checkbox' class='required checkbox' name='spam[]' value='$language_catalog' id='$language_id'> $language_catalog</label>";
			}
			echo "$language_opt<input type='hidden' id='language'  name='language' /><br><label for='spam[]' class='error' style='color:#F00;font-size:10px;'>( 最少選一種語言 )</label></td></tr>";
			echo "<tr><th align='left'><b style='color:red'>*</b>資源類別：</th>";				
			$query = "select source_id,source_catalog from source";//*3
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				$source_id = $row["source_id"];
				$source_catalog = $row["source_catalog"];
				$source_opt .= "<option value='$source_id'>$source_catalog</option>";
			}
			echo "<td><select name='source_id' id='source_id' class='required' title='請選擇資源類別'><option value=''>請選擇</option>$source_opt</select></td></tr>";
			echo "<tr><th align='left'>您的角色：</th>";
			$query = "select role_id,role_catalog from role";//*4
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				 $role_id = $row["role_id"];
				 $role_catalog = $row["role_catalog"];
				 $role_opt .= "<option value='$role_id'>$role_catalog</option>";
			}
			echo "<td><select name='role_id' id='role_id'>$role_opt</select>
                <p style='color:#F00;font-size:10px;'>(當角色為【作者】時，可從選單選擇-共同作者)</p>";
                ?>
        </td></tr>
        </table>
        <hr/>
          <!--共同作者建立-->
        <div id='common_info' style=" border:#69F 1px inset;">
         <p>共同作者
         <?php
			$query = "select common_id,common_account from common";//*4
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $common_id = $row["common_id"];
				   $common_account = $row["common_account"];
				   $account_opt .= "<option value='$common_id'>$common_account</option>";
			}
         ?>
          <select id='common_id' name='common_id'>
           <option value=''>請選擇</option>
             $account_opt
            </select></p>
             姓名：<input type='text' id='common_account' class='cl_common'><br/>
             單位：<input type='text' id='common_unit' class='cl_common' ><br/>
             信箱：<input type='text' id='common_email' class='cl_common'><br/><br/>
             <input type='button' value='建立共同作者' id='insert'><br/>
          </div><hr/>
          <!--共同作者建立結束-->
                    
        <table width="100%" align="left" cellspacing="8">    
            <tr>
            <th align="left" style="width:25%">為付費影片：</th>
			<td><select name='cost'>
                <option value='no'>否</option>
                <option value='yes'>是</option>
                </select>
            </td>
            </tr>
            <tr>
            <th align="left">版權及限制：</th>
			<td><select name='copyright' id='copyright'>
                <option value='yes'>是</option>
                <option value='no'>否</option>
                </select>
            </td>
            </tr>
            <tr align="left">
            <th>授權描述：</th>
            <?php
              $query = "select ccdescript_id,ccdescript_catalog from ccdescript";
              $result = $mysqli->query($query);
              while($row = $result->fetch_array(MYSQL_ASSOC)){	    
                    $ccdescript_id = $row["ccdescript_id"];
                    $ccdescript_catalog = $row["ccdescript_catalog"];
                    if($ccdescript_id==3)
                        $ccdescript_opt .= "<option value='$ccdescript_id' selected='selected'>$ccdescript_catalog</option>";
                    else
                        $ccdescript_opt .= "<option value='$ccdescript_id'>$ccdescript_catalog</option>";
              }
              echo "<td><select name='ccdescription_id' id='ccdescript'>$ccdescript_opt</select></td></tr>";
              mysqli_free_result($result);
            ?>  
            <tr>
            <th align="left"><b style='color:red'>*</b>影片創作日期：</th>
            <td><input type='text' name='design_date' id='design_date' size='15' class='dateISO required' />
            </td>
            </tr>
			<tr>
            <th align="left">影片版本：</th>
            <td><input type='text' name='version' id='version' size='15' />
            </td>
            </tr>
			<tr>
            <th align="left">關鍵字：</th>
            <td><input type='text' name='keyword' id='keyword' size='30' /><p style='color:#F00;font-size:10px;'>( 請以逗點分隔 )</p>
            </td>
            </tr>
			<tr>
            <th align="left">涵蓋範圍：</th>
            <td><input type='text' name='coverage' id='coverage' size='60' /><p style='font-size:10px;'>( 學習物件所適用的時間、文化、地理或地區 )</p></td>
            </tr>
			<tr>
            <th align="left">影片內容描述：</th>
            <td><textarea name='description' id='description' cols='45' rows='5' class='account'></textarea></td>
            </tr>
			<!--以下為教材資料-->
			<tr>
            <th align="left">語意密度：</th>
			<?php
             	$query = "select density_id,density_catalog from density";//*4
                $result = $mysqli->query($query);
                while($row = $result->fetch_array(MYSQL_ASSOC)){
                       $density_id = $row["density_id"];
                       $density_catalog = $row["density_catalog"];
                       $density_opt .= "<option value='$density_id'>$density_catalog</option>";
                }
                echo "<td><select id='density_id' name='density_id'><option value=''>請選擇</option>$density_opt</select></td?</tr>";
            ?>
            <tr>
            <th align="left">適用對象：</th>
            <td><select id='intended_user' name='intended_user'><option value=''>請選擇</option><option value='學習者'>學習者</option></select></td>
            </tr>
			<tr>
            <th align="left"><b style='color:red'>*</b>困難度：</th>
            <?php
              $query = "select difficulty_id,difficulty_catalog from difficulty";//*4
              $result = $mysqli->query($query);
              while($row = $result->fetch_array(MYSQL_ASSOC)){
                       $difficulty_id = $row["difficulty_id"];
                       $difficulty_catalog = $row["difficulty_catalog"];
                       $difficulty_opt .= "<option value='$difficulty_id'>$difficulty_catalog</option>";
              }
              echo "<td><select id='difficulty_id' name='difficulty_id' class='required'><option value=''>請選擇</option>$difficulty_opt</select></td></tr>";			
              echo "<tr><th align='left'><b style='color:red'>*</b>適用年級：</th><td><input type='hidden' name='slesson' id='slesson' />";
              $query = "select slesson_id,slesson_catalog from slesson";//*4
              $result = $mysqli->query($query);
              while($row = $result->fetch_array(MYSQL_ASSOC)){
                       $slesson_id = $row["slesson_id"];
                       $slesson_catalog = $row["slesson_catalog"];
                       $slesson_opt .= "<option value='$slesson_id'>$slesson_catalog</option>";
              }
              echo "<select id='slesson_id' name='slesson_id' class='required' size='5' multiple='multiple'>$slesson_opt</select></td></tr>";
              echo "<tr><th align='left'><b style='color:red'>*</b>學科：</th>";
              $query = "select subject_id,subject_catalog from subject";//*4
              $result = $mysqli->query($query);
               while($row = $result->fetch_array(MYSQL_ASSOC)){
                       $subject_id = $row["subject_id"];
                       $subject_catalog = $row["subject_catalog"];
                       $subject_opt .= "<option value='$subject_id'>$subject_catalog</option>";
              }
              echo "<td><select id='subject_id' name='subject_id' class='required'><option value=''>請選擇</option>$subject_opt</select></td></tr>";
                    ?>
              <tr>
              <th align="left">情境：</th>
              <td><input type='hidden' id='context'  name='context' />	
              <label for='ad1v'><input type='checkbox' class='checkbox context' name='ad' value='引起動機' id='ad1v' /> 引起動機</label>
              <label for='ad2v'><input type='checkbox' class='checkbox context' name='ad' value='知識性認知' id='ad2v' /> 知識性認知</label>
              <label for='ad3v'><input type='checkbox' class='checkbox context' name='ad' value='操作性技能' id='ad3v' /> 操作性技能</label></td>
              </tr>
              <tr>
              <th align="left"><b style='color:red'>*</b>學習資源類型：</th><td>
                    
              <?php
                $query = "select source_id,source_catalog from source";//*3
                $result = $mysqli->query($query);
                while($row = $result->fetch_array(MYSQL_ASSOC)){
                       $source_id = $row["source_id"];
                       $source_catalog = $row["source_catalog"];
                       echo "<label for='$source_id'><input type='checkbox' class='required checkbox learn_source' name='spam_type[]' value='$source_catalog' id='$source_id'/> $source_catalog</label>";
                }
                echo "<input type='hidden' id='learn_source'  name='learn_source' /><br/><label for='spam_type[]' class='error' style='color:#F00;font-size:10px;'> ( 最少選一種類型 )</label>";
             ?></td>
            </tr>
			<tr>
            <th align="left">基本教學時數：</th>
            <td><input type='text' id='learn_time' class='learn_time'  name='learn_time' /><p style='font-size:10px;'>以 PTxxHxxMxxS 形式著錄。<br/>ex:(需時1 小時35 分45 秒，則著錄PT01H35M45S)</p></td>
            </tr>
			<tr>
            <th align="left"><b style='color:red'>*</b>學習目標：</th>
            <td><input type='text' id='books_target' name='books_target' class='required' size='40' /></td>
            </tr>
			<tr>
            <th align="left"><b style='color:red'>*</b>學習內容：</th>
            <td><input type='text' id='books_content' name='books_content' class='required' size='40' /></td>
            </tr>
			<tr>
            <th align="left"><b style='color:red'>*</b>學習概念：</th>
            <td><input type='text' id='books_concept' name='books_concept' class='required' size='40' /></td>
            </tr>
			<tr>
            <th align="left">學習步驟：</th>
            <td><input type='text' id='books_step' name='books_step' size='40' /></td>
            </tr>
            </table>    
            <br/>        
		<input type='submit' name='button' id='edbutton' value='發佈' style="width:100%;height:30px;text-align:center;margin-top:10px;" />
	  </form>
            <?php
				}
			?>
    </div>
</div>
</div>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  
var mydate=new Date();
month = ((mydate.getMonth()+1)>=10)? mydate.getMonth()+1:'0'+(mydate.getMonth()+1)
day = (mydate.getDate() >= 10) ? mydate.getDate():'0'+mydate.getDate()
$('#design_date').val(mydate.getFullYear() + "-" + month + "-" + day)

var member_id = "<?php print $_SESSION['member_id']; ?>";
var handlerA = function(){ $(this).attr("src","../images/remove.jpg") };

jQuery.validator.addMethod("account", function(value, element) { //
  return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);
}, "只能包括中文字、英文字母、數字和下劃線");

$("#eform").validate(); //驗證註冊資料



$('#copyright').change(function(){ 
if($(this).get(0).selectedIndex==1){
$('#ccdescript').prepend("<option value=' '>不須授權</option>").attr('disabled', "disabled")
$("#ccdescript option[text='不須授權']").attr("selected", true);
}
else{
$("#ccdescript option[text='不須授權']").remove();
$('#ccdescript').attr("disabled","")
$("#ccdescript option[value='3']").attr("selected", true);
}
})

$('#role_id').change(function(){ 
if($(this).get(0).selectedIndex == 0){
$("#common_id option[text='請選擇']").attr("selected", true);
$("#common_info").show();
}
else{
$('#common_info').hide();
$("#common_id option[text='請選擇']").attr("selected", true);
}
})

$('#slesson_id').click(function(){ //適用年級
    var fruit = "";
     $("#slesson_id option:selected").each(function() {
        fruit += $(this).text()+',';
    });
	$('#slesson').val(fruit.replace(/,$/,''))
})

$('input[type=checkbox].learn_source').click(function(){ //學習資源類型
    showMessage = "";
    $('input.checkbox.learn_source:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#learn_source').val(showMessage.replace(/,$/,''))
})

$('input[type=checkbox].context').click(function(){ //情境
    showMessage = "";
    $('input.checkbox.context:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#context').val(showMessage.replace(/,$/,''))
})

/*$('input[type=checkbox].subject').click(function(){ //學科
    showMessage = "";
    $('input.checkbox.subject:checked').each(function() {
        showMessage += $(this).val()+",";
    });
	$('#subject').val(showMessage.replace(/,$/,''))
})*/



$('input[type=checkbox].language').click(function(){
    showMessage = [];
    $('input.checkbox:checked').each(function() {
        showMessage += $(this).val()+",";
    });

	$('#language').val(showMessage.replace(/,$/,''))

})


$('#insert').click(function(){
if($('#common_account').val().length < 2 || $('#common_unit').val().length < 2 || $('#common_email').val().length < 10){
alert('請確實填寫共同作者資訊 !!');
return false;
}
else
	$.ajax({
		url: '../php/insert_common.php',
		data: {member_id:member_id,common_account:$('#common_account').val(),common_unit:$('#common_unit').val(),common_email:$('#common_email').val()},
		error: function(xhr) {alert('Ajax request 發生錯誤');},
		success : function(data){
		alert("資料建立成功，請從選單內選擇共同作者");
		var com = data.split("#");
		$("#common_id").append("<option value='"+com[0]+"'>"+com[1]+"</option>")
		$('input.cl_common').val('');
	}})

})

$("img.youtube").each(function(){
$(this).attr("src", $.jYoutube($(this).attr("name"), "small")).bind("error.A",handlerA);
})




});

</script>

</body>
</html>
