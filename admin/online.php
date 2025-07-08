<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

if($superRoles[5] != 6 && $principal !=1){
  header("location:".$WORKPATH."/");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online</title>
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
                <h2>Online</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                      <table class="table table-responsive">
                        <thead>
                          <tr>
                            <th>Agence</th>
                            <th>Agent</th>
                          </tr>
                        </thead>
                        <tbody id="online"> 
                        </tbody>
                      </table>
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
<script src="<?php echo $WORKPATH;?>js/custom.js"></script>
<script>
action      = "fetch_data";
dataString  = "action=" + action;
$.ajax({
type: 'POST',
url: HOME+'files/functions_confirm.php',
data: dataString,
success: function (data) {
 $('#online').html(data);
}
});

</script>
</body>
</html>
