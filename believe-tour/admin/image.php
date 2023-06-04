<?php
require_once 'conn.php';

if(isset($_POST['submit'])){
    $title = $_POST['title'];

    $countfiles = count($_FILES['file']['name']);

    $totalFileUploaded = 0;
    for($i=0;$i<$countfiles;$i++){
         $filename = $_FILES['file']['name'][$i];

         ## Location
         $location = "uploads/".$filename;
         $extension = pathinfo($location,PATHINFO_EXTENSION);
         $extension = strtolower($extension);

         ## File upload allowed extensions
         $valid_extensions = array("jpg","jpeg","png","pdf","docx");

         $response = 0;
         ## Check file extension
         if(in_array(strtolower($extension), $valid_extensions)) {
              ## Upload file
              if(move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$filename)){
                    $image[] = $filename;

              }
         }

    }
    $image = json_encode($image);
    // print_r($image);die;
    $sql = "INSERT INTO `package` (`title`,`image`) values ('$title','$image') ";
    $result = mysqli_query($con,$sql);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="#" method="post" enctype="multipart/form-data">
<input class="form-control" type="text" name="title"  placeholder="Enter Package Title"> <br>   
Select Image Files to Upload:
    <input type="file" name="file[]" id="file" multiple>
    <input type="submit" name="submit" value="UPLOAD">
</form>

<table>
    <tr>
        <th>title</th>
        <th>image</th>
        </tr>
    <?php 
        $sql ="SELECT * from `package` ";
        $result =mysqli_query($con,$sql);

        while($row =mysqli_fetch_assoc($result)){
                   $images = json_decode($row['image']);
                //    print_r($images);die;

                   foreach($images as $image){ ?>
                        <img src="uploads/<?php echo $image ?>" height="50" width="50">          
       <?php   } }?>
       <td>
                            <a href='update_package.php?update=".$id."' class='btn btn-primary btn-sm'>Update</a>
                            
                            </td>
</table>
</body>
</html>