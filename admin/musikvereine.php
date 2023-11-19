<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

if($rbac->Users->hasRole('Admin', $userid)!=1){
  echo '<META HTTP-EQUIV="Refresh" Content="2; URL=../">';
}

$level = NOTICE; $message=$_SESSION['user'].' - Ist auf Seite Musikvereine'; include '../assets/inc/logfile-end.php';

include "../assets/templates/05_scripte_head.php"; ?>

<!-- <link rel="stylesheet" href="./assets/css/bootstrapcontrol.css"> -->

<!-- Neuen User hinzufügen -->
  <?php
    if (isset($_POST['musik_neu'])) {

      $vereinsname = $_POST['vereinsname'];
      $vereinsnr = $_POST['vereinsnummer'];
      $obmann = $_POST['obmann'];
      $mobil = $_POST['mobil'];
      $email = $_POST["email"];
      $homepage = $_POST["homepage"];

      /* echo "<pre>";
      echo "FILES:<br>";
      print_r ($_FILES );
      echo "</pre>"; */
      
      $sql2 = "INSERT INTO musikvereine (nr,name,obmann,mobil,email,homepage)
      VALUES('$vereinsnr', '$vereinsname', '$obmann', '$mobil', '$email', '$homepage')";
      if(mysqli_query($conn, $sql2)){
        $userid = mysqli_insert_id($conn);
        $rbac->Users->assign($_POST['rolle'], $userid);
        $level = INFO; $message=$_SESSION['user'].' - Hat den Musikverein "'. $vereinsname .'" hinzugefügt'; include '../assets/inc/logfile-end.php';
        $_SESSION['alert-class'] = "alert-success";
        $_SESSION['message'] = "Musikverein wurde erfolgreich hinzugefügt!";
        $_SESSION['alert-icon'] = $alert_yes;
        echo '<META HTTP-EQUIV="Refresh" Content="1; URL=musikvereine.php">';
      } else{
        echo $sql2."\n";
        $level = ERROR; $message=$_SESSION['user'].' - Hinzufügen von Musikverein "'. $vereinsname .'" nicht erfolgreich! - DB Fehler: '.$sql2; include '../assets/inc/logfile-end.php';
        $_SESSION['alert-class'] = "alert-danger";
        $_SESSION['message'] = "Musikverein Eintrag nicht erfolgreich! Datenbank Fehler!";
        $_SESSION['alert-icon'] = $alert_no;
        echo '<META HTTP-EQUIV="Refresh" Content="3; URL=musikvereine.php">';
      }
    }
  ?>
<!-- / Neuen User hinzufügen -->

<!-- User löschen -->
  <?php
    if(isset($_GET['userdelete'])) {
      $userdelete = $_GET['userdelete'];
      $deleteuserfoto = $_GET['u_foto'];
      $delete_id = $_GET['uid'];

      $sql4 = "DELETE FROM user WHERE username ='$_GET[userdelete]'; ";
      if (mysqli_query($conn, $sql4)) {
        if($_GET['u_foto']!=""){
          unlink("userbilder/".$deleteuserfoto);
        }
        $level = INFO; $message=$_SESSION['user'].' - Hat den Benutzer "'. $userdelete .'" gelöscht'; include '../assets/inc/logfile-end.php';
        $_SESSION['alert-class'] = "alert-success";
        $_SESSION['message'] = "User wurde erfolgreich gelöscht!";
        $_SESSION['alert-icon'] = $alert_yes;
        echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
      } else {
        $level = ERROR; $message=$_SESSION['user'].' - Löschen von Benutzer "'. $userdelete .'" nicht erfolgreich! - DB Fehler: '.$sql4; include '../assets/inc/logfile-end.php';
        $_SESSION['alert-class'] = "alert-danger";
        $_SESSION['message'] = "User konnte nicht gelöscht werden!";
        $_SESSION['alert-icon'] = $alert_no;
        echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
      }      
    }
  ?>
<!-- / User löschen -->

<!-- Benutzerrolle löschen -->
    <?php
      if(isset($_GET['roledelete'])){
        $rbac->Users->unassign($_GET['rid'], $_GET['uid']);
      }
    ?>
<!-- / Benutzerrolle löschen -->

<title>Musikvereine</title>

<body>

  <div class="wrapper">

    <?php include "../assets/templates/06_sidebar_start.php"; ?>

    <!-- Page Content Holder -->
    <div id="content">

      <?php include "../assets/templates/07_topnav.php"; ?>

      <?php 
      if ($CONFIG['ansicht']['preinc'] == 1){
      include "../assets/inc/pre.inc.php"; 
      } ?>

      <div class='container-fluid'>

