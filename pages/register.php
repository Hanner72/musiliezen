<?php

include '../template/01_doctype.php';

$seitenname = 'musicapo - Dein Musikverein';

include '../template/02_head.php';

// Register löschen
    if(isset($_GET['regdel'])){
        $regdel = $_GET['regdel'];

        $statement4 = $DB->prepare("DELETE FROM register WHERE regid = ?");
        if($statement4->execute(array($regdel))){
            $_SESSION['alert-class'] = "success";
            $_SESSION['message'] = 'Register wurde erfolgreich gelöscht!';
            $_SESSION['alert-type'] = "INFO";
        }else{
            $error = "SQL Error <br />".$statement4->queryString."<br />".$statement4->errorInfo()[2];
            $_SESSION['alert-class'] = "danger";
            $_SESSION['message'] = 'Register wurde wegen: ' . $error . ' nicht gelöscht!';
            $_SESSION['alert-type'] = "ERROR";
        }
    }

// Mitglied aus Register austragen
    if(isset($_GET['mgl'])){
        $mglid = $_GET['mgl'];
        $sql = "UPDATE mitglieder SET register_regid = ? WHERE mglid = ?";
        $stmt = $DB->prepare($sql);
        if($stmt->execute(array(0, $mglid))){
            $_SESSION['alert-class'] = "success";
            $_SESSION['message'] = 'Mitglied wurde aus Register ausgetragen!';
            $_SESSION['alert-type'] = "INFO";
        }else{
            $error = "SQL Error <br />".$stmt->queryString."<br />".$stmt->errorInfo()[2];
            $_SESSION['alert-class'] = "danger";
            $_SESSION['message'] = 'Mitglied wurde wegen: ' . $error . ' nicht ausgetragen!';
            $_SESSION['alert-type'] = "ERROR";
        }
    }

// Mitglied in Register eintragen
    if(isset($_GET['regid'])){
        $regid = $_GET['regid'];
        $mglid = $_GET['mgl'];
        $sql = "UPDATE mitglieder SET register_regid = ? WHERE mglid = ?";
        $stmt = $DB->prepare($sql);
        if($stmt->execute(array($regid, $mglid))){
            $_SESSION['alert-class'] = "success";
            $_SESSION['message'] = 'Mitglied wurde zu Register hinzugefügt!';
            $_SESSION['alert-type'] = "INFO";
        }else{
            $error = "SQL Error <br />".$stmt->queryString."<br />".$stmt->errorInfo()[2];
            $_SESSION['alert-class'] = "danger";
            $_SESSION['message'] = 'Mitglied wurde wegen: ' . $error . ' nicht hinzugefügt!';
            $_SESSION['alert-type'] = "ERROR";
        }
    }

// Register nach oben sortieren
    if(isset($_GET['sortauf'])){
        $altsort = $_GET['sortauf'];
        $regid = $_GET['regid'];
        $neusort = $altsort-1;

            // oberes Register eines nach unten schieben
            $sql5 = "UPDATE register SET regsort= regsort + 1 WHERE regsort = ($altsort-1) LIMIT 1";
            $stmt = $DB->prepare($sql5);
            $stmt->execute();

        // Register nach oben schieben
        $sql = "UPDATE register SET regsort = ? WHERE regid = ?";
        $stmt = $DB->prepare($sql);
        // $stmt->execute(array($neusort, $regid));
        if($stmt->execute(array($neusort, $regid))){
            $_SESSION['alert-class'] = "info";
            $_SESSION['message'] = 'Register wurde nach oben geschoben';
            $_SESSION['alert-type'] = "INFO";
        }
    }

// Register nach unten sortieren
    if(isset($_GET['sortab'])){
        $altsort = $_GET['sortab'];
        $regid = $_GET['regid'];
        $neusort = $altsort+1;

            // oberes Register eines nach oben schieben
            $sql5 = "UPDATE register SET regsort= regsort - 1 WHERE regsort = ($altsort+1) LIMIT 1";
            $stmt = $DB->prepare($sql5);
            $stmt->execute();

        // Register nach unten schieben
        $sql = "UPDATE register SET regsort = ? WHERE regid = ?";
        $stmt = $DB->prepare($sql);
        if($stmt->execute(array($neusort, $regid))){
            $_SESSION['alert-class'] = "info";
            $_SESSION['message'] = 'Register wurde nach unten geschoben';
            $_SESSION['alert-type'] = "INFO";
        }
    }

