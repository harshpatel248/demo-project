<?php
//Database connection file
include('conn.php');

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $image = $_FILES['image']['name'];

    $sql = '';
    foreach ($image as $key => $value) {
        $image = $_FILES['image']['name'][$key];
        $imagepath = 'uploads/' . $image;
        $tmp_name = $_FILES['image']['tmp_name'][$key];
        move_uploaded_file($tmp_name, $imagepath);
        $image = $imagepath;

        $sql .= "INSERT INTO `addmore` (`name`,`image`) VALUES('" . $name[$key] . "','$image');";
    }
    $result = mysqli_query($con, $sql);
}
?>
<html>

<head>
    <title> with JQuery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 align="center">Dynamically Add or Remove input fields in PHP with JQuery</h2><br />
        <div class="form-group">
            <form name="add_name" id="add_name" method="post" enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <td><input type="text" name="name[]" placeholder="Enter your name" class="form-control name_list" /></td>
                            <td><input type="file" name="image[]" class="form-control name_list" /></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Enter your name" class="form-control name_list" /></td><td><input type="file" name="image[]"  class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
</script>

</html>