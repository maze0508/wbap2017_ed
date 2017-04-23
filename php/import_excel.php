<?php
include_once('root.php');
require_once '../Excel/reader.php';
$tempFile = $_FILES['Filedata']['tmp_name'];
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read($tempFile);
$addcompet = mysql_escape_string($_POST['addcompet']);

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
{ 
for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
{
    //echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
}

$query = "SELECT member_id from member where account='".$data->sheets[0]['cells'][$i][1]."' || email='".$data->sheets[0]['cells'][$i][4]."' limit 0,1 ";
$result = $mysqli->query($query);
$rows=@$result->num_rows;
if(!$rows){
   $query = "insert into member(account,pwd,name,email,unit,iclass,compet) values ('".$data->sheets[0]['cells'][$i][1]."','".$data->sheets[0]['cells'][$i][2]."','".$data->sheets[0]['cells'][$i][3]."','".$data->sheets[0]['cells'][$i][4]."','".$data->sheets[0]['cells'][$i][5]."','".$data->sheets[0]['cells'][$i][6]."','$addcompet')";
   $result = $mysqli->query($query);
}else
echo "<label style='color:red'>".$data->sheets[0]['cells'][$i][3]."匯入失敗、</label>";
}
		
	// } else {
	// 	echo 'Invalid file type.';
	// }

?>