// Register ändern
    if(isset($_POST['registereditsenden'])){
        $reglangname = $_POST['reglangname'];
        $regkurzname = $_POST['regkurzname'];
        $regid = $_POST['regid'];

        $statement = $DB->prepare("UPDATE register SET reglangname = :reglangname, regkurzname = :regkurzname WHERE regid = :regid");
        if($statement->execute(array('reglangname' => $reglangname, 'regkurzname' => $regkurzname, 'regid' => $regid))){
            $_SESSION['alert-class'] = "success";
            $_SESSION['message'] = 'Register wurde erfolgreich geändert!';
            $_SESSION['alert-type'] = "INFO";
        }else{
            $error = "SQL Error <br />".$statement->queryString."<br />".$statement->errorInfo()[2];
            
            $_SESSION['alert-class'] = "danger";
            $_SESSION['message'] = 'Register wurde wegen: ' . $error . ' nicht geändert!';
            $_SESSION['alert-type'] = "ERROR";
        }

    }

// Register hinzufügen
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reglangname = $_POST["reglangname"];
        $regkurzname = $_POST["regkurzname"];

        // größte Sortierungs Zahl rausfinden
        $sql = "SELECT MAX(regsort) AS groessteZahl FROM register";
        $result = $DB->query($sql);
        // Ergebnis der Abfrage abrufen
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $groessteZahl = $row["groessteZahl"];
        $naechsteZahl = $groessteZahl+1;

        // Vorbereitete Anweisung ausführen
        $stmt = $DB->prepare("INSERT INTO register (reglangname, regkurzname, regsort) VALUES (:reglangname, :regkurzname, :regsort)");
        $stmt->bindParam(':reglangname', $reglangname);
        $stmt->bindParam(':regkurzname', $regkurzname);
        $stmt->bindParam(':regsort', $naechsteZahl);

            try {
                $stmt->execute();
                $_SESSION['alert-class'] = "success";
                $_SESSION['message'] = 'Register wurde erfolgreich hinzugefügt!';
                $_SESSION['alert-type'] = "INFO";
            } catch(PDOException $e) {
                $_SESSION['alert-class'] = "danger";
                $_SESSION['message'] = 'Register wurde wegen: ' . $e->getMessage() . ' nicht hinzugefügt!';
                $_SESSION['alert-type'] = "ERROR";
            }
    }
