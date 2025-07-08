<?php
session_start();
include_once("DB_FUNCTION_INC.php");
$site = new SITE();
//utilisés
if( isset($_POST['action']) && ($_POST['action'] == "HotelImageRemove") ){
	$iduser = $_POST['pid']; //get the filename
	$user=$site-> SelectObjectTableWC('user','id',$iduser,'id','ASC');
	$filename=$user->logo;
	
	$insert = $site->updateLogo($iduser,'');
	unlink('../images/logo/'.DIRECTORY_SEPARATOR.$filename); //delete it
	echo 'OK';
	}
if( isset($_POST['action']) && ($_POST['action'] == "login_form") ){

	$Email 		= addslashes(utf8_encode($_POST['Email']));
	$Login 		= addslashes(utf8_encode($_POST['Login']));
	$Password 	= addslashes(utf8_encode($_POST['Password']));
	$last_login = date("Y-m-d H:i:s");

	$table = "superworkers";
	$champ = "email";
	$value = $Email;
	$isSUP = $site->countTableWC($table,$champ,$value);

	if ($isSUP > 0) {
		$_SESSION['isSuperSuperAdmin'] = false;
		$champ1 = "login";
		$value1 = $Login;
		$champ2 = "password";
		$value2 = md5($Password);
		$ord 	= "pid";
		$dir 	= "ASC";
		
		$isSUPP = $site->countTableW3C($table,$champ,$value,$champ1,$value1,$champ2,$value2);
		
		if($isSUPP > 0){
			$_SESSION['isSuperSuperAdmin'] = true;
			$SuperAdmin = $site->SelectObjectTableW2C($table,$champ1,$value1,$champ2,$value2,$ord,$dir);
			if(($SuperAdmin->etat) == 1){
				$pid 	= $SuperAdmin->pid;
				$champ 	= "last_login";
				$LAST 	= $site->lastLogin($table,$champ,$last_login,$pid);
				
				$_SESSION['password'] = $Password;
				$_SESSION['SuperSuperAdmin'] = $SuperAdmin;
				$MSG 	= "AIG";
				$superWorker 	= $pid;
				$insertedOn 	= date('Y-m-d H:i:s');
				$tache 			= 'login';
				$usedTable 		= $table;
				$comment 		= $table.'--'.$champ1.'--'.$value1.'--'.$champ2.'--'.$value2.'--'.$ord.'--'.$dir;
				$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
			
			}else{
				$MSG = "AID";
			}			
		}else{
			$MSG = "CAI";
		}

	}else{
		$MSG = "AIB";
	}

	echo $MSG;

}

