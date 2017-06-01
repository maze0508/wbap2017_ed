<?php
//選擇欲使用的組織方式後，會顯示的畫面
include_once("root.php");
$composition = mysql_escape_string($_POST['composition']);
$member_id = mysql_escape_string($_POST['member_id']);

echo"	<div class='content' id='content'>
        <div class='Tit'><img src='images/test/pic-Tit.png'/>
            <a href='index.php' title='個人書房'>個人書房</a> >> <a href='#' title='統整'>統整</a> >> ";

switch($composition){
	case "list":
		echo"
		<a href='#' title='list'>清單</a></div>
		<div id='contentR'>
			<div id='Edit' class='list'>
				<ul>
					<table id='1' class='composition_new' CELLPADDING='10'>
							<tr>
								<td><li style='vertical-align:middle;'></li></td>
								<td class='image'>
									<div id='image_1' class='image_choose' style='width:200px;height:150px;box-shadow:5px 5px 10px #777777;'><img class='image_url' style='width:200px;'/></div>
								</td>
								<td class='descript'>
									<div id='descript_1' class='descript_choose' style='border-bottom:1px solid;height:50px;cursor:pointer;width:400px;'><div class='descript_text'></div></div>
								</td>
								<td >
									<div><img class='del_new' style='width:16px;cursor:pointer;'src='./images/cancel.png';></img></div>
								</td>
							</tr>
					</table>	
				</ul>
			</div>		
			<button id='add_new' class='list' style='font-family:微軟正黑體;font-size:20px;font-weight:bold;background-color:#FFF;'>新增項目</button><br/>
			<div align=center>
				<button id='save' class='list' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;margin:15px;'>儲存</button>
					
				<button id='clean' class='list' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;'>清空</button>
			</div>
		</div>
		<div id='sidebarR'>
		<div style='float:top;'>
			<img id='toolbaox' src='./images/test/Toolbox2.png';></img>
			<table id='toolbaox2' rules='none' cellpadding='5' >
				<tr class='lavel1'><td ><div>組織方式</div>
					<img id='pull' style='width:20px;float:right;'src='./images/test/pull.png';></img></td></tr>
				<tr class='lavel2'><td></td></tr>
				<tr class='lavel3'><td><img id='list' class='tool_composition' style='width:100px;'src='./images/test/list-3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='sequence' class='tool_composition' style='width:100px;'src='./images/test/sequence3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='hie' class='tool_composition' style='width:100px;'src='./images/test/hie3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='mesh' class='tool_composition' style='width:100px;'src='./images/test/Mesh3.png';></img></td></tr>
			</table>
		</div>";
		echo"<div id='compos_book'><select id='compos_book_select'> <option value='change'>請選擇章節</option>";
		$query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$member_id'";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_book_id = $row['compos_book_id'];
			$compos_book_name = $row['compos_book_name'];
			echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
		}
		echo"</select></div>";
		echo"</div>";
		
	break;
	case "sequence":
		echo"
		<a href='#' title='sequence'>次序</a></div>
		<div id='contentR'>
			<div id='Edit' class='sequence'>
				<ol>
					<table id='1' class='composition_new' CELLPADDING='10'>
							<tr>
								<td><li style='vertical-align:middle;'></li></td>
								<td class='image'>
									<div id='image_1' class='image_choose' style='width:200px;height:150px;box-shadow:5px 5px 10px #777777;'><img class='image_url' style='width:200px;'/></div>
								</td>
								<td class='descript'>
									<div id='descript_1' class='descript_choose' style='border-bottom:1px solid;height:50px;cursor:pointer;width:400px;'><div class='descript_text'></div></div>
								</td>
								<td >
									<div><img class='del_new' style='width:16px;cursor:pointer;'src='./images/cancel.png';></img></div>
								</td>
							</tr>
					</table>		
				</ol>
			</div>		
			<button id='add_new' class='list' style='font-family:微軟正黑體;font-size:20px;font-weight:bold;background-color:#FFF;'>新增項目</button><br/>
			<div align=center>
				<button id='save' class='list' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;margin:15px;'>儲存</button>
				<button id='clean' class='list' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;'>清空</button>
			</div>
			
		</div>
		<div id='sidebarR'>
		<div style='float:top;'>
			<img id='toolbaox' src='./images/test/Toolbox2.png';></img>
			<table id='toolbaox2' rules='none' cellpadding='5' >
				<tr class='lavel1'><td ><div>組織方式</div>
					<img id='pull' style='width:20px;float:right;'src='./images/test/pull.png';></img></td></tr>
				<tr class='lavel2'><td></td></tr>
				<tr class='lavel3'><td><img id='list' class='tool_composition' style='width:100px;'src='./images/test/list-3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='sequence' class='tool_composition' style='width:100px;'src='./images/test/sequence3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='hie' class='tool_composition' style='width:100px;'src='./images/test/hie3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='mesh' class='tool_composition' style='width:100px;'src='./images/test/Mesh3.png';></img></td></tr>
			</table>
		</div>";
		echo"<div id='compos_book'><select id='compos_book_select'> <option value='change'>請選擇章節</option>";
		$query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$member_id'";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_book_id = $row['compos_book_id'];
			$compos_book_name = $row['compos_book_name'];
			echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
		}
		echo"</select></div>";
		echo"</div>";
		
	break;
	case "hie":
	echo"
	<a href='#' title='hie'>階層</a></div>
	<div id='contentR'>
			<div id='Edit' class='hie'>
				<ul id='org' style='display:none'>
					<li>
						<table id='1' class='composition_new' style='width:155px;border:1px solid;margin:auto;'>
							<tr>
								<td class='image'>
									<div><img  style='width:10px;cursor:pointer;'src='./images/cancel.png';></img></div>
									<div id='image_1' class='image_choose' style='width:145px;height:109px;border:1px solid;'><img class='image_url' style='width:145px;'/></div>
								</td>
							</tr>
							<tr>
								<td class='descript'>
									<div id='descript_1' class='descript_choose' style='border-bottom:1px solid;height:30px;cursor:pointer;width:145px;'><div class='descript_text'></div></div>
								</td>
							</tr>
							<tr>
								<td>
									<button class='add_child' style='border:1px solid #666;font-size:10px;font-weight:bold;'>add</button><br/>
								</td>
							</tr>
						</table>
					</li>
				</ul>            
				<div id='chart' class='orgChart'></div>
			</div>
			<div>

			<div align=center>
				<button id='save' class='list' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;margin:15px;'>儲存</button>
				<button id='clean' class='list' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;'>清空</button>
			</div>
			</div>
		</div>	
		<div id='sidebarR'>
		<div style='float:top;'>
			<img id='toolbaox' src='./images/test/Toolbox2.png';></img>
			<table id='toolbaox2' rules='none' cellpadding='5' >
				<tr class='lavel1'><td ><div>組織方式</div>
					<img id='pull' style='width:20px;float:right;'src='./images/test/pull.png';></img></td></tr>
				<tr class='lavel2'><td></td></tr>
				<tr class='lavel3'><td><img id='list' class='tool_composition' style='width:100px;'src='./images/test/list-3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='sequence' class='tool_composition' style='width:100px;'src='./images/test/sequence3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='hie' class='tool_composition' style='width:100px;'src='./images/test/hie3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='mesh' class='tool_composition' style='width:100px;'src='./images/test/Mesh3.png';></img></td></tr>
			</table>
		</div>";
		echo"<div id='compos_book'><select id='compos_book_select'> <option value='change'>請選擇章節</option>";
		$query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$member_id'";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_book_id = $row['compos_book_id'];
			$compos_book_name = $row['compos_book_name'];
			echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
		}
		echo"</select></div>";
		echo"</div>";
	break;
	case "mesh":
	echo"
	<a href='#' title='mesh'>網狀</a></div>
	<div id='contentR'>
			<div style='position:absolute;'>
				<button id='add_new' class='mesh' style='font-family:微軟正黑體;font-size:20px;font-weight:bold;'>新增節點</button><br/>
				<button id='add_line' class='mesh' style='font-family:微軟正黑體;font-size:20px;font-weight:bold;'>新增連線</button><br/>
				<button id='del_line' class='mesh' style='font-family:微軟正黑體;font-size:20px;font-weight:bold;'>刪除連線</button><br/>
			</div>
			<div id='Edit' class='mesh'>
						
				<div id='1' style='top: 167px; left: 360.5px;position: absolute;'>
					<table id='1' class='composition_new' style='width:155px;border:1px solid;margin:auto;'>
						<tr>
							<td class='image'>
								<div><img  class='del_new' style='width:14px;cursor:pointer; float:right; 'src='./images/cancel.png';></img>
								<img  class='Select' style='width:14px;cursor:pointer; 'src='./images/test/pic-click.png';></img>
								<img  class='handle' style='width:14px;cursor:pointer;'src='./images/test/pic-drag.png';></img></div>
								<div id='image_1' class='image_choose' style='width:145px;height:109px;border:1px solid;'><img class='image_url' style='width:145px;'/></div>
							</td>
						</tr>
						<tr>
							<td class='descript'>
								<div id='descript_1' class='descript_choose' style='border-bottom:1px solid;height:30px;cursor:pointer;width:145px;'><div class='descript_text'></div></div>
							</td>
						</tr>
						
					</table>
				</div>				
			</div>
			
			
			
			<div align=center>
				<button id='save' class='mesh' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;margin:15px;'>儲存</button>
				<button id='clean' class='mesh' style='font-family:微軟正黑體;font-size:22px;font-weight:bold;'>清空</button>
			</div>
		</div>	
		<div id='sidebarR'>
		<div style='float:top;'>
			<img id='toolbaox' src='./images/test/Toolbox2.png';></img>
			<table id='toolbaox2' rules='none' cellpadding='5' >
				<tr class='lavel1'><td ><div>組織方式</div>
					<img id='pull' style='width:20px;float:right;'src='./images/test/pull.png';></img></td></tr>
				<tr class='lavel2'><td></td></tr>
				<tr class='lavel3'><td><img id='list' class='tool_composition' style='width:100px;'src='./images/test/list-3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='sequence' class='tool_composition' style='width:100px;'src='./images/test/sequence3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='hie' class='tool_composition' style='width:100px;'src='./images/test/hie3.png';></img></td></tr>
				<tr class='lavel3'><td><img id='mesh' class='tool_composition' style='width:100px;'src='./images/test/Mesh3.png';></img></td></tr>
			</table>
		</div>";
		echo"<div id='compos_book'><select id='compos_book_select'> <option value='change'>請選擇章節</option>";
		$query="SELECT   compos_book_id,compos_book_name FROM compos_book WHERE member_id ='$member_id'";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQL_ASSOC)) {
			$compos_book_id = $row['compos_book_id'];
			$compos_book_name = $row['compos_book_name'];
			echo '<option value="' . $compos_book_id . '">' . $compos_book_name . '</option>' . "\n";
		}
		echo"</select></div>";
		echo"</div>";		
	break;



}
		
?>