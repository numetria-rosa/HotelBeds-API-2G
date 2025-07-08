<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();
$table = "markup";
$ord   = "markup_b2b";
$dir   = "ASC";
if ($principal !=1) {
  header("location:" . $WORKPATH . "/");
}
$IsMarkup = $site->countTable($table);


$Markup = $site->SelectLastObjectTable($table, $ord, $dir);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Markup</title>

  <!-- Bootstrap -->
  <link href="<?php echo $WORKPATH; ?>css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo $WORKPATH; ?>css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo $WORKPATH; ?>css/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo $WORKPATH; ?>css/custom.min.css" rel="stylesheet">
  <link href="<?php echo $WORKPATH;?>css/pnotify.css" rel="stylesheet">
<style>
.custom-notification-alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.custom-notification-alert-success .ui-pnotify .notification .ui-pnotify-icon > span {
    border-color: #c3e6cb;
}


</style>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include_once("files/main_menu.php"); ?>

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  <form class="form-horizontal form-label-left" method="post" action="<?php echo $WORKPATH; ?>files/functions_confirm.php" novalidate>
                    <span class="section">Mark up</span>
                    <input type="hidden" name="action" value="markup_update">
                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12">
                      <div class="row">
                        <div class="form-group col-md-6 col-sm-6 ">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deposit">Markup b2c <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  class="form-control col-md-7 col-xs-12" name="markup_b2c" id="markup_b2c" required="required" type="text" value="<?php echo $Markup->markup_b2c  ?>">
                          </div>
                          <div class="form-group col-md-2 col-sm-2">
                            <a class="btn btn-square btn-success hover-success CityUpdate" data-provide="tooltip" data-tooltip-color="success" title="Update" rt="1" p="" id="markup_b2cB"><i class="fa fa-check text-white"></i></a>
                          </div>
                        </div>
                   
                      </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                      <div class="row">
                        <div class="form-group col-md-6 col-sm-6 ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deposit">Markup b2b <span class="required">*</span>
                      </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" name="markup_b2b" id="markup_b2b" required="required" type="text" value="<?php echo $Markup->markup_b2b  ?>">
                          </div>
                          <div class="form-group col-md-2 col-sm-2">
                            <a class="btn btn-square btn-success hover-success CityUpdate" data-provide="tooltip" data-tooltip-color="success" title="Update" rt="1" p="" id="markup_b2bB"><i class="fa fa-check text-white"></i></a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="row">
                        <div class="form-group col-md-6 col-sm-6 ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deposit">Markup b2e <span class="required">*</span>
                         </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" name="markup_b2e"  id="markup_b2e" required="required" type="text" value="<?php echo $Markup->markup_b2e ?>">
                          </div>
                          <div class="form-group col-md-2 col-sm-2">
                            <a class="btn btn-square btn-success hover-success CityUpdate" data-provide="tooltip" data-tooltip-color="success" title="Update" rt="1" p="" id="markup_b2eB"><i class="fa fa-check text-white"></i></a>
                          </div>
                        </div>
                       
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <?php include_once("files/footer.php"); ?>
      <!-- /footer content -->
    </div>
  </div>
  <script>
    HOME = '<?php echo $WORKPATH; ?>';
  </script>
  <!-- jQuery -->
  <script src="<?php echo $WORKPATH; ?>js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo $WORKPATH; ?>js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo $WORKPATH; ?>js/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo $WORKPATH; ?>js/nprogress.js"></script>
  <!-- validator -->
  <script src="<?php echo $WORKPATH; ?>js/validator.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="<?php echo $WORKPATH; ?>js/custom.min.js"></script>
  <script src="<?php echo $WORKPATH;?>js/pnotify.js"></script>
  <!-- validator -->
  <script>
    $( document ).ready(function() {
      function notify (message, type){
    new PNotify({
        title: false,
        text: message,
        type: 'custom',
        addclass: 'custom-notification-alert-success',
        icon: false,
        buttons: {
                sticker: false
            }
    });
}

 $("#markup_b2cB").click(function (e) {
            var dataString = 'markupb2c=' + $('#markup_b2c').val()  + '&action=updateMarkupB2c';
            $.ajax({
                type: "POST",
                url:"/admin/files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {  
                  notify ('Markup edité avec succés', 'info');
                }
            }); 
    });
    $("#markup_b2bB").click(function (e) {
            var dataString = 'markupb2b=' + $('#markup_b2b').val()  + '&action=updateMarkupB2b';
            $.ajax({
                type: "POST",
                url:"/admin/files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {
                  notify ('Markup edité avec succés', 'info');
                }
            });  
    });
    $("#markup_b2eB").click(function (e) {
            var dataString = 'markupb2e=' + $('#markup_b2e').val()  + '&action=updateMarkupB2e';
            $.ajax({
                type: "POST",
                url:"/admin/files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {
                  notify ('Markup edité avec succés', 'info');
                }
            });
    });
    $("#markup_perB").click(function (e) {
            var dataString = 'markuppersonne=' + $('#markuppersonne').val()  + '&action=updateMarkuppersonne';
            $.ajax({
                type: "POST",
                url:"/admin/files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {   notify ('markup edité avec succés', 'info');
                }
            });
        
    });
    $("#markup_perB2b").click(function (e) {
            var dataString = 'markuppersonne=' + $('#markuppersonneb2b').val()  + '&action=updateMarkuppersonneb2b';
            $.ajax({
                type: "POST",
                url:"/admin/files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {
                  notify ('Markup edité avec succés', 'info'); 
                }
            });
        
    });
    $("#markup_perB2e").click(function (e) {
            var dataString = 'markuppersonne=' + $('#markuppersonneb2e').val()  + '&action=updateMarkuppersonneb2e';
            $.ajax({
                type: "POST",
                url:"/admin/files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {
                  notify ('markup edité avec succés', 'info');
                }
            });
        
    });
  });
  </script>
  <!-- /validator -->
</body>

</html>