if( isset($_POST['action']) && ($_POST['action'] == "resaFilter") ){
	
	$Condition = " WHERE  ";
    $canal=$_POST['resacanal'];
	$reportRange = $_POST['reportRange'];
	$Range 		 = explode('-', $reportRange);
	$StartTime 	 = $Range[0];
	$EndTime 	 = $Range[1];
	$StartTime 	= str_replace(' ', '', $StartTime);
	$EndTime 	= str_replace(' ', '', $EndTime);

	$dateType 	= $_POST['dateType'];
	if($dateType == 1){
		if($StartTime != $EndTime){
			$Condition .= "  `starttime` BETWEEN '".DATUMREPORTSTART($StartTime)."' AND '".DATUMREPORTEND($EndTime)."' ";
		}else{
			$Condition .= "  `starttime` LIKE '%".DATUMREPORTLike($StartTime)."%'";
		}
	}
	
	if($dateType == 2){
		if($StartTime != $EndTime){
			$newStartTime 	= substr($StartTime,6,4).'-'.substr($StartTime,3,2).'-'.substr($StartTime,0,2);
			$newEndTime 	= substr($EndTime,6,4).'-'.substr($EndTime,3,2).'-'.substr($EndTime,0,2);
			$Condition .= "  CAST(`checkindate` AS DATETIME) BETWEEN '".DATUMREPORTSTART($StartTime)."' AND '".DATUMREPORTEND($EndTime)."' ";
		}else{
			$Condition .= "  CAST(`checkindate` AS DATETIME) LIKE '%".DATUMREPORTLike($StartTime)."%'";
		}
	}

	$resaAgence = addslashes(utf8_encode($_POST['resaAgence']));
	if($resaAgence != ""){
		$Condition .= "  AND (`agentid`='".$resaAgence."') ";
	}

	$resaAgent = addslashes(utf8_encode($_POST['resaAgent']));
	if($resaAgent != ""){
		$Condition .= " AND (`agentid`='".$resaAgent."') ";
	}



	$resaSupplier = addslashes(utf8_encode($_POST['resaSupplier']));
	if($resaSupplier != ""){
		if($resaSupplier == 2){
			$bookingservicetype = 'hotelsbeds';
		}elseif($resaSupplier == 3){
			$bookingservicetype = 'elmouradihotels';
		}elseif($resaSupplier == 4){
			$bookingservicetype = 'hotelbedsactivity';
		}elseif($resaSupplier == 6){
			$bookingservicetype = 'carthagehotels';
		}

		$Condition .= " AND (`bookingservicetype`='".$bookingservicetype."') ";
	}
	
	$resaStatus = addslashes(utf8_encode($_POST['resaStatus']));
	if($resaStatus != ''){

		switch ($resaStatus) {
		    case 0 : $newStatus = "requested"; break; //En Attente
		    case 1 : $newStatus = "vouchered"; break; //Confirm&eacute;es
		    case 2 : $newStatus = "refused"; break; //Refus&eacute;es
		    case 3 : $newStatus = "cancelled"; break; //Annul&eacute;es
		}
		
		$Condition .= " AND (`currentstatus`='".$newStatus."') ";
	}
	
	$iSBooking = $site->countResaFilter($Condition);
	$BookingDetails = $site->resaFilter($Condition);

	$RES = '';
	
	$TotalPriceResaNetEUR = 0;
	$TotalPriceResaNetGBP = 0;
	$TotalPriceResaNetTND = 0;
	$TotalPriceResaAgn = 0;
	$nbBooking  = 0;
	$nbBookingC = 0;
	$TotalPriceResaNet = array();
	if($iSBooking > 0){
		foreach ($BookingDetails as $BookingDetail) {
			$nbBooking += 1;
			$Pid				    = $BookingDetail['pid'];
			$Id					    = $BookingDetail['id'];
			$AgentId			    = $BookingDetail['agentid'];
			$BookingReference	  	= $BookingDetail['bookingreference'];
			$TotalCharges		    = $BookingDetail['totalcharges'];
			$Convertion		      	= $BookingDetail['convertion'];
			$LeaderTitle		    = $BookingDetail['leadertitle'];
			$LeaderTitle 			= strtolower($LeaderTitle);
			$LeaderTitle 			= ucwords($LeaderTitle);
			$LeaderFirstName		= stripslashes(utf8_decode($BookingDetail['leaderfirstname']));
			$LeaderFirstName 		= strtolower($LeaderFirstName);
			$LeaderFirstName 		= ucwords($LeaderFirstName);
			$LeaderLastName		  	= stripslashes(utf8_decode($BookingDetail['leaderlastname']));
			$LeaderLastName 		= strtolower($LeaderLastName);
			$LeaderLastName 		= ucwords($LeaderLastName);
			$CurrencyCode		    = $BookingDetail['currencycode'];
			$LocalHotelId		    = $BookingDetail['localhotelid'];
			$HotelName			    = stripslashes(utf8_decode($BookingDetail['hotelname']));
			$CountryName		    = $BookingDetail['countryname'];
			$CityName			    = $BookingDetail['cityname'];
			$CityId				    = $BookingDetail['cityid'];
			$HotelAddress1		  	= $BookingDetail['hoteladdress'];
			$CurrentStatus		  	= $BookingDetail['currentstatus'];
			$TotalAdults		    = $BookingDetail['totaladults'];
			$TotalChildren		  	= $BookingDetail['totalchildren'];
			$TotalRooms			    = $BookingDetail['totalrooms'];
			$CheckInDate		    = $BookingDetail['checkindate'];
			$CheckOutDate		    = $BookingDetail['checkoutdate'];
			$GrossAmount		    = $BookingDetail['grossamount'];
			$HotelPhone			    = $BookingDetail['hotelphone'];
			$SelectedNights		  	= $BookingDetail['selectednights'];
			$BookingServiceType 	= $BookingDetail['bookingservicetype'];

			if($BookingServiceType == 'hotelsbeds'){
	          $TrBg = 'hotelsbedsbg';
	        }elseif($BookingServiceType == 'hotelbedsactivity'){
	          $TrBg = 'hotelbedsactivitybg';
	        }elseif($BookingServiceType == 'elmouradihotels'){
	          $TrBg = 'elmouradihotelsbg';
	        }elseif($BookingServiceType == 'carthagehotels'){
              $TrBg = 'carthagehotels';
            }
	    

			$agence	  	= $BookingDetail['agentid'];
			$agent	  	= $BookingDetail['agentid'];
			
			$AGNT       = $site->SelectObjectTableWC("user","id",$agent,"id","ASC");
			
			$AGENT      = stripslashes(utf8_decode($AGNT->firstname));
			$AGN        = $site->SelectObjectTableWC("user","id",$agence,"id","ASC");
			$AGENCE     = stripslashes(utf8_decode($AGN->lastname));
			$CREDITAGN  = stripslashes(utf8_decode($AGN->credit));
			$Devise     = stripslashes(utf8_decode($AGN->code_devise));
			
			if($CurrentStatus == "vouchered"){
				$TotalPriceResaAgn += $GrossAmount;
				$nbBookingC += 1;

	            $ETAT = '<b class="has-success"> Confirm&eacute;e </b>';
	            if(!isset($TotalPriceResaNet[$CurrencyCode])){
	            	$TotalPriceResaNet[$CurrencyCode]  = 0;
	            }
	           
	    	$TotalPriceResaNet[$CurrencyCode] += $TotalCharges;
	            			}elseif($CurrentStatus == "cancelled"){
			$ETAT = '<b class="has-error"> Annul&eacute;e </b>';
			}elseif($CurrentStatus == "refused"){
				$ETAT = '<b class="has-error"> Refus&eacute;e </b>';
			}else{
				$ETAT = '<b class="has-warning"> En Attente </b>';
			}
			
			$StartTime = $BookingDetail['starttime'];
			$CheckInDate	= str_replace('-','',$CheckInDate);
			$Today			= date("Ymd");

			if ($BookingServiceType == "hotelbedsactivity") {
                $ActivityDetails = $site->SelectObjectTableWC('activityDetail','pidBooking',$Pid,'pid','ASC');
                $HotelName = stripslashes(utf8_decode($ActivityDetails->activityName));
            }
			$canaluser=$AGN ->canal;
		
			if ($canal==''){
			$RES .='<tr>';
			if($CurrentStatus == "vouchered"){
				$RES .='<td class="'.$TrBg.'"><a style="color: #73879C;" href="'.$WORKPATH.'proforma.php?BookingId='.$Pid.'" target="_blank">'.$BookingReference.'</a></td>';
			}else{
				$RES .='<td class="'.$TrBg.'">'.$BookingReference.'</td>';
			}

			$RES .='
			<td class="'.$TrBg.'"><a style="color: #73879C;" href="'.$WORKPATH.'agency/diagram/'.$agence.'/">'.$AGENCE.'</a></td>
			
			<td class="'.$TrBg.'">'.$HotelName.'</td>
			<td class="'.$TrBg.'">'.$LeaderTitle.' '.$LeaderFirstName.' '.$LeaderLastName.'</td>
			<td class="'.$TrBg.'">'.DATUML($StartTime).'</td>';
		    $RES .='<td class="'.$TrBg.'">'.$TotalCharges.' '.$CurrencyCode;
			
			
			$RES .= '</td>';
			$RES .='<td style="background: #e6e6e6;">'.$ETAT.'</td>
			<td style="background: #e6e6e6;"><a class="btn btn-primary btn-sm" href="'.$WORKPATH.'reservation.php?pid='.$Pid.'"> D&eacute;tails </a>';
		
		
			$super_roles    = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->role));
			$roles          = explode(',', $super_roles);
			if($roles[0] == 1){
				if($CurrentStatus == "vouchered"){
					$RES .= '	<form action="'.$WORKPATH.'files/functions_confirm.php" method="post">
									<input type="hidden" value="forceStatus" name="action">
									<input type="hidden" value="'.$Pid.'" name="booking">
									<input type="hidden" value="0" name="forceStatus">
									<input type="submit" value="Force Cancel" class="btn btn-danger btn-sm">
								</form>';
				}
				if($CurrentStatus == "cancelled" || $CurrentStatus == "refused"){
					$RES .= '	<form action="'.$WORKPATH.'files/functions_confirm.php" method="post">
									<input type="hidden" value="forceStatus" name="action">
									<input type="hidden" value="'.$Pid.'" name="booking">
									<input type="hidden" value="1" name="forceStatus">
									<input type="submit" value="Force Confirm" class="btn btn-success btn-sm">
								</form>';
				}
			
			}
			$RES .='</td></tr>';
	
		
	
	}elseif(trim($canal)==trim($canaluser))	{
		
		$RES .='<tr>';
		if($CurrentStatus == "vouchered"){
			$RES .='<td class="'.$TrBg.'"><a style="color: #73879C;" href="'.$WORKPATH.'proforma.php?BookingId='.$Pid.'" target="_blank">'.$BookingReference.'</a></td>';
		}else{
			$RES .='<td class="'.$TrBg.'">'.$BookingReference.'</td>';
		}

		$RES .='
		<td class="'.$TrBg.'"><a style="color: #73879C;" href="'.$WORKPATH.'agency/diagram/'.$agence.'/">'.$AGENCE.'</a></td>
		
		<td class="'.$TrBg.'">'.$HotelName.'</td>
		<td class="'.$TrBg.'">'.$LeaderTitle.' '.$LeaderFirstName.' '.$LeaderLastName.'</td>
		<td class="'.$TrBg.'">'.DATUML($StartTime).'</td>';
		$RES .='<td class="'.$TrBg.'">'.$TotalCharges.' '.$CurrencyCode;
		
		
		$RES .= '</td>';
		$RES .='<td style="background: #e6e6e6;">'.$ETAT.'</td>
		<td style="background: #e6e6e6;"><a class="btn btn-primary btn-sm" href="'.$WORKPATH.'reservation.php?pid='.$Pid.'"> D&eacute;tails </a>';
	
	
		$super_roles    = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->role));
		$roles          = explode(',', $super_roles);
		if($roles[0] == 1){
			if($CurrentStatus == "vouchered"){
				$RES .= '	<form action="'.$WORKPATH.'files/functions_confirm.php" method="post">
								<input type="hidden" value="forceStatus" name="action">
								<input type="hidden" value="'.$Pid.'" name="booking">
								<input type="hidden" value="0" name="forceStatus">
								<input type="submit" value="Force Cancel" class="btn btn-danger btn-sm">
							</form>';
			}
			if($CurrentStatus == "cancelled" || $CurrentStatus == "refused"){
				$RES .= '	<form action="'.$WORKPATH.'files/functions_confirm.php" method="post">
								<input type="hidden" value="forceStatus" name="action">
								<input type="hidden" value="'.$Pid.'" name="booking">
								<input type="hidden" value="1" name="forceStatus">
								<input type="submit" value="Force Confirm" class="btn btn-success btn-sm">
							</form>';
			}
		
		}
		$RES .='</td></tr>';
	}
	}
	$RES .= '<tr style="color:#73879C;">
	<td colspan="5"></td>
	<th colspan="2" align="right">R&eacute;servations Confirm&eacute;es</th>
	<th colspan="3">'.$nbBookingC.' / '.$nbBooking.'</th>
  </tr>';

