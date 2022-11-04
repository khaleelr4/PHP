<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- default styling -->
    <link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/default.css">
    <!-- preheader -->
    <link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/preheader.css">
    <!-- navigation -->
    <link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/navigation.css">
    <!-- footer -->
    <link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/footer.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="<?=URLROOT?>/public/img/tabicon.png">
    <!-- Add the Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?=URLROOT?>/public/javascript/bismillahaudio.js"></script>
    <!-- Add the Globals -->
    <script src="<?=URLROOT?>/public/javascript/globals.js"></script>
    <!-- loader css -->
    <link rel="stylesheet" href="<?=URLROOT?>/public/css/loader.css">
    <!-- splash css -->
    <link rel="stylesheet" href="<?=URLROOT?>/public/css/splash.css">
    <!-- login script -->
    <script src="<?=URLROOT?>/public/javascript/login.js"></script>
    <title><?=$data['view']?> - Madani Beacon</title>
    
    <?php
      // init the session before any DOM is rendered.
      $session_helper = new SessionHelper();
    ?>