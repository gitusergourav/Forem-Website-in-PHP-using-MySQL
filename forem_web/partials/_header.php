<?php
session_start();
include "partials/_connection.php";

echo '<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">StartWithUs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

            
            $sql = "SELECT `category_name`,`category_id` FROM `categories` LIMIT 5";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
              // <li><a class="dropdown-item" href="#">Another action</a></li>
            }


            // <li><hr class="dropdown-divider"></li>
            // <li><a class="dropdown-item" href="#">Something else here</a></li>
            
          echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>';
        if(isset($_SESSION['loggedin']) && isset($_SESSION['loggedin']) == true )
        {
        echo '
          <li class="nav-item">
            <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#categoryModal">Add Category</a>
          </li>';
        }
        echo'
      </ul>';

      
      if(isset($_SESSION['loggedin']) && isset($_SESSION['loggedin']) == true )
      {
        echo'
        <form class="d-flex" method="get" action="search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button> <p class="mt-2 mb-0 mx-1">' .
          $_SESSION['useremail']
          . '</p>
        </form>
        <div class="mx-2">
          <a href="partials/_logout.php" role="button" class="btn btn-outline-success">Log-Out</a>
        </div>';
     }
    else{
        echo '
            <form class="d-flex" method="get" action="search.php">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button> 
            </form> 
            <div class="mx-2"> <button class=" btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal" >Log-In</button>
            <button class=" btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Sign-Up</button>
            </div>';
     }

      echo '
    </div>
  </div>
</nav>';

include "partials/_loginModal.php";
include "partials/_signupModal.php";
include "partials/_addCategory.php";

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] =='true')
{
  echo'<div class=" mb-0 alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Use Can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] =='false')
{
  echo '<div class=" mb-0 alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> ' . $_GET['error'] . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
// if(isset($_GET['error']))
// {
//   echo '<div class=" mb-0 alert alert-danger alert-dismissible fade show" role="alert">
//   <strong>Error!</strong> ' . $_GET['error'] . '
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }
else if(isset($_GET['loginsuccess']) && isset($_GET['loginsuccess'])=='true')
{
  echo'<div class=" mb-0 alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Login Successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
<?php
  if($showSuccess)
  {
    echo '
    <div class=" mb-0 alert alert-success alert-dismissible fade show" role="alert">
      <strong>Successfull!</strong> ' . $showSuccess . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
  }
?>
