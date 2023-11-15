<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

if($_SESSION['role']!="SUPERADMIN" && $_SESSION['role']!="ADMIN"){
  echo '<META HTTP-EQUIV="Refresh" Content="2; URL=../">';
}

if(isset($_POST['senden'])){
  // Ansicht
  if(isset($_POST['preinc'])){
    $preincneu = 1;
  }else{
    $preincneu = 2;
  }
  if(isset($_POST['config'])){
    $configneu = 1;
  }else{
    $configneu = 2;
  }
  // Berechtigungen
    // Elektotechnik Lagerverwaltung
    $gr_eelager = strtoupper($_POST['gr_eelager']);
    $gr_eelager = explode(',', $gr_eelager);
    $gr_eelager = array_map('trim', $gr_eelager);
    $anz_gr_eelager = count($gr_eelager);

    //echo $gr_eelager[0].$gr_eelager[1];

    $anz_gr_eelager >= 1 ? $gr_eelagerstrg = $gr_eelager[0] : '';
    $anz_gr_eelager > 1 ? $gr_eelagerstrg .= ', '.$gr_eelager[1] : '';
    $anz_gr_eelager > 2 ? $gr_eelagerstrg .= ', '.$gr_eelager[2] : '';
    $anz_gr_eelager > 3 ? $gr_eelagerstrg .= ', '.$gr_eelager[3] : '';
    $anz_gr_eelager > 4 ? $gr_eelagerstrg .= ', '.$gr_eelager[4] : '';


  // Developerinfos
  if(isset($_POST['drucker1einaus'])){
    $drucker1einaus = 1;
  }else{
    $drucker1einaus = 0;
  }
  if(isset($_POST['drucker2einaus'])){
    $drucker2einaus = 1;
  }else{
    $drucker2einaus = 0;
  }
  
  $ipdrucker1 = $_POST['ipdrucker1'];
  $ipdrucker2 = $_POST['ipdrucker2'];

  $configtext = file_get_contents('../assets/inc/config.ini');

  // Ansicht
  $configtext = str_replace('preinc = ' . $CONFIG['ansicht']['preinc'] , 'preinc = ' . $preincneu , $configtext);
  $configtext = str_replace('config = ' . $CONFIG['ansicht']['config'] , 'config = ' . $configneu , $configtext);
  // Berechtigungen
  $configtext = str_replace('gr_eelager = "' . $CONFIG['gruppe']['gr_eelager'] . '"', 'gr_eelager = "' . $gr_eelagerstrg . '"', $configtext);
  // Developer Info
  $configtext = str_replace('drucker1einaus = ' . $CONFIG['druckerein']['drucker1einaus'] , 'drucker1einaus = ' . $drucker1einaus , $configtext);
  $configtext = str_replace('drucker2einaus = ' . $CONFIG['druckerein']['drucker2einaus'] , 'drucker2einaus = ' . $drucker2einaus , $configtext);
  $configtext = str_replace('ipdrucker1 = "' . $CONFIG['druckerip']['ipdrucker1'] . '"', 'ipdrucker1 = "' . $ipdrucker1 . '"' , $configtext);
  $configtext = str_replace('ipdrucker2 = "' . $CONFIG['druckerip']['ipdrucker2'] . '"', 'ipdrucker2 = "' . $ipdrucker2 . '"' , $configtext);
  file_put_contents('../assets/inc/config.ini', $configtext);

  $_SESSION['alert-class'] = "alert-success";
  $_SESSION['message'] = "Änderung wurde gespeichert!";
  $_SESSION['alert-icon'] = $alert_yes;
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./einstellungen.php">'; 
}

?>

<?php include "../assets/templates/05_scripte_head.php"; ?>

<title>DIR-AH - Einstellungen</title>

<body onload="load()">

  <div class="wrapper">

    <?php include "../assets/templates/06_sidebar_start.php"; ?>

    <!-- Page Content Holder -->
    <div id="content">

      <?php include "../assets/templates/07_topnav.php"; ?>

      <?php 
      if ($CONFIG['ansicht']['preinc'] == 1){
      include "../assets/inc/pre.inc.php"; 
      } ?>

      <div class="container-fluid w-95">
        <div class="jumbotron mt-4">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row bg-light border border-dark">
              <div class="col-12 mt-2">
                <h3>Ansicht:</h3>
              </div>
            </div>
            <div class="row m-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="preinc" <?php if($CONFIG['ansicht']['preinc']==1){echo "checked";}?> >
                  PRE INC einschalten
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="config" <?php if($CONFIG['ansicht']['config']==1){echo "checked";}?> >
                  PRE CONFIG einschalten (ohne Funktion)
                </label>
              </div>
            </div>
            <div class="row bg-light border border-dark">
              <div class="col-12 mt-2">
                <h3>Berechtigungen: (mit Beistrich getrennt, max. 5)</h3>
              </div>
            </div>
            <div class="row m-3">
              <div class="col">
                <div class="form-group">
                  <label for="eelager">Elektrotechnik Lagerverwaltung (GRUPPEN)</label>
                  <input type="text" class="form-control" id="gr_eelager" name="gr_eelager" value="<?=$CONFIG['gruppe']['gr_eelager']?>">
                </div>
              </div>
            </div>
            <div class="row bg-light border border-dark">
              <div class="col-12 mt-2">
                <h3>Developer Info:</h3>
              </div>
            </div>
            <div class="row m-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="drucker1einaus" <?php if($CONFIG['druckerein']['drucker1einaus']==1){echo "checked";}?> >
                  Bondrucker 1 (Speisen) ein/ausschalten
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="drucker2einaus" <?php if($CONFIG['druckerein']['drucker2einaus']==1){echo "checked";}?> >
                  Bondrucker 2 (Schank) ein/ausschalten
                </label>
              </div>
              <div class="form-group mt-3">
                <label for="ipdrucker1">IP für Drucker 1 (Speisen)</label>
                <input type="text" class="form-control" id="ipdrucker1" name="ipdrucker1" value="<?=$CONFIG['druckerip']['ipdrucker1']?>">
              </div>
              <div class="form-group">
                <label for="ipdrucker2">IP für Drucker 2 (Schank)</label>
                <input type="text" class="form-control" id="ipdrucker2" name="ipdrucker2" value="<?=$CONFIG['druckerip']['ipdrucker2']?>">
              </div>
            </div>
            <div class="row bg-light">
              <button type="submit" name="senden" class="btn btn-primary">absenden</button>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>

  <script>

  </script>

  <?php include "../assets/templates/10_footer.php"; ?>

</body>

</html>