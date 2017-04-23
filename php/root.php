<?php
$mysqli = mysqli_connect("120.110.114.90","maze","faIRhg5uLF","wbap2017");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->query("set character_set_client = utf8");           // D1
$mysqli->query("set character_set_results = utf8");         // D2
$mysqli->query("set character_set_connection = utf8");      // D3

?>