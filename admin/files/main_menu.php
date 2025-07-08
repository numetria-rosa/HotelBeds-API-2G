<?php
$super_roles    = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->role));
$principal   = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->principal));
$roles          = explode(',', $super_roles);
?>
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/admin" class="site_title"><span><?php echo $SITE_NAME;?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $WORKPATH;?>images/img.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                  <h2> <strong>Bienvenue,</strong><h2>
                  <h2><strong><?php echo stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->first_name));?></strong></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                <?php
                  if($roles[0] == 1 || $roles[1] == 2 || $principal ==1){
                  ?>
                  <li>
                    <a><i class="fa fa-building"></i> Affiliates </a>
                    <ul class="nav child_menu">
                    <?php if($principal== 1 ){
                      ?>
                      <li><a href="<?php echo $WORKPATH;?>superworkers.php">Admins</a></li>
                      <?php
                        }
                      ?> 
                      <li><a href="<?php echo $WORKPATH;?>agences_b2c.php">B2C</a></li>
                      <li><a href="<?php echo $WORKPATH;?>agences_b2b.php">B2B</a></li>
                      <li><a href="<?php echo $WORKPATH;?>agences_b2e.php">B2E</a></li>
                    </ul>
                  </li>
                  <?php
                  }
                  ?>
           
				         <?php
				           if($roles[0] == 1 || $roles[2] == 3 || $principal ==1){
                  ?>
                  <li><a href="<?php echo $WORKPATH;?>devises.php"><i class="fa fa-money"></i> Devises </a></li>
				         <?php
                  }
                  ?>
				         <?php
			  if($roles[0] == 1 || $roles[3] == 4 || $principal ==1){
          ?>
          <li><a href="<?php echo $WORKPATH;?>countries.php"><i class="fa fa-globe"></i> Pays </a></li>
          <?php
          }
            ?>
              <?php if($principal== 1 ){?>
            <li><a href="<?php echo $WORKPATH;?>markup.php"><i class="fa fa-globe"></i> Markup </a></li>
            <?php } ?>
            <?php
           
                  if($roles[0] == 1 || $roles[4] == 5 || $principal ==1){
                  ?>
                  <li><a href="<?php echo $WORKPATH;?>reservations.php"><i class="fa fa-ticket"></i> Réservations </a></li>
                  <?php
                  }
                  if($principal == 1 ){
                    ?>
                    <li>
                      <a href="<?php echo $WORKPATH;?>tasks.php"><i class="fa fa-tasks"></i> Tâches </a></li>
                    </li>
                 <?php  } ?>
				         <?php
                  if($roles[0] == 1 || $roles[5] == 6|| $principal ==1){
                  ?>
                  <li>
                    <a href="<?php echo $WORKPATH;?>online.php"><i class="fa fa-tasks"></i> Online </a></li>
                  </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $WORKPATH;?>images/img.png" alt=""><?php echo stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->first_name));?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo $WORKPATH;?>superworker.php?pid=<?php echo $_SESSION['SuperSuperAdmin']->pid;?>"> Profile</a></li>
                    <li><a href="<?php echo $WORKPATH;?>logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
