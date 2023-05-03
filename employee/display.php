<?php 
require 'con.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee view</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body>
    <div class="container py-3">
        <a href="index.php" class="btn btn-primary">Add Data</a>   
    </div>
    <div class="container">

        <table class="table table-stripped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Hobby</th>
                <th>Dob</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM `emp`";
            $result =mysqli_query($con,$sql);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $gender = $row['gender'];
                        $hobby = $row['hobby'];
                        $dob = $row['dob'];
                        $image = $row['image'];

                        echo "<tr>
                            <td>".$id."</td>                            
                            <td>".$name."</td>                            
                            <td>".$email."</td>                            
                            <td>".$gender."</td>                            
                            <td>".$hobby."</td>                            
                            <td>".$dob."</td>                            
                            <td><img src=upload/".$image." height='50' width='50' class='rounded-circle'></td>                            
                            <td>
                            <a href='update.php?edit=".$id."' class='btn btn-primary'>Update</a>
                            <a href='delete.php?delete=".$id."' class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>";
                }
            }
            else{

                echo "<tr>
                <td colspan='8'>no data found</td>
                </tr>";
            }

            ?>
        </table>
    </div> 
</body>
</html>