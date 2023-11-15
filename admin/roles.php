<?php

error_reporting(E_ALL & ~E_NOTICE);

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

include "../assets/templates/05_scripte_head.php";


if(isset($_POST['submitrole'])){
  if($_POST['rolle']==0){
    $rbac->Roles->add($_POST['name'], $_POST['beschreibung']);
  }else{
    $rbac->Roles->add($_POST['name'], $_POST['beschreibung'], $_POST['rolle']);
  }
}

if(isset($_POST['submitpermission'])){
  if($_POST['permissions']==0){
    $rbac->Permissions->add($_POST['pername'], $_POST['perbeschreibung']);
  }else{
    $rbac->Permissions->add($_POST['pername'], $_POST['perbeschreibung'], $_POST['permissions']);
  }
}

if(isset($_POST['submitrolepermission'])){
  $rbac->assign($_POST['rolle'], $_POST['rechte']);
}

if(isset($_POST['submituserrole'])){
  $rbac->Users->assign($_POST['rolle'], $_POST['user']);
}

if(isset($_GET['roledelete'])){
  $roledelete = $_GET['roledelete'];
  $rbac->Roles->remove($roledelete, false);
  header('location:./roles.php');
}

if(isset($_GET['roleunassign'])){
  $roleunassign = $_GET['roleunassign'];
  $rbac->Roles->unassignPermissions($roleunassign);
  header('location:./roles.php');
}

if(isset($_GET['userunassign'])){
  $userunassign = $_GET['userunassign'];
  $rbac->Roles->unassignUsers($userunassign);
  header('location:./roles.php');
}

if(isset($_GET['perdelete'])){
  $perdelete = $_GET['perdelete'];
  $rbac->Permissions->remove($perdelete, false);
  header('location:./roles.php');
}

if(isset($_GET['perunassign'])){
  $perunassign = $_GET['perunassign'];
  $rbac->Permissions->unassignRoles($perunassign);
  header('location:./roles.php');
}

// Assign Role to User (The UserID is provided by the application's User Management System)
// $rbac->Users->assign($role_id, 5);

?>

<title>Rolle hinzufügen</title>

<body>

