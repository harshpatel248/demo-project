<?php 
require 'conn.php';


$sql = "SELECT * FROM `gallery`";
$result =mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['title'].'</td>';
        echo '<td><img src="uploads/'.$row['file'].'" height="100" width="100"></td>';
        $images = json_decode($row['images']);
        foreach($images as $image){
            echo '<td><img src="uploads/'.$image.'" height="100" width="100"></td>';
            
        }
        
        echo '<td><a href="update.php?id='.$row['id'].'">Update</td>';
    }
}

?>