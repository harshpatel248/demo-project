<?php 
    require 'con.php';

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];

        $sql = "SELECT * FROM `emp` WHERE id=".$id;
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $hobby = $row['hobby'];
        $dob = $row['dob'];

        if(isset($_POST['submit'])){

            $_POST['hobby'] = implode(',',$_POST['hobby']);
            $fname = $_POST['name'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $hobby = $_POST['hobby'];

            if(!empty($_FILES['image']['name'])) {
                
                $name=time();
                $strfilename = $_FILES['image']['name'];
                $arrfilename = explode('.', $strfilename);
                $arrfileextension = end($arrfilename);
                $strfilename = $name .'.'.$arrfileextension;
                move_uploaded_file($_FILES['image']['tmp_name'], 'upload/'.$strfilename);
                $image = $strfilename;
            }
            else{
                $image=trim($_POST['oldImage']);
            }

            $sql =  "UPDATE `emp` SET name ='$fname', email='$email', password='$password',gender='$gender',hobby='$hobby',dob='$dob',image='$image' where id=".$id;
                // echo $sql;die;
            $result = mysqli_query($con,$sql);

            if($result){
                header("location:display.php");
            }
            

        }

    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee CRUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <style>
         .error {
      color: red;
    
   }
    </style>

</head>

<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">
                Employee crud
            </div>
        </div>
    </div>
    <div class="container py-3">
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="<?php echo $name;?>">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo $email?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="male" <?php if($gender == 'male'){echo 'checked';}?>>
                    male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female" <?php if($gender == 'female'){echo 'checked';}?>>
                    <label class="form-check-label" for="flexRadioDefault2">
                        female
                    </label>
                </div>
                <div>
                        <label for="gender" class="error"></label>
                </div>
            </div>
            <div class="form-group">
                <label for="control-label ">Hobby</label>
                <div class="form-check">
                    <label class="checkbox-inline"><input type="checkbox" name="hobby[]" value="gaming" <?php if(strpos($row['hobby'], 'gaming') !== false){ ?> checked <?php }?>   >
                        gaming</label>
                    <label class="checkbox-inline"><input type="checkbox" name="hobby[]" value="chess" <?php if(strpos($row['hobby'],'chess') !== false){ ?> checked <?php }?> >
                        chess</label>
                    <label class="checkbox-inline"><input type="checkbox" name="hobby[]" value="cricket" <?php if(strpos($row['hobby'],'cricket') !== false){ ?> checked <?php }?>>
                        cricket</label>
                </div>
                <div>
                        <label for="hobby[]" class="error"></label>
                </div>
            </div>

            <div class="form-group">
                    <label class="control-label">DOB:</label>
                    <div class="input-group date form-check" class="datepicker" data-provide="datepicker">
                        <input type="text" class="form-control" name="dob" class="datepicker" id="datepicker" value="<?php echo $dob;?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                   
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">image</label>
                <input type="file" class="form-control" name="image" id="image" onchange="showMyImage(this)" >
                <input type="hidden" name="oldImage" value="<?php echo $row['image'];?>" >
                <img id="thumbnil" style="width:20%; margin-top:10px;" alt="image" src="upload/<?php  echo $row['image']; ?>">
            </div>
                

            <input type="submit" class="btn btn-primary" name="submit" value="submit">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
   <script>
 $(function() {
  $("#form").validate({

    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      gender:{ required:true },
      'hobby[]':{ 
        required:true,
        maxlength:3,
    },
    dob: "required",
    // image:{
    //         	required:true,
    //         	// uploadfile:true,
    //         	accept: "jpg,png,jpeg,gif",
    //         },

    },
    // Specify validation error messages
    messages: {
      name: "Please enter your name",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address",
      gender:
          {
            required:"Please select a gender<br>",
          },
          'hobby[]':
          {
            required:"Please select a hobby<br>",
            maxlength:"check one or more checkboz",
          },
          dob: "Please enter your date",
        //   image:{
        // 		required:"upload image",
        // 		// uploadfile:"upload image",
        // 		accept:"upload image only jpg,jpeg,png ",
        // 	},

          

          
    },
    
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
    
  });
});
   </script>
   
   
   <script>
        $(document).ready(function() {
          
          $(function() {
              $( "#datepicker" ).datepicker();
          });
      })



      function showMyImage(fileInput) {
var files = fileInput.files;
for (var i = 0; i < files.length; i++) {
var file = files[i];
var imageType = /image.*/;
if (!file.type.match(imageType)) {
continue;
}
var img=document.getElementById("thumbnil");
img.file = file;
var reader = new FileReader();
reader.onload = (function(aImg) {
return function(e) {
aImg.src = e.target.result;
};
})(img);
reader.readAsDataURL(file);
}
}
    </script>
</body>

</html>