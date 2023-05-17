<?php 

$con = mysqli_connect('localhost','root','','slider');

if(!$con){

    echo 'connection error'.mysqli_connect_error();
}

?>