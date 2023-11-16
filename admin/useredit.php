<?php

error_reporting(E_ALL & ~E_NOTICE);

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

if($rbac->Users->hasRole('Admin', $userid)!=1){
  echo '<META HTTP-EQUIV="Refresh" Content="2; URL=../">';
}

$level = NOTICE; $message=$_SESSION['user'].' - Ist auf Seite Benutzer ändern'; include '../assets/inc/logfile-end.php';

include "../assets/templates/05_scripte_head.php"; 

if(isset($_GET['useredit'])){
  $useredit = $_GET['useredit'];
}

?>
<!-- Neuen User hinzufügen -->
  <?php
    if (isset($_POST['user_edit'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];
      $vorname = $_POST['vorname'];
      $nachname = $_POST['nachname'];
      $email = $_POST["email"];
      $mobil = $_POST["mobil"];
      $whatsappapi = $_POST["whatsappapi"];
      $userfoto = basename($_FILES['userfoto']['name']);
      
      if(($_FILES['userfoto']['tmp_name'] != null)){
      $userfotoext = pathinfo(basename($_FILES['userfoto']['name']), PATHINFO_EXTENSION);
      $uploaddir = 'userbilder/';
      $userfotofile = "userfoto-" . basename($_FILES['userfoto']['tmp_name']) . "." . $userfotoext;
      $userfotouploadfile = $uploaddir . "userfoto-" . basename($_FILES['userfoto']['tmp_name']) . "." . $userfotoext; 
      }

      /* echo "<pre>";
      echo "FILES:<br>";
      print_r ($_FILES );
      echo "</pre>"; */

      if(($_FILES['userfoto']['tmp_name'] != null)){
        if (move_uploaded_file($_FILES['userfoto']['tmp_name'], $userfotouploadfile)) {
            $sql2 = "UPDATE user SET username='$username', password='$password', vorname='$vorname', nachname='$nachname', email='$email', mobil='$mobil', whatsappapi='$whatsappapi', foto='$userfotofile' WHERE username='$useredit'";
            if(mysqli_query($conn, $sql2)){
              $level = INFO; $message=$_SESSION['user'].' - Hat den Benutzer "'. $username .'" geändert'; include '../assets/inc/logfile-end.php';
              $_SESSION['alert-class'] = "alert-success";
              $_SESSION['message'] = "User wurde erfolgreich hinzugefügt!";
              $_SESSION['alert-icon'] = $alert_yes;
              echo '<META HTTP-EQUIV="Refresh" Content="1; URL=user.php">';
            } else{
              echo $sql2."\n";
              $level = ERROR; $message=$_SESSION['user'].' - Ändern von Benutzer "'. $username .'" nicht erfolgreich! - DB Fehler: '.$sql2; include '../assets/inc/logfile-end.php';
              $_SESSION['alert-class'] = "alert-danger";
              $_SESSION['message'] = "User upload nicht erfolgreich! Datenbank Fehler!";
              $_SESSION['alert-icon'] = $alert_no;
              echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
            }
        } else {
            $level = ERROR; $message=$_SESSION['user'].' - Ändern von Bild für Benutzer "'. $username .'" nicht erfolgreich! - Zu große Datei?'; include '../assets/inc/logfile-end.php';
            $_SESSION['alert-class'] = "alert-danger";
            $_SESSION['message'] = "User upload nicht erfolgreich! Zu große Datei?";
            $_SESSION['alert-icon'] = $alert_no;
            echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
        }
      }else{
        $sql2 = "UPDATE user SET username='$username', password='$password', vorname='$vorname', nachname='$nachname', email='$email', mobil='$mobil', whatsappapi='$whatsappapi' WHERE username='$useredit'";
        if(mysqli_query($conn, $sql2)){
          $level = INFO; $message=$_SESSION['user'].' - Hat den Benutzer "'. $username .'" geändert'; include '../assets/inc/logfile-end.php';
          $_SESSION['alert-class'] = "alert-success";
          $_SESSION['message'] = "User wurde erfolgreich hinzugefügt!";
          $_SESSION['alert-icon'] = $alert_yes;
          echo '<META HTTP-EQUIV="Refresh" Content="1; URL=user.php">';
        } else{
          echo $sql2."\n";
          $level = ERROR; $message=$_SESSION['user'].' - Ändern von Benutzer "'. $username .'" nicht erfolgreich! - DB Fehler: '.$sql2; include '../assets/inc/logfile-end.php';
          $_SESSION['alert-class'] = "alert-danger";
          $_SESSION['message'] = "User Eintrag nicht erfolgreich! Datenbank Fehler!";
          $_SESSION['alert-icon'] = $alert_no;
          echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
        }
      }
    }
  ?>
<!-- / Neuen User hinzufügen -->

<title>User Ändern</title>

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
            <h1>User ändern</h1>
          </div>
        </div>
<!-- / Überschrift -->

<!-- User ändern Form -->
        <?php
          $sql = "SELECT * FROM all_roles, all_userroles, user
                    WHERE all_userroles.userID = user.ID
                      AND all_userroles.RoleID = all_roles.ID
                      AND username = '$useredit'";
          $result = mysqli_query($conn, $sql);
          $e = function ($value) {
              return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
          };
          
          foreach ($result as $row):
            $u_ID = $e($row['ID']);
            $u_username = $e($row['username']);
            $u_password = $e($row['password']);
            $u_vorname = $e($row['vorname']);
            $u_nachname = $e($row['nachname']);
            $u_email = $e($row['email']);
            $u_foto = $e($row['foto']); 
            $u_mobil = $e($row['mobil']); 
            $u_whatsappapi = $e($row['whatsappapi']);
            $u_rolle = $e($row['Title']); 
        ?>        
        <form action="" id="needs-validation" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-lg-4">
              <label class="control-label">Benutzername *</label>
              <input type="text" class="form-control" name="username" value="<?=$u_username?>" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Passwort *</label>
              <input type="text" class="form-control" name="password" value="<?=$u_password?>" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Mobilnummer</label>
              <input type="text" class="form-control" name="mobil" value="<?=$u_mobil?>">
            </div>
            <div class="col-lg-4">
              <label class="control-label">Vorname</label>
              <input type="text" class="form-control" name="vorname" value="<?=$u_vorname?>">
            </div>
            <div class="col-lg-4">
              <label class="control-label">Nachname</label>
              <input type="text" class="form-control" name="nachname" value="<?=$u_nachname?>">
            </div>
            <div class="col-lg-4">
              <label class="control-label">Whatsapp-API</label>
              <input type="text" class="form-control" name="whatsappapi"  value="<?=$u_whatsappapi?>">
            </div>
            <div class="col-lg-4 mb-2">
              <label class="control-label">email *</label>
              <input type="mail" class="form-control" name="email" value="<?=$u_email?>" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4 mb-2">
              <label class="control-label">Rolle</label>
                <?php
                  $sql = "SELECT all_userroles.userID, all_userroles.RoleID, all_roles.*, user.ID, user.username FROM all_roles, all_userroles, user
                            WHERE all_userroles.userID = user.ID
                              AND all_userroles.RoleID = all_roles.ID
                              AND username = '$u_username'";
                  foreach ($pdo->query($sql) as $row) { ?>
                    <input value="<?=$row['Title']?> - <?=$row['Description']?>" class="form-control" disabled data-toggle='tooltip' title='Kann nur bei den Benutzerrollen geändert werden!'>
                <?php } ?>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-12 col-md-12 col-xs-12">  
              <div class="">  
                <img src="./userbilder/<?=$u_foto?>" width="160px" style="border-radius: 50%; border-style: solid; border-width: 2px; border-color: #333333;"></img> 
              </div>                                  
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12">  
              <div class="form-group">  
                <label>Foto vom Benutzer</label>  
                <div class="custom-file">  
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="userfoto">  
                    <label class="custom-file-label" for="validatedCustomFile">Foto auswählen...</label> 
                </div>  
              </div>                                  
            </div>                                  
          </div>
          <div class="form-row">
            <div class="col-9 mb-1">
              <div class="col-2 form-group text-right mt-3 mb-3 float-right"> <!-- Submit Button -->
                <input type="submit" name ="user_edit" value="User ändern" class="btn btn-primary" id="anzeigen">
              </div>
            </div>
          </div>
        </form>
        <?php endforeach; ?>
<!-- / User ändern Form -->

      </div>

    </div>

  </div>

  <?php include "../assets/templates/10_footer.php"; ?>

  <?php include "../assets/templates/11_datatable.php"; ?>

  <!-- Seitenspezifische Scriptdatei zum anpassen -->
  <script type="text/javascript" src="../assets/js/datatable_user.js"></script>

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

    $(function () {
      $('[data-toggle="tooltip"]').tooltip({
        html: true
      })
    })
  </script>

</body>
</html>