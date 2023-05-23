<?php
//Database connection file
include('conn.php');
if (isset($_POST['submit'])) {
    // print_r($_POST);die;
    foreach ($_POST['name'] as $key => $name) {
        $image = '';
        if (isset($_FILES['image']['name'][$key]) && !empty($_FILES['image']['name'][$key])) {
            $image = $_FILES['image']['name'][$key];
            $imagepath = 'uploads/' . $image;
            $tmp_name = $_FILES['image']['tmp_name'][$key];
            move_uploaded_file($tmp_name, $imagepath);
            $image = ', image = "'.$imagepath.'"';
        }
        $sql = 'UPDATE `addmore` SET name = "' . $name . '" '.$image.' WHERE id = "' . $_POST['id'][$key] . '"';
        $result = mysqli_query($con, $sql);
    }
}
