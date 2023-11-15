<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

?>

<?php include "../assets/templates/05_scripte_head.php"; ?>

<!-- <link rel="stylesheet" href="./assets/css/bootstrapcontrol.css"> -->

<title>Stunden schütteln - Seite 1</title>

<body>

  <div class="wrapper">

    <?php include "../assets/templates/06_sidebar_start.php"; ?>

    <!-- Page Content Holder -->
    <div id="content">

      <?php include "../assets/templates/07_topnav.php"; ?>

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