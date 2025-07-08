<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();
$table  = "historyused";
$ord  = "pid";
$dir  = "DESC";
$limit_start  = 0;
$limit_end    = 10;
if($principal != 1){
  header("location:".$WORKPATH."/");
}
$page         = 1;
if(isset($_GET['page'])){
  $page        = $_GET['page'];
  $limit_start = ($_GET['page'] * $limit_end) - $limit_end;
}
$Tasks = $site->selectWLIMIT($table,$ord,$dir,$limit_start,$limit_end);
$NbTasks = $site->countTable($table);
$next_page = 1;
$nb_pages = ceil($NbTasks/$limit_end);
if( $nb_pages > 1 ){
  $next_page = 1;
}
include("files/pagination.php");
$targetpage = $WORKPATH.'tasks.php?page=';
$pagination = getPaginationString($page, $NbTasks, $limit_end, $adjacents = 1, $targetpage , $pagestring = "");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tâches</title>
<!-- Bootstrap -->
<link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="<?php echo $WORKPATH;?>css/daterangepicker.css" rel="stylesheet">
<!-- iCheck -->
<link href="<?php echo $WORKPATH;?>css/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="<?php echo $WORKPATH;?>css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/scroller.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/select2.mn.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?php echo $WORKPATH;?>css/custom.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/pnotify.css" rel="stylesheet">
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
                <h2>Tâches</h2>
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>Utilisateurs</label>
                      <select id="superworkers" name="superworkers" class="form-control custom-select">
                        <option value="" selected>Toutes les Utilisateurs</option>
                        <?php
                        $PRD = $site->SelectFromTableORD("superworkers","first_name","asc");
                        foreach($PRD as $prd){
                          $pidAgn = $prd['pid'];
                          $nomAgn = stripslashes(utf8_decode($prd['first_name']));
                        ?>
                        <option value="<?php echo $pidAgn;?>"><?php echo $nomAgn;?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>Opérations</label>
                      <select id="operation" name="operation" class="form-control custom-select">
                        <option value="">Opération</option>
                        <option value="login">Ouverture de Session</option>
                        <option value="insert">Ajout</option>
                        <option value="update">Modification</option>
                        <option value="delete">Suppression</option>
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>Date</label>
                      <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span></span> <b class="caret"></b>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>&nbsp;</label>
                      <button class="btn btn-default tasksFilter form-control" type="button">Filtrer</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                      <table class="table table-responsive">
                        <thead>
                          <tr>
                            <th>Utilisateur</th>
                            <th>Tâche</th>
                            <th>Opération</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($Tasks as $Task) {
                            $Pid           = $Task['pid'];
                            
                            $superworker   = $Task['superWorker'];
                            $superWorker = '';
                            if($superworker != 0){
                              $SUPER        = $site->SelectObjectTableWC("superworkers","pid",$superworker,"pid","ASC");
                              $superWorker  = ucfirst(stripslashes(utf8_decode($SUPER->first_name)));
                            }
                            $insertedOn   = $Task['insertedOn'];
                            $tache        = $Task['tache'];
                            $usedTable    = $Task['usedTable'];

                            $TachesGsa    = TachesGsa($tache,$usedTable);

                            $Tache        = $TachesGsa['Tache'];
                            $Operation    = $TachesGsa['Operation'];
                          ?>
                          <tr>
                            <td><?php echo $superWorker;?></td>
                            <td><?php echo $Operation;?></td>
                            <td><?php echo $Tache;?></td>
                            <td><?php echo DATUML($insertedOn);?></td>
                          </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                      <div>
                        <?php echo $pagination;?>
                      </div>
                    </div>
                  </div>
                </div>
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
<!-- bootstrap-daterangepicker -->
<script src="<?php echo $WORKPATH;?>js/moment.min.js"></script>
<script src="<?php echo $WORKPATH;?>js/daterangepicker.js"></script>
<!-- iCheck -->
<script src="<?php echo $WORKPATH;?>js/icheck.min.js"></script>
<script src="<?php echo $WORKPATH;?>js/select2.min.js"></script>
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
<script src="<?php echo $WORKPATH;?>js/customm.js"></script>
<script src="<?php echo $WORKPATH;?>js/pnotify.js"></script>
<script src="<?php echo $WORKPATH;?>js/reportrange.min.js"></script>
</body>
</html>
