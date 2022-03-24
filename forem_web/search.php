<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="partials/_style_for_footer.css"> -->
    <style>
        #maincontainer{
            min-height:489px;
        }
    </style>
    <title>StartWithUs - Coding Forem</title>
  </head>
  <body>
    <?php include "partials/_header.php"; ?>
    <?php include "partials/_connection.php"; ?>

    
    <div class="container" id="maincontainer">        
        <h1 class="mt-2 mx-2">Search Result for <em>"<?php echo $_GET['search'];?>"</em></h1>

        <?php
        $searched_question = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`,`thread_desc`) AGAINST ('$searched_question')";
        $result = mysqli_query($conn,$sql);
        $row_count = mysqli_num_rows($result);
        if($row_count>0)
        {

            while($row = mysqli_fetch_assoc($result))
            {
                $url = "thread.php?thread_id=" . $row['thread_id'];
                echo '
                <div class="result">
                    <h3><a href="' . $url . ' " >' . $row['thread_title'] . '</a></h3>   <!-- class="text-dark" -->
                    <p>' . $row['thread_desc'] . '</p>
                </div>';
            }
        }
        else
        {
            echo '
                 <div class="alert alert-secondary mt-5" role="alert">
                    <p class="alert-heading fs-1 mb-0">No result founds </p>
                    <p class="ms-5">- did not match any documents.</p>
                    <hr>
                    <p class="mb-0">
                    Suggestions:
                    <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                    </ul>
                    </p>
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
    <?php include "partials/_footer.php"; ?>
  </body>
</html>