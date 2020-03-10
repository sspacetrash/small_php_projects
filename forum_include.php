<?php
function openDB(){
	global $conn;
$serverName = "pippin.ee.kent.ac.uk";
$connectOptions = array("database" => "hn92", "UID" => "hn92", "PWD" => "sM{y:o/8#Gf5");

//connect to the server and select database 
$conn = sqlsrv_connect($serverName, $connectOptions);

if ($conn == false)
{
echo "Unable to connect.</br>";
die(print_r(sqlsrv_errors(), true));
}

if ($conn == true)
{
echo "connected.</br>";
} 
}
?>