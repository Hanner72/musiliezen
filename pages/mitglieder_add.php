<?php

include '../template/01_doctype.php';

$seitenname = 'musicapo - Dein Musikverein';

include '../template/02_head.php';

?>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- preloader area start -->
        <?php include '../template/03_preloader.php'; ?>
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

                <!-- page title area start -->
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Mitglieder</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="mitglieder.php">Mitgliederliste</a></li>
                                        <li><span>Mitglieder hinzufügen</span></li>
                                    </ul>
                                </div>
                            </div>

                            <?php include '../template/09_usermenu.php'; ?>

                        </div>
                    </div>
                <!-- page title area end -->

                <div class="main-content-inner">

                    <!-- MAIN CONTENT GOES HERE -->
                    <?php require("../assets/inc/func_mitglieder_add.php"); ?>

                    <form class="container was-validated" novalidate="" action="mitglieder_add.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label class="form-control-label" for="mglvorname">Vorname</label>
                            <input type="text" name="mglvorname" id="mglvorname" class="form-control" required="">
                            <div class="invalid-feedback">
                                Bitte Vornamen eintragen. * PFLICHTFELD
                            </div>
                            <div class="valid-feedback">
                                Schaut gut aus!
                            </div>
                            </div>
                            <div class="form-group col-md-6">
                            <label class="form-control-label" for="mglnachname">Nachname</label>
                            <input type="text" name="mglnachname" id="mglnachname" class="form-control" required="">
                            <div class="invalid-feedback">
                                Bitte Nachnamen eintragen. * PFLICHTFELD
                            </div>
                            <div class="valid-feedback">
                                Schaut gut aus!
                            </div>
                            </div>
                            <div class="form-group col-md-2">
                            <label class="form-control-label" for="mglgebdatum">geb. Datum</label>
                            <input type="date" name="mglgebdatum" id="mglgebdatum" class="form-control" placeholder="01.01.2000"
                                required="">
                            <div class="invalid-feedback">
                                Bitte geb. Datum eintragen. * PFLICHTFELD
                            </div>
                            <div class="valid-feedback">
                                Schaut gut aus!
                            </div>
                            </div>
                            <div class="form-group col-md-3">
                            <label class="form-control-label" for="mglbild">Portrait</label>
                            <input type="file"  accept="image/gif,image/jpeg,image/png" name="mglbild" id="mglbild" class="form-control">
                            <div class="is-valid">
                                kein Pflichtfeld
                            </div>
                            </div>
                            <div class="form-group col-md-6">
                            <label class="form-control-label" for="mglmail">Mail-adresse</label>
                            <input type="text" name="mglmail" id="mglmail" class="form-control" placeholder="mail@domain.at"
                                required="">
                            <div class="invalid-feedback">
                                Bitte mail Adresse eintragen. * PFLICHTFELD
                            </div>
                            <div class="valid-feedback">
                                Hoffentlich passt die so!
                            </div>
                            </div>
                            <div class="form-group col-md-2">
                            <label class="form-control-label" for="mglplz">PLZ</label>
                            <input type="text" name="mglplz" id="mglplz" class="form-control" placeholder="1234">
                            <div class="is-valid">
                                kein Pflichtfeld
                            </div>
                            </div>
                            <div class="form-group col-md-5">
                            <label class="form-control-label" for="mglort">Ort/Stadt</label>
                            <input type="text" name="mglort" id="mglort" class="form-control" placeholder="Musterort">
                            <div class="is-valid">
                                kein Pflichtfeld
                            </div>
                            </div>
                            <div class="form-group col-md-5">
                            <label class="form-control-label" for="mgladresse">Anschrift</label>
                            <input type="text" name="mgladresse" id="mgladresse" class="form-control" placeholder="Anschrift, Hausnr.">
                            <div class="is-valid">
                                kein Pflichtfeld
                            </div>
                            </div>
                            <div class="form-group col-md-4">
                            <label class="form-control-label" for="mglbeginn">Eintrittsdatum</label>
                            <input type="date" name="mglbeginn" id="mglbeginn" class="form-control" placeholder="01.01.2000"
                                required="">
                            <div class="invalid-feedback">
                                Bitte Eintrittsdatum eintragen. * PFLICHTFELD
                            </div>
                            <div class="valid-feedback">
                                Schaut gut aus!
                            </div>
                            </div>
                            <div class="form-group col-md-4">
                            <label class="form-control-label" for="mglaktiv">Status</label>
                            <select type="date" name="mglaktiv" id="mglaktiv" class="form-control" required="">
                                <option value="">Status</option>
                                <option value="1">Aktiver Musikant</option>
                                <option value="2">Musikant in Ruhestand</option>
                                <option value="0">zahlendes Mitglied</option>
                            </select>
                            <div class="invalid-feedback">
                                Bitte Status auswählen. * PFLICHTFELD
                            </div>
                            <div class="valid-feedback">
                                Schaut gut aus!
                            </div>
                            </div>
                            <div class="form-group col-md-4">
                            <label class="form-control-label" for="mglende">Austrittsdatum</label>
                            <input type="date" name="mglende" id="mglende" class="form-control">
                            <div class="is-valid">
                                kein Pflichtfeld
                            </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit">Speichern</button>
                        </form>
                    <!-- / MAIN CONTENT GOES HERE -->

                </div>
            </div>                              
        <!-- main content area end -->

        <!-- footer area start-->
            <?php include '../template/06_footertext.php'; ?>
        <!-- footer area end-->

    </div>
    <!-- page container area end -->

    <!-- offset area start -->
        <?php include '../template/07_einstellungsmenu.php'; ?>
    <!-- offset area end -->

    <?php include '../template/08_footer.php'; ?>
    
</body>

</html>