<!-- Alert Messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="row m-1">
              <div class="col-12 mt-2">
                <?php echo $_SESSION['alert-icon']; ?>
              </div>
            </div>
            <div class="row m-1">
              <div class="col-12 mt-2">
                <div class="alert <?php echo $_SESSION['alert-class']; ?> text-center" role="alert">
                  <?php
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                  unset($_SESSION['alert-class']);
                  unset($_SESSION['alert-icon'])
                  ?>
                </div>
              </div>
            </div>
          <?php endif;?>
<!-- /Alert Messages -->

<!-- Überschrift -->
        <div class="row m-1">
          <div class="col-xs-12 bt-3">
            <h1>Musikvereine</h1>
          </div>
        </div>

<!-- Buttons -->
        <!-- <div class="row m-1">
          <div class="col-xs-12 mb-3">
            <?php
            if ($_SESSION['role']=="buero" || $_SESSION['role']=="admin" || $_SESSION['role']=="superadmin") { ?>
              <button type='button' class='btn btn-success text-white' data-toggle='tooltip' title='User hinzufügen'><a href="user_neu.php"><i class='fa fa-plus'></i> User hinzufügen</a></button><?php
            }else{ ?>
              <button type='button' class='btn btn-outline-secondary' data-toggle='tooltip' title='Keine Berechtigung zum hinzufügen!'><i class='fa fa-plus text-secondary'></i> User hinzufügen</button><?php
            }?>
          </div>
        </div> -->

<!-- User hinzufügen Form -->
        <div class="row m-1 mt-4">
          <div class="col-xs-12 mb-2">
            <h3>Musikverein hinzufügen</h3>
          </div>
        </div>

        <form action="" id="needs-validation" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-lg-4">
              <label class="control-label">Vereinsname *</label>
              <input type="text" class="form-control" name="vereinsname" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Vereinsnummer *</label>
              <input type="text" class="form-control" name="vereinsnummer" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Obmann *</label>
              <input type="text" class="form-control" name="obmann" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Mobil Nr.</label>
              <input type="text" class="form-control" name="mobil" placeholder="+43 000 0000000">
            </div>
            <div class="col-lg-4">
              <label class="control-label">E-mail *</label>
              <input type="text" class="form-control" name="email" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Homepage</label>
              <input type="text" class="form-control" name="homepage" placeholder="https://">
            </div>
          </div>

          <div class="form-row">
            <div class="col-9 mb-1">
              <div class="col-2 form-group text-right mt-3 mb-3 float-right"> <!-- Submit Button -->
                <input type="submit" name ="musik_neu" value="Verein eintragen" class="btn btn-primary" id="anzeigen">
              </div>
            </div>
          </div>
        </form>
<!-- / User hinzufügen Form -->

<!-- Musikverein Tabelle -->

        <div class='row m-1'>
          <div class="col-12 p-3 border border-warning table-responsive">
            <table class="datatable table border-top table-hover table-sm">
              <thead>
                <tr class='table-warning'>
                  <th class="text-center" scope='col'>ID</th> <!-- Spalte in ../assets/js/datatable.js ausgeblendet -->
                  <th scope='col'>Verein Nr.</th>
                  <th scope='col' class="sp-l">Verein</th>
                  <th scope='col' class="sp-l">Obmann</th>
                  <th scope='col' class="sp-l">Mobil</th>
                  <th scope='col' class="sp-m">E-Mail</th>
                  <th scope='col' class="sp-m">Homepage</th>
                  <th class="text-center" scope='col'>Aktionen</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM musikvereine ORDER BY nr ASC";
                foreach ($pdo->query($sql) as $row) {
                $m_id = $row['id'];
                $m_nr = $row['nr'];
                $m_name = $row['name'];
                $m_obmann = $row['obmann'];
                $m_mobil = $row['mobil'];
                $m_email = $row['email'];
                $m_homepage = $row['homepage'];
                ?>

                <tr>
                  <td class="align-middle text-center" scope='row'><?= $m_id ?></td>
                  <td class="align-middle"><?= $m_nr ?></td>
                  <td class="align-middle sp-l"><?= $m_name ?></td>
                  <td class="align-middle sp-l"><?= $m_obmann ?></td>
                  <td class="align-middle"><?= $m_mobil ?></td>
                  <td class="align-middle"><?= $m_email ?></td>
                  <td class="align-middle"><?= $m_homepage ?></td>
                  <td class='align-middle text-center'>
                    <button type='button' class='btn btn-secondary btn-sm' data-placement='left' data-toggle='tooltip' title='Eintrag kann nicht gelöscht werden, da noch Rollen vorhanden sind!'><a href='#$u_ID'><i class='fa fa-trash text-white'></i></a></button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include "../assets/templates/10_footer.php"; ?>

  <?php include "../assets/templates/11_datatable.php"; ?>

  <!-- Seitenspezifische Scriptdatei zum anpassen -->
  <script type="text/javascript" src="../assets/js/datatable_mv.js"></script>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>

</body>
</html>