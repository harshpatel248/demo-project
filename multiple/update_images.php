<?php 
require 'conn.php';
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM `gallery`";
    $result =mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    $str = [];
    if(!empty($_FILES['file']['name'])){
        $strfilename = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $strfilename);
        $str[] = "`file` = '".$strfilename."'";
        unlink('uploads/'.$row['file']);
    }
 
    if(!empty($_FILES['images']['name'])){
        $countfiles = count($_FILES['images']['name']);

        $valid_extensions = array("jpg", "jpeg", "png");
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['images']['name'][$i];

            ## Location
            $location = "uploads/" . $filename;
            $extension = pathinfo($location, PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            ## File upload allowed extensions

            $response = 0;
            ## Check file extension
            if (in_array(strtolower($extension), $valid_extensions)) {
                ## Upload file
                if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $location)) {
                    $image[] = $filename;
                }
            }
        }
        if(!empty($image)){
            $imageList = json_encode($image);
            $str[] = "`images` = '".$imageList."'";
        }
        $deleteList = json_decode($row['images']);
        foreach($deleteList as $d){
            unlink('uploads/'.$d);
        }
    }
    $updateString = '';
    if(!empty($str)){
        $updateString = implode(',', $str); 
        $updateString = ','.$updateString;
    }
   
    $sql = "UPDATE `gallery` SET title = '".$_POST['title']."'". $updateString." WHERE id = '".$id."'";
    $result =mysqli_query($con,$sql);
}
?>