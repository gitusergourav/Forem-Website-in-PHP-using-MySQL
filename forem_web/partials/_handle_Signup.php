<?php
    $showError = "false";
    $showAlert = False;
    require "_connection.php";

    $user_email = $_POST['signup_email'];
    $user_password = $_POST['signup_password'];
    $user_cpassword = $_POST['signup_cpassword'];


    // Check whether the email is exist or not
    if(strlen($user_email)>0 and strlen($user_password)>0 and strlen($user_cpassword)>0)
    {
    
        $sql = "SELECT * FROM `users` WHERE  `user_email` = '$user_email' ";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0)
        {
            $showError = "Email already in use";
        }
        else
        {
            if($user_password == $user_cpassword)
            {
                $hash = password_hash($user_password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users`(`user_email`,`user_password`) VALUES('$user_email','$hash')";
                $result = mysqli_query($conn,$sql);
                if($result)
                {
                    $showAlert = True;
                    header("location: /forem_web/index.php?signupsuccess=true");
                    exit();
                }
            }
            else
            {
                $showError = "Password does not match.";
            }   
        }
    }
    else
    {
        $showError = "All fields are required!";
    }
    header("location: /forem_web/index.php?signupsuccess=false&error=$showError");

?>