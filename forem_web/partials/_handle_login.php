<?php
    $showError = "false";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require "_connection.php";
        $login_email = $_POST['login_email'];
        $login_password = $_POST['login_password'];

        $sql = "SELECT * FROM `users` WHERE `user_email`='$login_email' ";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 1)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if(password_verify($login_password,$row['user_password']))
                {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['useremail'] = $login_email;
                    header("location: /forem_web/index.php?loginsuccess=true");
                    exit();
                }
                else
                {
                    $showError = "Incorrect Password";
                    header("location: /forem_web/index.php?error=$showError");

                }
                
            }
            
        }
        else
        {
            $showError = "Incorrect Email Id and Password";
            header("location: /forem_web/index.php?error=$showError");

        }
    }

?>