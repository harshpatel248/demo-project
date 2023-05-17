<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="create_photo_gallery.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" />
        <table width="100%">
            <tr>
                <td>Select Photo (one or multiple):</td>
                <td><input type="file" name="files[]" multiple/></td>
            </tr>
            <tr>
                <td colspan="2" align="center">Note: Supported image format: .jpeg, .jpg, .png, .gif</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" id="selectedButton"/></td>
            </tr>
        </table>
    </form>    
    <a href="view_gallery.php">view all</a>
</body>
</html>