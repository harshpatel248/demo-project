<?php
require 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPmailer/src/Exception.php";
require "PHPmailer/src/PHPMailer.php";
require "PHPmailer/src/SMTP.php";
function set_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.clickthedemo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dev@clickthedemo.com'; // SMTP username
    $mail->Password = 'A7{u2d&wE)do'; // SMTP password
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom('dev@clickthedemo.com');

    $mail->addAddress($get_email);
    $mail->isHTML(true);
    $mail->Subject = "Reset Password Notificaton";
    $email_template = "
        <h2>Hello</h2>
        <h3>You are receiving this email because we received a password reset for your account.</h3>
        <br>
        <a href='http://localhost/Harsh/believe-tour/admin/password-change.php?token=$token&email=$get_email'> Reset Password </a>
        ";
    $mail->Body = $email_template;

    $mail->send();
}
if (isset($_POST['password_reset_link'])) {
    $email = $_POST['email'];
    $token = md5(rand());

    $check_email = "SELECT * FROM `user` where email = '". $email ."' LIMIT  1";
    $result = mysqli_query($con, $check_email);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $get_name = $row['username'];
        $get_email = $row['email'];

        $update_token = "UPDATE `user` SET `verify_token` ='$token' WHERE  `email` ='$get_email' LIMIT 1";
        $update_token_result = mysqli_query($con, $update_token);
        // echo $update_token;die;
        if ($update_token_result) {
            set_password_reset($get_name, $get_email, $token);
            $_SESSION['message'] = "We Emailed you password reset link";
            header('location:password-reset.php');
        } else {
            $_SESSION['message'] = "Something went wrong";
            header('location:password-reset.php');
        }

    } else {

        $_SESSION['message'] = "Email ID not Exist";
        header('location:password-reset.php');
    }
}

if (isset($_POST['password_update'])) {

    // print_r($_POST);die;
    $email = $_POST['email'];
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $token = $_POST['password_token'];

    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            $check_token = "SELECT verify_token FROM `user` WHERE verify_token ='$token' LIMIT 1 ";
            $check_token_result = mysqli_query($con, $check_token);
            if (mysqli_num_rows($check_token_result) > 0) {
                if ($new_password == $confirm_password) {
                    $update_password = "UPDATE `user` SET password = '$new_password' WHERE verify_token ='$token' LIMIT 1";
                    $update_password_result = mysqli_query($con, $update_password);
                    if ($update_password_result) {
                        $newtoken = md5(rand());
                        $update_to_new_token = "UPDATE `user` SET  verify_token = '$newtoken' WHERE verify_token ='$token' LIMIT 1";
                        $update_to_new_token_result = mysqli_query($con, $update_to_new_token);


                        $_SESSION['message'] = "Password Updated Successfully";
                        header("location:sign-in.php");

                    } else {
                        $_SESSION['message'] = "Something went wrong";
                        header("location:password-change.php?token=$token&email=$email");

                    }


                } else {
                    $_SESSION['message'] = "Password and confirm password not matching";
                    header("location:password-change.php?token=$token&email=$email");
                }


            } else {
                $_SESSION['message'] = "Invalid token";
                header("location:password-change.php?token=$token&email=$email");

            }


        } else {

            $_SESSION['message'] = "All Fields are mandatory";
            header("location:password-change.php?token=$token&email=$email");
        }


    } else {
        $_SESSION['message'] = "No token available";
        header('location:password-change.php');
    }




}



?>