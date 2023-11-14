<?php

date_default_timezone_set('Europe/Vienna');

  if (isset($_POST["submit"])) {

    //Variablen für Bildbenennung
    $jetzt = date('Ymd-Hi');
    $uploaddir = "../img/mglportraits";
    $mglbild = $_FILES['mglbild']['tmp_name'];
    if ($_FILES['mglbild']['size']>0) {
      $bildname = $_POST["mglnachname"]."_".$_POST["mglvorname"]."_".$jetzt.".jpg";
    }else{
      $bildname = "leer.jpg";
    }


    $mitglied = [
      'mglvorname' => $_POST["mglvorname"],
      'mglnachname' => $_POST["mglnachname"],
      'mglgebdatum' => $_POST["mglgebdatum"],
      'mgladresse' => $_POST["mgladresse"],
      'mglplz' => $_POST["mglplz"],
      'mglort' => $_POST["mglort"],
      'mglmail' => $_POST["mglmail"],
      'mglbeginn' => $_POST["mglbeginn"],
      'mglaktiv' => $_POST["mglaktiv"],
      'mglende' => $_POST["mglende"],
      'mglbild' => $bildname
    ];

      $sql = "INSERT INTO mitglieder (mglvorname,mglnachname,mglgebdatum,mgladresse,mglplz,mglort,mglmail,mglbeginn,mglaktiv,mglende,mglbild) VALUES (:mglvorname,:mglnachname,:mglgebdatum,:mgladresse,:mglplz,:mglort,:mglmail,:mglbeginn,:mglaktiv,:mglende,:mglbild)";
      $stmt= $DB->prepare($sql);
      $stmt->execute($mitglied);

      // echo '<pre>'; // GET und POST ausgeben
      // echo "letzte mglid = " .$id."<br>";
      // print_r( $_GET );
      // print_r( $_POST );
      // print_r( $_FILES );
      // echo '</pre>';

  // Prüfung ob Dateiendung passt und neuen Dateinamen setzen
  //Dann prüfen ob Dateiendung passt und Datei umbenennen und in Ordner uploaden
      if ($_FILES['mglbild']['size']>0) {
        $dateimime1 = mime_content_type($mglbild);         // statt obere Zeile
        //echo $dateimime1."<br>";
        $dateiname1 = $bildname;
        if($dateimime1 == 'image/gif' || $dateimime1 == 'image/jpeg' || $dateimime1 == 'image/png' || $dateimime1 == 'image/bmp'){
          move_uploaded_file($mglbild,$uploaddir."/".$dateiname1);
        }else{
          echo "Dateiendung von Datei 1 falsch!<br>";
        }
      }

  //Thumbnail für Mitglieder erstellen und speichern
  if ($_FILES['mglbild']['size']>0) {
  $_pic_src = $uploaddir."/".$bildname;
  $_im_ziel = $uploaddir."/thumb_".$bildname;
  $_br = 50;
  $_ho = 50;
  $_qual = 75;

  $_size = getimagesize($_pic_src);
  $_pic_src_x = $_size[0];
  $_pic_src_y = $_size[1];

  if ($dateimime1 == 'image/gif'):
    $_im_src = ImageCreateFromGIF ($_pic_src);
  elseif ($dateimime1 == 'image/jpeg'):
    $_im_src = @imagecreatefromjpeg ($_pic_src);
  elseif ($dateimime1 == 'image/png'):
    $_im_src = ImageCreateFromPNG ($_pic_src);
  elseif ($dateimime1 == 'image/bmp'):
    $_im_src = imagecreatefrombmp ($_pic_src);
  endif;

  if ($_im_src) {
    $_im_dst = imagecreatetruecolor($_br, $_ho);
    if ($_im_dst) {
      $_x_verschiebung = 0;
      $_y_verschiebung = 0;
      $_x_breite = $_pic_src_x;
      $_y_hoehe = $_pic_src_y;

      if ($_pic_src_x > $_pic_src_y) {
        # Breite größer als Höhe, nach Höhe richten
        $_x_breite = $_y_hoehe;
        $_x_verschiebung = ($_pic_src_x - $_y_hoehe) / 2;
        }

        if ($_pic_src_y > $_pic_src_x) {
          # Höhe größer als Breite, nach Breite richten
          $_y_hoehe = $_x_breite;
          $_y_verschiebung = ($_pic_src_y - $_x_breite) / 2;
        }

        @imagecopyresized($_im_dst,$_im_src,0,0,$_x_verschiebung,$_y_verschiebung,$_br,$_ho,$_x_breite,$_y_hoehe);
        //@imagerectangle( $_im_dst, 0, 0, $_br-1, $_ho-1, 0 );
        @imagejpeg($_im_dst, $_im_ziel, $_qual);
      }
      else
      {
      @imagedestroy($_im_src);
      }
    }
  }

?>

<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-12 mt-3">
      <div class="alert alert-success" role="alert">
        <button data-dismiss="alert" class="close" type="button">x</button>
        <p>Neues Mitglied wurde hinzugefügt!<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...du wirst weitergeleitet...
        </p>
      </div>
      <div style="height: 10px;">&nbsp;</div>
    </div>
  </div>
</div>

<script>
// Angabe in Millisekunden (10000 = 10 Sekunden)
window.setTimeout("location.href='mitglieder.php';", 3000);
</script>

<?php
  }
    ?>
