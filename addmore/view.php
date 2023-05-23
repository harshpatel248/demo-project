<?php
//Database connection file
include('conn.php');
$sql = "SELECT * FROM `addmore`";
$result = mysqli_query($con, $sql);

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
            <form name="add_name" action="update.php" id="add_name" method="post" enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                        <?php $i = 0;
                        while($row = mysqli_fetch_assoc($result)){  ?>
                        <tr>
                            <td><input type="text" name="name[<?php echo $i; ?>]" value="<?php echo $row['name']; ?>" />
                            <input type="hidden" name="id[<?php echo $i; ?>]" value="<?php echo $row['id']; ?>" />
                        </td>
                            <td><img src="<?php echo $row['image']; ?>" height="100" width="100" /><input type="file" name="image[<?php echo $i; ?>]" value="<?php echo $row['image']; ?>" class="form-control name_list" /></td>
                        </tr>
                        <?php $i++; } ?>
                    </table>
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>