<!-- Sidebar Holder -->
<?php
    $pfad = $_SERVER["PHP_SELF"];
    $sub = "";
    $root = dirname($_SERVER['PHP_SELF']);
?>

<nav id="sidebar">
    <div class="sidebar-header text-center">
        <div class="sidebar-header text-center bg-white mb-3">
            <img src="../assets/images/logo_st1600.png" class="rounded mx-auto img-fluid">
        </div>
        <p class="text-white" style="background: #856811;">Hallo <?php echo $_SESSION['vorname']; $user=$_SESSION['user'] ?>!</p>
        <?php
            $sql = "SELECT * FROM user WHERE username='$user'";
            $result = mysqli_query($conn, $sql);        
        foreach ($result as $row):
                $u_foto = $row['foto']; ?>
        <img src="../admin/userbilder/<?php echo ($row['foto']==NULL) ? 'userleer.png' : $row['foto']; ?>" height="110px" style="border-radius: 50%;">
        <?php endforeach; ?>
    </div>

    <ul class="list-unstyled components mt-3">

        <li class="<?php if ($pfad==$sub."/globalfiles/dashboard.php"){ echo "active"; } ?>"> <!-- wenn der Pfad gleich wie Link, dann ACTIV einfärben -->
            <a href="../globalfiles/dashboard.php"><i class="fa fa-home"></i> HOME</a>
        </li>

<!-- Wertungen MENÜ -->
            <li class="bg-dark">
                <p> -- Wertungen</p>
            </li>

    <!-- Wertungen MENÜ - Konzertwertung -->
        <?php if($rbac->Users->hasRole('Wertung_MOD', $userid)==1){ ?>
            <?php if($pfad==$sub."/lager/lagerstand.php" || // Collapse Menü öffnen wenn Link passt
                    $pfad==$sub."/lager/artikel.php" ||
                    $pfad==$sub."/lager/artikel_neu.php" ||
                    $pfad==$sub."/lager/artikel_edit.php" ||
                    $pfad==$sub."/lager/lagerbewegung.php" ||
                    $pfad==$sub."/lager/lagerbewegungen.php" ||
                    $pfad==$sub."/lager/monatsabschluss.php" ||
                    $pfad==$sub."/lager/artikel_qr.php"){
                        $lageractive = "active"; 
                        $lagerexpand = "true";
                        $lagertoggle = "";
                        $lagershow = "show";
                    }else{
                        $lageractive = "";
                        $lagerexpand = "false";
                        $lagertoggle = "collapsed";
                        $lagershow = "";
                    }?>
            <li class="<?=$lageractive?>">
                <a href="#lagerSubmenu" data-toggle="collapse" aria-expanded="<?=$lagerexpand?>" class="dropdown-toggle <?=$lagertoggle?>">Konzertwertung</a>
                <ul class="collapse list-unstyled <?=$lagershow?>" id="lagerSubmenu">
                    <li class="<?=($pfad==$sub."/lager/artikel.php")?"liactive":""?> lismall">
                        <a href="../lager/artikel.php">Musikvereine</a>
                    </li>
                    <li class="<?=($pfad==$sub."/lager/lagerstand.php")?"liactive":""?>">
                        <a href="../lager/lagerstand.php"><i class="fas fa-chart-line"></i> Lagerstand</a>
                    </li>
                    <li class="<?=($pfad==$sub."/lager/lagerbewegungen.php")?"liactive":""?>">
                        <a href="../lager/lagerbewegungen.php"><i class='fas fa-exchange-alt'></i> Lagerbewegungen</a>
                    </li>
                    <li class="<?=($pfad==$sub."/lager/monatsabschluss.php")?"liactive":""?>">
                        <a href="../lager/monatsabschluss.php"><i class="far fa-calendar-check"></i> Monatsabschluß</a>
                    </li>
                </ul>
            </li>
        <?php } ?> 
    <!-- WWZZ MENÜ - Geräteliste -->
        <!-- <?php if($rbac->Users->hasRole('WW-Admin', $userid)==1){ ?>           
            <li class="<?=($pfad==$sub."/geraete/geraete.php")?"active":""?>">
                <a href="../geraete/geraete.php"><i class="fas fa-wrench"></i> Geräteliste</a>
            </li>
        <?php } ?>  -->
    <!-- WWZZ MENÜ - Bestellwesen -->
        <!-- <?php if($rbac->Users->hasRole('WW-Admin', $userid)==1){ ?>           
            <li>
                <a href="http://bewe.strabag-sport.at/" target="_blank"><i class="fa fa-cart-arrow-down"></i> Bestellwesen</a>
            </li>
        <?php } ?> -->
    <!-- WWZZ MENÜ - Stunden - Kimai -->
        <?php if($rbac->Users->hasRole('WW-Admin', $userid)==1){ 
            if($pfad==$sub."/seiten/ww_stunden_start.php" || 
                $pfad==$sub."/seiten/ww_stunden_export_1.php" || 
                $pfad==$sub."/seiten/ww_stunden_export_2.php"){
                $stundenmenuactive = "active"; 
                $stundenmenuexpand = "true";
                $stundenmenutoggle = "";
                $stundenmenushow = "show";
            }else{
                $stundenmenuactive = "";
                $stundenmenuexpand = "false";
                $stundenmenutoggle = "collapsed";
                $stundenmenushow = "";
            }?>

            <li>
                <a href="#stundenSubmenu" data-toggle="collapse" aria-expanded="<?=$stundenmenuexpand?>" class="dropdown-toggle <?=$stundenmenutoggle?>">Stunden</a>
                <ul class="collapse list-unstyled <?=$stundenmenushow?>" id="stundenSubmenu">
                    <li>
                        <a href="http://zeit.strabag-sport.at/" target="_blank"><i class="fas fa-clock"></i> schreiben</a>
                    </li>
                    <li class="<?php if ($pfad==$sub."/seiten/ww_stunden_export_1.php" || 
                                        $pfad==$sub."/seiten/ww_stunden_export_2.php"){ echo "active"; } ?>">
                        <a href="../seiten/ww_stunden_export_1.php"><i class="fa-solid fa-file-import"></i> Import</a>
                    </li>
                    <li class="<?php if ($pfad==$sub."/seiten/ww_stunden_start.php"){ echo "active"; } ?>">
                        <a href="../seiten/ww_stunden_start.php"><i class="fas fa-user"></i> schütteln</a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    <!-- WWZZ MENÜ - Lieferscheine -->
        <!-- <li class="<?php if ($pfad==$sub."/lieferscheine/index.php"){ echo "active"; } ?>">
            <a href="../lieferscheine/index.php"><i class="fas fa-file-alt"></i> Lieferscheine</a>
        </li> -->
    <!-- WWZZ MENÜ - Fotos senden -->
        <!-- <li class="<?php if ($pfad==$sub."/bilderupload/index.php" ||
                            $pfad==$sub."/bilderupload/akquifoto.php" ||
                            $pfad==$sub."/bilderupload/baustellenfoto.php" ||
                            $pfad==$sub."/bilderupload/baustellenfoto_multi.php" ||
                            $pfad==$sub."/bilderupload/referenzfoto.php"
                            ){ echo "active"; } ?>">
            <a href="../bilderupload/"><i class="fas fa-image"></i> Fotos senden</a>
        </li> -->
