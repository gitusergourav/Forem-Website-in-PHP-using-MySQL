<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign-Up to an StartWithUs Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="partials/_handle_Signup.php" method="post">
        <div class="modal-body">
            <div class="mb-3">
                <label for="signup_email" class="form-label">Username</label>
                <!-- <input type="email" class="form-control" id="signup_email" name="signup_email" aria-describedby="emailHelp"> -->
                <input type="text" class="form-control" id="signup_email" name="signup_email" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
                <label for="signup_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="signup_password" name="signup_password">
            </div>
            <div class="mb-3">
                <label for="signup_cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="signup_cpassword" name="signup_cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Sign-Up</button>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
    </form>
    </div>
  </div>
</div>