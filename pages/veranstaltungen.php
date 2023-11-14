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

                <!-- page title area start -->
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Veranstaltungen</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="index.php">Home</a></li>
                                        <li><span>Veranstaltungsliste</span></li>
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
                        $sql = "SELECT *, termine.id terminid FROM termine
                                    LEFT JOIN termine_kat ON termine.cal_kategorie_id = termine_kat.id
                                    WHERE vondatum > now()
                                    ORDER BY vondatum ASC, vonzeit ASC";

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
                            <table class="table table-hover mt-3" id="">
                            <thead class="bg-warning text-dark">
                                <tr>
                                <th>ID</th>
                                <th class="dno">Veranstaltung</th>
                                <th class="dno">Beschreibung</th>
                                <th class="dno">wo?</th>
                                <th class="dno">von</th>
                                <th class="dno">bis</th>
                                <th class="dno">Treffpunkt</th>
                                <th class="dno">Kategorie</th>
                                <th>Aktion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row): ?>
                                <tr>
                                    <td class="align-middle"><?=$row['terminid']?></td>
                                    <td class="align-middle dno"  style="display: -webkit-box; margin: 12px 5px 5px 5px; line-height: 1; text-align: center; white-space: nowrap; border-radius: 0.25rem; 
                                color: <?=$row['katfarbe']?>; background-color: <?=$row['kathgfarbe']?>;"  data-toggle="tooltip" data-placement="right" title="Kategorie: <?=$e($row['katname'])?>"><?=$e($row['name'])?></ td>
                                    <td class="align-middle dno"><?=$e($row['beschreibung'])?></td>
                                    <td class="align-middle dno"><?=$e($row['wo'])?></td>
                                    <td class="align-middle dno"><?=$e($row['vondatum'])?>, <?=$e($row['vonzeit'])?></td>
                                    <td class="align-middle dno"><?=$e($row['bisdatum'])?>, <?=$e($row['biszeit'])?></td>
                                    <td class="align-middle dno"><?=$e($row['treffpunkt'])?></td>
                                    <td class="align-middle dno"><?=$e($row['katname'])?></td>
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

                    <?php
                        $sql = "SELECT *, termine.id terminid FROM termine
                                    LEFT JOIN termine_kat ON termine.cal_kategorie_id = termine_kat.id
                                    WHERE vondatum > now()
                                    ORDER BY vondatum ASC, vonzeit ASC";

                        $result = $DB->query($sql);

                        $e = function ($value) {
                            return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                        };
                    ?>

                    
                    <div class="card-deck">
                        <?php foreach ($result as $row): ?>
                            <div class="card border" style="max-width: 20rem;">
                                <div class="card-header" style="color: <?=$row['katfarbe']?>; background-color: <?=$row['kathgfarbe']?>">
                                    <?=$e($row['name'])?>
                                </div>
                                <img src="https://fakeimg.pl/800x300/" class="img-fluid">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$e($row['katname'])?></h5>
                                    <p class="card-text"><?=$e($row['beschreibung'])?></p>
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
