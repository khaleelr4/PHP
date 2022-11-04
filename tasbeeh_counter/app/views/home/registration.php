<?php require APPROOT . '/views/includes/header.php'?>
<!-- include the default style -->
<link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/registration.css">
</head>
  <body>
    <?php require APPROOT . '/views/includes/loader.php'?>
    <div class="container-fluid">
        <!-- preheader -->
        <?php require APPROOT . '/views/includes/preheader.php'?>
        <!-- header -->
        <?php require APPROOT . '/views/includes/navigation.php'?>
        <!-- notification container -->
        <div class="notification-container <?=NOTIFICATION_POSITION?>"></div>
        <!-- design the form for the registration here -->
        <form id="register_form" action="#" onsubmit="SubmitRegister('<?=URLROOT?>'); return false;">
            <div class="form-group">
                <label for="fullname" class="form-label">Enter Your Name</label>
                <input type="text" id="fullname" class="form-control" placeholder="Full Name">
            </div>
            <br>
            <div class="form-group">
                <label for="email" class="form-label">Enter Email Address</label>
                <input type="email" id="email" class="form-control" placeholder="Email Address" aria-describedby="email_help">
                <div id="email_help" class="form-text"><?=Email_Help?></div>
            </div>
            <br>
            <div class="form-group">
                <label for="phone" class="form-label">Enter Phone</label>
                <input type="number" id="phone" class="form-control" placeholder="Phone Number" aria-describedby="phone_help">
                <div id="phone_help" class="form-text"><?=Phone_Help?></div>
            </div>
            <br>
            <div class="form-group">
                <label for="password" class="form-label">Enter Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" aria-describedby="password_help">
                <div id="password_help" class="form-text"><?=Password_Help_Register?></div>
            </div>
            <br>
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirm Your Password</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password">
            </div>
            <br/>
            <div class="d-grid gap-2">
                <input type="submit" value="Sign Up Now" class="btn btn-outline-primary" />
            </div>
        </form>
    </div>
    <script src="<?=URLROOT?>/public/javascript/register.js"></script>
<?php require APPROOT . '/views/includes/footer.php'?>