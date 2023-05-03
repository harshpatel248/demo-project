<?php 
    require 'con.php';
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = 'DELETE FROM `emp` where id='.$id;
    $result = mysqli_query($con,$sql);

    if($result){
        header('location:display.php');
    }
}

?>