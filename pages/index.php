<?php

include '../template/01_doctype.php';

$seitenname = 'musicapo - Dein Musikverein';

// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {
    try {
        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module
                    WHERE 1 GROUP BY `mod_modulegroupcode`
                    ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module
                    WHERE 1
                    ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights
                    WHERE  rr_rolecode = :rc
                    ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);


        $stmt->execute();
        $userRights = $stmt->fetchAll();

        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

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
                                    <h4 class="page-title pull-left">Dashboard</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="#">Home</a></li>
                                    </ul>
                                </div>
                            </div>

                            <?php include '../template/09_usermenu.php'; ?>

                        </div>
                    </div>
                <!-- page title area end -->

                <div class="main-content-inner">

                
                    <!-- MAIN CONTENT GOES HERE -->
                    <div class="card-area">
                        <div class="row">
                        <!-- CARD GEBURTSTAGE -->
                            <?php
                                $sql = "SELECT mglvorname, mglnachname, mglgebdatum,
                                (DAY(`mglgebdatum`)-DAY(CURDATE())) difftage,
                                (YEAR(CURDATE())-YEAR(mglgebdatum)) AS soalt
                                            FROM mitglieder 
                                                WHERE DATE_FORMAT(STR_TO_DATE(`mglgebdatum`, '%Y-%m-%d'), CONCAT(YEAR(NOW()), '-%m-%d')) BETWEEN NOW() - INTERVAL 1 DAY AND NOW() + INTERVAL 14 DAY 
                                                AND mglaktiv = 1
                                                    ORDER BY difftage";
                                $result = $DB->query($sql);

                                $e = function ($value) {
                                    return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                };
                            ?>
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <h5 class="card-header"><i class="fa-solid fa-cake-candles"></i> nächste Geburtstage</h5>
                                    <div class="card-body">
                                    <?php foreach ($result as $row): 
                                        $difftage = $e($row['difftage']);
                                        if($difftage==2){
                                            $difftext = '<p class="text-primary">' . $e($row['mglvorname']) . ' ' . $e($row['mglnachname']) . '<br>' . date('d.m.Y', strtotime($e($row['mglgebdatum']))) . ' - wird Übermorgen ' . $e($row['soalt']) . ' Jahre</p>';
                                        }else if($difftage==1){
                                            $difftext = '<p class="text-warning">' . $e($row['mglvorname']) . ' ' . $e($row['mglnachname']) . '<br>' . date('d.m.Y', strtotime($e($row['mglgebdatum']))) . ' - wird Morgen ' . $e($row['soalt']) . ' Jahre</p>';
                                        }else if($difftage==0){
                                            $difftext = '<p class="text-success"><strong>' . $e($row['mglvorname']) . ' ' . $e($row['mglnachname']) . '<br>' . date('d.m.Y', strtotime($e($row['mglgebdatum']))) . ' - ist Heute ' . $e($row['soalt']) . ' Jahre <i class="fa-solid fa-cake-candles text-danger"></i></strong></p>';
                                        }else{
                                            $difftext = '<p class="text-dark">' . $e($row['mglvorname']) . ' ' . $e($row['mglnachname']) . '<br>' . date('d.m.Y', strtotime($e($row['mglgebdatum']))) . ' - wird in ' . $difftage . ' Tagen ' . $e($row['soalt']) . ' Jahre</p>';
                                        }
                                        ?>
                                        <p class="card-text">
                                        <!-- <?=$e($row['mglvorname'])?> <?=$e($row['mglnachname'])?> -->
                                        <?=$difftext?>
                                        </p>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD MITGLIEDERSTAND -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <h5 class="card-header"><i class="fa-solid fa-users"></i> Mitgliederstand</h5>
                                    <div class="card-body">
                                    <?php $sql1 = "SELECT (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=1) as aktive_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=2) as ruhende_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=3) as zahlende_mitglieder
                                                        FROM mitglieder
                                                        LIMIT 1";
                                    $result = $DB->query($sql1);

                                    $e = function ($value) {
                                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                    };
                                    
                                    foreach ($result as $row):
                                    
                                    ?>
                                    <p><h5 class="title text-center"><?=$row['aktive_mitglieder']?> aktive Mitglieder</h5></p>
                                    <p><h5 class="title text-center"><?=$row['ruhende_mitglieder']?> Mitglieder in Ruhestand</h5></p>
                                    <p><h5 class="title text-center"><?=$row['zahlende_mitglieder']?> unterstützende Mitglieder</h5></p>
                                    <?php 
                                        endforeach; 
                                    ?>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD VERANSTALTUNGEN -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <h5 class="card-header"><i class="fa-solid fa-calendar-days"></i> Veranstaltungen</h5>
                                    <div class="card-body">
                                    <?php $sql1 = "SELECT (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=1) as aktive_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=2) as ruhende_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=3) as zahlende_mitglieder
                                                        FROM mitglieder
                                                        LIMIT 1";
                                    $result = $DB->query($sql1);

                                    $e = function ($value) {
                                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                    };
                                    
                                    foreach ($result as $row):
                                    
                                    ?>
                                    <p><h5 class="title text-center"><?=$row['aktive_mitglieder']?> aktive Mitglieder</h5></p>
                                    <p><h5 class="title text-center"><?=$row['ruhende_mitglieder']?> Mitglieder in Ruhestand</h5></p>
                                    <p><h5 class="title text-center"><?=$row['zahlende_mitglieder']?> unterstützende Mitglieder</h5></p>
                                    <?php 
                                        endforeach; 
                                    ?>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD NOTEN -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <h5 class="card-header"><i class="fa-solid fa-music"></i> Noten</h5>
                                    <div class="card-body">
                                    <?php $sql1 = "SELECT (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=1) as aktive_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=2) as ruhende_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=3) as zahlende_mitglieder
                                                        FROM mitglieder
                                                        LIMIT 1";
                                    $result = $DB->query($sql1);

                                    $e = function ($value) {
                                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                    };
                                    
                                    foreach ($result as $row):
                                    
                                    ?>
                                    <p><h5 class="title text-center"><?=$row['aktive_mitglieder']?> aktive Mitglieder</h5></p>
                                    <p><h5 class="title text-center"><?=$row['ruhende_mitglieder']?> Mitglieder in Ruhestand</h5></p>
                                    <p><h5 class="title text-center"><?=$row['zahlende_mitglieder']?> unterstützende Mitglieder</h5></p>
                                    <?php 
                                        endforeach; 
                                    ?>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD INSTRUMENTE -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <h5 class="card-header"><i class="fa-solid fa-drum"></i> Instrumente</h5>
                                    <div class="card-body">
                                    <?php $sql1 = "SELECT (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=1) as aktive_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=2) as ruhende_mitglieder,
                                                    (SELECT COUNT(mglid) FROM mitglieder WHERE mglaktiv=3) as zahlende_mitglieder
                                                        FROM mitglieder
                                                        LIMIT 1";
                                    $result = $DB->query($sql1);

                                    $e = function ($value) {
                                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                                    };
                                    
                                    foreach ($result as $row):
                                    
                                    ?>
                                    <p><h5 class="title text-center"><?=$row['aktive_mitglieder']?> aktive Mitglieder</h5></p>
                                    <p><h5 class="title text-center"><?=$row['ruhende_mitglieder']?> Mitglieder in Ruhestand</h5></p>
                                    <p><h5 class="title text-center"><?=$row['zahlende_mitglieder']?> unterstützende Mitglieder</h5></p>
                                    <?php 
                                        endforeach; 
                                    ?>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <img class="card-img-top img-fluid" src="assets/images/card/card-img6.jpg" alt="image">
                                    <div class="card-body">
                                        <h5 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dicta.</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia adipisci quidem, quam nam reiciendis facere blanditiis atque neque architecto omnis magni totam, voluptate maiores, iusto molestias incidunt unde nesciunt cum.
                                        </p>
                                        <a href="#" class="btn btn-primary">Go More....</a>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <img class="card-img-top img-fluid" src="assets/images/card/card-img7.jpg" alt="image">
                                    <div class="card-body">
                                        <h5 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dicta.</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia adipisci quidem, quam nam reiciendis facere blanditiis atque neque architecto omnis magni totam, voluptate maiores, iusto molestias incidunt unde nesciunt cum.
                                        </p>
                                        <a href="#" class="btn btn-primary">Go More....</a>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <img class="card-img-top img-fluid" src="assets/images/card/card-img8.jpg" alt="image">
                                    <div class="card-body">
                                        <h5 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dicta.</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia adipisci quidem, quam nam reiciendis facere blanditiis atque neque architecto omnis magni totam, voluptate maiores, iusto molestias incidunt unde nesciunt cum.
                                        </p>
                                        <a href="#" class="btn btn-primary">Go More....</a>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD -->
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card card-bordered h-100">
                                    <img class="card-img-top img-fluid" src="assets/images/card/card-img9.jpg" alt="image">
                                    <div class="card-body">
                                        <h5 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dicta.</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia adipisci quidem, quam nam reiciendis facere blanditiis atque neque architecto omnis magni totam, voluptate maiores, iusto molestias incidunt unde nesciunt cum.
                                        </p>
                                        <a href="#" class="btn btn-primary">Go More....</a>
                                    </div>
                                </div>
                            </div>
                        <!-- CARD -->
                        </div>
                    </div>
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
