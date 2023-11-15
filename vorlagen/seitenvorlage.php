<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

?>

<?php include "../assets/templates/05_scripte_head.php"; ?>

<!-- <link rel="stylesheet" href="./assets/css/bootstrapcontrol.css"> -->

<title>Title</title>

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
      </div>

<!-- Überschrift -->
      <div class="row m-1 mb-5">
				<div class="col-xs-12 bt-3">
					<h1>Foto Upload - Kategorie Auswahl</h1>
				</div>
			</div>
<!-- / Überschrift -->

<!-- Seiteninhalt -->
      <h1>Das ist eine Seitenvorlage !</h1>
<!-- /Seiteninhalt -->

    </div>

  </div>

  <?php include "../assets/templates/10_footer.php"; ?>

  <!-- <?php include "../assets/templates/11_datatable.php"; ?> -->
  <!-- Seitenspezifische Scriptdatei zum anpassen -->
  <!-- <script type="text/javascript" src="./assets/js/datatable.js"></script> -->

</body>
</html>