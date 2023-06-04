<?php 
session_start();

//database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "believe";

$con = mysqli_connect($servername,$username,$password,$database);

if(!$con){
	echo "Connection Failed";
}


 ?>