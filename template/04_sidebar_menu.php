<?php
    $pfad = $_SERVER["PHP_SELF"];
    // #$sub = ""; // Leer lassen wenn kein Unterordner am LIVE-Server verwendet wird
    $sub = "/musicapo2023"; // Ordnername wo das Projekt auf localhost liegt z.B. /dir-ah
    $root = dirname($_SERVER['PHP_SELF']);
?>

<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="#"><img src="../img/musicapo_logo_gelb_auf_grau_500x140.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="<?php if($pfad==$sub."/pages/index.php"){ echo "active"; } ?>">
                        <a href="index.php" aria-expanded="true"><i class="ti-dashboard <?php if($pfad==$sub."/pages/index.php"){ echo "active"; } ?>"></i><span>Dashboard</span></a>
                    </li>
                    <li class="<?php if($pfad==$sub."/pages/mitglieder.php" || $pfad==$sub."/pages/mitglieder_add.php"){ echo "active"; } ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users"></i><span>Mitglieder</span></a>
                        <ul class="collapse">
                            <li class="<?php if($pfad==$sub."/pages/mitglieder.php"){ echo "active"; } ?>"><a href="mitglieder.php">Mitgliederliste</a></li>
                            <li class="<?php if($pfad==$sub."/pages/mitglieder_add.php"){ echo "active"; } ?>"><a href="mitglieder_add.php">Mitglieder hinzufügen</a></li>
                            <li><a href="#">Menuitem 3</a></li>
                        </ul>
                    </li>
                    <li class="<?php if($pfad==$sub."/pages/inventar.php"){ echo "active"; } ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-guitar"></i><span>Inventar</span></a>
                        <ul class="collapse">
                            <li class="<?php if($pfad==$sub."/pages/inventar.php"){ echo "active"; } ?>"><a href="mitglieder.php">Instrumente</a></li>
                            <li><a href="#">Menuitem 2</a></li>
                            <li><a href="#">Menuitem 3</a></li>
                        </ul>
                    </li>
                    <li class="<?php if($pfad==$sub."/pages/noten.php"){ echo "active"; } ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-music"></i><span>Noten</span></a>
                        <ul class="collapse">
                            <li class="<?php if($pfad==$sub."/pages/noten.php"){ echo "active"; } ?>"><a href="mitglieder.php">Notenliste</a></li>
                            <li><a href="#">Menuitem 2</a></li>
                            <li><a href="#">Menuitem 3</a></li>
                        </ul>
                    </li>
                    <li class="<?php if($pfad==$sub."/pages/veranstaltungen.php"){ echo "active"; } ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-calendar-days"></i><span>Veranstaltungen</span></a>
                        <ul class="collapse">
                            <li class="<?php if($pfad==$sub."/pages/veranstaltungen.php"){ echo "active"; } ?>"><a href="veranstaltungen.php">Veranstaltungsliste</a></li>
                            <li><a href="#">Menuitem 2</a></li>
                            <li><a href="#">Menuitem 3</a></li>
                        </ul>
                    </li>
                    <li class="<?php if($pfad==$sub."/pages/verwaltung.php"){ echo "active"; } ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Verwaltung</span></a>
                        <ul class="collapse">
                            <li class="<?php if($pfad==$sub."/pages/register.php"){ echo "active"; } ?>"><a href="register.php">Register</a></li>
                            <li><a href="#">Menuitem 2</a></li>
                            <li><a href="#">Menuitem 3</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="ti-map-alt"></i><span>Not expanding</span></a></li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i>
                            <span>Multi level menu</span></a>
                        <ul class="collapse">
                            <li><a href="#">Item level (1)</a></li>
                            <li><a href="#">Item level (1)</a></li>
                            <li><a href="#" aria-expanded="true">Item level (1)</a>
                                <ul class="collapse">
                                    <li><a href="#">Item level (2)</a></li>
                                    <li><a href="#">Item level (2)</a></li>
                                    <li><a href="#">Item level (2)</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Item level (1)</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>