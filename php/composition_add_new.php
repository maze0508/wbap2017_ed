<?php
include_once("root.php");
$composition = mysql_escape_string($_POST['composition']);
$index = mysql_escape_string($_POST['index']);


switch($composition){
	case "list":
		echo"
		
			<table id='$index' class='composition_new' CELLPADDING='10'>
				<tr>
					<td><li style='vertical-align:middle;'></li></td>
					<td class='image'>
						<div id='image_$index' class='image_choose' style='width:200px;height:150px;box-shadow:5px 5px 10px #777777;'><img class='image_url' style='width:200px;'/></div>
					</td>
					<td class='descript'>
						<div id='descript_$index' class='descript_choose' style='border-bottom:1px solid;height:50px;cursor:pointer;width:400px;'><div class='descript_text'></div></div>
					</td>
					<td >
						<div><img class='del_new' style='width:16px;cursor:pointer;'src='./images/cancel.png';></img></div>
					</td>
				</tr>
			</table>";
		
	break;
	case "sequence":
		echo"
		
			<table id='$index' class='composition_new' CELLPADDING='10'>
				<tr>
					<td><li style='vertical-align:middle;'></li></td>
					<td class='image'>
						<div id='image_$index' class='image_choose' style='width:200px;height:150px;box-shadow:5px 5px 10px #777777;'><img class='image_url' style='width:200px;'/></div>
					</td>
					<td class='descript'>
						<div id='descript_$index' class='descript_choose' style='border-bottom:1px solid;height:50px;cursor:pointer;width:400px;'><div class='descript_text'></div></div>
					</td>
					<td >
						<div><img class='del_new' style='width:16px;cursor:pointer;'src='./images/cancel.png';></img></div>
					</td>
				</tr>
			</table>";
		
	break;
	case "hie":
		echo"<li>
						<table id='$index' class='composition_new' style='width:155px;border:1px solid;margin:auto;'>
							<tr>
								<td class='image'>
									<div><img class='del_child' style='width:10px;cursor:pointer;'src='./images/cancel.png';></img></div>
									<div id='image_$index' class='image_choose' style='width:145px;height:109px;border:1px solid;'><img class='image_url' style='width:145px;'/></div>
								</td>
							</tr>
							<tr>
								<td class='descript'>
									<div id='descript_$index' class='descript_choose' style='border-bottom:1px solid;height:30px;cursor:pointer;width:145px;'><div class='descript_text'></div></div>
								</td>
							</tr>
							<tr>
								<td>
									<button class='add_child' style='border:1px solid #666;font-size:10px;font-weight:bold;'>add</button><br/>
								</td>
							</tr>
						</table>
					</li>";
	break;
	case "mesh":
		echo"<div id='$index' style='top: 167px; left: 360.5px;position: absolute;'>
					<table id='$index' class='composition_new' style='width:155px;border:1px solid;margin:auto;'>
						<tr>
							<td class='image'>
								<div><img  class='del_new' style='width:14px;cursor:pointer; float:right; 'src='./images/cancel.png';></img>
								<img  class='Select' style='width:14px;cursor:pointer; 'src='./images/test/pic-click.png';></img>
								<img  class='handle' style='width:14px;cursor:pointer;'src='./images/test/pic-drag.png';></img></div>
								<div id='image_$index' class='image_choose' style='width:145px;height:109px;border:1px solid;'><img class='image_url' style='width:145px;'/></div>
							</td>
						</tr>
						<tr>
							<td class='descript'>
								<div id='descript_$index' class='descript_choose' style='border-bottom:1px solid;height:30px;cursor:pointer;width:145px;'><div class='descript_text'></div></div>
							</td>
						</tr>
						
					</table>
				</div>
				";
	break;



}
		
?>