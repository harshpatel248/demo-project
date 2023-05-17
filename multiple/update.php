<?php
require 'conn.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $sql = "SELECT * FROM `gallery` WHERE id=".$_GET['id'];
    $result =mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <form action="update_images.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" value="<?php echo $row['title']; ?>" name="title">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">file</label>
            <input type="file" class="form-control" name="file">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">multi</label>
            <input type="file" class="form-control" name="images[]" multiple>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
        </div>
        <div>
            <input type="submit" name="submit" value="submit" class="btn btn-success">

        </div>

    </form>
</body>

</html>
<?php 
}else{
    echo '404';
}
?>