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
                                        <li><span>Mitgliederliste</span></li>
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
                        $sql = "SELECT * FROM mitglieder mg
                                    LEFT JOIN system_users su ON mg.mglid = su.mitglieder_mglid
                                    WHERE mglid!=0
                                        GROUP BY mg.mglid
                                        ORDER BY mg.mglnachname ASC, mg.mglvorname ASC";
                        $result = $DB->query($sql);

                        $e = function ($value) {
                            return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                        };
                    ?>

                    <div class="row mt-2">
                    <div class="col-12 mb-2">
                        <a class="btn btn-outline-success btn-sm" href="mitglieder_add.php">
                        <i class="fa fa-plus"></i> Mitglied hinzufügen </a>
                        <a class="btn btn-outline-primary btn-sm" href="mitglieder_aktiv_pdf.php" target="_blank">
                        <i class="fa fa-print"></i> aktive Mitgliedliste PDF</a>
                    </div>
                    </div>
                    <div class="row">
                    <div class=" data-tables datatable-primary table-responsive-md col-12">
                        <table class="table table-hover mt-3" id="dataTable2">
                        <thead class="bg-warning text-dark">
                            <tr>
                            <th>Status</th>
                            <th class="dno2">Status</th>
                            <th class="dno">Portrait</th>
                            <th class="dno2">Vor- und Nachname</th>
                            <th class="dno">Vorname</th>
                            <th class="dno">Nachname</th>
                            <th class="dno">Geb. Datum</th>
                            <th class="dno">Ort</th>
                            <th class="dno">Adresse</th>
                            <th class="dno">Funktion</th>
                            <th class="dno">Funktion Sortierung</th>
                            <th>Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row): ?>
                            <tr>
                            <td class="align-middle">
                                <?php
                                if ($e($row['mglaktiv']) == 3):
                                    echo '<span class="text-primary" data-toggle="tooltip" data-placement="left" title="zahlendes Mitglied"><i class="fa fa-user fa-sm" data-offset="0 5"></i> <i class="fa-solid fa-coins"></i></span> <span class="text-light">'.$e($row['mglaktiv']).'</span>';
                                elseif ($e($row['mglaktiv']) == 1):
                                    echo '<span class="text-success" data-toggle="tooltip" data-placement="left" title="aktives Mitglied"><i class="fa fa-user fa-sm" data-offset="0 5"></i> <i class="fa fa-play fa-sm"></i></span> <span class="text-light">'.$e($row['mglaktiv']).'</span>';
                                elseif ($e($row['mglaktiv']) == 2):
                                    echo '<span class="text-dark" data-toggle="tooltip" data-placement="left" title="Mitglied in Ruhestand"><i class="fa fa-user fa-sm" data-offset="0 5"></i> <i class="fa fa-pause fa-sm"></i></span> <span class="text-light">'.$e($row['mglaktiv']).'</span>';
                                elseif ($e($row['mglaktiv']) == 9):
                                    echo '<p class="text-danger"><i class="fa fa-eject fa-sm"></i></p>';
                                endif;
                                ?>
                            </td>
                            <td class="align-middle dno2"><?=$e($row['mgl_aktiv_txt'])?></td>
                            <td class="align-middle dno"><a><img src="../img/mglportraits/thumb_<?php echo $e($row['mglbild']); ?>" class="mglthumb z-depth-1" data-toggle="modal" data-target="#modal<?php echo $e($row['mglid']); ?>" width="30"></a></td>
                            <!-- MODAL BEGINN -->
                                <div class="modal fade" id="modal<?php echo $e($row['mglid']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <!--Content-->
                                    <div class="modal-content">
                                    <!--Body-->
                                    <div class="modal-body mb-0 p-0">
                                        <div class="embed-responsive z-depth-1-half">
                                        <img src="../img/mglportraits/<?php echo $e($row['mglbild']); ?>" width="300px">
                                        </div>
                                    </div>
                                    <!--Footer-->
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                    <!--/.Content-->
                                </div>
                                </div>
                            <!-- MODAL ENDE -->
                            <td class="align-middle dno2"><?php echo $e($row['mglvorname']); ?><br><b><?php echo $e($row['mglnachname']); ?></b></td>
                            <td class="align-middle dno"><?php echo $e($row['mglvorname']); ?></td>
                            <td class="align-middle dno"><b><?php echo $e($row['mglnachname']); ?></b></td>
                            <td class="align-middle dno"><?php echo $e($row['mglgebdatum']); ?></td>
                            <td class="align-middle dno"><?php echo $e($row['mglplz']); ?> <?php echo $e($row['mglort']); ?></td>
                            <td class="align-middle dno"><?php echo $e($row['mgladresse']); ?></td>
                            
                            <td class="align-middle dno">
                            <?php // Abfrage um die Funktionen eines Mitgliedes aufzulisten
                                $mglid = $row['mglid'];

                                $sql4 = "SELECT fk.fktname FROM mitglieder mg, funktionen fk, mitglieder_hat_funktionen mf
                                            WHERE mglid!=0
                                            AND mg.mglid = mf.mitglieder_mglid
                                            AND fk.fktid = mf.funktionen_fktid
                                            AND mg.mglid = $mglid";
                                $result4 = $DB->query($sql4);

                                foreach ($result4 as $row4):
                                $funktionen = $row4['fktname'];
                                    
                                    echo $row4['fktname'].'<br>';
                                    
                                endforeach;
                            ?>
                            </td>
                            
                            <td class="align-middle dno"><?php echo $e($row['fktreihung']); ?></td>
                            <td class="align-middle">
                                <!-- for updating mitglieder function -->
                                <?php if (authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["view"])) { ?>
                                <a class="badge bg-primary text-light disabled"
                                href="view_mitglied.php?mglid=<?php echo $e($row['mglid']); ?>" data-toggle="tooltip" data-placement="top" title="Details ansehen">
                                <i class="fa fa-eye"></i></a>
                                <?php } ?>
                                <!-- for updating mitglieder function -->
                                <?php if (authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["edit"])) { ?>
                                    <a class="badge bg-warning text-dark" href="mitglieder_edit.php?mglid=<?php echo $e($row['mglid']); ?>" data-toggle="tooltip" data-placement="top" title="bearbeiten"> <i class="fa fa-edit"></i></a>
                                    <?php if($e($row['mglmail']==NULL || $e($row['mglmail']==""))){ ?>
                                        <a class="badge bg-secondary text-light" href="#" data-toggle="tooltip" data-placement="top" title="zu User machen - keine Mailadresse vohanden!"> <i class="fas fa-user-plus"></i></a>
                                    <?php }else{ 
                                        if($row['u_userid']>0){ ?>
                                            <a class="badge bg-success text-light" href="#" data-toggle="tooltip" data-placement="top" title="ist bereits ein User"> <i class="fas fa-user-plus"></i></a>
                                        <?php }else{ ?>
                                            <a class="badge bg-primary text-light" href="mitglieder_up.php?mglid=<?php echo $e($row['mglid']); ?>" data-toggle="tooltip" data-placement="top" title="zu User machen"> <i class="fas fa-user-plus"></i></a>
                                    <?php }
                                    } 
                                } ?>
                                <!-- for updating mitglieder function -->
                                <?php if (authorize($_SESSION["access"]["VERW"]["MITGLIEDER"]["delete"])) { ?>
                                <a class="badge bg-danger text-light" href="#"
                                data-href="./mitglied_delete.php?mglid=<?php echo $e($row['mglid']); ?>" data-toggle="modal"
                                data-target="#confirm-delete">
                                <i class="fa fa-minus" data-toggle="tooltip" data-placement="top" title="löschen" data-offset="0 9"></i></a>
                                <?php } ?>
                            </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
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

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

</html>
