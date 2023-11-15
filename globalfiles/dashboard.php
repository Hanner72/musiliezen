<?php

include "../assets/templates/01_top_includes.php";

include "../assets/templates/02_doctype.php";

include "../assets/templates/03_meta_head.php";

include "../assets/templates/04_link_head.php";

include "../assets/templates/05_scripte_head.php";

// include "../assets/templates/20_lagerstand_pruefen.php";
?>

<title>WW - APP - Dasboard</title>

<body onload="load()">

  <div class="wrapper">

    <?php include "../assets/templates/06_sidebar_start.php"; ?>

    <!-- Page Content Holder -->
    <div id="content">

      <?php include "../assets/templates/07_topnav.php"; ?>

      <?php include "../assets/inc/pre.inc.php"; ?>

      <div class="jumbotron" style="background-color: unset;">
        <div class="row w-100">
          
        </div>
      </div>

      <div class="row mt-3 p-1">
        <div class="col-12">
          <h2>Es gibt neues auf unserer Seite!</h2>
          <div class="row p-2 mt-5 m-1 border border-dotted border-primary">
            <p class="text-dark">Ab sofort ist auch eine Bildergalerie für die Baustellenbilder Verfügbar. Diese dient aber mehr zur schnellen Übersicht als zur Bilderverwaltung. Die Bilder im großen Format liegen am SharePoint.<br>
              Hier gehts zur Bildergalerie: <a href="../bilderupload/galerie.php" class="btn btn-outline-primary"> --> Los geht´s</a> </p>
          </div>
          <div class="row p-2 m-1 border border-dotted border-danger">
            <p class="text-dark"><b>NOTRUFNUMMERN!</b><br>
              Links im Menü unter Infos -> Notrufnummern sind ab sofort die wichtigsten Nummern eingetragen. Ich hoffe wir brauchen die nicht zu oft. ;-)<br>
              Oder hier: <a href="../infos/notrufnummern.php" class="btn btn-outline-primary"> --> Los geht´s</a> </p>
          </div>
        </div>
      </div>

      <div class="line"></div>

      <!-- <h2>Lorem Ipsum Dolor</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->

    </div>

  </div>

  <script>
    function animate(obj, initVal, lastVal, duration) {
      let startTime = null;

      //get the current timestamp and assign it to the currentTime variable
      let currentTime = Date.now();

      //pass the current timestamp to the step function
      const step = (currentTime) => {

        //if the start time is null, assign the current time to startTime
        if (!startTime) {
          startTime = currentTime;
        }

        //calculate the value to be used in calculating the number to be displayed
        const progress = Math.min((currentTime - startTime) / duration, 1);

        //calculate what to be displayed using the value gotten above
        obj.innerHTML = Math.floor(progress * (lastVal - initVal) + initVal);

        //checking to make sure the counter does not exceed the last value (lastVal)
        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          window.cancelAnimationFrame(window.requestAnimationFrame(step));
        }
      };
      //start animating
      window.requestAnimationFrame(step);
    }
    let text1 = document.getElementById('00101');
    let text2 = document.getElementById('00102');
    let text3 = document.getElementById('00103');
    let text4 = document.getElementById('00104');
    const load = () => {
      animate(text1, 100, <?php echo $anzlstext; ?>, 2500);
      animate(text2, 0, <?php echo $anzaqtext; ?>, 3000);
      animate(text3, 100, <?php echo $anzbvtext; ?>, 3500);
      animate(text4, 0, <?php echo $anzrztext; ?>, 4000);
    }
  </script>

  <?php include "../assets/templates/10_footer.php"; ?>

</body>

</html>