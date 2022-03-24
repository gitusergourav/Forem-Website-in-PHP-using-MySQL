<?php
    
    include "partials/_connection.php";
    $showSuccess = False;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        if(isset($_POST['create']))
        {
            $cat_add_name = $_POST['cat_add_name'];
            $cat_add_desc = $_POST['cat_add_desc'];

            if(strlen($cat_add_name)>0 and strlen($cat_add_desc)>0)
            {
                $sql = "INSERT INTO `categories`(`category_name`,`category_description`) VALUES('$cat_add_name','$cat_add_desc')";
                $result = mysqli_query($conn,$sql);
                $showSuccess = "Cateogry Created Successfully";
            }
        }
    }

?>
<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="categoryModalLabel">Create Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <form action="index.php" method="post">
        <div class="modal-body">
            <div class="mb-3">
                <label for="cat_add_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="cat_add_name" name="cat_add_name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="cat_add_desc" class="form-label">Category Description</label>
                <textarea type="text" class="form-control" id="cat_add_desc" name="cat_add_desc"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" name="create">Create</button>
        </div>
    </form>



    </div>
  </div>
</div>