$RES .= '<tr style="color:#73879C;">
	<td colspan="5"></td>
	<th colspan="2" align="right">Total Agence</th>
	<th colspan="3">'.number_format($TotalPriceResaAgn,3,"."," " ).' '.$Devise.'</th>
  </tr>';
$RES .= '<tr style="color:#73879C;">
	<th colspan="5"></th>
	<th colspan="2" align="right">Total Net</th>
	<th colspan="3">';
foreach($TotalPriceResaNet as $keyNet => $valueNet){
if($valueNet > 0){
$RES .= number_format($valueNet,3,"."," " ) . ' ' . $keyNet . ' <br> ';
}
}
$RES .= '</th>';
$RES .= '</tr>';		
}			  
	echo $RES;
}
if( isset($_POST['action']) && ($_POST['action'] == "agn_update") ){

	$agn_devise 	 = addslashes(utf8_encode($_POST['agn_devise']));
	$agn_pid 	 	= addslashes(utf8_encode($_POST['agn_pid']));
	$agn_login 	 	= addslashes(utf8_encode($_POST['agn_login']));
	$agn_adress 	= addslashes(utf8_encode($_POST['agn_adress']));
	if (isset($_POST['agn_zipcode'])){
		$agn_zipcode 	= addslashes(utf8_encode($_POST['agn_zipcode']));
	}else{
		$agn_zipcode 	= '';
	}
	if (isset($_POST['agn_markup_personne'])&& $_POST['agn_markup_personne']!=''){
		
		$agn_markup_personne=addslashes(utf8_encode($_POST['agn_markup_personne']));
	}else{
		$agn_markup_personne=0;
	}
	if (isset($_POST['agn_rc'])){
		$agn_rc 	 	= addslashes(utf8_encode($_POST['agn_rc']));
	}else{
		$agn_rc 	 	= '';
	}
	if (isset($_POST['agn_mf'])){
		$agn_mf 	 	= addslashes(utf8_encode($_POST['agn_mf']));
	}else{
		$agn_mf 	 	= '';
	}
	if (isset($_POST['agn_iata'])){
		$agn_iata 	 	= addslashes(utf8_encode($_POST['agn_iata']));
	}else{
		$agn_iata 	 	= '';	
	}
	if (isset($_POST['agn_licence'])){
		$agn_licence 	= addslashes(utf8_encode($_POST['agn_licence']));
	}else{
		$agn_licence 	= '';
	}

$table = "user";
$champ = "id";
$value = $agn_pid ;
$ord   = "id";
$dir   = "ASC";
$AGNTOU   = $site->SelectObjectTableWC($table,$champ,$value,$ord,$dir);


	if (isset($_POST['agn_markup'])){
		$agn_markup	 	= addslashes(utf8_encode($_POST['agn_markup']));
	}else{
		$agn_markup		= $AGNTOU->markup;
	}
	$agn_ville 	 	= addslashes(utf8_encode($_POST['agn_ville']));
	$agn_pays 	 	= addslashes(utf8_encode($_POST['agn_pays']));
	$agn_etat 	 	= addslashes(utf8_encode($_POST['agn_etat']));
	$client_nom 	= addslashes(utf8_encode($_POST['client_nom']));
	if (isset($_POST['client_prenom'])){
		$client_prenom 	= addslashes(utf8_encode($_POST['client_prenom']));
	}else{
		$client_prenom 	= '';
	}
	$client_email 	= addslashes(utf8_encode($_POST['client_email']));
	$client_tel 	= addslashes(utf8_encode($_POST['client_tel']));
	$canal		    = addslashes(utf8_encode($_POST['canal']));
	if (!empty($_POST['newPassword'])){
		$password		    = addslashes(utf8_encode($_POST['newPassword']));
		$password		    =	md5($password);
	}else{
		
		$password    =$AGNTOU->password;
	}

	if (isset($_POST['roles'])){
		$role 	= $_POST['roles'];
		$roles  = '';

		for ($i=1; $i<=2 ; $i++) { 
			if(in_array($i, $role)){
				if($i == 2){
					$roles .= '2';
				}else{
					$roles .= $i.',';
				}
			}else{
				if($i == 2){
					$roles .= '0';
				}else{
					$roles .= '0,';
				}
				
			}
		}
	}else{
		$role 	= [];
		$roles  = '1,2';
	}

	$UPDATE = $site->editSuperAgence($agn_login,$agn_markup_personne,$password,$agn_devise,$agn_markup,$agn_adress,$agn_zipcode,$agn_ville,$agn_pays,$agn_rc,$agn_mf,$agn_iata,$agn_licence,$agn_etat,$roles,$client_nom,$client_prenom,$client_email,$client_tel,$agn_pid,$canal);
	if(isset($_SESSION['logo'])){
		$logo = $_SESSION['logo'];
		foreach ($logo as $key => $value) {
			$ImageName 	= $value;
		}
		$insert = $site->updateLogo($agn_pid,$ImageName);
		unset($_SESSION['logo']);
	}


	if($canal=='B2C'){
		header("location:".$WORKPATH."agences_b2c.php");
	}elseif($canal=='B2B'){
		header("location:".$WORKPATH."agences_b2b.php");
	}else{
		header("location:".$WORKPATH."agences_b2e.php");
	}

}
if( isset($_POST['action']) && ($_POST['action'] == "agn_add") ){
	
	$agn_login 	 	= addslashes(utf8_encode($_POST['agn_login']));
	$agn_adress 	= addslashes(utf8_encode($_POST['agn_adress']));
	if (isset($_POST['agn_zipcode'])){
		$agn_zipcode 	= addslashes(utf8_encode($_POST['agn_zipcode']));
	}else{
		$agn_zipcode 	= '';
	}
	if (isset($_POST['agn_rc'])){
		$agn_rc 	 	= addslashes(utf8_encode($_POST['agn_rc']));
	}else{
		$agn_rc 	 	= '';
	}
	if (isset($_POST['agn_mf'])){
		$agn_mf 	 	= addslashes(utf8_encode($_POST['agn_mf']));
	}else{
		$agn_mf 	 	= '';
	}
	if (isset($_POST['agn_iata'])){
		$agn_iata 	 	= addslashes(utf8_encode($_POST['agn_iata']));
	}else{
		$agn_iata 	 	= '';	
	}
	if (isset($_POST['agn_licence'])){
		$agn_licence 	= addslashes(utf8_encode($_POST['agn_licence']));
	}else{
		$agn_licence 	= '';
	}
	$table = "markup";
	$ord   = "markup_b2b";
	$dir   = "ASC";
	$Markup = $site->SelectLastObjectTable($table, $ord, $dir);
	if (isset($_POST['agn_markup'])){
		$agn_markup	 	= addslashes(utf8_encode($_POST['agn_markup']));
	}else{
		$agn_markup		= $Markup->markup_b2c ;
	}
	$agn_ville 	 	= addslashes(utf8_encode($_POST['agn_ville']));
	$agn_pays 	 	= addslashes(utf8_encode($_POST['agn_pays']));
	$agn_etat 	 	= addslashes(utf8_encode($_POST['agn_etat']));
	$client_nom 	= addslashes(utf8_encode($_POST['client_nom']));
	$agn_devise	    = addslashes(utf8_encode($_POST['agn_devise']));

	if (isset($_POST['agn_markup_personne']) && $_POST['agn_markup_personne']!=''){
		$agn_markup_personne=addslashes(utf8_encode($_POST['agn_markup_personne']));
	}else{
		$agn_markup_personne=0;
	}



	if (isset($_POST['client_prenom'])){
		$client_prenom 	= addslashes(utf8_encode($_POST['client_prenom']));
	}else{
		$client_prenom 	= '';
	}
	
	$client_email 	= addslashes(utf8_encode($_POST['client_email']));
	$client_tel 	= addslashes(utf8_encode($_POST['client_tel']));
	$canal		    = addslashes(utf8_encode($_POST['canal']));
	$password		= addslashes(utf8_encode($_POST['newPassword']));
	$password		= md5($password);
	if (isset($_POST['roles'])){
		$role 	= $_POST['roles'];
		$roles  = '';
		for ($i=1; $i<=2 ; $i++) { 
			if(in_array($i, $role)){
				if($i == 2){
					$roles .= '2';
				}else{
					$roles .= $i.',';
				}
			}else{
				if($i == 2){
					$roles .= '0';
				}else{
					$roles .= '0,';
				}
				
			}
		}
	}else{
		$role 	= [];
		$roles  = '1,2';
	}

	$agn_pid='';

	if(isset($_SESSION['logo'])){
		$logo = $_SESSION['logo'];
		foreach ($logo as $key => $value) {
			$ImageName 	= $value;
		}
		$insert = $site->insertSuperAgence($agn_devise,$agn_markup_personne,$agn_login,$password,$agn_markup,$agn_adress,$agn_zipcode,$agn_ville,$agn_pays,$agn_rc,$agn_mf,$agn_iata,$agn_licence,$agn_etat,$roles,$client_nom,$client_prenom,$client_email,$client_tel,$agn_pid,$canal,$ImageName);
	
		unset($_SESSION['logo']);
	}else{

		$insert = $site->insertSuperAgence($agn_devise,$agn_markup_personne,$agn_login,$password,$agn_markup,$agn_adress,$agn_zipcode,$agn_ville,$agn_pays,$agn_rc,$agn_mf,$agn_iata,$agn_licence,$agn_etat,$roles,$client_nom,$client_prenom,$client_email,$client_tel,$agn_pid,$canal,'');
	}
	$subject = "Bienvenue Chez Emna Voyages";
    $body = file_get_contents('../email-templates/email.php');
    $body = str_replace("DummyTexttest",$agn_login,$body);
    smtpmailer($client_email, $NOREPLY_EMAIL, $SITE_NAME, $subject, $body, $is_gmail = false);
	if($canal=='B2B'){
	header("location:".$WORKPATH."agences_b2b.php");
	}
	elseif($canal=='B2C'){
		header("location:".$WORKPATH."agences_b2c.php");
	}
	else{
	header("location:".$WORKPATH."agences_b2e.php");
	}


}
if (isset($_POST['action']) && ($_POST['action'] == "UserCheck")) {
    $emailcheck = 0;
    $usernamecheck = 0;

    $email = addslashes(utf8_encode($_POST['email']));

    $UserEmailCheck = $site->EmailCheck($email);

    if ($UserEmailCheck > 0) {
        $emailcheck = 1;
    }

    $username = addslashes(utf8_encode($_POST['username']));
    $UserNameCheck = $site->UserNameCheck($username);

    if ($UserNameCheck > 0) {
        $usernamecheck = 1;
    }

    $arr = [$usernamecheck, $emailcheck];

    print_r(json_encode($arr));

}
//non utilisés
if( isset($_POST['action']) && ($_POST['action'] == "change_city") ){
	$alpha = $_POST['alpha'];

	$iS = $site->countTableWC("pays","alpha2",$alpha);
	if($iS > 0){
		$P = $site->SelectObjectTableWC("pays","alpha2",$alpha,"id_pays","ASC");
		$id_pays = $P->id_pays;

		$V = $site->SelectFromTableWC("ville","id_pays",$id_pays,"nom_fra","ASC");

		$options = '<option value="">---</option>';
		foreach($V as $ville){
			$id_ville = $ville['id_ville'];
			$nom_fra  = stripslashes(utf8_decode($ville['nom_fra']));

			$options .= '<option value="'.$id_ville.'">'.$nom_fra.'</option>';
		}


	}else{
		$options = "";
	}

	echo $options;
}
if( isset($_POST['action']) && ($_POST['action'] == "worker_save") ){

	$pid 	 	= addslashes(utf8_encode($_POST['pid']));
	$last_name	= addslashes(utf8_encode($_POST['last_name']));
	$first_name	= addslashes(utf8_encode($_POST['first_name']));
	$email 		= addslashes(utf8_encode($_POST['email']));
	$login 		= addslashes(utf8_encode($_POST['login']));
	$password	= addslashes(utf8_encode($_POST['password']));
    $etat 		= addslashes(utf8_encode($_POST['etat']));

    if(isset($_POST['roles'])){
    	$role 	= $_POST['roles'];
	    $Nrole 	= count($role);
		$roles  = '';

		foreach ($role as $key => $value) {
			if ($key < $Nrole-1) {
				# code...
			}
		}

		for ($i=1; $i<=9 ; $i++) { 
			if(in_array($i, $role)){
				if($i == 9){
					$roles .= '9';
				}else{
					$roles .= $i.',';
				}
			}else{
				if($i == 9){
					$roles .= '0';
				}else{
					$roles .= '0,';
				}
				
			}
		}

		$UPDATE		= $site->saveSuperWorker($last_name,$first_name,$email,$login,md5($password),$etat,$roles,$pid);
		$comment 	= addslashes(utf8_encode($UPDATE));
		header("location:".$WORKPATH."superworkers.php");
    }else{
    	$UPDATE		= $site->saveSuperWorkerSB($last_name,$first_name,$email,$login,md5($password),$etat,$pid);
		$comment 	= addslashes(utf8_encode($UPDATE));
		header("location:".$WORKPATH."superworker.php?pid=".$pid);
    }
    
    $superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'superworkers';
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);


}
if( isset($_POST['action']) && ($_POST['action'] == "updateMarkupB2c") ){
	$markupb2c=$_POST['markupb2c'];
	$UPDATE = $site->updateMarkup($markupb2c);
	$UPDATEUserB2c = $site->updateUserB2C($markupb2c);
		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'markup';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
}
if( isset($_POST['action']) && ($_POST['action'] == "updateMarkupB2b") ){
	$markupb2b=$_POST['markupb2b'];
	$UPDATE = $site->updateMarkupb2b($markupb2b);
		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'markup';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
}
if( isset($_POST['action']) && ($_POST['action'] == "updateMarkupB2e") ){
	$markupb2e=$_POST['markupb2e'];
	$UPDATE = $site->updateMarkupb2e($markupb2e);
		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'markup';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
}
if( isset($_POST['action']) && ($_POST['action'] == "updateMarkuppersonne") ){
	$markuppersonne=$_POST['markuppersonne'];
	$UPDATE = $site->updateMarkuppersonne($markuppersonne);
	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'markup';
	$comment 		= addslashes(utf8_encode($UPDATE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
}
if( isset($_POST['action']) && ($_POST['action'] == "updateMarkuppersonneb2b") ){
	$markuppersonne=$_POST['markuppersonne'];
	$UPDATE = $site->updateMarkuppersonneb2b($markuppersonne);
	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'markup';
	$comment 		= addslashes(utf8_encode($UPDATE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
}
if( isset($_POST['action']) && ($_POST['action'] == "updateMarkuppersonneb2e") ){
	$markuppersonne=$_POST['markuppersonne'];
	$UPDATE = $site->updateMarkuppersonneb2e($markuppersonne);
	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'markup';
	$comment 		= addslashes(utf8_encode($UPDATE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
}
if( isset($_POST['action']) && ($_POST['action'] == "worker_add") ){

	$last_name	= addslashes(utf8_encode($_POST['last_name']));
	$first_name	= addslashes(utf8_encode($_POST['first_name']));
	$email 		= addslashes(utf8_encode($_POST['email']));
	$login 		= addslashes(utf8_encode($_POST['login']));
	$password	= addslashes(utf8_encode($_POST['password']));
    $etat 		= addslashes(utf8_encode($_POST['etat']));

	$created_on 	= date("Y-m-d H:i:s");
	$last_login 	= date("Y-m-d H:i:s");

	$INSERT		= $site->addWorker($last_name,$first_name,$email,$login,md5($password),$etat,$created_on,$last_login);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'insert';
	$usedTable 		= 'superworkers';
	$comment 		= addslashes(utf8_encode($INSERT));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	header("location:".$WORKPATH."superworkers.php");

}
if( isset($_POST['action']) && ($_POST['action'] == "worker_remove") ){
	
	$pid 	 = addslashes(utf8_encode($_POST['p']));

	$DELETE		= $site->DelFrom("workers","pid",$pid);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'delete';
	$usedTable 		= 'workers';
	$comment 		= addslashes(utf8_encode($DELETE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	echo "OOK";

}
if( isset($_POST['action']) && ($_POST['action'] == "super_activ") ){
	
	$pid 	 = addslashes(utf8_encode($_POST['p']));
	$etat 	 = addslashes(utf8_encode($_POST['e']));
	if($etat == 0){
		$E = 1;
	}else{
		$E = 0;
	}

	$UPDATE		= $site->editSuperEtat($E,$pid);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'superworkers';
	$comment 		= addslashes(utf8_encode($UPDATE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	echo "OOK,".$E;

}
if( isset($_POST['action']) && ($_POST['action'] == "agn_activ") ){
	
	$pid 	 = addslashes(utf8_encode($_POST['p']));
	$etat 	 = addslashes(utf8_encode($_POST['e']));
	if($etat == 0){
		$E = 1;
	}else{
		$E = 0;
	}

	$UPDATE		= $site->editAgenceEtat($E,$pid);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'user';
	$comment 		= addslashes(utf8_encode($UPDATE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	echo "OOK,".$E;

}
if( isset($_POST['action']) && ($_POST['action'] == "agn_activ_email") ){
	
	$pid 	 = addslashes(utf8_encode($_POST['p']));
	$AGN     = $site->SelectObjectTableWC("agence","pid",$pid,"pid","ASC");

	$DATUM 		  = DTODAY(date("Y-m-d"));
	$EMAIL        = stripslashes(utf8_decode($AGN->email));
	$USERNAME     = stripslashes(utf8_decode($AGN->login));
	$PASSWORD     = stripslashes(utf8_decode($AGN->password));

	$to         = $EMAIL;
	$from       = $NOREPLY_EMAIL;
	$from_name  = $SITE_NAME;
	$subject    = "Account Activation";
	include_once("agency-email-activation.php");
	$body       = $msg;
	smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = false);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'smtpmailer';
	$usedTable 		= 'user';
	$comment 		= addslashes(utf8_encode(" Account Activation `agence` WHERE `pid`='".$pid."' "));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

}
if( isset($_POST['action']) && ($_POST['action'] == "deposit_add") ){
	
	$agence	 = addslashes(utf8_encode($_POST['pid']));
	$deposit = addslashes(utf8_encode($_POST['deposit']));
	$comment = addslashes(utf8_encode($_POST['comment']));

	$superworker = $_SESSION['SuperSuperAdmin']->pid;

	$deposit_on = date("Y-m-d H:i:s");
	$AGN 		= $site->SelectObjectTableWC("user","id",$agence,"id","ASC");
	$currency = $AGN->code_devise;

	$CREDIT 	= $AGN->credit;
	$INSERT		= $site->addAgenceDeposit($agence,$deposit,$currency,$deposit_on,$comment,$CREDIT,$superworker);

	$CREDIT    += $deposit;
	
	$UPDATE 	= $site->updateAgenceCredit($agence,$CREDIT);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'insert';
	$usedTable 		= 'deposit';
	$comment 		= addslashes(utf8_encode($INSERT));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	header("location:".$WORKPATH."deposits.php?pid=".$agence);

}
if( isset($_POST['action']) && ($_POST['action'] == "devise_insert") ){
	
	$CurrLongName 	= addslashes(utf8_encode($_POST['CurrLongName']));
	$CurrShortName 	= addslashes(utf8_encode($_POST['CurrShortName']));
	$CurrChange 	= addslashes(utf8_encode($_POST['CurrChange']));
	$CurrToTND 		= addslashes(utf8_encode($_POST['CurrToTND']));

	$INSERT = $site->insertCurrency($CurrLongName,$CurrShortName,$CurrChange,$CurrToTND);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'insert';
	$usedTable 		= 'devises';
	$comment 		= addslashes(utf8_encode($INSERT));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "devise_update") ){

	
	$CurrPid	= addslashes(utf8_encode($_POST['CurrPid']));
	$isBook		= $site->countTableWC("devises","pid",$CurrPid);
	if($isBook > 0){
		$CurrLongName 	= addslashes(utf8_encode($_POST['CurrLongName']));
		$CurrShortName 	= addslashes(utf8_encode($_POST['CurrShortName']));
		$CurrChange 	= addslashes(utf8_encode($_POST['CurrChange']));
		$CurrToTND 		= addslashes(utf8_encode($_POST['CurrToTND']));
	
		$UPDATE = $site->updateCurrency($CurrLongName,$CurrShortName,$CurrChange,$CurrToTND,$CurrPid);

		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'devises';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}
	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "devise_del") ){
	
	$CurrPid	= addslashes(utf8_encode($_POST['CurrPid']));
	$isBook		= $site->countTableWC("devises","pid",$CurrPid);
	if($isBook > 0){
		$DELETE = $site->DelFrom("devises","pid",$CurrPid);

		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'delete';
		$usedTable 		= 'devises';
		$comment 		= addslashes(utf8_encode($DELETE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}
	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "country_del") ){
	
	$CurrPid	= addslashes(utf8_encode($_POST['CurrPid']));
	$isBook		= $site->countTableWC("pays","id_pays",$CurrPid);
	if($isBook > 0){
		$DELETE = $site->DelFrom("pays","id_pays",$CurrPid);

		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'delete';
		$usedTable 		= 'pays';
		$comment 		= addslashes(utf8_encode($DELETE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}
	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "country_update") ){
	
	$PaysPid	= addslashes(utf8_encode($_POST['PaysPid']));
	$isBook		= $site->countTableWC("pays","id_pays",$PaysPid);
	if($isBook > 0){
		$PaysNom 	= addslashes(utf8_encode($_POST['PaysNom']));
		$PaysAlpha2 	= addslashes(utf8_encode($_POST['PaysAlpha2']));
		$PaysAlpha3 	= addslashes(utf8_encode($_POST['PaysAlpha3']));
		$UPDATE = $site->updateCountry($PaysPid,$PaysNom,$PaysAlpha2,$PaysAlpha3);
		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'pays';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History        = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}

	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "CityUpdate") ){
	
	$CityPid	= addslashes(utf8_encode($_POST['CityPid']));
	$isBook		= $site->countTableWC("ville","id_ville",$CityPid);
	if($isBook > 0){
		$CityNomFra 	= addslashes(utf8_encode($_POST['CityNomFra']));
		$CityNomEng 	= addslashes(utf8_encode($_POST['CityNomEng']));
	
		$UPDATE = $site->updateCity($CityPid,$CityNomFra,$CityNomEng);

		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'ville';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}
	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "CityRemove") ){
	
	$CityPid	= addslashes(utf8_encode($_POST['CityPid']));
	$isBook		= $site->countTableWC("ville","id_ville",$CityPid);
	if($isBook > 0){	
		$DELETE = $site->DelFrom("ville","id_ville",$CityPid);

		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'delete';
		$usedTable 		= 'ville';
		$comment 		= addslashes(utf8_encode($DELETE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}
	echo "OK";
}
if( isset($_POST['action']) && ($_POST['action'] == "CityAdd") ){
	
	$PaysPid 	= addslashes(utf8_encode($_POST['PaysPid']));
	$CityNomFra = addslashes(utf8_encode($_POST['CityNomFra']));
	$CityNomEng = addslashes(utf8_encode($_POST['CityNomEng']));

	$INSERT = $site->insertCity($PaysPid,$CityNomFra,$CityNomEng);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'insert';
	$usedTable 		= 'ville';
	$comment 		= addslashes(utf8_encode($INSERT));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);

	echo "OK";

}
if( isset($_POST['action']) && ($_POST['action'] == "soldeXml") ){
	
	$request 	= soldeXml();
	$result 	= json_decode($request, true);
	echo ($result['AgentCreditAvailable']);
}
if( isset($_POST['action']) && ($_POST['action'] == "AgenceChange") ){
	
	$agence = $_POST['agence'];

	$iS = $site->countTableWC("agence","pid",$agence);
	if($iS > 0){
		$P = $site->SelectFromTableW2C("workers","agence",$agence,"etat",1,"prenom","ASC");

		$options = '<option value="">Agent</option>';
		foreach($P as $AGENT){
			$pidAgent 		= $AGENT['pid'];
			$prenomAgent 	= stripslashes(utf8_decode($AGENT['prenom']));

			$options .= '<option value="'.$pidAgent.'">'.$prenomAgent.'</option>';
		}


	}else{
		$options = '<option value="">Agent</option>';
	}

	echo $options;
}
if( isset($_POST['action']) && ($_POST['action'] == "BookClientUpdate") ){
	$BookPid	= addslashes(utf8_encode($_POST['BookPid']));
	$pidPax		= addslashes(utf8_encode($_POST['pidPax']));
	$princ		= addslashes(utf8_encode($_POST['princ']));
	$FirstName	= addslashes(utf8_encode($_POST['FirstName']));
	$LastName	= addslashes(utf8_encode($_POST['LastName']));

	$UPDATE = $site->BookClientUpdate('bookingroomdetails','firstname',$FirstName,'lastname',$LastName,'pid',$pidPax);

	$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
	$insertedOn 	= date('Y-m-d H:i:s');
	$tache 			= 'update';
	$usedTable 		= 'bookingroomdetails';
	$comment 		= addslashes(utf8_encode($UPDATE));
	$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	
	if($princ == 1){
		$UPDATE = $site->BookClientUpdate('booking','leaderfirstname',$FirstName,'leaderlastname',$LastName,'pid',$BookPid);

		$superWorker 	= $_SESSION['SuperSuperAdmin']->pid;
		$insertedOn 	= date('Y-m-d H:i:s');
		$tache 			= 'update';
		$usedTable 		= 'booking';
		$comment 		= addslashes(utf8_encode($UPDATE));
		$History = $site->insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment);
	}

	echo "OK";
}
include 'RandomColor.php';
use \Colors\RandomColor;
if( isset($_POST['action']) && ($_POST['action'] == "fetch_data") ){
	$output = '';
	$table 	= 'online';
	$ord 	= 'last_activity';
	$dir 	= 'DESC';
	$result = $site->fetchDataOnline();
	$i = 0;
	
	function rand_color() {
		return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}
	$SS = RandomColor::many(1, array('luminosity'=>'dark'));
	$BG = $SS[0];
	$BG = "";

	foreach($result as $row){
		$i += 1;
		$Agency 	= $site->SelectObjectTableWC('user','id',$row['agencypid'],'id','ASC');
		$AgencyName = stripslashes(utf8_decode($Agency->lastname));
		$AgentName 	= stripslashes(utf8_decode($Agency->lastname));
		if(isset($result[$i-2]) && $result[$i-2]['agencypid'] != $row['agencypid']){
			$SS = RandomColor::many(1, array('luminosity'=>'dark'));
			$BG = $SS[0];
			$BG = "";
		}
		$output .= '
		<tr> 
		<td style="background-color:'.$BG.'; "><a style="" href="'.$WORKPATH.'agency/diagram/'.$row['agencypid'].'/" target="_blank">'.$AgencyName.'</a></td>
		<td style="background-color:'.$BG.'; ">'.$AgentName.'</td>
		</tr>
		';
	}
	$output .= '
		<tr> 
		<th>Connected Agents</th>
		<th>'.$i.'</th>
		</tr>
		';
	echo $output;
}

if( isset($_POST['action']) && ($_POST['action'] == "forceStatus") ){
	
	$pidBooking = $_POST['booking'];
	$oldStatus 	= $_POST['forceStatus'];
	
	$BOOKING 	= $site->SelectObjectTableWC('booking','pid',$pidBooking,'pid','ASC');



	$GrossAmount= $BOOKING->grossamount;
	$pidAgency 	= $BOOKING->agentid;
	$Agency 	= $site->SelectObjectTableWC('user','id',$pidAgency,'id','ASC');
	$Credit 	= $Agency->credit;
	
	if($oldStatus == 1){
		$newStatus = 'vouchered';
		$newCredit = $Credit - $GrossAmount;
		$UPDATE = $site->lastLoginid("user","credit",$newCredit,$pidAgency);
		$UPDATE = $site->lastLogin("booking","currentstatus",$newStatus,$pidBooking);
	}
	if($oldStatus == 0){
		$newStatus = 'cancelled';
		$newCredit = $Credit + $GrossAmount;
		$UPDATE = $site->lastLoginid("user","credit",$newCredit,$pidAgency);
		$UPDATE = $site->lastLogin("booking","currentstatus",$newStatus,$pidBooking);
	}
	
	header("location:".$WORKPATH."reservations.php");
}


if( isset($_POST['action']) && ($_POST['action'] == "tasksFilter") ){
	
	$Condition = " WHERE  ";

	$reportRange = $_POST['reportRange'];
	$Range 		 = explode('-', $reportRange);
	$StartTime 	 = $Range[0];
	$EndTime 	 = $Range[1];
	$StartTime 	= str_replace(' ', '', $StartTime);
	$EndTime 	= str_replace(' ', '', $EndTime);
	if($StartTime != $EndTime){
		$Condition .= "  `insertedOn` BETWEEN '".DATUMREPORTSTART($StartTime)."' AND '".DATUMREPORTEND($EndTime)."' ";
	}else{
		$Condition .= "  `insertedOn` LIKE '%".DATUMREPORTLike($StartTime)."%'";
	}

	$superworkers = addslashes(utf8_encode($_POST['superworkers']));
	if($superworkers != ""){
		$Condition .= "  AND (`superWorker`='".$superworkers."') ";
	}

	$operation = addslashes(utf8_encode($_POST['operation']));
	if($operation != ""){
		$Condition .= " AND (`tache`='".$operation."') ";
	}

	$iSTasks = $site->countTaskFilter($Condition);
	$TaskDetails = $site->taskFilter($Condition);
	
	$RES = '';
	
	if($iSTasks > 0){
		foreach ($TaskDetails as $TaskDetail) {
			$Pid				= $TaskDetail['pid'];
			$superWorker		= $TaskDetail['superWorker'];
			$tache			    = $TaskDetail['tache'];
			$insertedOn 		= $TaskDetail['insertedOn'];
			$usedTable 			= $TaskDetail['usedTable'];

			$TachesGsa    = TachesGsa($tache,$usedTable);

            $Tache        = $TachesGsa['Tache'];
            $Operation    = $TachesGsa['Operation'];

			$superWorkers= $site->SelectObjectTableWC("superworkers","pid",$superWorker,"pid","ASC");
			$superworker  = ucfirst(stripslashes(utf8_decode($superWorkers->first_name)));
			
			$RES .='
			<tr>
			<td>'.$superworker.'</td>
			<td>'.$Operation.'</td>
			<td>'.$Tache.'</td>
			<td>'.DATUML($insertedOn).'</td>';
			$RES .='</tr>';
		}
	}
			  
	echo $RES;
}

?>