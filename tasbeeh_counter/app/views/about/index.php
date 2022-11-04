<?php require APPROOT . '/views/includes/header.php'?>
<!-- include the default style -->
<link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/about.css">
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
          <div class="container">
              <div id="about_head" class="alert alert-light" role="alert">
                <div class="d-flex justify-content-center">
                    <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    &nbsp;
                    <i class="fa fa-chevron-right fa-lg" aria-hidden="true">About</i>
                </div>
              </div>
              <div id="aboutscroll">
                <center><h1>About US</h1></center><br>
                  <ol>
                    <h2><li>Where are we located?</li></h2>
                    <h4>Pakistan Lahore.</h4><br>

                    <h2><li>Is this Website only specific for Counter Related Prayer Model?</li></h2>
                    <h4><b>Yes</b>, we made this website solely for this purpose as a service to our people for the Good deeds.</h4><br>

                    <h2><li>Will our Potential Customers be able to get the Updates related to our Projects?</li></h2>
                    <h4><b>Yes</b>, Our Team is working to their best potential to keep the customers updated.</h4><br>

                    <h2><li>Will you add new Features to the website?</li></h2>
                    <h4><b>Yes</b>, with the passage of time you'll get updated about of our any new Project.</h4><br>

                    <h2><li>If you like the Ideology of this Website and you wanna see it grow more to reach out to millions of users. How can you contribute to this work?</li></h2>
                    <h4>You can Contribute to this website by giving you feedback in the Contact us Section of our website and if you wanna support us financially you can go to our Patreon and show your love to our efforts.</h4><br>

                    <h2><li>There are limited number of Azkars in our website? Will this content grow more or be limited?</li></h2>
                    <h4>Our team is working on the contents of our website and you'll see more new azkars in our website and then you'll enjoy more on this website. Keep in touch with our Social Media Contents and keep supporting Us</h4><br>
                  </ol>
              </div>
          </div>
      </div>
<?php require APPROOT . '/views/includes/footer.php'?>