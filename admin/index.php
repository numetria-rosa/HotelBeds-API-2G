<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$super_roles    = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->role));
$roles          = explode(',', $super_roles);
$site = new SITE();
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$table	= "booking";
$champ	= 'bookingservicetype';
$ord	= "pid";
$dir	= "DESC";
$limit_start	= 0;
$limit_end		= 50;

if (strpos($url,'contrat') !== false) {
	$value	= 'hotelsdirect';
	$BookingDetails  = $site->selectW1CLIMIT($table,$champ,$value,$ord,$dir,$limit_start,$limit_end);
}elseif (strpos($url,'xml') !== false) {
	$value	= 'hotels';
  $BookingDetails  = $site->selectW1CLIMIT($table,$champ,$value,$ord,$dir,$limit_start,$limit_end);
} else {
	$champ = 'starttime';
	$value = date('Y-m-d');
	$BookingDetails  = $site->bookingFilter($table,$champ,$value,$ord,$dir,$limit_end);
}


$table = "user";
$ord   = "id";
$dir   = "DESC";
$limit_end=10;
$champ1 = 'CreatedAt';
	$value1 = date('Y-m-d');
	$AGNB  = $site->userFilterDJ($table,$champ1,$value1,'B2B',$ord,$dir,$limit_end);
	$AGNC  = $site->userFilterDJ($table,$champ1,$value1,'B2C',$ord,$dir,$limit_end);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $SITE_NAME;?></title>
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
<style>
        #tableresa  th{
              font-size: 13px !important;
          }
          #tableresa  td a{
              color: white !important;
              font-size: 13px !important;
          }
          #tableresa td{
              color: white !important;
              font-size: 13px !important;
          }
          #datatable-buttons td{
              color: #73879C !important;
              font-size: 13px !important;
          }
      </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include_once("files/main_menu.php");?>
     <!-- page content -->
     <!-- page content -->
     
    <div class="right_col" >
      <div class="">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Réservations</h2>
                <?php
                if($_SESSION['SuperSuperAdmin']->role == "supersuperadmin"){
    				  	?>
                <div class="title_right">
                  <div class="col-md-3 col-sm-5 col-xs-5 form-group pull-right">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Solde XML AIT" disabled id="soldeXml">
                      <span class="input-group-btn">
                      <button class="btn btn-default soldeXml" type="button">Demande Solde XML AIT</button>
                      </span> </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <?php
      					}
      					?>
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-2 col-sm-12 col-xs-12" style="display:none">
                      <label>Agences</label>
                      <select id="resaAgence" name="resaAgence" class="form-control custom-select">
                        <option value="" selected>Toutes les Agences</option>
                        <?php
				               		$PRD = $site->SelectFromTableORD("user","lastname","asc");
						                  foreach($PRD as $prd){
						                	$pidAgn = $prd['id'];
					                		$nomAgn = stripslashes(utf8_decode($prd['lastname']));
                        ?>
                        <option value="<?php echo $pidAgn;?>"><?php echo $nomAgn;?></option>
                        <?php
						               }
					          	?>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12" style="display:none">
                      <label>Agents</label>
                      <select id="resaAgent" name="resaAgent" class="form-control custom-select">
                        <option value="">Agent</option>
                      </select>
                    </div>
                
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>Suppliers</label>
                      <select id="resaSupplier" name="resaSupplier" class="form-control custom-select">
                        <option value="">Tous les Suppliers</option>
                        <option value="6">H&ocirc;tels en Tunisie</option>
                        <option value="2">H&ocirc;tels Hotelbeds</option>
                        <option value="4">Tickets Hotelbeds</option>
                    
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>Canal</label>
                      <select id="resacanal" name="resacanal" class="form-control custom-select">
                        <option value="">Tous </option>
                        <option value="B2C">B2C</option>
                        <option value="B2B">B2B</option>
                        <option value="B2E">B2E</option>
                      </select>
                    </div>
					<div class="col-md-1 col-sm-12 col-xs-12">
                      <label>&Eacute;tat</label>
                      <select id="resaStatus" name="resaStatus" class="form-control custom-select">
                        <option value="">Toutes</option>
                        <option value="0">En Attente</option>
                        <option value="1">Confirm&eacute;es</option>
                        <option value="2">Refus&eacute;es</option>
                        <option value="3">Annul&eacute;es</option>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12">
                      <label>Date</label>
                      <select id="dateType" name="dateType" class="form-control custom-select">
                        <option value="1">R&eacute;servation</option>
                        <option value="2">Check In</option>
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <label>Date</label>
                      <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; height: 38px; line-height: 30px;">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>

                        </span> 
                        <b class="caret"></b>
                      </div>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12">
                      <label>&nbsp;</label>
                      <button class="btn btn-default resaFilterB form-control" type="button">Filtrer</button>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <span class="label hotelsdirectbg" style="color: #fff;">H&ocirc;tels en Tunisie</span>
                    <span class="label hotelsbedsbg" style="color: #fff;">H&ocirc;tels Hotelbeds</span>
                  </div>
                </div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                      <table class="table" id="tableresa">
                        <thead>
                          <tr>
                            <th>Référence Réservation</th>
                            <th>Agence</th>
                          
                            <th>Destination</th>
                            <th>Client</th>
                            <th>Date de Réservation</th>
                            <th>Prix</th>
                            <th>État</th>
                            <th>Détails</th>
                          </tr>
                        </thead>
                        <tbody class="bodyt">
                          <?php
                          $TotalPriceResaNetEUR = 0;
                          $TotalPriceResaNetGBP = 0;
                          $TotalPriceResaNetTND = 0;
                          $TotalPriceResaAgn = 0;
                          $TotalPriceResaNet = array();
							foreach ($BookingDetails as $BookingDetail) {
								$Pid				=   $BookingDetail['pid'];
								$Id					=   $BookingDetail['id'];
                $AgentId		=   $BookingDetail['agentid'];
                $BookingReference	= $BookingDetail['bookingreference'];
								$TotalCharges       = $BookingDetail['totalcharges'];
                $Convertion		      = $BookingDetail['convertion'];
                $LeaderTitle		    = $BookingDetail['leadertitle'];
								$LeaderTitle 		    = strtolower($LeaderTitle);
								$LeaderTitle 		    = ucwords($LeaderTitle);
                $LeaderFirstName	  = stripslashes(utf8_decode($BookingDetail['leaderfirstname']));
								$LeaderFirstName 	  = strtolower($LeaderFirstName);
								$LeaderFirstName 	  = ucwords($LeaderFirstName);
                $LeaderLastName		  = stripslashes(utf8_decode($BookingDetail['leaderlastname']));
								$LeaderLastName   	= strtolower($LeaderLastName);
								$LeaderLastName 	  = ucwords($LeaderLastName);
                        		$CurrencyCode		= $BookingDetail['currencycode'];
                        		$LocalHotelId		= $BookingDetail['localhotelid'];
                        		$HotelName			= stripslashes(utf8_decode($BookingDetail['hotelname']));
                        		$CountryName		= $BookingDetail['countryname'];
                        		$CityName			= $BookingDetail['cityname'];
                        		$CityId				= $BookingDetail['cityid'];
                        		$HotelAddress1		= $BookingDetail['hoteladdress'];
                        		$CurrentStatus		= $BookingDetail['currentstatus'];
                        		$TotalAdults		= $BookingDetail['totaladults'];
                        		$TotalChildren		= $BookingDetail['totalchildren'];
                        		$TotalRooms			= $BookingDetail['totalrooms'];
                        		$CheckInDate		= $BookingDetail['checkindate'];
                        		$CheckOutDate		= $BookingDetail['checkoutdate'];
                        		$GrossAmount		= $BookingDetail['grossamount'];
                        		$HotelPhone			= $BookingDetail['hotelphone'];
                        		$SelectedNights		= $BookingDetail['selectednights'];
          					      	$BookingServiceType = $BookingDetail['bookingservicetype'];
								            $Convertion         = $BookingDetail['convertion'];

						if($BookingServiceType == 'hotelsbeds'){
								  $TrBg = 'hotelsbedsbg';
								}elseif($BookingServiceType == 'hotelbedsactivity'){
								  $TrBg = 'hotelbedsactivitybg';
								}elseif($BookingServiceType == 'carthagehotels'){
								  $TrBg = 'carthagehotels';
								}

								$agence	  	= $BookingDetail['agentid'];
								$agent	  	= $BookingDetail['agentid'];
				                $AGNT= $site->SelectObjectTableWC("user","id",$agent,"id","ASC");
								$AGENT      = stripslashes(utf8_decode($AGNT->lastname));
								$AGN        = $site->SelectObjectTableWC("user","id",$agence,"id","ASC");
								$AGENCE     = stripslashes(utf8_decode($AGN->lastname));
								$CREDITAGN  = stripslashes(utf8_decode($AGN->credit));
								$Devise     = stripslashes(utf8_decode($AGN->code_devise));
								
								if($CurrentStatus == "vouchered"){
								  $TotalPriceResaAgn += $GrossAmount;

								  $ETAT = "<b class='has-success'> Confirmée </b>";
								  if(!isset($TotalPriceResaNet[$CurrencyCode])){
								   $TotalPriceResaNet[$CurrencyCode]  = 0;
								  }
								  if($CurrencyCode != 'TND' && $BookingServiceType == 'hotelsdirect'){
									$TotalPriceResaNet['TND'] += $TotalCharges;
									$TotalPriceResaAgn -= $GrossAmount;
									$TotalPriceResaAgn += $TotalCharges;
									$CurrencyCode = 'TND';
								  }
                  else{
									$TotalPriceResaNet[$CurrencyCode] += $TotalCharges;
								  }
								}elseif($CurrentStatus == "cancelled"){
								  $ETAT = "<b class='has-error'> Annulée </b>";
								}elseif($CurrentStatus == "refused"){
								  $ETAT = "<b class='has-error'> Refusée </b>";
								}else{
								  $ETAT = "<b class='has-warning'> En Attente </b>";
								}
          									
								$StartTime = $BookingDetail['starttime'];
								$CheckInDate= str_replace('-','',$CheckInDate);
								$Today			= date("Ymd");

								if ($BookingServiceType == "hotelbedsactivity") {
									$ActivityDetails = $site->SelectObjectTableWC('activityDetail','pidBooking',$Pid,'pid','ASC');
									$HotelName = stripslashes(utf8_decode($ActivityDetails->activityName));
								}

                            ?>
                          <tr>
                            <td class="<?php echo $TrBg;?>">
                              <?php
                              if($CurrentStatus == "vouchered"){
                              ?>
                              <a style="" href="<?php echo $WORKPATH;?>proforma.php?BookingId=<?php echo $Pid;?>" target="_blank">
                              <?php echo $BookingReference;?>
                              </a>
                              <?php
                              }else{
                              ?>
                              <?php echo $BookingReference;?>
                              <?php
                              }
                              ?>
                            </td>
                            <td class="<?php echo $TrBg;?>"><a style="" href=""><?php echo $AGENCE;?></a></td>
                           
                            <td class="<?php echo $TrBg;?>"><?php echo $HotelName;?></td>
                            <td class="<?php echo $TrBg;?>"><?php echo $LeaderTitle." ".$LeaderFirstName." ".$LeaderLastName;?></td>
                            <td class="<?php echo $TrBg;?>"><?php echo DATUML($StartTime);?></td>
							<?php if($Devise == 'EUR' && $BookingServiceType == 'hotelsdirect'){ ?>
								<td class="<?php echo $TrBg;?>"><?php echo $TotalCharges;?> TND
							<?php
							}else{ ?>
								<td class="<?php echo $TrBg;?>"><?php echo $TotalCharges . ' ' . $CurrencyCode;?>
							<?php
							}
							?>
							<?php
							if($CurrentStatus == 'requested' && $BookingServiceType == 'hotelsdirect'){
								if($GrossAmount > $CREDITAGN){
									echo '<br><span title="Solde Restant" style="color:red;font-size: 12px !important;font-weight: 900;text-shadow: 1px 1px 2px red, 0 0 1em #000, 0 0 0.2em #000;">'.$CREDITAGN . ' ' . $Devise.'</span>';
								}
							}
							?>
							</td>
                            <td style="background: #e6e6e6;"><?php echo $ETAT;?></td>
                            <td style="background: #e6e6e6;"><a class="btn btn-primary btn-sm" href="<?php echo $WORKPATH;?>reservation.php?pid=<?php echo $Pid;?>"> Détails </a>
                            <?php
								if($BookingServiceType == "hotelsdirect"){
									if($Today <= $CheckInDate && $CurrentStatus == "vouchered"){
								?>
							<a class="btn btn-info btn-sm btn-danger cancelHotelDirect" p="<?php echo $Pid;?>"> Annuler </a>
							<input type="text" name="CancellationRate" id="CancellationRate<?php echo $Pid;?>" class="form-control" placeholder="Frais d'Annulation" value="" style="width:150px;" />
							<?php
								}
								
								if($Today <= $CheckInDate && $CurrentStatus == "requested"){
								?>
                            <a class="btn btn-info btn-sm btn-success validateHotelDirect" p="<?php echo $Pid;?>"> Valider </a> <a class="btn btn-info btn-sm btn-danger refuseHotelDirect" p="<?php echo $Pid;?>"> Refuser </a>
                            <?php
									}
								}
								?>

                            <?php
                            ?>
							
							<?php
							if($roles[0] == 1){
								if($CurrentStatus == "vouchered"){
									echo '	<form action="'.$WORKPATH.'files/functions_confirm.php" method="post">
												<input type="hidden" value="forceStatus" name="action">
												<input type="hidden" value="'.$Pid.'" name="booking">
												<input type="hidden" value="0" name="forceStatus">
												<input type="submit" value="Force Cancel" class="btn btn-danger btn-sm">
											</form>';
								}
								if($CurrentStatus == "cancelled" || $CurrentStatus == "refused"){
									echo '	<form action="'.$WORKPATH.'files/functions_confirm.php" method="post">
												<input type="hidden" value="forceStatus" name="action">
												<input type="hidden" value="'.$Pid.'" name="booking">
												<input type="hidden" value="1" name="forceStatus">
												<input type="submit" value="Force Confirm" class="btn btn-success btn-sm">
											</form>';
								}

              
                
							}
							?>
                            </td>
                          </tr>
                          <?php
                                }
                                ?>
                          <tr style="color:#73879C;">
                          	<td colspan="6"></td>
                            <td align="right">Total Agence</td>
                            <td colspan="3"><?php echo number_format($TotalPriceResaAgn,3,"."," " );?> TND</td>
                          </tr>
                          <tr style="color:#73879C;">
                            <td colspan="6"></td>
                            <td align="right">Total Net</td>
                            <th colspan="3">
                              <?php
                              foreach($TotalPriceResaNet as $keyNet => $valueNet){
								  if($valueNet > 0){
									echo number_format($valueNet,3,"."," " ) . ' ' . $keyNet . ' <br> ';
								  }
                              }
                              ?>
                            </th>
                          </tr>
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
    <div class="right_col"  style="min-height: 0px !important;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Agences</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered ">
                      <thead>
                        <tr>
                          <th>Agence</th>
                          <th>Pays</th>
                          <th>Ville</th>
                          <th>Téléphone</th>
                          <th>Email</th>
                          <th>Date de Création</th>
                          <th>Action</th>
                          <th>Détails</th>
                          <th>Déposit</th>
                          <th>Solde</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        //echo print_r($AGN);die();
                        foreach ($AGNB as $agn) {
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
                            $ETAT = '<a class="btn btn-success btn-sm agn_activ" p="'.$agn_pid.'" e="'.$agn_etat.'"> Activer </a>';
                          }else{
                            $ETAT = '<a class="btn  btn-danger btn-sm agn_activ" p="'.$agn_pid.'" e="'.$agn_etat.'"> Désactiver </a>';
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
                          <td align="center"><?php echo $ETAT;?></td>
                          <td align="center"><a class="btn btn-info btn-sm" href="<?php echo $WORKPATH;?>agence.php?pid=<?php echo $agn_pid;?>"> Détails </a></td>
                          <td align="center"><a class="btn btn-info btn-sm" href="<?php echo $WORKPATH;?>deposits.php?pid=<?php echo $agn_pid;?>"> Détails </a></td>
                          <td><?php echo $Credit. ' ' .$Devise;?></td>
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
      
    <div class="right_col" role="main" style="height: 500px !important;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Clients B2C</h2>
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
                          <th>Action</th>
                          <th>Détails</th>
                   
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($AGNC as $agn) {
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
                            $ETAT = '<a class="btn btn-success btn-sm agn_activ" p="'.$agn_pid.'" e="'.$agn_etat.'"> Activer </a>';
                          }else{
                            $ETAT = '<a class="btn  btn-danger btn-sm agn_activ" p="'.$agn_pid.'" e="'.$agn_etat.'"> Désactiver </a>';
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
                          <td align="center"><?php echo $ETAT;?></td>
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
<!-- Custom Theme Scripts -->
<script src="<?php echo $WORKPATH;?>js/custom.minn.js"></script>
<script src="<?php echo $WORKPATH;?>js/custom.js"></script>
<script src="<?php echo $WORKPATH;?>js/reportrange.min.js"></script>
<script>
$(".resaFilterB").click(function (e) {
 
            var dataString = 'resaAgence=' + $('#resaAgence').val()  + '&resaAgent=' + $('#resaAgent').val() + '&resaStatus=' + $('#resaStatus').val()  
            +'&resaAgent=' + $('#resaAgent').val()+'&resaStatus=' + $('#resaStatus').val()+'&dateType=' + 
            $('#dateType').val()+'&resaSupplier=' + $('#resaSupplier').val()+'&reportRange=' + $('#reportrange > span').text()+'&resaHotels=' 
            + $('#resaHotels').val()+ '&resacanal=' + $('#resacanal').val()+'&action=resaFilter';
           
            $.ajax({
                type: "POST",
                url:HOME +"files/functions_confirm.php",
                data: dataString,
                cache: false,
                success: function (json) {  
               
               $('.bodyt').html(json);
                }
            }); 
    });
</script>
</body>
</html>
