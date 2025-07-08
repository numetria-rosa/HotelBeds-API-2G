<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

$table = "user";
$champ = "id";
$value = $_GET['pid'];
$ord   = "id";
$dir   = "ASC";

if($superRoles[1] != 2){
  header("location:".$WORKPATH."/");
}

$IsAgency = $site->countTableWC($table,$champ,$value);
if($IsAgency == 0){
  header("location:".$WORKPATH."agencies/");
}

$AGN   = $site->SelectObjectTableWC($table,$champ,$value,$ord,$dir);

$agn_pid      = stripslashes(utf8_decode($AGN->id));
$agn_nom      = stripslashes(utf8_decode($AGN->lastname));
if ($AGN->code_pays){
  $IDPAYS       = stripslashes(utf8_decode($AGN->code_pays));
  $PAYS         = $site->SelectObjectTableWC("pays","alpha2",$IDPAYS,"id_pays","ASC");
  $id_pays      = stripslashes(utf8_decode($PAYS->id_pays));
}else{
  $IDPAYS       = 'TN';
  $PAYS         = $site->SelectObjectTableWC("pays","alpha2",$IDPAYS,"id_pays","ASC");
  $id_pays      = stripslashes(utf8_decode($PAYS->id_pays));
}


$IDVILLE      = stripslashes(utf8_decode($AGN->code_ville));

$agn_email    = stripslashes(utf8_decode($AGN->email));
$agn_tel      = stripslashes(utf8_decode($AGN->telephone));
$agn_fax      = stripslashes(utf8_decode($AGN->fax));
$agn_adress   = stripslashes(utf8_decode($AGN->adresse));
$agn_zipcode  = stripslashes(utf8_decode($AGN->code_postal));
$agn_login    = stripslashes(utf8_decode($AGN->username));
$agn_password = stripslashes(utf8_decode($AGN->password));

$agn_rc       = stripslashes(utf8_decode($AGN->reg_commerce));
$agn_mf       = stripslashes(utf8_decode($AGN->num_fiscal));
$agn_licence  = stripslashes(utf8_decode($AGN->num_licence));
$agn_iata     = stripslashes(utf8_decode($AGN->code_iata));
$agn_markup   = stripslashes(utf8_decode($AGN->markup));
$agn_role     = stripslashes(utf8_decode($AGN->roles));
$canal        = stripslashes(utf8_decode($AGN->canal));
$rolesAgn     = explode(',', $agn_role);

