<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();
$table = "markup";
$ord   = "markup_b2b";
$dir   = "ASC";
$site = new SITE();
$markup = $site->SelectLastObjectTable($table, $ord, $dir);

$markupB2b=$markup ->markup_b2b;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agences</title>
    <link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/green.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/custom.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/dropzone.css" rel="stylesheet">
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
                    <h2></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form  id="add_client" class="form-horizontal form-label-left" method="post" action="<?php echo $WORKPATH;?>files/functions_confirm.php" novalidate autocomplete="off">
                      <span class="section col-md-6 col-sm-12 col-xs-12">Données</span>
                      <input type="hidden" name="action" value="agn_add">
                      <input type="hidden" name="agn_pid" value="">
                  
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agn_login">Login <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" value="" id="agn_login" name="agn_login" required="required" placeholder="Login" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                          <div id="username_error"></div>
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_markup" class="control-label col-md-3 col-sm-3 col-xs-12">Password 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="newPassword" value="" type="text" name="newPassword" placeholder="Password" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="canal" class="control-label col-md-3 col-sm-3 col-xs-12">Canal<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="canal" type="text" name="canal" placeholder="" class="form-control col-md-7 col-xs-12" required="required">
                       
                              <option  value="B2B">B2B</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agn_etat">État <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="agn_etat" name="agn_etat" class="form-control col-md-7 col-xs-12" required>
                            <option value="0" >Désactivé</option>
                            <option value="1">Activé</option>
                          </select>
                        </div>
                      </div>
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

                                if ($alpha == 'TN') {
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
                        <label for="agn_rc" class="control-label col-md-3 col-sm-3 col-xs-12">N° Registre de Commerce 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agn_rc" value="" type="text" name="agn_rc" placeholder="N° Registre de Commerce" data-validate-length="3,4" class="form-control col-md-7 col-xs-12">
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
                            $value = 219;
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
                        <label for="agn_iata" class="control-label col-md-3 col-sm-3 col-xs-12">N° IATA 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agn_iata" value="" type="text" name="agn_iata" placeholder="N° IATA" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_zipcode" class="control-label col-md-3 col-sm-3 col-xs-12">Code Postal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agn_zipcode" value="" type="text" name="agn_zipcode" placeholder="Code Postal" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_mf" class="control-label col-md-3 col-sm-3 col-xs-12">N° Matricule Fiscale 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agn_mf" value="" type="text" name="agn_mf" placeholder="N° Matricule Fiscale" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_adress" class="control-label col-md-3 col-sm-3 col-xs-12">Adresse <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="agn_adress" type="text" name="agn_adress" placeholder="Adresse" class="form-control col-md-7 col-xs-12" required="required"></textarea>
                        </div>
                      </div>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_licence" class="control-label col-md-3 col-sm-3 col-xs-12">Licence 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agn_licence" value="" type="text" name="agn_licence" placeholder="Licence" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                  
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="agn_markup" class="control-label col-md-3 col-sm-3 col-xs-12">MARKUP 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="agn_markup" type="text" name="agn_markup" placeholder="MARKUP" class="form-control col-md-7 col-xs-12" value="<?php echo $markupB2b ?>">
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

                                if ($devise['CurrShortName'] =='TND') {
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
                          <input type="text" value="" id="agn_markup_personne" name="agn_markup_personne" required="required" placeholder="markup par personne" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <span class="section col-md-6 col-sm-12 col-xs-12">Rôles</span>

                      <div class="item form-group col-md-9 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="roles">Rôles <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select id="roles" name="roles[]" class="selectpicker form-control" multiple required>
                            <option value="1">H&ocirc;tels en Tunisie</option>
                            <option value="2">H&ocirc;tels Hotelbeds</option>
                          </select>
                        </div>
                      </div>
                      
                      <span class="section col-md-6 col-sm-12 col-xs-12">Informations Personnelles</span>
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_nom">Nom agence <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="client_nom" value="" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="client_nom" placeholder="Nom" required="required" type="text">
                        </div>
                      </div>
                     
                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="client_email" value="" name="client_email" required="required" placeholder="Email" class="form-control col-md-7 col-xs-12">
                          <div id="email_error"></div>
                        </div>
                      </div>

                      <div class="item form-group col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_tel">Téléphone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="client_tel" value="" name="client_tel" required="required" placeholder="Téléphone" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="agn_update" class="btn btn-success" type="button">Sauvegarder</button>
                        </div>
                      </div>
                    </form>
                    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="HotelImages" class="control-label">Logo <span class="required">*</span></label>
                          <div class="image_upload_div">
                            <form action="<?php echo $WORKPATH;?>logoUpload.php" class="dropzone"></form>
                            <div class="clearfix"></div>
                          </div> 
                          <div class="clearfix"></div>
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
    <script src="<?php echo $WORKPATH;?>js/jquery.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/fastclick.js"></script>
    <script src="<?php echo $WORKPATH;?>js/nprogress.js"></script>
    <script src="<?php echo $WORKPATH;?>js/icheck.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/validator.js"></script>
    <script src="<?php echo $WORKPATH;?>js/bootstrap-select.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/custom.js"></script>
    <script src="<?php echo $WORKPATH;?>js/dropzone.js"></script>
    <script>
      validator.message.date = 'not a real date';
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('#agn_update').click(function() {
          if($('#agn_login').val()!='' || $('#client_email').val()!=''){ 
            var dataStringUserCheck = 'username=' + $('#agn_login').val() + '&email=' + $('#client_email').val() + '&action=UserCheck';
           // alert(dataStringUserCheck);
            $.ajax({
                type: "POST",
                url: HOME+"files/functions_confirm.php",
                data: dataStringUserCheck,
                cache: false,
                success: function (json) {
                    var data = JSON.parse(json); 
                    if (data[0] == 0 && data[1] == 0) {
                      $("#add_client").submit();
                    } else {
                        if (data[0] == 1) {
                            $('#username_error').show();
                            $('#username_error').html('Nom d\'utilisateur déjà existe');
                        } else {
                            $('#username_error').hide();
                        }
                        if (data[1] == 1) {
                            $('#email_error').show();
                            $('#email_error').html('Email déjà existe');
                        } else {
                            $('#email_error').hide();
                         
                        }
                    }
                }
            });
          }else{

            $("#add_client").submit();

          }

      });


      $('#agn_devise').change(function() { 
          if ($(this).val()=='TND'){
            document.getElementById('divmarkup').style.display='none';
            $('#agn_markup_personne').val('');
          }else{
            document.getElementById('divmarkup').style.display='block';
          }

       });

      $('#add_client').submit(function (e) {
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
