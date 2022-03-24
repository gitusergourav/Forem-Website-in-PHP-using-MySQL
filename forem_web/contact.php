<?php
  include "partials/_connection.php";
  $showMessage = False;
  $showErrorMessage = False;

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['submit']))
    {
      $full_name = $_POST['full_name'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $message = $_POST['message'];

      if(strlen($full_name)>0 and strlen($email)>0 and strlen($contact)>0 and strlen($message)>0)
      {

      
        $sql = "SELECT * FROM `contact` WHERE `email`='$email' AND `contact`='$contact' ";
        $result = mysqli_query($conn,$sql);
        $num_count = mysqli_num_rows($result);
        if($num_count>0)
        {
          $showErrorMessage = "Contact Number and Email already been used";
        }
        else
        {
          $sql1 = "INSERT INTO `contact`(`name`,`email`,`contact`,`message`) VALUES('$full_name','$email','$contact','$message')";
          $result1 = mysqli_query($conn,$sql1);
          if($result1)
          {
            $showMessage = "Thank you for interact with us";
          }
        }
      }
      else
      {
        $showErrorMessage = "All Fields are required";
      }
      
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/_style_for_footer.css">
    <title>StartWithUs- Coding Forem</title>
  </head>
  <body>
    <?php include "partials/_header.php"; ?>
    <?php

      if($showMessage)
      {
          echo'
          <div class=" mb-0 alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thank You!</strong> ' . $showMessage . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
      if($showErrorMessage)
      {
          echo'
          <div class=" mb-0 alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> ' . $showErrorMessage . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
    ?>
    <div class="container" id="ques">
     
      <form class="mt-5" method="post" action="contact.php">
          <div class="mb-3">
              <label for="full_name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="full_name" name="full_name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
              <label for="contact" class="form-label">Phone</label>
              <input type="text" class="form-control" id="contact" name="contact" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <?php include "partials/_footer.php"; ?>
  </body>
</html>