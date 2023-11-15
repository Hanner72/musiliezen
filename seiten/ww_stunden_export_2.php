<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

?>

<?php include "../assets/templates/05_scripte_head.php"; ?>

<!-- <link rel="stylesheet" href="./assets/css/bootstrapcontrol.css"> -->

<?php

$collapse_formular_neu = "";
$editid = 0;

if(isset($_GET['edit'])){
  $editid = $_GET['edit'];
  $collapse_formular_neu = "show";
}

if(isset($_GET['del'])){
  $sql = "DELETE FROM ff_std_import WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $idToDelete = $_GET['del']; // The ID of the record you want to delete
  $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
  $stmt->execute();
}

if(isset($_GET['m'])) {
  $m = $_GET['m'];
  $j = $_GET['j'];

  $_SESSION['m'] = $m;
  $_SESSION['j'] = $j;
}

if(!isset($_SESSION['m']) AND !isset($_SESSION['j'])){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./ww_stunden_export_1.php">';
}else{
  $m = $_SESSION['m'];
  $j = $_SESSION['j'];
}

/* Datensatz ändern */
  if(isset($_POST['editsend'])){
    $editid = $_POST['id'];
    $editdate = $_POST['datestart'];
    $timestart = $_POST['timestart'];
    $timeend = $_POST['timeend'];

    // Erstellen Sie DateTime-Objekte aus den Eingaben
    $starttime = new DateTime($editdate . ' ' . $timestart);
    $endtime = new DateTime($editdate . ' ' . $timeend);

    // Jetzt können Sie die format-Methode verwenden
    $starttimeFormatted = $starttime->format('Y-m-d H:i:s');
    $endtimeFormatted = $endtime->format('Y-m-d H:i:s');

    // Sekunden berechnen
    // Zeiten in Stunden, Minuten und Sekunden aufteilen
    list($start_stunden, $start_minuten, $start_sekunden) = explode(":", $timestart);
    list($end_stunden, $end_minuten, $end_sekunden) = explode(":", $timeend);

    // Die Zeit in Sekunden umrechnen
    $start_in_sekunden = $start_stunden * 3600 + $start_minuten * 60 + $start_sekunden;
    $end_in_sekunden = $end_stunden * 3600 + $end_minuten * 60 + $end_sekunden;

    // Differenz berechnen
    $sek = $end_in_sekunden - $start_in_sekunden;
    $std = $sek / 60 / 60;

    //echo "sek. " . $sek . "<br>" . "Std. " . number_format($std, 2) . "<br>";

    //echo $starttimeFormatted .", ".$endtimeFormatted . "<br>";

    $sql = "UPDATE ff_std_import SET start_time=:start_time, end_time=:end_time, duration=:duration, stunden=:stunden WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':start_time', $starttimeFormatted, PDO::PARAM_STR);
    $stmt->bindParam(':end_time', $endtimeFormatted, PDO::PARAM_STR);
    $stmt->bindParam(':duration', $sek);
    $stmt->bindParam(':stunden', $std);
    $stmt->bindParam(':id', $editid, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      // echo "Datensatz erfolgreich aktualisiert.";
      echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./ww_stunden_export_2.php">';
    } else {
      echo "Fehler beim Aktualisieren des Datensatzes.";
    }
  }
/* / Datensatz ändern */

?>

<title>Stunden schütteln - Export</title>

<body>

<style>
  tr.group,
  tr.group:hover {
      background-color: #ddd !important;
  }
</style>

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
					<h1>Stunden schütteln - Seite 2</h1>
				</div>
			</div>
<!-- / Überschrift -->

<!-- Formular neu -->
        <div class="row m-1 mb-4">
          <div class="col-12">
            <div class="collapse <?=$collapse_formular_neu?>" id="collapseExample">
              <h3>Datensatz bearbeiten</h3>
              <?php
                $sql = "SELECT *, DAY(start_time) tag, time(start_time) timestart, time(end_time) timeend, date(start_time) datestart, date(end_time) dateend FROM ff_std_import
                          WHERE MONTH(start_time) = $m
                            AND YEAR(start_time) = $j
                            AND id = $editid";
                foreach ($pdo->query($sql) as $row) {
                  } ?>
              <form action="" method="post">
                <div class="row mb-3">
                    <input type="text" class="form-control" value="<?=$row['id']?>" name="id" hidden>
                  <div class="col-6">
                    <input type="text" class="form-control" value="<?=$row['user']?>" disabled>
                  </div>
                  <div class="col-6">
                    <input type="text" class="form-control" value="<?=$row['alias']?>" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                    <input type="text" class="form-control" value="<?=$row['activity']?>" disabled>
                  </div>
                  <div class="col-6">
                    <input type="text" class="form-control" value="<?=$row['project']?>" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                    <input type="date" class="form-control" value="<?=$row['datestart']?>" id="datestart" name="datestart">
                  </div>
                  <div class="col-3">
                    <input type="time" class="form-control" value="<?=$row['timestart']?>" id="timestart" name="timestart">
                  </div>
                  <div class="col-3">
                    <input type="time" class="form-control" value="<?=$row['timeend']?>" id="timeend" name="timeend">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" name="editsend">Änderung absenden</button>
              </form>
            </div>
          </div>
        </div>
<!-- / Formular neu -->

<!-- Seiteninhalt -->

        <div class='row m-1'>
          <div class="col-12 p-3 border border-warning table-responsive">
            <table class="datatable table border-top table-hover table-sm">
              <thead>
                <tr class='table-warning'>
                  <th class="text-center" scope='col'>id</th> <!-- Spalte in ../assets/js/datatable.js ausgeblendet -->
                  <th scope='col'>User</th>
                  <th scope='col'>Name</th>
                  <th scope='col'>Arbeit</th>
                  <th scope='col'>Projekt</th>
                  <th scope='col'>Tag</th>
                  <th scope='col'>von</th>
                  <th scope='col'>bis</th>
                  <!-- <th scope='col'>Sek.</th> -->
                  <th scope='col'>Std.</th>
                  <th scope='col'>Aktion</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $sql = "SELECT *, DAY(start_time) tag, time(start_time) timestart, time(end_time) timeend FROM ff_std_import
                              WHERE MONTH(start_time) = $m
                                AND YEAR(start_time) = $j";
                    foreach ($pdo->query($sql) as $row) {
                      $std = number_format($row['duration']/60/60,2,",",".");
                      ?>
                      <tr>
                        <td><?=$row['id']?></td>
                        <td><?=$row['user']?></td>
                        <td><?=$row['alias']?></td>
                        <td><?=$row['activity']?></td>
                        <td><?=$row['project']?></td>
                        <td><?=$row['tag']?></td>
                        <td><?=$row['timestart']?></td>
                        <!-- <td><?=$row['start_time']?></td> -->
                        <td><?=$row['timeend']?></td>
                        <!-- <td><?=$row['end_time']?></td> -->
                        <!-- <td><?=$row['duration']?></td> -->
                        <td><?=$std?></td>
                        <td class="text-end">
                          <a class="badge bg-warning text-dark" href="?edit=<?=$row['id']?>&csn=1" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                          <a class="badge bg-danger text-light" href="?del=<?=$row['id']?>" role="button"><i class="fa-solid fa-trash"></i></a>
                        </td>
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
  <script type="text/javascript" src="../assets/js/datatable_import_2.js"></script>


</body>
</html>