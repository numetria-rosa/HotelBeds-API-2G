<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

if($superRoles[4] != 5){
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

    <title>Devises</title>

    <!-- Bootstrap -->
    <link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $WORKPATH;?>css/green.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
    <!-- bootstrap-select -->
    <link href="<?php echo $WORKPATH;?>css/bootstrap-select.min.css" rel="stylesheet">
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
                  
                  <div class="x_content">
                      <input type="hidden" id="action" name="action" value="devise_insert">
                      <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label " for="CurrLongName">Currency Long Name <span class="required">*</span></label>
                          <input id="CurrLongName" value="" class="form-control col-md-12 col-sm-12 col-xs-12" name="CurrLongName" placeholder="Currency Long Name" required="required" type="text">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label " for="CurrShortName">Currency Short Name <span class="required">*</span></label>
                          <input id="CurrShortName" value="" class="form-control col-md-12 col-sm-12 col-xs-12" name="CurrShortName" placeholder="Currency Short Name" required="required" type="text">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="CurrChange" class="control-label">Currency Change (Currency To TND) <span class="required">*</span></label>
                        <input id="CurrChange" value="" class="form-control col-md-12 col-sm-12 col-xs-12" name="CurrChange" placeholder="Currency Change" required="required" type="text" >
                        </div>
                      </div>
                      <div class="clearfix"></div>

                      <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="CurrToTND" class="control-label">Currency Change (TND To Currency) <span class="required">*</span></label>
                        <input id="CurrToTND" value="" class="form-control col-md-12 col-sm-12 col-xs-12" name="CurrToTND" placeholder="Currency Change" required="required" type="text" >
                        </div>
                      </div>
                      <div class="clearfix"></div>

                      <div class="form-group">
                        <div class="col-md-6">
                          <button id="devise_insert" class="btn btn-success">Sauvegarder</button>
                        </div>
                      </div>
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
    <!-- validator -->
    <script src="<?php echo $WORKPATH;?>js/validator.js"></script>
    <!-- bootstrap-select -->
    <script src="<?php echo $WORKPATH;?>js/bootstrap-select.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo $WORKPATH;?>js/select2.full.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.js"></script>
  </body>
</html>