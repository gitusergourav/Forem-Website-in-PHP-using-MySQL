<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/_style_for_footer.css">

    <title>StartWithUs- Coding Forem</title>
  </head>
  <body>
    <?php include "partials/_header.php"; ?>
    <?php
        require "partials/_connection.php";
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM `threads` WHERE `thread_id` = $id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $thread_title =  $row['thread_title'];
            $thread_Desc =  $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];

            // Query for fetching name of posted by question from the database
            $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`='$thread_user_id' ";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
        }
    ?>

    <!-- For Welcome container for particular cateogry -->

    <div class="container">
        <div class="alert alert-secondary mt-2" role="alert">
            <h4 class="alert-heading"><?php echo $thread_title;?></h4>
            <p><?php echo $thread_Desc;?></p>
            <hr>
            <p class="mb-0"><b>Rules</b></p>
            <p>No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
            <p>Posted by : <b><?php echo $posted_by; ?></b></p>
            <!-- <p>Posted by : <em><?php echo $posted_by; ?></em></p> -->
        </div>
    </div>


    <?php
        $method = $_SERVER['REQUEST_METHOD'];
        $showAlert = False;
        $showError = False;
        if($method == 'POST')
        {
            if(isset($_POST['post_comment']))
            {

                $comment = $_POST['comment'];

                $comment = str_replace('<','&lt;',$comment);
                $comment = str_replace('>','&gt;',$comment);
                
                $user_id = $_SESSION['user_id'];
                
                if($comment == "")
                {
                    $showError = "Fields are empty";
                }
                else
                {
                    // Inserting into database
                    $sql = "INSERT INTO `comments`(`comment_content`,`thread_id`,`comment_by`) VALUES('$comment','$id','$user_id')";
                    $result = mysqli_query($conn,$sql);
                    if($result)
                    {
                        $showAlert = True;
                    }
                }
            }
        }
    ?>
    
    <!-- For thread comments -->
    <div class="container">
        <h1 class="py-2">Post a Comment</h1>

        <?php
            if($showAlert)
            {
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Comment has been added
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            if($showError)
            {
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> Missing!</strong> ' . $showError . '.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        ?>
    <?php
    if(isset($_SESSION['loggedin']) && isset($_SESSION['loggedin']) == true )
    {
        echo '
        <form action=" ' . $_SERVER['REQUEST_URI'] . ' " method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Type your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="user_id" value=' . $_SESSION['user_id'] . '>
            </div>
            <button type="submit" class="btn btn-outline-success mb-2" name="post_comment">Post Comment</button>
        </form>';
        
    }
    else
    {
        echo '
        <div class="alert alert-warning" role="alert">
            <div class="lead">
            You are not logged in ! Please Log-in to post a comments
            </div>
        </div>';
    }
    ?>



        
    </div>

    <!-- For thread questions -->

    <div class="container" id="ques">
        <h1 class="py-2">Discussion</h1>
        
        <?php
            require "partials/_connection.php";
            $id = $_GET['thread_id'];
            $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id";
            $result = mysqli_query($conn,$sql);
            $noResult = True;
            while($row = mysqli_fetch_assoc($result))
            {
                $noResult = False;
                $comment_id =  $row['comment_id'];
                $content =  $row['comment_content'];
                $posted_date = $row['comment_time'];
                $comment_by = $row['comment_by'];

                $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`='$comment_by' ";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '
                <div class="media my-3">
                    <img class="mr-3" src="img/4.jpg" width="55px" height="50px" alt="...">
                    <div class="media-body">
                        <h6 class="mt-0"> Posted by : <b>' . $row2['user_email'] . '</b><br> at ' . $posted_date . '</h6>
                        ' . $content . '
                    </div>
                </div>';
             }
             if($noResult)
             {
                echo '
                <div class="alert alert-secondary" role="alert">
                   <p class="alert-heading fs-1">No Comments Found </p>
                   
                   <hr>
                   <p class="mb-0">Be the first person to start a discussion</p>
                </div>';
             }
        ?> 
    </div>















    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
    <?php include "partials/_footer.php"; ?>
  </body>
</html>