<!-- Globale Links MENÜ -->
        <li class="bg-dark">
            <p> -- Globale Links</p>
        </li>
    <!-- Blasmusikverband  MENÜ -->
        <li>
            <a href="https://www.blasmusik.at/" target="_blank">Blasmusikverband</a>
        </li>
    <!-- Blasmusikverband Stmk MENÜ -->
        <li>
            <a href="https://www.blasmusik-verband.at" target="_blank">Blasmusikverband Stmk</a>
        </li>
    <!-- Blasmusikverband Liezen MENÜ -->
        <li>
            <a href="https://www.blasmusik-verband.at/Liezen" target="_blank">Blasmusikverband Liezen</a>
        </li>

<!-- Administration MENÜ -->
            <li class="bg-dark">
                <p> -- Administration</p>
            </li>

            <?php if($rbac->Users->hasRole('Admin', $userid)==1){ 
                if($pfad==$sub."/admin/user.php" || // Collapse Menü öffnen wenn Link passt
                    $pfad==$sub."/admin/roles.php" ||
                    $pfad==$sub."/admin/useredit.php" ||
                    $pfad==$sub."/admin/mysqladmin.php"){
                    $adminmenuactive = "active"; 
                    $adminmenuexpand = "true";
                    $adminmenutoggle = "";
                    $adminmenushow = "show";
                }else{
                    $adminmenuactive = "";
                    $adminmenuexpand = "false";
                    $adminmenutoggle = "collapsed";
                    $adminmenushow = "";
                }?>
    <!-- Benutzeradminmenüs -->
            <li>
                <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="<?=$adminmenuexpand?>" class="dropdown-toggle <?=$adminmenutoggle?>">Administration</a>
                <ul class="collapse list-unstyled <?=$adminmenushow?>" id="adminSubmenu">
                    <li class="<?php if ($pfad==$sub."/admin/user.php" || $pfad==$sub."/admin/useredit.php"){ echo "active"; } ?>">
                        <a href="../admin/user.php"><i class="fas fa-user"></i> Benutzer</a>
                    </li>
                    <li class="<?php if ($pfad==$sub."/admin/roles.php"){ echo "active"; } ?>">
                        <a href="../admin/roles.php"><i class="fas fa-user"></i> Benutzerrollen</a>
                    </li>
    <!-- MySQL Adminmenü -->
                    <li class="<?php if ($pfad==$sub."/admin/mysqladmin.php"){ echo "active"; } ?>">
                        <a href="../admin/mysqladmin.php" target="_blank"><i class="fa-solid fa-database"></i> MySQL Admin</a>
                    </li>
                </ul>
            </li>
    <!-- Musikvereinmenüs -->
                <?php if($pfad==$sub."/admin/musikvereine.php"){
                    $mvmenuactive = "active"; 
                    $mvmenuexpand = "true";
                    $mvmenutoggle = "";
                    $mvmenushow = "show";
                }else{
                    $mvmenuactive = "";
                    $mvmenuexpand = "false";
                    $mvmenutoggle = "collapsed";
                    $mvmenushow = "";
                }?>
            <li>
                <a href="#mvSubmenu" data-toggle="collapse" aria-expanded="<?=$mvmenuexpand?>" class="dropdown-toggle <?=$mvmenutoggle?>">Musikvereine</a>
                <ul class="collapse list-unstyled <?=$mvmenushow?>" id="mvSubmenu">
                    <li class="<?php if ($pfad==$sub."/admin/musikvereine.php"){ echo "active"; } ?>">
                        <a href="../admin/musikvereine.php"><i class="fa-solid fa-list-check"></i> Vereinsliste</a>
                    </li>
                    <li class="<?php if ($pfad==$sub."/admin/roles.php"){ echo "active"; } ?>">
                        <a href="../admin/roles.php"><i class="fas fa-user"></i> Benutzerrollen</a>
                    </li>
                </ul>
            </li>

            <?php if($pfad==$sub."/vorlagen/seitenvorlage.php" || // Collapse Menü öffnen wenn Link passt
                    $pfad==$sub.""){
                    $vorlagenmenuactive = "active"; 
                    $vorlagenmenuexpand = "true";
                    $vorlagenmenutoggle = "";
                    $vorlagenmenushow = "show";
                }else{
                    $vorlagenmenuactive = "";
                    $vorlagenmenuexpand = "false";
                    $vorlagenmenutoggle = "collapsed";
                    $vorlagenmenushow = "";
                }?>
            <li>
    <!-- Vorlagen -->
                <a href="#adminvorlagen" data-toggle="collapse" aria-expanded="<?=$vorlagenmenuexpand?>" class="dropdown-toggle <?=$vorlagenmenutoggle?>">Vorlagen</a>
                <ul class="collapse list-unstyled <?=$vorlagenmenushow?>" id="adminvorlagen">
                    <li class="<?php if ($pfad==$sub."/vorlagen/seitenvorlage.php"){ echo "active"; } ?>">
                        <a href="../vorlagen/seitenvorlage.php"><i class="far fa-file-alt"></i> Seitenvorlage</a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        
<!-- Tests MENÜ -->
        <?php if($rbac->Users->hasRole('Superadmin', $userid)==1){ ?>
            <!-- <li class="bg-black">
                <p> -- DEV Tests</p>
            </li>

            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tests</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="../geo-fotos/">Geo-Fotos</a>
                    </li>
                </ul>
            </li> -->
        <?php } ?>

<!-- Kontakt MENÜ -->
        <!-- <li>
            <a href="#">Contact</a>
        </li> -->
    </ul>

<!-- FOOTER -->
    <ul>
    <div class="row" style="position: absolute; display: inline-block; bottom: 5px;">
        <a href="https://github.com/Hanner72/musiliezen/issues" target="_blank" style="font-size: 12px; margin-left: -19px;">Bugs melden</a>
        <a href="#" style="font-size: 12px; margin-left: -9px;">|</a>
        <a href="https://github.com/Hanner72/musiliezen/discussions" target="_blank" style="font-size: 12px; margin-left: -7px;">Developerforum</a>
    </div>
    </ul>

</nav>