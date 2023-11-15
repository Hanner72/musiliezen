<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

?>

<?php include "../assets/templates/05_scripte_head.php"; ?>

<!-- <link rel="stylesheet" href="./assets/css/bootstrapcontrol.css"> -->

<?php

if(!isset($_SESSION['m'])){
  $_SESSION['m'] = date('n');
}
if(!isset($_SESSION['j'])){
  $_SESSION['j'] = date('Y');
}

if(isset($_GET['m'])) {
  $m = $_GET['m'];
  $j = $_GET['j'];

  $_SESSION['m'] = $m;
  $_SESSION['j'] = $j;

  $sourceData = $pdo2->query("SELECT ts.id, us.username, us.alias, pj.name pjname, ts.duration, ts.start_time, ts.end_time, ac.name acname FROM kimai2_timesheet ts, kimai2_users us, kimai2_projects pj, kimai2_activities ac
	WHERE ts.user = us.id
    AND ts.project_id = pj.id
    AND ts.activity_id = ac.id
    AND MONTH(ts.start_time) = $m
    AND YEAR(ts.start_time) = $j
    ORDER BY us.username ASC, DAY(ts.start_time) ASC, HOUR(ts.start_time) ASC")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($sourceData as $row) {
    $id = $row['id'];
    $username = $row['username'];
    $alias = $row['alias'];
    $pjname = $row['pjname'];
    $acname = $row['acname'];
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];
    $duration = $row['duration'];
    $std = number_format($row['duration']/60/60,2,".",",");

    $sql = "INSERT INTO ff_std_import (user, alias, project, activity, start_time, end_time, duration, stunden)
    VALUES (?,?,?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    if($stmt->execute([$username, $alias, $pjname, $acname, $start_time, $end_time, $duration, $std])){
      //echo "Passt, ";
    }else{
      $info = "SQL Error <br />" . $stmt->queryString."<br />" . $stmt->errorInfo()[2];
      echo $info;
      echo "<br>Admins und KellnerInnen Export nicht erfolgreich!<br><br>";
    }
  }

  $sql1 = "INSERT INTO ff_std_import_aktionen (monat, jahr, importiert)
  VALUES (?,?,?)";
  $stmt1=$pdo->prepare($sql1);
  if($stmt1->execute([$m, $j, 1])){
    //echo "Passt, ";
  }else{
    $info = "SQL Error <br />" . $stmt1->queryString."<br />" . $stmt1->errorInfo()[2];
    echo $info;
    echo "<br>Eintrag der Import Aktionen nicht erfolgreich!<br><br>";
  }
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./ww_stunden_export_1.php">';
}

?>

<title>Stunden schütteln - Export</title>

<body>

  <div class="wrapper">

    <?php include "../assets/templates/06_sidebar_start.php"; ?>

    <!-- Page Content Holder -->
    <div id="content">

      <?php include "../assets/templates/07_topnav.php"; ?>

      <?php include "../assets/inc/pre.inc.php"; ?>

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
      <div class="row m-1 mb-5">
				<div class="col-xs-12 bt-3">
					<h1>Stunden schütteln - Seite 1</h1>
				</div>
			</div>
<!-- / Überschrift -->

<!-- Seiteninhalt -->
        <div class="row m-1">
          <div class="col-12">
            <?php
              $pdo2->exec("SET lc_time_names = 'de_DE'");
              $sql = "SELECT MONTH(start_time) monat, YEAR(start_time) jahr, DATE_FORMAT(start_time, '%M') as Monat FROM kimai2_timesheet GROUP BY YEAR(start_time) DESC, MONTH(start_time) DESC";
              foreach ($pdo2->query($sql) as $row) { 
                //$std = number_format($row['duration']/60/60,2,",",".");
                $monat = $row['monat'];
                $jahr = $row['jahr'];
                $Monat = $row['Monat'];
                
                $farbe = "primary";
                $link = "?m=" . $monat . "&j=" . $jahr;
                $disabled = "";
                $btn_first = "";
                $btn_last ="";
                $tooltip = " data-toggle='tooltip' title='Stunden für Monat $Monat/$jahr importieren!'";
                
                $sql1 = "SELECT * FROM ff_std_import_aktionen WHERE jahr = $jahr AND monat = $monat";
                foreach ($pdo->query($sql1) as $row1) {
                  $importiert = $row1['importiert'];
                  if($importiert == 1) { 
                    $farbe = "success";
                    $link = "#";
                    $disabled = "";
                    $tooltip = " data-toggle='tooltip' title='Stunden bereits importieren!'";
                    $btn_first = "<div class='btn-group' role='group'>";
                    $btn_last ="<a class='btn btn-danger' href='./ww_stunden_export_2.php?m=$monat&j=$jahr' type='button' data-toggle='tooltip' title='Stunden für Monat $Monat bearbeiten'>LINK</a></div>";
                  }else{
                    $farbe = "primary";
                    $link = "?m=" . $monat . "&j=" . $jahr;
                    $disabled = "disabled";
                    $btn_first = "";
                    $btn_last ="";
                  } ?>
                <?php } ?>
                <div class="m-1 float-start"><?=$btn_first?><a class="btn btn-<?=$farbe?> <?=$disabled?>" href="<?=$link?>" type="button" <?=$tooltip?>><?=$Monat?> / <?=$jahr?></a><?=$btn_last?></div>
                  <!-- <a class="btn btn-<?=$farbe?> m-1 <?=$disabled?>" href="<?=$link?>" role="button"><?=$Monat?> / <?=$jahr?></a> -->
              <?php } ?>
          </div>
        </div>

        <div class='row m-1'>
          <div class="col-12 p-3 border border-warning table-responsive">
            <table class="datatable table border-top table-hover table-sm">
              <thead>
                <tr class='table-warning'>
                  <th class="text-center" scope='col'>Username</th> <!-- Spalte in ../assets/js/datatable.js ausgeblendet -->
                  <th scope='col'>Name</th>
                  <th scope='col'>Projekt</th>
                  <th scope='col'>Arbeit</th>
                  <th scope='col'>von</th>
                  <th scope='col'>bis</th>
                  <th scope='col'>Sek.</th>
                  <th scope='col'>Std.</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $sql = "SELECT us.username, us.alias, pj.name pjname, ts.duration, ts.start_time, ts.end_time, ac.name acname FROM kimai2_timesheet ts, kimai2_users us, kimai2_projects pj, kimai2_activities ac
                              WHERE ts.user = us.id
                                AND ts.project_id = pj.id
                                AND ts.activity_id = ac.id
                                AND ts.start_time  >=   '2023-09-01 00:00:00'  and  ts.end_time <= '2023-09-30 23:59:59'
                                  ORDER BY us.username, ts.start_time";
                    foreach ($pdo2->query($sql) as $row) { 
                      $std = number_format($row['duration']/60/60,2,",",".");
                      ?>
                      <tr>
                        <td><?=$row['username']?></td>
                        <td><?=$row['alias']?></td>
                        <td><?=$row['pjname']?></td>
                        <td><?=$row['acname']?></td>
                        <td><?=$row['start_time']?></td>
                        <td><?=$row['end_time']?></td>
                        <td><?=$row['duration']?></td>
                        <td><?=$std?></td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
<!-- /Seiteninhalt -->

    </div>

  </div>

  <?php include "../assets/templates/10_footer.php"; ?>

  <?php include "../assets/templates/11_datatable.php"; ?>
  <!-- Seitenspezifische Scriptdatei zum anpassen -->
  <!-- <script type="text/javascript" src="../assets/js/datatable.js"></script> -->

</body>
</html>