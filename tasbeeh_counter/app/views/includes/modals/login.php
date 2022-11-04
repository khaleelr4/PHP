<!-- Login Modal -->
<div id="login_modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Login Modal Header -->
            <div class="modal-header">
                <!-- modal title -->
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- login modal body -->
            <div class="modal-body">
                <form action="#">
                    <div class="form-group">
                        <label  for="login_email" class="form-label">Enter Email</label>
                        <input id="login_email" type="email" class="form-control" placeholder="Email Address" aria-describedby="email_help">
                        <div id="email_help" class="form-text"><?=Email_Help?></div>
                    </div>
                    <div class="form-group">
                        <label for="login_password" class="form-label">Enter Password</label>
                        <input id="login_password" type="password" class="form-control" placeholder="Password" aria-describedby="password_help">
                        <div id="password_help" class="form-text"><?=Password_Help_Login?></div>
                    </div>
                </form>
                <a href="<?=URLROOT?>/home/register" class="link-primary">Not a Member? Sign Up Here</a>
            </div>
            <!-- login modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="SubmitLogin('<?=URLROOT?>')">Sign In</button>
            </div>
        </div>
    </div>
</div>