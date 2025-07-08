<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

$table = "pays";
$champ = "id_pays";
$value = $_GET['pid'];
$ord   = "id_pays";
$dir   = "ASC";


$IsProd = $site->countTableWC($table,$champ,$value);
if($IsProd == 0){
  header("location:".$WORKPATH."countries.php");
}

$prd   = $site->SelectObjectTableWC($table,$champ,$value,$ord,$dir);

$PaysPid    = stripslashes(utf8_decode($prd->id_pays));
$PaysCode   = stripslashes(utf8_decode($prd->code));
$PaysAlpha2 = stripslashes(utf8_decode($prd->alpha2));
$PaysAlpha3 = stripslashes(utf8_decode($prd->alpha3));
$PaysNom    = stripslashes(utf8_decode($prd->nom));

$IsCity = $site->countTableWC("ville","id_pays",$PaysPid);
$Cities   = $site->SelectFromTableWC("ville","id_pays",$PaysPid,"nom_fra","ASC");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pays</title>

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
                    <h2><?php echo $PaysNom;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <input type="hidden" id="action" name="action" value="country_update">
                      <input type="hidden" id="PaysPid" name="PaysPid" value="<?php echo $PaysPid;?>">
                      <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <label class="control-label " for="PaysNom">Nom Pays <span class="required">*</span></label>
                          <input id="PaysNom" value="<?php echo $PaysNom;?>" class="form-control col-md-12 col-sm-12 col-xs-12" name="PaysNom" placeholder="Nom Pays" required="required" type="text">
                        </div>
                      
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <label class="control-label " for="PaysAlpha2">Pays Alpha 2 <span class="required">*</span></label>
                          <input id="PaysAlpha2" value="<?php echo $PaysAlpha2;?>" class="form-control col-md-12 col-sm-12 col-xs-12" name="PaysAlpha2" placeholder="Pays Alpha 2" required="required" type="text">
                        </div>
                      
                        <div class="col-md-4 col-sm-6 col-xs-12">
                        <label for="PaysAlpha3" class="control-label">Pays Alpha 3 <span class="required">*</span></label>
                        <input id="PaysAlpha3" value="<?php echo $PaysAlpha3;?>" class="form-control col-md-12 col-sm-12 col-xs-12" name="PaysAlpha3" placeholder="Pays Alpha 3" required="required" type="text" >
                        </div>
                      </div>
                      <div class="clearfix"></div>

                      <div class="form-group">
                        <div class="col-md-6">
                          <button id="country_update" class="btn btn-success">Sauvegarder</button>
                          <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#CityAddNew">Ajouter Ville</button>
                        </div>
                      </div>


                      <div class="modal modal-center fade" id="CityAddNew" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Nouvelle Ville</h5>
                              <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-left">

                              <div class="row" id="CityNew">
                                <div class="form-group col-md-6">
                                  <label class="col-form-label require" for="CityNomFra">Nom Ville Fra</label>
                                  <input type="text" class="form-control" id="CityNomFra" value="" required="">
                                  <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-form-label require" for="CityNomEng">Nom Ville Eng</label>
                                  <input type="text" class="form-control" id="CityNomEng" value="" required="">
                                  <div class="invalid-feedback"></div>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Annuler</button>
                              <button type="button" class="btn btn-bold btn-pure btn-primary CityAdd">Ajouter Ville</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

                  <?php
                  if($IsCity > 0){
                  ?>
                  <div class="x_content">
                    <form data-provide="validation" data-disable="false">
                      <div class="card-body row">
                        <?php
                        foreach($Cities as $City){
                          $CityPid    = $City['id_ville'];
                          $CityNomFra = stripslashes(utf8_decode($City['nom_fra']));
                          $CityNomEng = stripslashes(utf8_decode($City['nom_eng']));
                        ?>
                        <div class="col-md-4 col-sm-4" id="City<?php echo $CityPid;?>">
                            <div class="form-group col-md-4 col-sm-4">
                              <label class="col-form-label require" for="CityNomFra<?php echo $CityPid;?>">Nom Ville Fra</label>
                              <input type="text" class="form-control" id="CityNomFra<?php echo $CityPid;?>" value="<?php echo $CityNomFra;?>" required="">
                              <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-md-4 col-sm-4">
                              <label class="col-form-label require" for="CityNomEng<?php echo $CityPid;?>">Nom Ville Eng</label>
                              <input type="text" class="form-control" id="CityNomEng<?php echo $CityPid;?>" value="<?php echo $CityNomEng;?>" required="">
                              <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-md-4 col-sm-4">
                              <label class="col-form-label">Action</label><br>
                              <a class="btn btn-square btn-success hover-success CityUpdate" data-provide="tooltip" data-tooltip-color="success" title="Update" rt="1" p="<?php echo $CityPid;?>"><i class="fa fa-check text-white"></i></a>
                              <a class="btn btn-square btn-danger hover-danger CityRemove" data-provide="tooltip" data-tooltip-color="danger" title="Remove" p="<?php echo $CityPid;?>"><i class="fa fa-minus text-white"></i></a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                      </div>
                    </form>
                  </div>
                  <?php } ?>

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
    <script type="text/javascript">
        HOME = "<?php echo $WORKPATH;?>";
    </script>
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
    <script src="<?php echo $WORKPATH;?>js/customm.js"></script>
    <script src="<?php echo $WORKPATH;?>js/pnotify.js"></script>
  </body>
</html>