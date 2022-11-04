<?php require APPROOT . '/views/includes/splash.php'?>
<?php require APPROOT . '/views/includes/header.php'?>
<!-- include the default style -->
<link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/home.css">
<!-- using the jquery ddslick for the dropdown -->
<script src="<?=URLROOT?>/public/libraries/jquery.ddslick.min.js"></script>
<script>
    const urlroot = '<?=URLROOT?>';
</script>
</head>
  <body>
      <!-- as the autoplay is not supported in many browsers so this sets does the autoplay -->
      <!-- start set -->
      <audio id="bismillah_audio" controls autoplay>
          <source src="<?=URLROOT?>/public/audio/bismillah_audio.mp3" type="audio/mp3">
      </audio>
      <!-- end set -->
      <?php require APPROOT . '/views/includes/loader.php'?>
      <div class="container-fluid">
          <!-- preheader -->
          <?php require APPROOT . '/views/includes/preheader.php'?>
          <!-- header -->
          <?php require APPROOT . '/views/includes/navigation.php'?>
          <!-- notification container -->
          <div class="notification-container <?=NOTIFICATION_POSITION?>"></div>
          <div class="container">
            <!-- screen overlay -->
            <div id="screen_overlay" class="row">
                <!-- counter props -->
                <div class="col-6">
                    <!-- dropdown options -->
                    <div id="ayat_dropdown_div" class="row">
                        <label for="ayat_dropdown" class="text-white">Select Ayats</label>
                        <select id="ayat_dropdown" class="ayat_selector form-select" placeholder="Select Ayat to Recite" aria-label="ayat_select">
                            <?php foreach($data[0]['ayat_array'] as $ayat){?>
                                <option value="<?=$ayat->id?>" data-description="<?=$ayat->ayat_description?>"><?=$ayat->ayat_name?></option>
                            <?php }?>
                        </select>
                    </div>
                    <!-- selected image -->
                    <div class="row">
                        <img id="image_placeholder" src="https://s.clipartkey.com/mpngs/s/248-2485652_quran-islamic-ayat-e-karima-calligraphy.png">
                    </div>
                </div>
                <!-- counter button -->
                <div class="col-6">
                    <div id="counter_container">
                      <h3 id="tasbeeh_counter_label" class="text-white">Start Your Tasbeeh</h3>
                      <button id="tasbeeh_counter" class="counter_btn text-white display-4">0</button>
                    </div>
                </div>
                <!-- audio -->
                <div id="ayat_audio_div" class="row">
                    <audio id="ayat_audio" controls>
                        <source src="" type="audio/mpeg">
                    </audio>
                </div>
            </div>
        </div>
      </div>
<script src="<?=URLROOT?>/public/javascript/home.js"></script>
<script src="<?=URLROOT?>/public/javascript/splash.js"></script>
<?php require APPROOT . '/views/includes/footer.php'?>