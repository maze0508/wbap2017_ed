<?php
$con=mysqli_connect("120.110.114.90","maze","faIRhg5uLF","wbap2017");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
mysqli_query($con,"SET NAMES 'utf8'");
?>