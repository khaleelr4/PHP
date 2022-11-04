<?php require APPROOT . '/views/includes/header.php'?>
<!-- include the default style -->
<link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/contact.css">
</head>
  <body>
    <?php require APPROOT . '/views/includes/loader.php'?>
    <div class="container-fluid">
        <!-- notification container -->
        <div class="notification-container <?=NOTIFICATION_POSITION?>"></div>
        <!-- preheader -->
        <?php require APPROOT . '/views/includes/preheader.php'?>
        <!-- header -->
        <?php require APPROOT . '/views/includes/navigation.php'?>
        <!-- build the contact form -->
        <div class="container">
        <!-- contact us heading -->
        <div id="contact_head" class="alert alert-light" role="alert">
            <div class="d-flex justify-content-center">
                <i class="fa fa-moon-o fa-lg" aria-hidden="true"></i>
                &nbsp;
                <i class="fa fa-chevron-right fa-lg" aria-hidden="true">Contact Us</i>
            </div>
        </div>
        <!-- contact us form -->
        <form id="contact_form" onsubmit="submitcontactform('<?=URLROOT?>'); return false;">
            <div class="row" style="width:100%">
                <div class="col-3">
                    <div class="form-group">
                        <label for="full_name">Enter Your Name</label>
                        <input type="text" id="full_name" class="form-control" name="full_name" placeholder="Full Name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="email">Enter Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="phone">Enter Your Phone</label>
                        <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" placeholder="Enter Your Message" cols="30" rows="10"></textarea>
                </div>
            </div>
            <br>
            <input type="submit" class="btn btn-success" value="Send Message">
        </form>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'?>
<script src="<?=URLROOT?>/public/javascript/contact.js"></script>