$client_nom   = stripslashes(utf8_decode($AGN->lastname));
$client_prenom= stripslashes(utf8_decode($AGN->firstname));
$client_email = stripslashes(utf8_decode($AGN->email));
$client_tel   = stripslashes(utf8_decode($AGN->telephone));
$agn_etat     = stripslashes(utf8_decode($AGN->Etat));
$agn_creation = stripslashes(utf8_decode($AGN->CreatedAt));
$code_devise =$AGN->code_devise;
$markup_personne=$AGN->markup_personne;

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients</title>
    <link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/green.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/bootstrap-select.min.css" rel="stylesheet">
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
                    <h2><?php echo $agn_nom;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo $WORKPATH;?>files/functions_confirm.php" novalidate autocomplete="off">
                      <span class="section col-md-6 col-sm-12 col-xs-12">Données</span>
                      <input type="hidden" name="action" value="agn_update">
                      <input type="hidden" name="agn_pid" value="<?php echo $agn_pid;?>">
                  
                  
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agn_login">Login <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" value="<?php echo $agn_login;?>" id="agn_login" name="agn_login" required="required" placeholder="Login" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_markup" class="control-label col-md-3 col-sm-3 col-xs-12">Password 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="newPassword" value="" type="text" name="newPassword" placeholder="Password" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
               
                      <div class="clearfix"></div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_pays" class="control-label col-md-3 col-sm-3 col-xs-12">Pays <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="agn_pays" name="agn_pays" class="form-control col-md-7 col-xs-12" required>
                            <?php
                            $table  = "pays";
                            $ord    = "nom";
                            $dir    = "ASC";
                            $STATE = $site->SelectFromTableORD($table,$ord,$dir);
                            foreach ($STATE as $state) {
                                $alpha  = $state['alpha2'];
                                $nom    = stripslashes(utf8_decode($state['nom']));

                                if ($alpha == $IDPAYS) {
                            ?>
                            <option value="<?php echo $alpha;?>" selected><?php echo $nom;?></option>
                            <?php
                                }else{
                            ?>
                            <option value="<?php echo $alpha;?>"><?php echo $nom;?></option>
                            <?php
                                }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                   
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agn_etat">État <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="agn_etat" name="agn_etat" class="form-control col-md-7 col-xs-12" required>
                            <option value="0" <?php if($agn_etat==0){?> selected <?php }?>>Désactivé</option>
                            <option value="1" <?php if($agn_etat==1){?> selected <?php }?>>Activé</option>
                          </select>
                        </div>
                      </div>

                  
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_ville" class="control-label col-md-3 col-sm-3 col-xs-12">Ville <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="agn_ville" name="agn_ville" class="form-control col-md-7 col-xs-12" required>
                            <?php
                            $table = "ville";
                            $champ = "id_pays";
                            $value = $id_pays;
                            $ord   = "nom_fra";
                            $dir   = "ASC";
                            $CITY  = $site->SelectFromTableWC($table,$champ,$value,$ord,$dir);
                            foreach ($CITY as $city) {
                                $nom      = stripslashes(utf8_decode($city['nom_fra']));
                                $id_ville = $city['id_ville'];

                                if ($id_ville == $IDVILLE) {
                            ?>
                            <option value="<?php echo $id_ville;?>" selected><?php echo $nom;?></option>
                            <?php
                                }else{
                            ?>
                            <option value="<?php echo $id_ville;?>"><?php echo $nom;?></option>
                            <?php
                                }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
					            <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="canal" class="control-label col-md-3 col-sm-3 col-xs-12">Canal<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="canal" type="text" name="canal" placeholder="" class="form-control col-md-7 col-xs-12" required="required">
                              <option <?php if($canal=='B2C'){?> selected <?php }?> value="B2C">B2C</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_adress" class="control-label col-md-3 col-sm-3 col-xs-12">Adresse <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="agn_adress" type="text" name="agn_adress" placeholder="Adresse" class="form-control col-md-7 col-xs-12" required="required"><?php echo $agn_adress;?></textarea>
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_pays" class="control-label col-md-3 col-sm-3 col-xs-12">Devise <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            $table  = "devises";
                            $ord    = "CurrShortName";
                            $dir    = "ASC";
                            $devises = $site->SelectFromTableORD($table,$ord,$dir); ?>
                          <select id="agn_devise" name="agn_devise" class="form-control col-md-7 col-xs-12" required>
                          <?php
                            foreach ($devises as $devise) {
                             
                                $alpha  = $devise['CurrShortName'];
                                $nom    = stripslashes(utf8_decode($devise['CurrLongName']));
                                if ($code_devise){
                                  $code=$code_devise;
                                }else{
                                  $code='TND';
                                }

                                if ($devise['CurrShortName'] ==$code) {
                            ?>
                            <option value="<?php echo $alpha;?>" selected><?php echo $nom;?></option>
                            <?php
                                }else{
                            ?>
                            <option value="<?php echo $alpha;?>"><?php echo $nom;?></option>
                            <?php
                                }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div id="divmarkup" class="item form-group col-md-6 col-sm-12 col-xs-12" style="display:none">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agn_markup_personne">Markup par personne <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="agn_markup_personne" name="agn_markup_personne" required="required" placeholder="markup par personne"  class="form-control col-md-7 col-xs-12" value="<?php echo $markup_personne?>">
                        </div>
                      </div>
                      <span class="section col-md-6 col-sm-12 col-xs-12">Informations Personnelles</span>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_nom">Nom <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="client_nom" value="<?php echo $client_nom;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="client_nom" placeholder="Nom" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_prenom">Prénom <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="client_prenom" value="<?php echo $client_prenom;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="client_prenom" placeholder="Prénom" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="client_email" value="<?php echo $client_email;?>" name="client_email" required="required" placeholder="Email" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_tel">Téléphone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="client_tel" value="<?php echo $client_tel;?>" name="client_tel" required="required" placeholder="Téléphone" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="agn_update" class="btn btn-success">Sauvegarder</button>
                        </div>
                      </div>
                    </form>
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
    <script src="<?php echo $WORKPATH;?>js/validator.js"></script>
    <script src="<?php echo $WORKPATH;?>js/bootstrap-select.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.js"></script>
    <script>
      validator.message.date = 'not a real date';
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      if ($('#agn_devise').val()=='TND'){
            document.getElementById('divmarkup').style.display='none';
            $('#agn_markup_personne').val('0');
          }else{
            document.getElementById('divmarkup').style.display='block';
          }
      $('#agn_devise').change(function() { 
          if ($(this).val()=='TND'){
            document.getElementById('divmarkup').style.display='none';
            $('#agn_markup_personne').val('0');
          }else{
            document.getElementById('divmarkup').style.display='block';
          }

       });
      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
  </body>
</html>
