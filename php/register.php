<?php
session_start();

include_once("root.php");
$account = mysql_escape_string($_POST['account']);
$pwd = mysql_escape_string($_POST['pwd']);
$name = mysql_escape_string($_POST['name']);
$unit = mysql_escape_string($_POST['unit']);
$email = mysql_escape_string($_POST['email']);
$iclass = mysql_escape_string($_POST['iclass']);
$addcompet = mysql_escape_string($_POST['addcompet']);

$query = "SELECT account from member where account='$account' || email='$email' limit 0,1 ";
$result = $mysqli->query($query);
$rows=@$result->num_rows;
if($rows){
echo "<script>alert('此帳號已被註冊!')</script>";
echo "<script>document.location.href='../sign.php'</script>";
mysqli_free_result($result);
}
else{
   $query = "insert into member(account,pwd,name,unit,email,iclass,compet) values ('$account','$pwd','$name','$unit','$email','$iclass','$addcompet')";
   $result = $mysqli->query($query);
   echo "<script>alert('帳號註冊成功，請重新登入')</script>";
   echo "<script>document.location.href='../sign.php'</script>";
 }

?>