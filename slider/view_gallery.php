<?php
require 'conn.php';

$sql = "SELECT * FROM `gallery`";
$result =mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['title'].'</td>';
        $images = json_decode($row['images']);
        foreach($images as $image){
            echo '<td><img src="photo_gallery/'.$image.'" height="100" width="100"></td>';
            echo '<td><a href="delete_image.php?id='.$row['id'].'&name='.$image.'">Delete</td>';
            echo '<td><a href="update_image.php">Update</td>';
        }
    }
}