?>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- preloader area start -->
        <!-- <?php include '../template/03_preloader.php'; ?> -->
    <!-- preloader area end -->

    <!-- page container area start -->
    <div class="page-container">

        <!-- sidebar menu area start -->
            <?php include '../template/04_sidebar_menu.php'; ?>
        <!-- sidebar menu area end -->

        <!-- main content area start -->
        <div class="main-content">

            <!-- header area start -->
                <?php include '../template/05_header_menu.php'; ?>
            <!-- header area end -->

            <!-- Alert Messages -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class=" p-3 toast" style="margin-top:95px; position: absolute; top: 50px; right: 0;">
                        <div id="liveToast" class="toast hide rounded border border-<?=$_SESSION['alert-class']?>" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="4000">
                            <div class="toast-header p-2 bg-<?=$_SESSION['alert-class']?>">
                                <strong class="mr-auto text-white"><?=$_SESSION['alert-type']?></strong>
                                <!-- <button type="button" class="btn-close btn-close-white me-2 m-auto" data-dismiss="toast" aria-label="Close"></button> -->
                            </div>
                            <div class="toast-body bg-white p-2">
                                <?=$_SESSION['message']?>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var toast = new bootstrap.Toast(document.getElementById('liveToast'));
                            toast.show();
                        });
                    </script>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['alert-class']);
                    unset($_SESSION['alert-type']);
                    ?>
                <?php endif; ?>
            <!-- /Alert Messages -->
            
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Verwaltung</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Register</span></li>
                            </ul>
                        </div>
                    </div>
                    
                    <?php include '../template/09_usermenu.php'; ?>

                </div>
            </div>
            <!-- page title area end -->

            <div class="main-content-inner">

                <!-- MAIN CONTENT GOES HERE -->
                <?php
                    $sql = "SELECT * FROM register ORDER BY regsort ASC";
                    $result = $DB->query($sql);

                    $e = function ($value) {
                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                    };
                ?>

                <div class="row mt-2">
                    <div class="col-12 mb-2">
                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus"></i> Register hinzufügen </a>
                        <!-- <a class="btn btn-outline-primary btn-sm" href="mitglieder_aktiv_pdf.php" target="_blank">
                        <i class="fa fa-print"></i> aktive Mitgliedliste PDF</a> -->
                    </div>
                </div>
                <div class="row">
                    <div class=" data-tables datatable-primary table-responsive-md col-12">
                        <table class="table table-hover mt-3" id="">
                        <thead class="bg-warning text-dark">
                            <tr>
                            <th>ID</th>
                            <th>Name lang</th>
                            <th class="dno">Name kurz</th>
                            <th class="dno text-center">Sortierung</th>
                            <th class="align-middle dno text-center">Musikanten</th>
                            <th class="text-right">Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row): 
                                $regid = $row['regid'];
                                $regsortfind = $row['regsort']; ?>
                            <tr>
                            <td class="align-middle"><?=$row['regid']?></td>
                            <td class="align-middle"><?=$e($row['reglangname'])?></td>
                            <td class="align-middle dno"><?=$e($row['regkurzname'])?></td>
                            <td class="align-middle dno text-center">   <!-- Sortierung -->
                                <?=$e($row['regsort'])?>
                                <?php
                                if($regsortfind <= 0){ ?>
                                    <a class="badge bg-secondary text-light" href="#" data-toggle="tooltip" data-placement="top" title="nicht möglicch, ist bereits ganz oben"> <i class="fa-solid fa-caret-up"></i></a>
                                <?php }else{ ?>
                                    <a class="badge bg-primary text-light" href="?sortauf=<?=$e($row['regsort'])?>&regid=<?=$e($row['regid'])?>" data-toggle="tooltip" data-placement="top" title="nach oben schieben"> <i class="fa-solid fa-caret-up"></i></a>
                                <?php } ?>
                                <a class="badge bg-primary text-light" href="?sortab=<?=$e($row['regsort'])?>&regid=<?=$e($row['regid'])?>" data-toggle="tooltip" data-placement="top" title="nach unten schieben"> <i class="fa-solid fa-caret-down"></i></a>
                            </td>
                            <td class="align-middle dno text-center">   <!-- Anzahl mitglieder pro Register -->
                                <?php
                                    $sql4 = "SELECT *, count(regid) anzahl FROM register rg, mitglieder mg 
                                    WHERE rg.regid = mg.register_regid
                                    AND regid=$regid";
                                    $result = $DB->query($sql4);

                                    $e = function ($value) {
                                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                    };
                                    foreach ($result as $row4): 
                                        echo $row4['anzahl'];
                                    endforeach; ?>
                            </td>
                            <td class="text-right">        <!-- Aktionsbuttons -->
                                <!-- for updating mitglieder function -->
                                <?php if (authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["edit"])) { ?>
                                    <a class="badge bg-warning text-dark editbtn" href="" role="button" data-tooltip="tooltip" title="Kunde bearbeiten" data-toggle="modal" data-target="#registeredit"><i class="fas fa-pencil-alt"></i></a>
                                <?php } ?>
                                <!-- for updating mitglieder function -->
                                <?php if (authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["delete"])) {
                                    if($row4['anzahl'] <= 0){ ?>
                                        <a class="badge bg-danger text-light" href="#"
                                        data-href="?regdel=<?php echo $e($row['regid']); ?>" data-toggle="modal"
                                        data-target="#confirm-delete">
                                        <i class="fa fa-minus" data-toggle="tooltip" data-placement="top" title="löschen" data-offset="0 9"></i></a> <?php
                                    }else{ ?>
                                        <a class="badge bg-secondary text-light" href="#">
                                        <i class="fa fa-minus" data-toggle="tooltip" data-placement="top" title="Löschen nicht möglich! <?=$row4['anzahl']?> Mitglieder in Register" data-offset="0 9"></i></a>
                                <?php }
                                } ?>
                            </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php
                        $sql1 = "SELECT * FROM register ORDER BY regsort ASC";
                        $result1 = $DB->query($sql1);

                        $e = function ($value) {
                            return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                        };
                    ?>

                    <?php foreach ($result1 as $row1): // Schleife um die einzelnen Register abzufgragen
                        $regid = $e($row1['regid']) ?>
                        <div class="col-sm-4">
                            <div class="card border border-warning mb-3">

                                <div class="card-header bg-warning">
                                    <h5><?=$e($row1['reglangname'])?></h5>
                                </div>

                                <div class="card-body">
                                    <?php
                                        $sql2 = "SELECT * FROM mitglieder 
                                                    WHERE mglaktiv=1
                                                    AND (register_regid=$regid OR register_regid=0)";
                                        $result2 = $DB->query($sql2);

                                        $e = function ($value) {
                                            return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                        };
                                    foreach ($result2 as $row2): // Schleife um die Mitglieder der Register abzufragen ?>
                                        <p style="white-space: nowrap;">
                                        <?php if($row2['register_regid']==$regid){ ?>
                                            <span class="badge badge-secondary"><i class="fa-regular fa-circle-check"></i></span> <a href="?mgl=<?=$e($row2['mglid'])?>" role="button"><span class="badge badge-danger" data-toggle="tooltip" title="aus Register austragen"><i class="fa-regular fa-circle-xmark"></i></span></a>
                                        <?php }else{ ?>
                                            <a href="?regid=<?=$e($row1['regid'])?>&mgl=<?=$e($row2['mglid'])?>" role="button"><span class="badge badge-success" data-toggle="tooltip" title="in Register aufnehmen"><i class="fa-regular fa-circle-check"></i></span></a> <span class="badge badge-secondary"><i class="fa-regular fa-circle-xmark"></i></span>
                                        <?php } ?>  
                                        <?=$e($row2['mglnachname'])?>, <?=$e($row2['mglvorname'])?></p>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

