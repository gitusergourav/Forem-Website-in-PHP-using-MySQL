<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log-In to iDiscuss</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action="partials/_handle_login.php" method="post">
        <div class="modal-body">
            <div class="mb-3">
                <label for="login_email" class="form-label">Username</label>
                <!-- <input type="email" class="form-control" id="login_email" name="login_email" aria-describedby="emailHelp"> -->
                <input type="text" class="form-control" id="login_email" name="login_email" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.    </div> -->
            </div>
            <div class="mb-3">
                <label for="login_password" class="form-label">Password</label>
                <input type="password" class="form-control" name="login_password" id="login_password">
            </div>
           
            <button type="submit" class="btn btn-primary">Log-In</button>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
    </form>
</div>
</div>
</div>