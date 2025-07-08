<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();
$table = "user";
$ord   = "id";
$dir   = "ASC";
if($superRoles[1] != 2){
  header("location:".$WORKPATH."/");
}
$AGN = $site->SelectFromTableWC($table,'canal','B2C',$ord,$dir);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agences</title>

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
    <link href="<?php echo $WORKPATH;?>css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include_once("files/main_menu.php");?>
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Clients B2C</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-sm btn-default" href="<?php echo $WORKPATH;?>agence_add_b2c.php"><i class="fa fa-plus"></i> Ajouter</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered ">
                      <thead>
                        <tr>
                          <th>Nom</th>
                          <th>Pays</th>
                          <th>Ville</th>
                          <th>Téléphone</th>
                          <th>Email</th>
                          <th>Date de Création</th>
                          <th>Etat</th>
                          <th>Action</th>
                          <th>Détails</th>
                   
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($AGN as $agn) {
                          $agn_pid      = stripslashes(utf8_decode($agn['id']));
                          $agn_nom      = stripslashes(utf8_decode($agn['lastname']));
                          $IDPAYS       = stripslashes(utf8_decode($agn['code_pays']));
                          $PAYS         = $site->SelectObjectTableWC("pays","alpha2",$IDPAYS,"id_pays","ASC");
                          if(isset($PAYS->nom)){
                            $agn_pays     = stripslashes(utf8_decode($PAYS->nom));
                            $id_pays      = stripslashes(utf8_decode($PAYS->id_pays));
                          }else{
                            $agn_pays     = '';
                            $id_pays      = '';
                          }
                          $IDVILLE      = stripslashes(utf8_decode($agn['code_ville']));
                          $VILLE        = $site->SelectObjectTableW2C("ville","id_pays",$id_pays,"id_ville",$IDVILLE,"nom_fra","ASC");
                 
                          if(isset($VILLE->nom_fra)){
                            $agn_ville    = stripslashes(utf8_decode($VILLE->nom_fra));
                          }else{
                            $agn_ville    = '';
                          }
                          $agn_tel      = stripslashes(utf8_decode($agn['telephone']));
                          $Credit       = stripslashes(utf8_decode($agn['credit']));
                          $Devise       = stripslashes(utf8_decode($agn['code_devise']));
                          $agn_email    = stripslashes(utf8_decode($agn['email']));
                          $client_nom   = stripslashes(utf8_decode($agn['lastname']));
                          $client_prenom= stripslashes(utf8_decode($agn['firstname']));
                          $agn_etat     = stripslashes(utf8_decode($agn['Etat']));
                          if($agn_etat == 0){
                            $action = '<a class="btn btn-success btn-sm agn_activ" p="'.$agn_pid.'" e="'.$agn_etat.'"> Activer </a>';
                            $etat='Désactivé';
                          }else{
                            $action = '<a class="btn  btn-danger btn-sm agn_activ" p="'.$agn_pid.'" e="'.$agn_etat.'"> Désactiver </a>';
                            $etat='Activé';
                          }
                          $agn_creation = stripslashes(utf8_decode($agn['CreatedAt']));
                        ?>
                        <tr id="agn_activ<?php echo $agn_pid;?>">
                          <td><?php echo $agn_nom;?></td>
                          <td><?php echo $agn_pays;?></td>
                          <td><?php echo $agn_ville;?></td>
                          <td><?php echo $agn_tel;?></td>
                          <td><?php echo $agn_email;?></td>
                          <td><?php echo DATUML($agn_creation);?></td>   
                          <td align="center"><?php echo $etat;?></td>
                          <td align="center"><?php echo $action;?></td>
                          <td align="center"><a class="btn btn-info btn-sm" href="<?php echo $WORKPATH;?>agence_b2c.php?pid=<?php echo $agn_pid;?>"> Détails </a></td>
                         
                        </tr>
                        <?php
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
        <?php include_once("files/footer.php");?>
      </div>
    </div>
    <script>
      HOME = '<?php echo $WORKPATH;?>';
    </script>
    <script src="<?php echo $WORKPATH;?>js/jquery.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/fastclick.js"></script>
    <script src="<?php echo $WORKPATH;?>js/nprogress.js"></script>
    <script src="<?php echo $WORKPATH;?>js/icheck.min.js"></script>
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
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.js"></script>
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
          ajax: "<?php echo $WORKPATH;?>js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
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
  </body>
</html>