<div class="wrapper">

  <?php include "../assets/templates/06_sidebar_start.php"; ?>

  <!-- Page Content Holder -->
  <div id="content">

    <?php include "../assets/templates/07_topnav.php"; ?>

    <!-- <?php
      include "../inc/pre.inc.php"; 
    ?> -->


    <div class="container">

      <div class="row mt-4">
        <blockquote class="blockquote">
          <p>Rechtesystem von: https://phprbac.net/docs_tutorial.php</p>
        </blockquote>
      </div>

      <div class="row p-2 bg-primary text-white mt-4"> <!-- Rollen Überschrift -->
        <h1>Rollen</h1>
      </div>
      <div class="row border border-primary">
        <div class="col">
        <table class="table">                 <!-- Rollen Tabelle -->
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Beschreibung</th>
              <th scope="col">Elterngruppe</th>
              <th scope="col">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM all_roles ORDER BY ID ASC";
              foreach ($pdo->query($sql) as $row) { ?>
              <tr>
                <th scope="row"><?=$row['ID']?></th>
                <th scope="row"><?=$row['Title']?></th>
                <th scope="row"><?=$row['Description']?></th>
                <th scope="row"><?php 
                                if($row['ID']!=1){
                                $roleID = $row['ID'];
                                $array = $rbac->Roles->parentNode("$roleID");
                                echo $array['Title']." - ".$array['Description'];
                                } ?></th>
                <th scope="row">
                  <a name="roledelete" class="btn btn-sm btn-danger" href="?roledelete=<?=$row['ID']?>" role="button" data-bs-toggle="tooltip" title="Rolle mit allen Abhängikeiten löschen"><i class="fas fa-trash"></i></a>
                  <a name="roleunassign" class="btn btn-sm btn-warning" href="?roleunassign=<?=$row['ID']?>" role="button" data-bs-toggle="tooltip" title="Alle abhängigen Rechteverknüpfungen löschen. Rechte werden NICHT gelöscht!"><i class="fas fa-reply"></i></a>
                  <a name="userunassign" class="btn btn-sm btn-warning" href="?userunassign=<?=$row['ID']?>" role="button" data-bs-toggle="tooltip" title="Alle abhängigen Userverknüpfungen löschen. Rechte werden NICHT gelöscht!"><i class="fas fa-user-slash"></i></a>
                </th>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </div>

      <div class="row border border-primary">
        <div class="p-2 pt-3 mb-2 bg-primary text-white">
          <h4>Rolle hinzufügen</h4>
        </div>
        <div class="row">
          <form action="" method="post">        <!-- Rolle hinzufügen Formular -->
            <div class="mb-3 row">
              <label class="col-4 col-form-label">Rollenname</label>
              <div class="col-8">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-4 col-form-label">Rollenbeschreibung</label>
              <div class="col-8">
                <input type="text" class="form-control" name="beschreibung" id="beschreibung" placeholder="Beschreibung">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-4 col-form-label">Elterngruppe</label>
                <div class="col-8">
                  <select class="form-select" name="rolle">
                    <option selected>auswählen...</option>
                    <option value="0">KEINE</option>
                    <?php
                      $sql = "SELECT * FROM all_roles ORDER BY ID ASC";
                      foreach ($pdo->query($sql) as $row) { ?>
                        <option value="<?=$row['ID']?>"><?=$row['Title']?> - <?=$row['Description']?></option>
                    <?php } ?>
                  </select>
                </div>
            </div>
            <div class="mb-3 row">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" name="submitrole" class="btn btn-primary">Senden</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      

      <div class="row p-2 bg-info text-dark mt-4"> <!-- Rollen Überschrift -->
        <h1>Rechte</h1>
      </div>
      <div class="row border border-info">
        <div class="col">
        <table class="table">                 <!-- Rollen Tabelle -->
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Beschreibung</th>
              <th scope="col">Elterngruppe</th>
              <th scope="col">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM all_permissions";
              foreach ($pdo->query($sql) as $row) { ?>
              <tr>
                <th scope="row"><?=$row['ID']?></th>
                <th scope="row"><?=$row['Title']?></th>
                <th scope="row"><?=$row['Description']?></th>
                <th scope="row"><?php 
                                if($row['ID']!=1){
                                $perID = $row['ID'];
                                $array = $rbac->Permissions->parentNode("$perID");
                                echo $array['Title']." - ".$array['Description'];
                                } ?></th>
                <th scope="row">
                  <a name="perdelete" class="btn btn-sm btn-danger" href="?perdelete=<?=$row['ID']?>" role="button" data-bs-toggle="tooltip" title="Rechte mit allen Abhängikeiten löschen"><i class="fas fa-trash"></i></a>
                  <a name="perunassign" class="btn btn-sm btn-warning" href="?perunassign=<?=$row['ID']?>" role="button" data-bs-toggle="tooltip" title="Alle abhängigen Rechteverknüpfungen löschen. Rechte werden NICHT gelöscht!"><i class="fas fa-reply"></i></a>
                </th>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
      <div class="row border border-info">
        <div class="p-2 pt-3 mb-2 bg-info text-dark">
          <h4>Rechte hinzufügen</h4>
        </div>
        <div class="row g-2">
          <div class="col">
            <form action="" method="post">
              <div class="mb-3 mt-3 row">
                <label class="col-4 col-form-label">Rechtename</label>
                <div class="col-8">
                  <input type="text" class="form-control" name="pername" id="pername" placeholder="Name">
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-4 col-form-label">Rechtebeschreibung</label>
                <div class="col-8">
                  <input type="text" class="form-control" name="perbeschreibung" id="perbeschreibung" placeholder="Beschreibung">
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-4 col-form-label">Elterngruppe</label>
                  <div class="col-8">
                    <select class="form-select" name="permissions">
                      <option selected>auswählen...</option>
                      <option value="0">KEINE</option>
                      <?php
                        $sql = "SELECT * FROM all_permissions ORDER BY ID ASC";
                        foreach ($pdo->query($sql) as $row) { ?>
                          <option value="<?=$row['ID']?>"><?=$row['Title']?> - <?=$row['Description']?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>
              <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" name="submitpermission" class="btn btn-primary">Senden</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row p-2 bg-warning text-dark mt-4"> <!-- Rollen Überschrift -->
        <h1>Rollenrechte</h1>
      </div>
      <div class="row border border-warning">
        <div class="col">
        <table class="table">                 <!-- Rollen Tabelle -->
          <thead>
            <tr>
              <th scope="col">Rolle</th>
              <th scope="col">Rechte</th>
              <th scope="col">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT arp.RoleID arpid, ar.ID arid, ap.ID apid, ar.Title artitel, ar.Description arbeschr, ap.Title aptitel, ap.Description apbeschr 
                        FROM all_rolepermissions arp, all_roles ar, all_permissions ap
                          WHERE arp.RoleID = ar.ID
                          AND arp.PermissionID = ap.ID
                            ORDER BY ar.ID ASC";
              foreach ($pdo->query($sql) as $row) { ?>
              <tr>
                <th scope="row"><?=$row['artitel']?> (<?=$row['arbeschr']?>)</th>
                <th scope="row"><?=$row['aptitel']?> (<?=$row['apbeschr']?>)</th>
                <th scope="row"></th>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
      <div class="row border border-warning">
        <div class="p-2 pt-3 mb-2 bg-warning text-dark">
          <h4>Rollenrechte hinzufügen</h4>
        </div>
        <div class="row g-2">
          <div class="col">
            <form action="" method="post">
              <div class="mb-3 mt-3 row">
                <label class="col-4 col-form-label">Rolle</label>
                <div class="col-8">
                  <select class="form-select" name="rolle">
                    <option selected>auswählen...</option>
                    <?php
                      $sql = "SELECT * FROM all_roles ORDER BY Title ASC";
                      foreach ($pdo->query($sql) as $row) { ?>
                        <option value="<?=$row['Title']?>"><?=$row['Title']?> - <?=$row['Description']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 mt-3 row">
                <label class="col-4 col-form-label">Rechte</label>
                <div class="col-8">
                  <select class="form-select" name="rechte">
                    <option selected>auswählen...</option>
                    <?php
                      $sql = "SELECT * FROM all_permissions";
                      foreach ($pdo->query($sql) as $row) { ?>
                        <option value="<?=$row['Title']?>"><?=$row['Title']?> - <?=$row['Description']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" name="submitrolepermission" class="btn btn-primary">Senden</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row p-2 bg-danger text-white mt-4"> <!-- Rollen Überschrift -->
        <h1>Userrechte</h1>
      </div>
      <div class="row border border-danger">
        <div class="col">
        <table class="table">                 <!-- Rollen Tabelle -->
          <thead>
            <tr>
              <th scope="col">User</th>
              <th scope="col">Rechte</th>
              <th scope="col">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT user.*, all_userroles.UserID, all_roles.ID, all_roles.Title, all_roles.Description FROM user
                        LEFT JOIN all_userroles ON user.ID = all_userroles.UserID
                        LEFT JOIN all_roles ON all_userroles.RoleID = all_roles.ID
                          ORDER BY nachname ASC";
              foreach ($pdo->query($sql) as $row) { ?>
              <tr>
                <th scope="row"><?=$row['nachname']?>, <?=$row['vorname']?></th>
                <th scope="row"><?=($row['Title']!=NULL)?$row['Title']." (".$row['Description'].")":""?></th>
                <th scope="row"></th>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
      <div class="row border border-danger">
        <div class="p-2 pt-3 mb-2 bg-danger text-white">
          <h4>Userrechte hinzufügen</h4>
        </div>
        <div class="row g-2">
          <div class="col">
            <form action="" method="post">
              <div class="mb-3 mt-3 row">
                <label class="col-4 col-form-label">User</label>
                <div class="col-8">
                  <select class="form-select" name="user">
                    <option selected>auswählen...</option>
                    <?php
                      $sql = "SELECT * FROM user ORDER BY nachname ASC";
                      foreach ($pdo->query($sql) as $row) { ?>
                        <option value="<?=$row['ID']?>"><?=$row['nachname']?>, <?=$row['vorname']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 mt-3 row">
                <label class="col-4 col-form-label">Rolle</label>
                <div class="col-8">
                  <select class="form-select" name="rolle">
                    <option selected>auswählen...</option>
                    <?php
                      $sql = "SELECT * FROM all_roles";
                      foreach ($pdo->query($sql) as $row) { ?>
                        <option value="<?=$row['Title']?>"><?=$row['Title']?> - <?=$row['Description']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" name="submituserrole" class="btn btn-primary">Senden</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

<script type="text/javascript">
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>

</html>