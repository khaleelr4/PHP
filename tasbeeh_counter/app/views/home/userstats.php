<?php require APPROOT . '/views/includes/header.php'?>
<!-- include the default style -->
<link rel="stylesheet" type="text/css" href="<?=URLROOT?>/public/css/stats.css">
<script>
  const urlroot = '<?=URLROOT?>';
</script>
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
          <div class="container">
              <h1 id="title" class="display-4 text-center text-white">
                My Stats
              </h1>
              <ol id="ayat_stat_list" class="list-group list-group-numbered">
                  <?php foreach($data[0] as $ayat_stat){?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?=$ayat_stat['ayat_name']?></div>
                            <?=$ayat_stat['ayat_description']?>
                        </div>
                        <span class="badge bg-primary rounded-pill">
                          <span id="ayat_count_<?=$ayat_stat['id']?>">
                            <?=$ayat_stat['ayat_counts']->ayat_counts > 0 ? $ayat_stat['ayat_counts']->ayat_counts : 0?>
                          </span>
                        </span>
                    </li>
                  <?php }?>
              </ol>
          </div>
        </div>
      </div>
<script src="<?=URLROOT?>/public/javascript/user_stats.js"></script>
<?php require APPROOT . '/views/includes/footer.php'?>