<?php
require 'conn.php';

$sql = "SELECT * FROM `gallery` WHERE id = '".$_GET['id']."'";
$result =mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);

$imageList = json_decode($row['images']);
// print_r($imageList);
// print_r( array_keys( $imageList, $_GET['name']));die;
$name = $_GET['name'];
$key = (array_search($name, $imageList));
unset($imageList[$key]);
$images = json_encode($imageList);
print_r($images);
die;