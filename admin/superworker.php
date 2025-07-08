<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

$table = "superworkers";
$champ = "pid";
$value = $_GET['pid'];
$ord   = "last_name";
$dir   = "ASC";

if($value == 1 && $_SESSION['SuperSuperAdmin']->pid != 1){
	header("location:".$WORKPATH."superworkers.php");
}

if($superRoles[3] != 4 && $value != $_SESSION['SuperSuperAdmin']->pid){
  header("location:".$WORKPATH."/");
}

$IsSuper = $site->countTableWC($table,$champ,$value);
if($IsSuper == 0){
  header("location:".$WORKPATH."superworkers.php");
}

$superworkers   = $site->SelectObjectTableWC($table,$champ,$value,$ord,$dir);

$super_pid      = stripslashes(utf8_decode($superworkers->pid));
$super_nom      = stripslashes(utf8_decode($superworkers->last_name));
$super_prenom   = stripslashes(utf8_decode($superworkers->first_name));
$super_email    = stripslashes(utf8_decode($superworkers->email));
$super_login    = stripslashes(utf8_decode($superworkers->login));
$principal    = stripslashes(utf8_decode($superworkers->principal));
$super_password = stripslashes(utf8_decode($superworkers->password));

$Super_roles    = stripslashes(utf8_decode($superworkers->role));
$Roles          = explode(',', $Super_roles);
$super_etat     = stripslashes(utf8_decode($superworkers->etat));



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
                  <div class="x_title">
                    <h2><?php echo $super_nom . " " . $super_prenom;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo $WORKPATH;?>files/functions_confirm.php" novalidate>
                      <span class="section">Informations Personnelles</span>
                      <input type="hidden" name="action" value="worker_save">
                      <input type="hidden" name="pid" value="<?php echo $super_pid;?>">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Nom <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="last_name" value="<?php echo $super_nom;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="last_name" placeholder="Nom" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Prénom <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="first_name" value="<?php echo $super_prenom;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="first_name" placeholder="Prénom" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" value="<?php echo $super_email;?>" required="required" placeholder="Email" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                   
              
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="login">Login <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="login" value="<?php echo $super_login;?>" name="login" required="required" placeholder="Login" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Mot de Passe</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" value="" type="password" name="password" placeholder="Mot de Passe" data-validate-length="3,4" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3">Confirmation Mot de Passe</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password2" value="" type="password" name="password2" placeholder="Confirmation du Mot de Passe" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <?php if($principal==1){ ?>
                      <div class="item form-group">
                        <label class="control-label col-md-3" for="roles">Rôles</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="roles" name="roles[]" class="selectpicker form-control" multiple required>
                            <option value="1"<?php if($Roles[0]==1){?> selected<?php }?>>Accès Complet</option>
                            <option value="2"<?php if($Roles[1]==2){?> selected<?php }?>>Accès Agences</option>
							              <option value="3"<?php if($Roles[2]==3){?> selected<?php }?>>Accès Devises</option>
						              	<option value="4"<?php if($Roles[3]==4){?> selected<?php }?>>Accès Pays</option>
						              	<option value="5"<?php if($Roles[4]==5){?> selected<?php }?>>Accès Réservations</option>
							              <option value="6"<?php if($Roles[5]==6){?> selected<?php }?>>Accès Online</option>
                          </select>
                        </div>
                      </div>
                      <?php }?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="etat">État <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="etat" name="etat" class="form-control col-md-7 col-xs-12" required>
                            <option value="0" <?php if($super_etat == 0){?> selected<?php }?>>Désactivé</option>
                            <option value="1" <?php if($super_etat == 1){?> selected<?php }?>>Activé</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="worker_add" class="btn btn-success">Sauvegarder</button>
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
        <?php include_once("files/footer.php");?>
        <!-- /footer content -->
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

    <!-- Custom Theme Scripts -->
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.js"></script>

    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
    <!--<script src="js/custom.js"></script>-->
  </body>
</html>