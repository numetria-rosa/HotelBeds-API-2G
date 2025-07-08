<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

$table = "superworkers";
$ord   = "etat";
$dir   = "DESC";

if($superRoles[3] != 4){
  header("location:".$WORKPATH."/");
}
$SUPERWORKERS = $site->SelectFromTableORD($table,$ord,$dir);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Utilisateurs</title>

    <!-- Bootstrap -->
    <link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $WORKPATH;?>css/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo $WORKPATH;?>css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $WORKPATH;?>css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include_once("files/main_menu.php");?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Utilisateurs</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-sm btn-default" href="<?php echo $WORKPATH;?>superworkers_add.php"><i class="fa fa-plus"></i> Ajouter</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered table-buttons">
                      <thead>
                        <tr>
                          <th>Nom</th>
                          <th>Prénom</th>
                          <th>Email</th>
                          <th>Login</th>
                          <th>Date de Création</th>
                          <th>État</th>
                          <th>Action</th>
                          <th>Détails</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
						if($_SESSION['SuperSuperAdmin']->pid != 1){
							foreach ($SUPERWORKERS as $superworkers) {
								$super_pid      = stripslashes(utf8_decode($superworkers['pid']));
								$super_nom      = stripslashes(utf8_decode($superworkers['last_name']));
								$super_prenom   = stripslashes(utf8_decode($superworkers['first_name']));
								$super_email    = stripslashes(utf8_decode($superworkers['email']));
								$super_login    = stripslashes(utf8_decode($superworkers['login']));
								$super_creation = stripslashes(utf8_decode($superworkers['created_on']));

								$super_etat   = stripslashes(utf8_decode($superworkers['etat']));
								if($super_etat == 0){
									$action = '<a class="btn btn-success btn-sm super_activ" p="'.$super_pid.'" e="'.$super_etat.'">  Activer </a>';
                  $etat='Désactivé';
								}else{
									$action = '<a class="btn btn-danger btn-sm super_activ" p="'.$super_pid.'" e="'.$super_etat.'"> Désactiver </a>';
                  $etat='Activé';
								}

             

								if($super_pid != 1){

                        ?>
                        <tr id="super_activ<?php echo $super_pid;?>">
                          <td><?php echo $super_nom;?></td>
                          <td><?php echo $super_prenom;?></td>
                          <td><?php echo $super_email;?></td>
                          <td><?php echo $super_login;?></td>
                          <td><?php echo DATUML($super_creation);?></td>
                          <td><?php echo $etat;?></td>
                          <td><?php echo $action;?></td>
                          <td><a class="btn btn-info btn-sm" href="<?php echo $WORKPATH;?>superworker.php?pid=<?php echo $super_pid;?>"> Détails </a></td>
                        </tr>
                        <?php
								}
							}
						}else{
							foreach ($SUPERWORKERS as $superworkers) {
								$super_pid      = stripslashes(utf8_decode($superworkers['pid']));
								$super_nom      = stripslashes(utf8_decode($superworkers['last_name']));
								$super_prenom   = stripslashes(utf8_decode($superworkers['first_name']));
								$super_email    = stripslashes(utf8_decode($superworkers['email']));
								$super_login    = stripslashes(utf8_decode($superworkers['login']));
								$super_creation = stripslashes(utf8_decode($superworkers['created_on']));

								$super_etat   = stripslashes(utf8_decode($superworkers['etat']));
								if($super_etat == 0){
                  $action = '<a class="btn btn-success btn-sm super_activ" p="'.$super_pid.'" e="'.$super_etat.'">  Activer </a>';
                  $etat='Désactivé';
								}else{
									$action = '<a class="btn btn-danger btn-sm super_activ" p="'.$super_pid.'" e="'.$super_etat.'"> Désactiver </a>';
                  $etat='Activé';
								}
                        ?>
						<tr id="super_activ<?php echo $super_pid;?>">
                          <td><?php echo $super_nom;?></td>
                          <td><?php echo $super_prenom;?></td>
                          <td><?php echo $super_email;?></td>
                          <td><?php echo $super_login;?></td>
                          <td><?php echo DATUML($super_creation);?></td>
                          <td><?php echo $etat;?></td>
                          <td><?php echo $action;?></td>
                          <td><a class="btn btn-info btn-sm" href="<?php echo $WORKPATH;?>superworker.php?pid=<?php echo $super_pid;?>"> Détails </a></td>
                        </tr>
						<?php
							}
						}
						?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include_once("files/footer.php");?>
        <!-- /footer content -->
      </div>
    </div>
    <script>
      HOME = '<?php echo $WORKPATH;?>';
    </script>
    <!-- jQuery -->
    <script src="<?php echo $WORKPATH;?>js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $WORKPATH;?>js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $WORKPATH;?>js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $WORKPATH;?>js/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $WORKPATH;?>js/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo $WORKPATH;?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/buttons.flash.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/buttons.html5.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/buttons.print.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dataTables.responsive.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/responsive.bootstrap.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dataTables.scroller.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/jszip.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/pdfmake.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true,
              keys: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 5, 'desc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>