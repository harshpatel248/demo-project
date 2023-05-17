<?php
require 'conn.php';
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    //image
    $strfilename = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $strfilename);
    $file = $strfilename;
    //multiple
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
    $imageList = json_encode($image);
    $sql = "INSERT INTO `gallery`(`title`, `file`, `images`) VALUES  ('$title', '$file', '$imageList')";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">file</label>
            <input type="file" class="form-control" name="file">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">multi</label>
            <input type="file" class="form-control" name="images[]" multiple>
        </div>
        <div>
            <input type="submit" name="submit" value="submit" class="btn btn-success">

        </div>

    </form>
</body>

</html>