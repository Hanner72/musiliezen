
      <div class="accordion mb-3" id="accordionExample">
      <div class="card">
        <div class="card-header bg-warning" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-block text-left text-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Cookies
            </button>
          </h2>
        </div>
    
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <?php 
              // COOKIE Ausgabe anzeigen Anfang
              echo "<b>Cookies</b>";
              echo '<pre>';
              print_r( $_COOKIE );
              echo '</pre><br>';
            ?>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header bg-warning" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn text-light btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Sessions
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <?php
              // SESSION Ausgabe anzeigen Anfang
              echo "<b>Sessions</b>";
              echo '<pre>';
              print_r( $_SESSION );
              echo '</pre><br>';
            ?>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header bg-warning" id="headingThreee">
          <h2 class="mb-0">
            <button class="btn text-light btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThreee" aria-expanded="false" aria-controls="collapseThreee">
              Files
            </button>
          </h2>
        </div>
        <div id="collapseThreee" class="collapse" aria-labelledby="headingThreee" data-parent="#accordionExample">
          <div class="card-body">
            <?php
              // SESSION Ausgabe anzeigen Anfang
              echo "<b>Files</b>";
              echo '<pre>';
              print_r( $_FILES );
              echo '</pre><br>';
            ?>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header bg-warning" id="headingFour">
          <h2 class="mb-0">
            <button class="btn text-light btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              GET
            </button>
          </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            <?php
              // SESSION Ausgabe anzeigen Anfang
              echo "<b>GET</b>";
              echo '<pre>';
              print_r( $_GET );
              echo '</pre><br>';
            ?>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header bg-warning" id="headingFive">
          <h2 class="mb-0">
            <button class="btn text-light btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              POST
            </button>
          </h2>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
          <div class="card-body">
            <?php
              // SESSION Ausgabe anzeigen Anfang
              echo "<b>POST</b>";
              echo '<pre>';
              print_r( $_POST );
              echo '</pre><br>';
            ?>
          </div>
        </div>
      </div>
    </div>