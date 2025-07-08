<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
include_once("files/LOG.php");
$site = new SITE();

$table = "booking";
$champ = "pid";
$value = $_GET['pid'];
$ord   = "pid";
$dir   = "ASC";

if($superRoles[4] != 5 && $principal !=1){
  header("location:".$WORKPATH."/");
}

$IsBooked = $site->countTableWC($table,$champ,$value);
if($IsBooked == 0){
  header("location:".$WORKPATH."reservations.php");
}else{
  $BookingDetail = $site->SelectObjectTableWC($table,$champ,$value,$ord,$dir);

  $Pid                = $BookingDetail->pid;
  $Id                 = $BookingDetail->id;
  $AgentId            = $BookingDetail->agentid;
  $BookingReference   = $BookingDetail->bookingreference;
  $TotalCharges       = $BookingDetail->totalcharges;
  $LeaderTitle        = $BookingDetail->leadertitle;
  $LeaderTitle 		  = strtolower($LeaderTitle);
  $LeaderTitle 		  = ucwords($LeaderTitle);
  $LeaderFirstName    = stripslashes(utf8_decode($BookingDetail->leaderfirstname));
  $LeaderFirstName 	  = strtolower($LeaderFirstName);
  $LeaderFirstName 	  = ucwords($LeaderFirstName);
  $LeaderLastName     = stripslashes(utf8_decode($BookingDetail->leaderlastname));
  $LeaderLastName 	  = strtolower($LeaderLastName);
  $LeaderLastName 	  = ucwords($LeaderLastName);
  $CurrencyCode       = $BookingDetail->currencycode;
  $LocalHotelId       = $BookingDetail->localhotelid;
  $HotelName          = stripslashes(utf8_decode($BookingDetail->hotelname));
  $CountryName        = stripslashes(utf8_decode($BookingDetail->countryname));
  $CityName           = stripslashes(utf8_decode($BookingDetail->cityname));
  $CityId             = $BookingDetail->cityid;
  $HotelAddress1      = $BookingDetail->hoteladdress;
  $CurrentStatus      = $BookingDetail->currentstatus;
  $TotalAdults        = $BookingDetail->totaladults;
  $TotalChildren      = $BookingDetail->totalchildren;
  $TotalBabies        = $BookingDetail->totalkids;
  $TotalRooms         = $BookingDetail->totalrooms;
  $CheckInDate        = $BookingDetail->checkindate;
  $CheckOutDate       = $BookingDetail->checkoutdate;
  $GrossAmount        = $BookingDetail->grossamount;
  $TotalMarkup        = $BookingDetail->totalmarkup;
  $HotelPhone         = $BookingDetail->hotelphone;
  $SelectedNights     = $BookingDetail->selectednights;
  $BookingServiceType = $BookingDetail->bookingservicetype;
  $StartTime          = $BookingDetail->starttime;

  if($CurrencyCode != 'TND' && $BookingServiceType == 'hotelsdirect'){
    $CurrencyCode = 'TND';
  }
  if($BookingServiceType == 'hotelbedsactivity'){
    $ActivityDetails = $site->SelectObjectTableWC("activityDetail","pidBooking",$Pid,"pid","ASC");
    $CityName = stripslashes(utf8_decode($ActivityDetails->activityName));
  }

  $agence       = $BookingDetail->agentid;
  $agent        = $BookingDetail->agentid;
  $AGNT         = $site->SelectObjectTableWC("user","id",$agent,"id","ASC");
  $AGENT        = stripslashes(utf8_decode($AGNT->firstname));
  $AGENT 		    = ucwords($AGENT);
  $AGN          = $site->SelectObjectTableWC("user","id",$agence,"id","ASC");
  $AGENCE       = stripslashes(utf8_decode($AGN->lastname));
  $AGENCE 		= ucwords($AGENCE);
  $AGN_DEVISE   = $BookingDetail->agencydevise;
  $canal= stripslashes(utf8_decode($AGN->canal));
  if($CurrentStatus == "vouchered"){
    $ETAT = "<b class='has-success'> Confirmée </b>";
  }elseif($CurrentStatus == "cancelled"){
    $ETAT = "<b class='has-error'> Annulée </b>";
  }elseif($CurrentStatus == "refused"){
    $ETAT = "<b class='has-error'> Refusée </b>";
  }else{
    $ETAT = "<b class='has-warning'> En Attente </b>";
  }

  $BookingRooms = $site->SelectFromTableWC("bookingrooms","pidbooking",$Pid,"pid",$dir);
  
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Détails | Réservations</title>

    <link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
    <link href="<?php echo $WORKPATH;?>css/pnotify.css" rel="stylesheet">
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
                    <h2>Réservation N° <?php echo $BookingReference;?></h2>
                    <h2 class="pull-right">Agence : <?php echo $AGENCE;?> </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <!-- /.col -->
                        <div class="col-md-2 col-sm-6 col-xs-6 invoice-header">
                          <address>
							  <?php if($BookingServiceType != "hotelbedsactivity"){?>
							  <strong>Nom Hotel</strong>
							  <?php }?>
                              <br><strong>Destination</strong>
                              <?php /*if($BookingServiceType != "elmouradihotels"){?>
                              <br><strong>Client</strong>
                              <?php }*/?>
                              <br>Etat
                              <br>Date d'Entrée
                              <br>Date de Sortie
                              <?php if($canal=='B2B'){?>
							                <br><strong>Prix Affiliate</strong>
                              <?php }?>
                                <br><strong>Prix Distributeur</strong>
                          
                              <br><strong>Prix à Payer</strong>
                              <br>Client Principal
                          </address>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 invoice-header">
                          <address>
							               <?php if($BookingServiceType != "hotelbedsactivity"){?>
						              	  <strong><?php echo $HotelName;?></strong>
							                 <?php }?>
                              <br><strong><?php echo $CityName;?></strong>
                              <?php /*if($BookingServiceType != "elmouradihotels"){?>
                              <br><strong><?php echo $LeaderTitle." ".$LeaderFirstName." ".$LeaderLastName;?></strong>
                              <?php }*/?>
                              <br><?php echo $ETAT;?>
                              <br><?php echo DATUMRESA($CheckInDate);?>
                              <br><?php echo DATUMRESA($CheckOutDate);?>
                              <?php if($canal=='B2B'){?>
                              <br><strong><?php echo $TotalMarkup ." ".$AGN_DEVISE;?></strong>
                              <?php }?>
                              <br><strong><?php echo $GrossAmount." ".$AGN_DEVISE;?></strong>    
                              <br><strong><?php echo $TotalCharges." ".$CurrencyCode;?></strong>
                              <br><?php echo $LeaderTitle.' '.$LeaderFirstName.' '.$LeaderLastName;?>
                          </address>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Date d'entrée</th>
                                <th>Date de sortie</th>
                                <th>Nuitées</th>
                                <th>Total Adultes</th>
                                <th>Total Enfants</th>
                                <th>Total Bébés</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?php echo DATUMRESA($CheckInDate);?></td>
                                <td><?php echo DATUMRESA($CheckOutDate);?></td>
                                <td><?php echo $SelectedNights;?></td>
                                <td><?php echo $TotalAdults;?></td>
                                <td><?php echo $TotalChildren;?></td>
                                <td><?php echo $TotalBabies;?></td>
                              </tr>
                            </tbody>
                          </table>
                          <?php if($BookingServiceType != "hotelbedsactivity"){?>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Chambres</th>
                                <th>Nb de chambres</th>
                                <th>Adultes</th>
                                <th>Enfants</th>
                                <th>Bébés</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              foreach ($BookingRooms as $BookingRoom) {
                                $PidRoom        = $BookingRoom['pid'];
                                $RoomTypeDescription = stripslashes(utf8_decode($BookingRoom['roomtypedescription']));
                                $NumberOfRoom   = $BookingRoom['numberofroom'];

                                $NumberOfAdults = $site->countTableW2C("bookingroomdetails","passengertype","adult","pidroom",$PidRoom);
                                $NumberOfChilds = $site->countTableW2C("bookingroomdetails","passengertype","child","pidroom",$PidRoom);
                                $NumberOfBabies = $site->countTableW2C("bookingroomdetails","passengertype","baby","pidroom",$PidRoom);
                              ?>
                              <tr>
                                <td class="accordion accordion-connected">
								<b><?php echo $RoomTypeDescription;?></b>
									<div id="RoomType<?php echo $PidRoom;?>" >
									  <?php
									  if($NumberOfAdults > 0){
										$Clients = $site->SelectFromTableW2C('bookingroomdetails','pidroom',$PidRoom,'passengertype','adult','pid','ASC');
										$A = 0;
										foreach ($Clients as $Client) {
										  $SX = stripslashes(utf8_decode($Client['salutation']));
										  $SX = strtolower($SX);
										  $SX = ucwords($SX);
										  $FN = stripslashes(utf8_decode($Client['firstname']));
										  $FN = strtolower($FN);
										  $FN = ucwords($FN);
										  $LN = stripslashes(utf8_decode($Client['lastname']));
										  $LN = strtolower($LN);
										  $LN = ucwords($LN);
										  $A += 1;

										  echo "Adulte ". $A . " : ";
										  echo ucwords($SX . ' ' . $FN . ' ' . $LN);
										  echo "<br>";
										}
									  }

									  if($NumberOfChilds > 0){
										$Clients = $site->SelectFromTableW2C('bookingroomdetails','pidroom',$PidRoom,'passengertype','child','pid','ASC');
										$C = 0;
										foreach ($Clients as $Client) {
										  $SX = stripslashes(utf8_decode($Client['salutation']));
										  $SX = strtolower($SX);
										  $SX = ucwords($SX);
										  $FN = stripslashes(utf8_decode($Client['firstname']));
										  $FN = strtolower($FN);
										  $FN = ucwords($FN);
										  $LN = stripslashes(utf8_decode($Client['lastname']));
										  $LN = strtolower($LN);
										  $LN = ucwords($LN);
										  $AG = stripslashes(utf8_decode($Client['age']));
										  $C += 1;

										  echo "Enfant ". $C . " : ";
										  echo ucwords($FN . ' ' . $LN);
										  echo " ( ". $AG . " Ans )";
										  echo "<br>";
										}
									  }
									  ?>
									</div>
								</td>
                                <td><?php echo $NumberOfRoom;?></td>
                                <td><?php echo $NumberOfAdults;?></td>
                                <td><?php echo $NumberOfChilds;?></td>
                                <td><?php echo $NumberOfBabies;?></td>
                              </tr>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
                          <?php }?>
                          <?php
                          if($CurrentStatus == "vouchered"){
                          ?>
                    
              <a class="btn btn-success btn-sm" href="<?php echo $WORKPATH;?>proformaemv.php?BookingId=<?php echo $Pid.'/';?>" target="_blank">Proformat EMV</a>
              <a class="btn btn-danger btn-sm" href="<?php echo $WORKPATH;?>proforma.php?BookingId=<?php echo $Pid;?>" target="_blank">Proformat</a>
						  <a class="btn btn-primary btn-sm" href="<?php echo $WORKPATH;?>voucher.php?BookingId=<?php echo $Pid;?>" target="_blank">Voucher</a>
                          <?php
                          }
                          ?>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </section>
                 

           

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
    <script src="<?php echo $WORKPATH;?>js/pnotify.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $WORKPATH;?>js/custom.min.js"></script>
    <script src="<?php echo $WORKPATH;?>js/customm.js"></script>
  </body>
</html>