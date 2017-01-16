<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$NombreUsuario?></strong></span></span>
                        </a>
<!--                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>-->
                    </div>
                    <div class="logo-element">NWC10</div>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Eventos Inactivos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if(count($eventosInactivos)>0){ ?>
                        <?php foreach($eventosInactivos as $evento){ ?>
                        <li><a href="<?= "evento.php?id_evento=".$evento["id"] ?>" id="evento_<?=$evento["id"]?>" class="evento"><?=$evento["nombre"]?></a></li>
                        <?php }}else{ ?>
                        <li><a href="#">Ninguno</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Eventos Activos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if(count($eventosActivos)>0){ ?>
                        <?php foreach($eventosActivos as $evento){ ?>
                        <li><a href="<?= "evento.php?id_evento=".$evento["id"] ?>" id="evento_<?=$evento["id"]?>" class="evento"><?=$evento["nombre"]?></a></li>
                        <?php }}else{ ?>
                        <li><a href="#">Ninguno</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="nuevoevento.php"><i class="fa fa-pie-chart"></i> <span class="nav-label">Nuevo evento</span>  </a>
                </li>
            </ul>

        </div>
    </nav>

        

