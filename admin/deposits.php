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

$IsAgence = $site->countTableWC($table,$champ,$value);
if($IsAgence == 0){
  header("location:".$WORKPATH."agencies/");
}

$IsDeposit  = $site->countTableWC("deposit","agence",$value);
$DEPOSIT    = $site->SelectFromTableWC("deposit","agence",$value,"pid","DESC");
$Agence     = $site->SelectObjectTableWC($table,$champ,$value,"id","DESC");
$AgencyName = stripslashes(utf8_decode($Agence->lastname));
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agences | Déposits</title>

    <!-- Bootstrap -->
    <link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
    
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
                    <h2>Déposits | <?php echo $AgencyName;?></h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo $WORKPATH;?>files/functions_confirm.php" novalidate>
                      <span class="section">Nouveau Dépôt</span>
                      <input type="hidden" name="action" value="deposit_add">
                      <input type="hidden" name="pid" value="<?php echo $value;?>">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deposit">Montant <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="deposit" class="form-control col-md-7 col-xs-12" name="deposit" placeholder="Montant" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Libellé">Commentaire 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="Libellé" class="form-control col-md-7 col-xs-12" name="comment" placeholder="Libellé"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="worker_add" class="btn btn-success">Ajouter</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php
                  if($IsDeposit > 0){
                  ?>
                  <div class="x_content">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Montant Déposé</th>
                          <th>Montant Consommé</th>
                          <th>Montant Courant</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $TotalDeposit = 0;
                        foreach($DEPOSIT as $deposit){
                          $TotalDeposit += $deposit['deposit'];
                          $currency = stripslashes(utf8_decode($deposit['currency']));
                        }
                        $Credit   = stripslashes(utf8_decode($Agence->credit));

                        $Books    = $site->SelectFromTableW2C("booking","pidagence",$value,'currentstatus','vouchered',"pid","DESC");
                        $TotalCredit = 0;
                        foreach($Books as $Book){
                          $TotalCredit += $Book['grossamount'];
                        }
                        ?>
                        <tr>
                          <th scope="row"><?php echo number_format($TotalDeposit,3,'.',' ').' '.$currency;?></th>
                          <th scope="row"><?php echo number_format($TotalCredit,3,'.',' ').' '.$currency;?></th>
                          <th scope="row"><?php echo number_format($Credit,3,'.',' ').' '.$currency;?></th>
                        </tr>
                        <?php
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="x_content">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Date de Dépot</th>
                          <th></th>
						  <th>Montant</th>
                          <th>Commentaire</th>
                          <th>Solde Précédant</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach($DEPOSIT as $deposit){
                          $agn_deposit    = $deposit['deposit'];
                          $agn_depositon  = $deposit['deposit_on'];
                          $agn_comment    = stripslashes(utf8_decode($deposit['comment']));
                          $currency       = stripslashes(utf8_decode($deposit['currency']));
                          $oldCredit      = $deposit['oldCredit'];
                          $pidSuperWorker = $deposit['superworker'];

                          $superworker = '';

                          if($pidSuperWorker != 0){
                            $SUPER        = $site->SelectObjectTableWC("superworkers","pid",$pidSuperWorker,"pid","ASC");
                            $superworker  = stripslashes(utf8_decode($SUPER->first_name));
                          }
                        ?>
                        <tr>
                          <td>
                            <?php
                            echo DATUML($agn_depositon);
                            ?>
                          </td>
						  <td>
                            <?php
                            if($superworker != ''){
                              echo " <strong class='btn btn-sm btn-primary'>par ".ucfirst($superworker)."</strong>";
                            }
                            ?>
                          </td>
                          <th scope="row"><?php echo number_format($agn_deposit,3,'.',' ').' '.$currency;?></th>
                          <td><?php echo nl2br($agn_comment);?></td>
                          <td>
                            <?php
                            if($oldCredit != '0.000'){
                              echo number_format($oldCredit,3,'.',' ').' '.$currency;
                            }
                            ?>
                          </th>
                        </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <?php
                  }
                  ?>
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
    <!-- validator -->
    <script src="<?php echo $WORKPATH;?>js/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>

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
  </body>
</html>