<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

if($rbac->Users->hasRole('Admin', $userid)!=1){
  echo '<META HTTP-EQUIV="Refresh" Content="2; URL=../">';
}

$level = NOTICE; $message=$_SESSION['user'].' - Ist auf Seite Administration/Benutzer'; include '../assets/inc/logfile-end.php';

include "../assets/templates/05_scripte_head.php"; ?>

<!-- <link rel="stylesheet" href="./assets/css/bootstrapcontrol.css"> -->

<!-- Neuen User hinzufügen -->
  <?php
    if (isset($_POST['user_neu'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];
      $vorname = $_POST['vorname'];
      $nachname = $_POST['nachname'];
      $email = $_POST["email"];
      $mobil = $_POST["mobil"];
      $whatsappapi = $_POST["whatsappapi"];
      $rolle = $_POST["rolle"];
      $userfoto = basename($_FILES['userfoto']['name']);
          
      $userfotoext = pathinfo(basename($_FILES['userfoto']['name']), PATHINFO_EXTENSION);

      $uploaddir = 'userbilder/';
      
      $userfotofile = "userfoto-" . basename($_FILES['userfoto']['tmp_name']) . "." . $userfotoext;

      $userfotouploadfile = $uploaddir . "userfoto-" . basename($_FILES['userfoto']['tmp_name']) . "." . $userfotoext; 

      /* echo "<pre>";
      echo "FILES:<br>";
      print_r ($_FILES );
      echo "</pre>"; */

      if(($_FILES['userfoto']['tmp_name'] != null)){
        if (move_uploaded_file($_FILES['userfoto']['tmp_name'], $userfotouploadfile)) {
            $sql2 = "INSERT INTO user (username,password,vorname,nachname,email,mobil,whatsappapi,foto)
            VALUES('$username', '$password', '$vorname', '$nachname', '$email', '$mobil', '$whatsappapi', '$userfotofile')";
            if(mysqli_query($conn, $sql2)){
              $userid = mysqli_insert_id($conn);
              $rbac->Users->assign($_POST['rolle'], $userid);
              $level = INFO; $message=$_SESSION['user'].' - Hat den Benutzer "'. $username .'" hinzugefügt'; include '../assets/inc/logfile-end.php';
              $_SESSION['alert-class'] = "alert-success";
              $_SESSION['message'] = "User wurde erfolgreich hinzugefügt!";
              $_SESSION['alert-icon'] = $alert_yes;
              echo '<META HTTP-EQUIV="Refresh" Content="1; URL=user.php">';
            } else{
              echo $sql2."\n";
              $level = ERROR; $message=$_SESSION['user'].' - Hinzufügen von Benutzer "'. $username .'" nicht erfolgreich! - DB Fehler: '.$sql2; include '../assets/inc/logfile-end.php';
              $_SESSION['alert-class'] = "alert-danger";
              $_SESSION['message'] = "User upload nicht erfolgreich! Datenbank Fehler!";
              $_SESSION['alert-icon'] = $alert_no;
              echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
            }
        } else {
            $level = ERROR; $message=$_SESSION['user'].' - Hinzufügen von Bild für Benutzer "'. $username .'" nicht erfolgreich! - Zu große Datei?'; include '../assets/inc/logfile-end.php';
            $_SESSION['alert-class'] = "alert-danger";
            $_SESSION['message'] = "User upload nicht erfolgreich! Zu große Datei?";
            $_SESSION['alert-icon'] = $alert_no;
            echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
        }
      }else{
        $sql2 = "INSERT INTO user (username,password,vorname,nachname,email,mobil,whatsappapi,foto)
        VALUES('$username', '$password', '$vorname', '$nachname', '$email', '$mobil', '$whatsappapi', 'userleerbrown.jpg')";
        if(mysqli_query($conn, $sql2)){
          $userid = mysqli_insert_id($conn);
          $rbac->Users->assign($_POST['rolle'], $userid);
          $level = INFO; $message=$_SESSION['user'].' - Hat den Benutzer "'. $username .'" hinzugefügt'; include '../assets/inc/logfile-end.php';
          $_SESSION['alert-class'] = "alert-success";
          $_SESSION['message'] = "User wurde erfolgreich hinzugefügt!";
          $_SESSION['alert-icon'] = $alert_yes;
          echo '<META HTTP-EQUIV="Refresh" Content="1; URL=user.php">';
        } else{
          echo $sql2."\n";
          $level = ERROR; $message=$_SESSION['user'].' - Hinzufügen von Benutzer "'. $username .'" nicht erfolgreich! - DB Fehler: '.$sql2; include '../assets/inc/logfile-end.php';
          $_SESSION['alert-class'] = "alert-danger";
          $_SESSION['message'] = "User Eintrag nicht erfolgreich! Datenbank Fehler!";
          $_SESSION['alert-icon'] = $alert_no;
          echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
        }
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

<title>Userliste</title>

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
            <h1>Userliste</h1>
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
            <h3>User hinzufügen</h3>
          </div>
        </div>

        <form action="" id="needs-validation" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-lg-4">
              <label class="control-label">Benutzername *</label>
              <input type="text" class="form-control" name="username" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Passwort *</label>
              <input type="text" class="form-control" name="password" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Mobilnummer *</label>
              <input type="text" class="form-control" name="mobil" placeholder="+43 000 0000000">
            </div>
            <div class="col-lg-4">
              <label class="control-label">Vorname *</label>
              <input type="text" class="form-control" name="vorname" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Nachname</label>
              <input type="text" class="form-control" name="nachname" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4">
              <label class="control-label">Whatsapp-API</label>
              <input type="text" class="form-control" name="whatsappapi" placeholder="12345678">
            </div>
            <div class="col-lg-4 mb-2">
              <label class="control-label">email *</label>
              <input type="mail" class="form-control" name="email" required>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
            </div>
            <div class="col-lg-4 mb-2">
              <label class="control-label">Rolle *</label>
              <select class="form-select" name="rolle" required>
                <option selected disabled value="">auswählen...</option>
                <option disabled value="">---</option>
                <?php
                  $sql = "SELECT * FROM all_roles ORDER BY Title ASC";
                  foreach ($pdo->query($sql) as $row) { ?>
                    <option value="<?=$row['Title']?>"><?=$row['Title']?> - <?=$row['Description']?></option>
                <?php } ?>
              </select>
              <div class="valid-feedback">
                In Ordnung!
              </div>
              <div class="invalid-feedback">
                Bitte ausfüllen!
              </div>
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

          <div class="form-row">
            <div class="col-9 mb-1">
              <div class="col-2 form-group text-right mt-3 mb-3 float-right"> <!-- Submit Button -->
                <input type="submit" name ="user_neu" value="User eintragen" class="btn btn-primary" id="anzeigen">
              </div>
            </div>
          </div>
        </form>
<!-- / User hinzufügen Form -->

<!-- Boden Prüfberichte Tabelle -->

        <!-- Importierte Bauvorhabenliste anzeigen -->
        <?php
          $sql = "SELECT *, COUNT(RoleID) anzahl FROM user
                    LEFT JOIN  all_userroles ur ON user.ID = ur.UserID
                      GROUP BY ID
                      ORDER BY nachname ASC";
          $result = mysqli_query($conn, $sql);
          $e = function ($value) {
              return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
          };        
        ?>
    
        <div class='row m-1'>
          <div class="col-12 p-3 border border-warning table-responsive">
            <table class="datatable table border-top table-hover table-sm">
              <thead>
                <tr class='table-warning'>
                  <th class="text-center" scope='col'>ID</th> <!-- Spalte in ../assets/js/datatable.js ausgeblendet -->
                  <th scope='col'>Username</th>
                  <th scope='col' class="sp-l">Passwort</th>
                  <th scope='col' class="sp-l">email</th>
                  <th scope='col' class="sp-l">Rolle</th>
                  <th scope='col' class="sp-m">Userfoto</th>
                  <th class="text-center" scope='col'>Aktionen</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $row):
                $u_ID = $e($row['ID']);
                $u_username = $e($row['username']);
                $u_password = $e($row['password']);
                $U_email = $e($row['email']);
                $u_foto = $e($row['foto']);
                $u_anzahl = $row['anzahl'];

                //Buttons und Zustände inkl. Links
                if($u_anzahl>0){
                  $delete = "<button type='button' class='btn btn-secondary btn-sm' data-placement='left' data-toggle='tooltip' title='Eintrag kann nicht gelöscht werden, da noch Rollen vorhanden sind!'><a href='#$u_ID'><i class='fa fa-trash text-white'></i></a></button>";
                }else{
                  $delete = "<button type='button' class='btn btn-danger btn-sm' data-placement='left' data-toggle='tooltip' title='Eintrag löschen'><a href='?userdelete=" . $u_username . "&u_foto=".$u_foto."&uid=".$u_ID."'><i class='fa fa-trash text-white'></i></a></button>";
                }
                $deleteinaktiv = "<button type='button' class='btn btn-outline-secondary btn-sm' data-placement='left' data-toggle='tooltip' title='KEINE Berechtigung zum löschen!'><i class='fa fa-trash text-secondary'></i></button>";
                $edit = "<button type='button' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Eintrag ändern'><a href='useredit.php?useredit=" . $u_username . "'><i class='fas fa-pencil-alt'></i></a></button>";
                ?>
                <tr>
                  <td class="align-middle text-center" scope='row'><?php echo $e($row['ID']); ?></td>
                  <td class="align-middle"><?php echo $e($row['username']); ?></td>
                  <td class="align-middle sp-l"><?php echo $e($row['password']); ?></td>
                  <td class="align-middle sp-l"><?php echo $e($row['email']); ?></td>
                  <td class="align-middle">
                  <?php
                    $sql2 = "SELECT user.*, all_userroles.UserID, all_roles.ID RoleID, all_roles.Title, all_roles.Description FROM user
                              LEFT JOIN all_userroles ON user.ID = all_userroles.UserID
                              LEFT JOIN all_roles ON all_userroles.RoleID = all_roles.ID
                                WHERE user.ID = $u_ID";
                    foreach ($pdo->query($sql2) as $row2) { ?>
                        <?=($row2['Title']!=NULL)?$row2['Title']." (".$row2['Description'].") <a href='?roledelete=1&uid=" . $row2['ID'] . "&rid=".$row2['RoleID']."'><span class='badge bg-danger' data-toggle='tooltip' title='Rolle entfernen'><i class='fas fa-user-slash'></i></span></a><br>":""?>
                  <?php } ?>
                  </td>
                  <td class="align-middle sp-m">
                    <img src="./userbilder/<?php echo ($row['foto']==NULL) ? 'userleer.png' : $row['foto']; ?>" height="50px" width="50px" style="border-radius: 50%; border-style: solid; border-width: 2px; border-color: #333333;" data-placement="left" data-toggle="tooltip" title="<img src='userbilder/<?php echo ($row['foto']==NULL) ? 'userleer.png' : $row['foto']; ?>' width='160px' />" >
                  </td>
                  <?php
                    if ($rbac->Users->hasRole('Admin', $userid)==1) { // If else für Bautagesbericht hinzufügen Button (grün oder rot)
                      echo "<td class='align-middle text-center'>"
                        . $edit." ".$delete
                        . "</td>";
                    } elseif ($rbac->Users->hasRole('DirAH-User', $userid)==1) {
                      echo "<td class='align-middle text-center'>"
                        . $deleteinaktiv
                        . "</td>";
                    } else{
                      echo "<td class='align-middle text-center'>"
                        . $deleteinaktiv
                        . "</td>";
                    }
                    ?>
                </tr>
                <?php endforeach;?>
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
  </script>

</body>
</html>