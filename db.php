<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

$con = mysqli_connect($server, $username, $password, $database);

if(!$con){
    echo "No";
}

?>