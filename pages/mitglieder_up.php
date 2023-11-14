<?php

include '../template/01_doctype.php';

$seitenname = 'musicapo - Dein Musikverein';

include '../template/02_head.php';

if(isset($_GET['mglid'])){
    $mglid = $_GET['mglid'];
}else{
    echo "
      <script>
        M.toast('Login successful', 2200, 'rounded');
      </script>";
    echo '<META HTTP-EQUIV="Refresh" Content="5; URL=./mitglieder.php">';
}

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
                                    <h4 class="page-title pull-left">leere Seite Titel</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="index.php">Home</a></li>
                                        <li><span>leere Seite</span></li>
                                    </ul>
                                </div>
                            </div>

                            <?php include '../template/09_usermenu.php'; ?>

                        </div>
                    </div>
                <!-- page title area end -->

                <div class="main-content-inner">

                    <!-- MAIN CONTENT GOES HERE -->
                    Da kommt der Seiteninhalt rein.
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
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</body>

</html>
