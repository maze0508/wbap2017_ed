<?php
include_once("root.php");
//include_once("root2.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
		
		if($user_media_id){
		$query = "SELECT title,url from user_media where user_media_id='$user_media_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$url .= $row['url'];  	
			$title .= $row['title'];	
			$found .= strstr($url,"youtube");	
            $media_type .= $row['media_type']; 	
		}}
		?>
            <div id='content'><div class='post'><br/>
			<h2 class='title'><?php echo $title ;?></h2>
			<div class='entry'>

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
				        <iframe width="550" height="350" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
						/*else
						echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; */
						?>
				        <video id="MovieShow" preload="auto" controls loop width="550" height="350">
				    <?php
				        if(strstr($media_type,"mp4"))
				            echo "<source src=\"user_movie/".$url.".mp4\" type = 'video/mp4'>";
				        else if(strstr($media_type,"ogg"))
				            echo "<source src=\"user_movie/".$url.".ogv\" type = 'video/ogg'>";
				        else if(strstr($media_type,"webm"))
				            echo "<source src=\"user_movie/".$url.".webm\" type = 'video/webm'>";
				        //else
				          //  echo "您的瀏覽器不支援HTML5影片播放";
				    ?>
				        </video>
				    <?php
                    }else{				
				    ?>
				<embed type="application/x-shockwave-flash" id="player2" name="player2" src="player.swf" width="100%" height="350" allowscriptaccess="always"  allowfullscreen="true"
				    <?php
						if($user_media_id && $found)
						echo "flashvars='file=$url'";
						else if($user_media_id)	
						echo "flashvars='file=user_movie/$url.flv&image=user_pics/$url.jpg'";
					?> />
                <?php
                }
                ?>
				</object>
			</div>
		</div>