<!-- Bestätigungsdialog (Modal) zum löschen -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <i class="fa fa-exclamation-triangle fa-lg text-light mt-2"></i>
                <h5 class="modal-title text-light">Achtung</h5>
            </div>
            <div class="modal-body">
                Willst du den Datensatz wirklich löschen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
            </div>
        </div>
    </div>
<!-- / Bestätigungsdialog (Modal) zum löschen -->

            </div>
            <!-- / MAIN CONTENT GOES HERE -->

        </div>                          
        <!-- main content area end -->

        <!-- footer area start-->
            <?php include '../template/06_footertext.php'; ?>
        <!-- footer area end-->

    </div>
    <!-- page container area end -->

<!-- Register ändern  (Bootstrap MODAL) -->
    <div class="modal fade" id="registeredit" tabindex="-1" role="dialog" aria-labelledby="registereditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
            <h4 class="modal-title" id="registereditLabel"> Register ändern </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
                <input type="hidden" class="form-control mb-1" name="regid" id="regid">
                <label for="reglangname">Register Name lang</label>
                <input type="text" class="form-control mb-1" name="reglangname" id="reglangname">
                <label for="regkurzname">Register Name kurz (max. 5 Zeichen)</label>
                <input type="text" class="form-control mb-1" name="regkurzname" id="regkurzname">

                
            </div>
            <div class="modal-footer">
            <h6 class="mt-3 text-end">eingegebene Daten speichern?</h6>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Nein </button>
                <button type="submit" name="registereditsenden" class="btn btn-primary"> Ja! </button>
            </div>
            </form>

        </div>
        </div>
    </div>
<!-- /Register ändern  (Bootstrap MODAL) -->

<!-- /Register hinzu  (Bootstrap MODAL) -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Daten eingeben</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formular zum Eingeben der Daten -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="reglangname">Register Name Lang:</label>
                            <input type="text" class="form-control" id="reglangname" name="reglangname" required>
                        </div>
                        <div class="form-group">
                            <label for="regkurzname">Register Name kurz (max. 5 Zeichen):</label>
                            <input type="text" class="form-control" id="regkurzname" name="regkurzname" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Daten speichern</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /Register hinzu  (Bootstrap MODAL) -->

    <!-- offset area start -->
        <?php include '../template/07_einstellungsmenu.php'; ?>
    <!-- offset area end -->

    <!-- <?php include '../template/08_footer.php'; ?> -->

    
</body>

<script src="//bootstrap-extension.com/bootstrap-extension-5.0.0/js/bootstrap-extension.min.js"></script>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    /* EDIT MODAL SCRIPT*/
    $(document).ready(function () {
        $('.editbtn').on('click', function () {
            $('#registeredit').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);
            $('#regid').val(data[0]); // z.B. data[0] ist die Tabellenspalte!!!
            $('#reglangname').val(data[1]);
            $('#regkurzname').val(data[2]);
        });
    });
</script>

</html>