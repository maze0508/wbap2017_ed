<?php session_start();
include_once("php/root.php");

$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<script src="./js/jquery.min.js"></script>
		<script src="./js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="css/demos.css" type="text/css" />
		<style type="text/css">
		
		
		</style>
	</head>

	<body>
	<div style='border-bottom: 1px solid black;font-family: 微軟正黑體;font-size: 25px;font-weight: bold;margin:10px 10px 10px 10px;'><img style="width: 25px;"src='./images/tag_blue_add.png'>圖片剪裁</div>
	<p><label style='font-family: 微軟正黑體;font-size: 15px;font-weight: bold;margin: 10px 10px 10px 50px;'>請拖曳選取剪裁範圍。</label></p>
	<?php
	$media_anchor_image_id = mysql_escape_string($_POST['media_anchor_image_id']);
	//$edit_note_class_id = mysql_escape_string($_GET['edit_note_class_id']);
	$query="SELECT media_anchor_image.image, media_anchor_image.anchor_time, media_anchor_image.user_media_id, media_anchor_image.noteColor
			FROM media_anchor_image
			WHERE media_anchor_image.media_anchor_image_id = '$media_anchor_image_id'
			";
	$result = $mysqli->query($query);
	while($row = $result->fetch_array(MYSQL_ASSOC)){
		$image= $row['image'];
		$anchor_time= $row['anchor_time'];
		$user_media_id= $row['user_media_id'];
		$noteColor= $row['noteColor'];
		
		echo"
		<div id='$media_anchor_image_id' class='article'>
		
		<table>
			  <tr>
				<td>
				  <img src='./images/anchor/$image' id='cropbox' alt='Flowers' />
				</td>
				<td>
				  <div style='width:160px;height:120px;overflow:hidden;'>
					<img src='./images/anchor/$image' id='preview' alt='Preview' class='jcrop-preview' />
				  </div>
				</td>
			  </tr>
			</table>
		<div style='border-top: 1px solid black;margin:50px 10px 10px 10px;text-align: center;'>
		<button id='submit'>確定修改</button>
		</div>
	</div>";
	}
	
	?>
		

		

		<script language="Javascript">
			var media_anchor_image_id = "<?php print $media_anchor_image_id; ?>";
			var image = "<?php print $image; ?>";
			var anchor_time = "<?php print $anchor_time; ?>";
			var user_media_id = "<?php print $user_media_id; ?>";
			var noteColor = "<?php print $noteColor; ?>";
			//var member_id = "<?php print $_SESSION['member_id']; ?>";
			var cx;
			var cy;
			var cw;
			var ch;
			$(function(){

				$('#cropbox').Jcrop({
					aspectRatio: 4 / 3,
					onChange: updatePreview,
					onSelect: updatePreview
				},function(){
					// Use the API to get the real image size
					var bounds = this.getBounds();
					boundx = bounds[0];
					boundy = bounds[1];
					// Store the API in the jcrop_api variable
					jcrop_api = this;
				});

			});

			/*function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};*/
			function updatePreview(c)
			  {
				if (parseInt(c.w) > 0)
				{
				  cx
				  cw=c.w;
				  ch=c.h;
				  cx=c.x;
				  cy=c.y;
				  var rx = 160 / c.w;
				  var ry = 120 / c.h;

				  $('#preview').css({
					width: Math.round(rx * boundx) + 'px',
					height: Math.round(ry * boundy) + 'px',
					marginLeft: '-' + Math.round(rx * c.x) + 'px',
					marginTop: '-' + Math.round(ry * c.y) + 'px'
				  });
				}
			  };
			  
			$(function(){
			
				$("#submit").click(function(){
					
					if (parseInt(cw) > 0){
						$src="."+$('#cropbox').attr('src');//原圖路徑
						var image_old=image;
						
						/*alert(image);
						if(edit_note_class_id==""){
							var anchor_class_id="all_class";
						}else{
							var anchor_class_id=edit_note_class_id;
						}*/
						var button_type="image";
						//alert(url_new);
						//alert(image_new);
						$.post("./php/crop_archive_1.php",{media_anchor_image_id:media_anchor_image_id,image_old:image_old,src:$src,x:cx,y:cy,w:cw,h:ch},
							function(data) {
								//alert(data);
								parent.$.colorbox.close();								
							}
						);
						
					
					}else{
						alert('Please select a crop region then press submit.');
					}
					
				});
				
			
			});
		</script>

	</body>

</html>
