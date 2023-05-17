<?php
require 'conn.php';

if(isset($_POST['submit'])){
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    $files = [];
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)) {
            $filename=basename($file_name,$ext);
            $newFileName= time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$newFileName);
            $files[] = $newFileName;
        }
        else {
            array_push($error,"$file_name, ");
        }
    }
    $title = $_POST['title'];
    $images = json_encode($files);
    $sql = "INSERT INTO `gallery`(`title`, `images`) VALUES  ('$title','$images')";
    $result = mysqli_query($con,$sql);
}
