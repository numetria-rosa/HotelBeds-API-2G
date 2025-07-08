<?php
session_start();
include_once("DB_FUNCTION_INC.php");
$site = new SITE();


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

if( isset($_POST['action']) && ($_POST['action'] == "checkEmail") ){
	$email = $_POST['email'];

	$iS = $site->countTableWC("agence","email",$email);
	if($iS > 0){
		$Error = "NK";
	}else{
		$Error = "OK";
	}

	echo $Error;
}

if( isset($_POST['action']) && ($_POST['action'] == "agn_register") ){
	
	$agn_name 	= addslashes(utf8_encode($_POST['agn_name']));
	$last_name 	= addslashes(utf8_encode($_POST['last_name']));
	$first_name = addslashes(utf8_encode($_POST['first_name']));
	$telephone 	= addslashes(utf8_encode($_POST['telephone']));
	$fax 		= addslashes(utf8_encode($_POST['fax']));
	$email 		= addslashes(utf8_encode($_POST['email']));
	$pays 		= addslashes(utf8_encode($_POST['pays']));
	$ville 		= addslashes(utf8_encode($_POST['ville']));
	$localite 	= addslashes(utf8_encode($_POST['localite']));
	$adresse 	= addslashes(utf8_encode($_POST['adresse']));
	$zipcode 	= addslashes(utf8_encode($_POST['zipcode']));
	$iata 		= addslashes(utf8_encode($_POST['iata']));
	$rc 		= addslashes(utf8_encode($_POST['rc']));
	$if 		= addslashes(utf8_encode($_POST['if']));
	$licence 	= addslashes(utf8_encode($_POST['licence']));
	$username 	= addslashes(utf8_encode($_POST['username']));
	$password 	= addslashes(utf8_encode($_POST['password']));
	$langue 	= addslashes(utf8_encode($_POST['langue']));
	$devise 	= addslashes(utf8_encode($_POST['devise']));

	$verif		= md5($agn_name.date("Y-m-d H:i:s"));
	$created_on = date("Y-m-d H:i:s");
	$verified 	= 0;
	$etat 		= 0;

	$roles 		= "1,2,3,4,5,6";
	$role 		= "1,2,3,4,5";

	$INSERT		= $site->AgnAdd($agn_name,$pays,$ville,$localite,$adresse,$zipcode,$iata,$telephone,$fax,$email,$rc,$if,$licence,$last_name,$first_name,$username,$password,$langue,$devise,$verif,$verified,$etat,$created_on);
	$LAST 		= $site->SelectLastObjectTable("agence","pid","DESC");
	$PID 		= $LAST->pid;
	$INSERT		= $site->addWorker($last_name,$first_name,$telephone,$email,$username,$password,1,$roles,$role,$created_on,$PID);


	$FULLNAME	  = stripslashes(utf8_decode($first_name))." ".stripslashes(utf8_decode($last_name));
	$AGNNAME      = stripslashes(utf8_decode($agn_name));
	$OBJ		  = $site->SelectObjectTableWC("pays","alpha2",$pays,"alpha2","ASC");
	$PAYS         = stripslashes(utf8_decode($OBJ->nom));
	$IATA         = stripslashes(utf8_decode($iata));
	$DEVISE       = stripslashes(utf8_decode($devise));
	$ADRESSE      = stripslashes(utf8_decode($adresse));
	$OBJ		  = $site->SelectObjectTableWC("ville","id_ville",$ville,"id_ville","ASC");
	$VILLE        = stripslashes(utf8_decode($OBJ->nom_fra));
	$ZIPCODE      = stripslashes(utf8_decode($zipcode));
	$TELEPHONE    = stripslashes(utf8_decode($telephone));
	$FAX          = stripslashes(utf8_decode($fax));
	$EMAIL        = stripslashes(utf8_decode($email));
	$USERNAME     = stripslashes(utf8_decode($username));
	$PASSWORD     = stripslashes(utf8_decode($password));

	$DATUM 		  = DTODAY(date("Y-m-d"));
	$URLV		  = $WORKPATH.'verification.php?email='.$EMAIL.'&verif='.$verif.'';

	$to         = $EMAIL;
	$from       = "no-reply@emna-voyages.com";
	$from_name  = "Emna voyages";
	$subject    = "Inscription Verification";
	include_once("verification-email.php");
	$body       = $msg;
	smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = false);
	smtpmailer($from, $from, $from_name, $subject, $body, $is_gmail = false);

	echo "OK";

}

if($_POST["action"] == "update_time"){
	if(isset($_SESSION['AGENCE']) && isset($_SESSION['Worker'])){
		$workerpid = $_SESSION['Worker']->pid;
		$last_activity  = date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
		$isActivity 	= $site->countTableWC('online','workerpid',$workerpid);
		if($isActivity > 0){
			$UpdateOnlineActivity = $site->UpdateOnlineActivity($workerpid,$last_activity);
		}else{
			$PID = $_SESSION['AGENCE']->pid;
			$InsertOnlineActivity = $site->InsertOnlineActivity($workerpid,$PID,$last_activity);
			$userSIp = $_SERVER['REMOTE_ADDR'];
			$userIp  = getUserIP();
			$InsertOnlineActivityIp = $site->InsertOnlineActivityIp($workerpid,$PID,$last_activity,$userIp,$userSIp);
		}
	}
}

if( isset($_POST['action']) && ($_POST['action'] == "agn_login") ){
	
	$_SESSION['SE_START'] = time();
	$_SESSION['SE_END'] = $_SESSION['SE_START'] + (5 * 60) ; 
	$_SESSION['agnMarkup'] = 0;

	$agn_email 	  = addslashes(utf8_encode($_POST['agn_email']));
	$agn_username = addslashes(utf8_encode($_POST['agn_username']));
	$agn_password = addslashes(utf8_encode($_POST['agn_password']));

	$updated_on = date("Y-m-d H:i:s");

	$table = "agence";
	$champ = "email";
	$value = $agn_email;
	$isAGN = $site->countTableWC($table,$champ,$value);
	if ($isAGN > 0) {
		$AGN 	= $site->SelectObjectTableWC($table,$champ,$value,"pid","ASC");
		$ETAT 	= $AGN->etat;
		if ($ETAT == 0) {
			$MSG = "NAA";
		}else{
			$_SESSION['AGENCE'] = $AGN;
			$PID = $AGN->pid;
			$AGN_USERNAME 	= $AGN->login;
			$AGN_PASSWORD 	= $AGN->password;

			if($agn_username == $AGN_USERNAME && $agn_password == $AGN_PASSWORD){
				$_SESSION['isSuperAdmin'] = true;

				$table 		= "workers";
				$condition 	= "agence";
				$value 		= $PID;
				$condition2 = "login";
				$value2 	= $AGN_USERNAME;
				$condition3 = "password";
				$value3 	= $AGN_PASSWORD;
				$ord 		= "pid";
				$dir 		= "ASC";

				$Worker 	= $site->SelectObjectTableW3C($table,$condition,$value,$condition2,$value2,$condition3,$value3,$ord,$dir);
				$table 				= "workers";
				$champ 				= "last_login";
				$last_login 		= date("Y-m-d H:i:s");
				$pid 				= $AGN->pid;
				$LAST 				= $site->lastLogin($table,$champ,$last_login,$pid);
				$_SESSION['Worker'] = $Worker;

				
				$workerpid 		= $Worker->pid;
				$count 			= $site->countTableWC('online','workerpid',$workerpid);
				$last_activity  = date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
				if($count == 0){
					$InsertOnlineActivity = $site->InsertOnlineActivity($workerpid,$PID,$last_activity);
				}
				
				$userSIp = $_SERVER['REMOTE_ADDR'];
				$userIp  = getUserIP();
				$InsertOnlineActivityIp = $site->InsertOnlineActivityIp($workerpid,$PID,$last_activity,$userIp,$userSIp);
				$MSG = "IOK";
			}else{
				$_SESSION['isSuperAdmin'] = false;

				$table 		= "workers";
				$condition 	= "agence";
				$value 		= $PID;
				$condition2 = "login";
				$value2 	= $agn_username;
				$condition3 = "password";
				$value3 	= $agn_password;
				$ord 		= "pid";
				$dir 		= "ASC";
				$isWorker 	= $site->countTableW3C($table,$condition,$value,$condition2,$value2,$condition3,$value3);

				if ($isWorker > 0) {

					$Worker = $site->SelectObjectTableW3C($table,$condition,$value,$condition2,$value2,$condition3,$value3,$ord,$dir);
					$ETAT 	= $Worker->etat;
					if ($ETAT == 0) {
						$MSG = "WAA";
					}else{
						$_SESSION['Worker'] = $Worker;
						$table 				= "workers";
						$champ 				= "last_login";
						$last_login 		= date("Y-m-d H:i:s");
						$pid 				= $Worker->pid;
						$LAST 				= $site->lastLogin($table,$champ,$last_login,$pid);

						$workerpid 		= $Worker->pid;
						$count 			= $site->countTableWC('online','workerpid',$workerpid);
						$last_activity  = date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
						if($count == 0){
							$InsertOnlineActivity = $site->InsertOnlineActivity($workerpid,$PID,$last_activity);
						}
						
						$userSIp = $_SERVER['REMOTE_ADDR'];
						$userIp  = getUserIP();
						$InsertOnlineActivityIp = $site->InsertOnlineActivityIp($workerpid,$PID,$last_activity,$userIp,$userSIp);
						$MSG = "IOK";
					}
					
				}else{
					$MSG = "NLM";
				}

			}
		}
	}else{
		$MSG = "NAE";
	}

	echo $MSG;

}


if( isset($_POST['action']) && ($_POST['action'] == "update_a_profil") ){
	
	$agn_nom 		= addslashes(utf8_encode($_POST['agn_nom']));
	$agn_prenom 	= addslashes(utf8_encode($_POST['agn_prenom']));
	$agn_email_client = addslashes(utf8_encode($_POST['agn_email_client']));
	$agn_telephone 	= addslashes(utf8_encode($_POST['agn_telephone']));
	$username 		= addslashes(utf8_encode($_POST['username']));
	$password 		= addslashes(utf8_encode($_POST['password']));
	$percent 		= addslashes(utf8_encode($_POST['percent']));

	$AGN        	= $_SESSION['AGENCE'];
	$PID 			= $AGN->pid;


	$UPDATE		= $site->aProfilEdit($agn_nom,$agn_prenom,$agn_email_client,$agn_telephone,$username,$password,$percent,$PID);

	$AGN 		= $site->SelectObjectTableWC("agence","pid",$PID,"pid","ASC");
	$_SESSION['AGENCE'] = $AGN;

	if($_SESSION['isSuperAdmin'] == true){
		$Workers        	= $_SESSION['Worker'];
		$PIDW 			= $Workers->pid;
		$UPDATE		= $site->wProfilEdit($agn_nom,$agn_prenom,$agn_email_client,$agn_telephone,$username,$password,$PIDW);

		$Worker 		= $site->SelectObjectTableWC("workers","pid",$PIDW,"pid","ASC");
		$_SESSION['Worker'] = $Worker;
	}

	echo "OOK";

}

if( isset($_POST['action']) && ($_POST['action'] == "update_w_profil") ){
	
	$agn_nom 		= addslashes(utf8_encode($_POST['agn_nom']));
	$agn_prenom 	= addslashes(utf8_encode($_POST['agn_prenom']));
	$agn_email_client = addslashes(utf8_encode($_POST['agn_email_client']));
	$agn_telephone 	= addslashes(utf8_encode($_POST['agn_telephone']));
	$username 		= addslashes(utf8_encode($_POST['username']));
	$password 		= addslashes(utf8_encode($_POST['password']));

	$Worker        	= $_SESSION['Worker'];
	$PID 			= $Worker->pid;

	$UPDATE		= $site->wProfilEdit($agn_nom,$agn_prenom,$agn_email_client,$agn_telephone,$username,$password,$PID);

	$Worker 		= $site->SelectObjectTableWC("workers","pid",$PID,"pid","ASC");
	$_SESSION['Worker'] = $Worker;

	echo "OOK";

}

if( isset($_POST['action']) && ($_POST['action'] == "update_agence") ){
	
	$agence_nom 		 = addslashes(utf8_encode($_POST['agence_nom']));
	$agence_email 		 = addslashes(utf8_encode($_POST['agence_email']));
    $pays                = addslashes(utf8_encode($_POST['pays']));
    $ville               = addslashes(utf8_encode($_POST['ville']));
    $agence_zip          = addslashes(utf8_encode($_POST['agence_zip']));
    $agence_iata         = addslashes(utf8_encode($_POST['agence_iata']));
    $agence_adresse      = addslashes(utf8_encode($_POST['agence_adresse']));
    $agence_licence      = addslashes(utf8_encode($_POST['agence_licence']));
    $agence_fiscal       = addslashes(utf8_encode($_POST['agence_fiscal']));
    $agence_registre     = addslashes(utf8_encode($_POST['agence_registre']));
    $user_nom            = addslashes(utf8_encode($_POST['user_nom']));
    $user_prenom         = addslashes(utf8_encode($_POST['user_prenom']));
    $user_phone          = addslashes(utf8_encode($_POST['user_phone']));
    $user_fax            = addslashes(utf8_encode($_POST['user_fax']));

	$AGN        	= $_SESSION['AGENCE'];
	$PID 			= $AGN->pid;

	$UPDATE		= $site->editAgence($agence_nom,$agence_email,$pays,$ville,$agence_zip,$agence_iata,$agence_adresse,$agence_licence,$agence_fiscal,$agence_registre,$user_nom,$user_prenom,$user_phone,$user_fax,$PID);

	$AGN 		= $site->SelectObjectTableWC("agence","pid",$PID,"pid","ASC");
	$_SESSION['AGENCE'] = $AGN;

	echo "OOK";

}

if( isset($_POST['action']) && ($_POST['action'] == "worker_activ") ){
	
	$pid 	 = addslashes(utf8_encode($_POST['p']));
	$etat 	 = addslashes(utf8_encode($_POST['e']));

	$E 		 = 0;
	if ($etat == 0) {
		$E = 1;
	}

	$AGN   	 = $_SESSION['AGENCE'];
	$PID 	 = $AGN->pid;

	$UPDATE		= $site->editWorkerEtat($E,$pid,$PID);

	echo "OOK,".$E;

}

if( isset($_POST['action']) && ($_POST['action'] == "worker_save") ){

	$pid 	 			= addslashes(utf8_encode($_POST['p']));
	$worker_tel 		= addslashes(utf8_encode($_POST['worker_tel']));
	$worker_email 		= addslashes(utf8_encode($_POST['worker_email']));
    $worker_password 	= addslashes(utf8_encode($_POST['worker_password']));

    $roles_h            = addslashes(utf8_encode($_POST['roles_h']));
    $roles_t            = addslashes(utf8_encode($_POST['roles_t']));
    $roles_vo           = addslashes(utf8_encode($_POST['roles_vo']));
    $roles_vi      		= addslashes(utf8_encode($_POST['roles_vi']));
    $roles_l      		= addslashes(utf8_encode($_POST['roles_l']));
    $roles_a       		= addslashes(utf8_encode($_POST['roles_a']));
    
    $role_p     		= addslashes(utf8_encode($_POST['role_p']));
    $role_b             = addslashes(utf8_encode($_POST['role_b']));
    $role_u         	= addslashes(utf8_encode($_POST['role_u']));
    $role_d          	= addslashes(utf8_encode($_POST['role_d']));
    $role_e            	= addslashes(utf8_encode($_POST['role_e']));

    $roles 				= $roles_h . "," . $roles_t . "," . $roles_vo . "," . $roles_vi . "," . $roles_l . "," . $roles_a;
    $role 				= $role_p . "," . $role_b . "," . $role_u . "," . $role_d . "," . $role_e;


	$UPDATE		= $site->editWorker($worker_tel,$worker_email,$worker_password,$roles,$role,$pid);

	echo "OOK";

}


if( isset($_POST['action']) && ($_POST['action'] == "worker_add") ){

	$worker_nom			= addslashes(utf8_encode($_POST['worker_nom']));
	$worker_prenom		= addslashes(utf8_encode($_POST['worker_prenom']));
	$worker_phone 		= addslashes(utf8_encode($_POST['worker_phone']));
	$worker_email 		= addslashes(utf8_encode($_POST['worker_email']));
	$worker_login		= addslashes(utf8_encode($_POST['worker_login']));
    $worker_password 	= addslashes(utf8_encode($_POST['worker_password']));
    $worker_etat		= addslashes(utf8_encode($_POST['worker_etat']));

    $roles_h            = addslashes(utf8_encode($_POST['roles_h']));
    $roles_t            = addslashes(utf8_encode($_POST['roles_t']));
    $roles_vo           = addslashes(utf8_encode($_POST['roles_vo']));
    $roles_vi      		= addslashes(utf8_encode($_POST['roles_vi']));
    $roles_l      		= addslashes(utf8_encode($_POST['roles_l']));
    $roles_a       		= addslashes(utf8_encode($_POST['roles_a']));
    
    $role_p     		= addslashes(utf8_encode($_POST['role_p']));
    $role_b             = addslashes(utf8_encode($_POST['role_b']));
    $role_u         	= addslashes(utf8_encode($_POST['role_u']));
    $role_d          	= addslashes(utf8_encode($_POST['role_d']));
    $role_e            	= addslashes(utf8_encode($_POST['role_e']));

    $roles 				= $roles_h . "," . $roles_t . "," . $roles_vo . "," . $roles_vi . "," . $roles_l . "," . $roles_a;
    $role 				= $role_p . "," . $role_b . "," . $role_u . "," . $role_d . "," . $role_e;

	$AGN        		= $_SESSION['AGENCE'];
	$PID 				= $AGN->pid;
	$created_on 		= date("Y-m-d H:i:s");

	$INSERT		= $site->addWorker($worker_nom,$worker_prenom,$worker_phone,$worker_email,$worker_login,$worker_password,$worker_etat,$roles,$role,$created_on,$PID);

	echo "OOK";

}

if( isset($_POST['action']) && ($_POST['action'] == "worker_remove") ){
	
	$pid 	 = addslashes(utf8_encode($_POST['p']));

	$DELETE		= $site->DelFrom("workers","pid",$pid);

	echo "OOK";

}

if( isset($_POST["action"]) && ($_POST["action"] =="ResaBookingUpdate") ){
	$idbook = $_POST["idbook"];
	$dateConf = date("Y-m-d h:i:s");
	$result = $site->ResaBookingUpdate($idbook,$dateConf);

	$Prenom = $_SESSION['Prenom'];
	$Nom = $_SESSION['Nom'];
	$PRN = "";
	$NB = $site->countTableWC("booking_room","num_booking",$idbook);
	if ($NB == 0) {
		foreach ($Prenom as $key => $value) {
			$prenom = $value;
			$nom 	= $Nom[$key];
			$INSERT = $site->ResaBookingRooms($idbook,$nom,$prenom);
		}
	}
	
	echo "OOK";
}

if( isset($_POST["action"]) && ($_POST["action"] =="load_more") ){
	$MARKUP  = ( ( $_SESSION['AGENCE']->markup  ) / 100 ) + 1;
	$PERCENT = ( ( $_SESSION['AGENCE']->percent ) / 100 ) + 1;
	$MARPER  = $MARKUP * $PERCENT;

	$SearchUniqueId = $_SESSION['SearchUniqueId'];
	$alpha = $_POST["alpha"];

	$limit = explode(',', $alpha);

	$LIMIT_START = $limit[0];
	$LIMIT = $limit[1];

	$LIMIT_START += 5;
	$_SESSION['LIMIT'] 		 = $LIMIT;

	$HotelList = $_SESSION['HotelList'];
	$HotelLIST = GetElements($HotelList,$LIMIT_START,$LIMIT) ;

	$RES = "";
	$HOTEL = $LIMIT_START;

	foreach($HotelLIST as $key => $H){
        $HotelId        = $H['HotelId'];
        $HotelName      = $H['HotelName'];
        $PropertyRating = $H['PropertyRating'];
        if($PropertyRating == "1.0"){
            $Percent = "20%";
        }elseif($PropertyRating == "2.0"){
            $Percent = "40%";
        }elseif($PropertyRating == "3.0"){
            $Percent = "60%";
        }elseif($PropertyRating == "4.0"){
            $Percent = "80%";
        }elseif($PropertyRating == "5.0"){
            $Percent = "100%";
        }
        $Location       	= $H['Location'];
        $ThumbNailUrl   	= $H['ThumbNailUrl'];
        $TotalCharges   	= $H['TotalCharges'];
        $RateCurrencyCode 	= $H['RateCurrencyCode'];

        $HotelDescription   = $H['ShortDescription'];
        $HotelDescription   = substr($HotelDescription,0,150);
        $Point = strrpos($HotelDescription, ".");
        $Length= strlen($HotelDescription);
        if($Point > 0){
            $HotelDescription = substr($HotelDescription, 0,($Point + 1));
        }else{
            $Point = strrpos($HotelDescription, " ");
            $HotelDescription = substr($HotelDescription, 0,($Point + 1));
            $HotelDescription.= ".";
        }
        $HotelAddress       = $H['Location'];

	    $RES .= '<article class="box">
	        <figure class="col-sm-5 col-md-4">
	            <a title="" href="'.$WORKPATH.'hotel/details/'.$HOTEL.'/"><img style="width:270px;height:160px;" alt="" src="'.$ThumbNailUrl.'"></a>
	        </figure>
	        <div class="details col-sm-7 col-md-8">
	            <div>
	                <div>
	                    <h4 class="box-title">'.$HotelName.' <small><i class="soap-icon-departure yellow-color"></i> '.$HotelAddress.', '.$Location.'</small></h4>
	                    <div class="amenities">
	                        <i class="soap-icon-wifi circle"></i>
	                        <i class="soap-icon-fitnessfacility circle"></i>
	                        <i class="soap-icon-fork circle"></i>
	                        <i class="soap-icon-television circle"></i>
	                    </div>
	                </div>
	                <div>
	                    <div class="five-stars-container">
	                        <span class="five-stars" style="width: '.$Percent.';"></span>
	                    </div>
	                </div>
	            </div>
	            <div>
	                <p>'.$HotelDescription.'</p>
	                <div>
	                    <span class="price"><small>À partir de</small>'.number_format( ($TotalCharges * $MARPER),3,"."," " ).' '.$RateCurrencyCode.'</span>
	                    <a class="button btn-small full-width text-center" title="" href="'.$WORKPATH.'hotel/details/'.$HOTEL.'/">CHOISIR</a>
	                </div>
	            </div>
	        </div>
	    </article>';
	    $HOTEL += 1;
    }

	echo $RES;
}

if( isset($_POST['action']) && ($_POST['action'] == "BookingCancel") ){
	
	$Id 	 = addslashes(utf8_encode($_POST['p']));

	$CancellationBooking 			= CancellationBookingRequest($Id);
	$CancellationBookingResponse  	= json_decode($CancellationBooking, true);

	if($CancellationBookingResponse['Message'] == 'success'){
		$UPDATE = $site->BookingUpdateStatus($Id);
		
		$BOOKING= $site->SelectObjectTableWC('booking','id',$Id,'id','ASC');
		$GROSS 	= $BOOKING->grossamount;
		$PID 	= $_SESSION['AGENCE']->pid;
		$CREDIT = $_SESSION['AGENCE']->credit;
		$CREDIT+= $GROSS;
		$UPDATE = $site->updateAgenceCredit($PID,$CREDIT);

		$_SESSION['AGENCE'] = $site->SelectObjectTableWC("agence","pid",$PID,"pid","ASC");

		echo "OK";
	}else{
		echo "NO";
	}

}

if( isset($_POST['action']) && ($_POST['action'] == "booking_filter") ){
	$_SESSION['BookingFilter'] = true;
	$_SESSION['BookingServiceType'] = "";
	$_SESSION['CurrentStatus'] = "";
	$_SESSION['CheckInDate'] = "";
	$_SESSION['CheckOutDate'] = "";
	$_SESSION['SelectedFilter'] = "";
	$_SESSION['SelectedValue'] = "";

	$Filter = "";
    if($_POST['BookingServiceType'] != ""){
        $BookingServiceType = $_POST['BookingServiceType'];
        $_SESSION['BookingServiceType'] = $BookingServiceType;
        $Filter .= " AND (`bookingservicetype`like'%".$BookingServiceType."%') ";
    }
    if($_POST['CheckInDate'] != ""){
        $CheckInDate = dat($_POST['CheckInDate']);
        $_SESSION['CheckInDate'] = $CheckInDate;
        $Filter .= " AND (`checkindate`='".$CheckInDate."') ";
    }
    if($_POST['CheckOutDate'] != ""){
        $CheckOutDate = dat($_POST['CheckOutDate']);
        $_SESSION['CheckOutDate'] = $CheckOutDate;
        $Filter .= " AND (`checkoutdate`='".$CheckOutDate."') ";
    }

    if($_POST['SelectedValue'] != ""){
        $SelectedValue = $_POST['SelectedValue'];
        $_SESSION['SelectedFilter'] = "BookingReference";
        $_SESSION['SelectedValue'] 	= $SelectedValue;
        $Filter .= " AND (`bookingreference`='".$SelectedValue."') ";
    }
    $_SESSION['Filter'] = $Filter;
    header("location:".$WORKPATH."agn/#reservations");
}

if( isset($_POST['action']) && ($_POST['action'] == "cancellation_policy") ){
	
	$CP = "";
	
	$HotelId 			= $_POST['HotelId'];
	$SearchUniqueId 	= $_POST['SearchUniqueId'];
	$SectionUniqueId 	= $_POST['SectionUniqueId'];

	$request 	= hotelCancellationPolicy($HotelId,$SearchUniqueId,$SectionUniqueId);
	$result 	= json_decode($request, true);

	if($result['ContractComment'] != ""){
		$CP .= $result['ContractComment']."<br>";
	}
	$CP .= 'Cancellation Charges of '.$result['AppliedAgentCharges'].' '.$result['CancellationCurrency'].' will be applicable if canceled after ';
	$DaysBefore = round($result['CancellationHours']/24);

	$date   = $_SESSION['checkInDate'];
	$X = XXXX($date);
	$newdate = strtotime ( '-'.$DaysBefore.' day' , strtotime ( $X ) ) ;
	$newdate = date ( 'Y-m-j' , $newdate );
	$newdate = datI($newdate);
	$CP .= '<b>'.$newdate.'</b> 08:00 hrs.';
	$_SESSION['CP'] = $CP;
	echo $CP;

}

if( isset($_POST['action']) && ($_POST['action'] == "cancellation_charges") ){
	
	$Id 		= $_POST['HotelId'];

	$request 	= CancellationFeeRequest($Id);
	$CancellationFeeResponse 	= json_decode($request, true);
	$RES = '';
	if($CancellationFeeResponse['AllowCancel'] == 'yes'){
		$RES.= '<strong class="dark-blue-color">'.$CancellationFeeResponse['MessageInfo'].'</strong>';
		$RES.= '<br/>';
		$RES.= '<strong class="dark-blue-color">Cancellation Charges : '.$CancellationFeeResponse['CancellationCharge'].' '.$CancellationFeeResponse['DisplayCurrencyCode'].'</strong>';
	}else{
		$RES.= '<strong class="dark-blue-color">'.$CancellationFeeResponse['MessageInfo'].'</strong>';
	}
	

	echo $RES;

}

if( isset($_POST['action']) && ($_POST['action'] == "cityChange") ){
	
	$selCountry = $_POST['selCountry'];

	$CityRequest= CityRequest($selCountry);
	$CityResult	= json_decode($CityRequest, true);
	$StartTime  = array_shift($CityResult);
    $EndTime    = array_shift($CityResult);
    $CityInfo 	= $CityResult['CityInfo'];

	$RES = '<option value="">Ville</option>';

	foreach ($CityInfo as $key => $value) {
		$RES .= '<option value="'.$value['CityCode'].'">'.$value['Name'].'</option>';
	}

	echo $RES;

}

if( isset($_POST['action']) && ($_POST['action'] == "cityChangeHB") ){
	XSIGNATURE($ApiKey, $Secret);
	$selCountry = $_POST['selCountryHB'];

	$CityRequest= CityRequestHB($selCountry);
	
	$CityResult	= $CityRequest['destinations']['destination'];
	$CityNB 	= $CityRequest['total'];
	$RES = '<option value="">Ville</option>';
	if($CityNB > 1){
		foreach ($CityResult as $key => $value) {
			$Code = $value['@attributes']['code'];
			$Name = $value['name'];
			if($Name != ''){
				$RES .= '<option value="'.$Code.'">'.$Name.'</option>';
			}
		}
	}elseif($CityNB == 1){
		$Code = $CityResult['@attributes']['code'];
		$Name = $CityResult['name'];
		if($Name != ''){
			$RES .= '<option value="'.$Code.'">'.$Name.'</option>';
		}
	}

	echo $RES;
}

if( isset($_POST['action']) && ($_POST['action'] == "cityHbChange") ){
	
	$selHbCountry = $_POST['selHbCountry'];
	XSIGNATUREActivity($ApiKeyActivity, $SecretActivity);
	$CityRequest= HBCityRequest($selHbCountry);
	$CityResult	= json_decode($CityRequest, true);
    $CityInfo 	= $CityResult['country']['destinations'];

	$RES = '<option value="">Ville</option>';

	foreach ($CityInfo as $key => $value) {
		$RES .= '<option value="'.$value['code'].'">'.$value['name'].'</option>';
	}

	echo $RES;

}

if( isset($_POST['action']) && ($_POST['action'] == "AirportCity") ){
	
	if(!isset($_SESSION['FlightAirportsRS'])){
		$_SESSION['FlightAirportsRS'] = FlightAirportRQ();
	}

	$xmlstr = $_SESSION['FlightAirportsRS'];
	$xml	= new SimpleXMLElement($xmlstr);
	$json 	= json_encode($xml);
	$array 	= json_decode($json,TRUE);

	$RES 	= '';

	$q 		= $_POST['q'];

	foreach ($xml->Destination as $key=>$quote) {
		$DestinationTitle 	= $quote->attributes()->Title;
		$DestinationCity 	= $quote->City;
		
		if ( stristr($DestinationTitle, $q) !== false ) {
			foreach ($DestinationCity as $key => $valueC) {
				$CityTitle 	= $valueC->attributes()->Title;
				$CityCode 	= $valueC->attributes()->Code;
					$CityAirport = $valueC->Airport;

					foreach ($CityAirport as $key => $valueA) {
						$AirportTitle 	= $valueA->attributes()->Title;
						$AirportCode 	= $valueA->attributes()->Code;
						$AirportLong 	= $valueA->attributes()->Longitude;
						$AirportLan 	= $valueA->attributes()->Latitude;

						if($CityCode == ""){
							$CityCodE = '';
						}else{
							$CityCodE = $CityCode;
						}
						$Value 			= $DestinationTitle . "," . $CityTitle . ',' . $CityCodE . ',' . $AirportTitle.','.$AirportCode;
						$RES .= '<option value="'.$Value.'">';
						$RES .= $DestinationTitle . " - " . $CityTitle;
						if($CityCode != ""){
							$RES .= ' - (' . $CityCode . ') ';
						}
						$RES .=  ' - ' . $AirportTitle.' : ('.$AirportCode.')';
						$RES .= "</option>";
					}
			}
		}else{
			
			foreach ($DestinationCity as $key => $valueC) {

				foreach ($DestinationCity as $key => $valueC) {
					$CityTitle 	= $valueC->attributes()->Title;
					$CityCode 	= $valueC->attributes()->Code;
					if( stristr($CityTitle, $q) !== false || stristr($CityCode, $q) !== false ){
						$CityAirport = $valueC->Airport;

						foreach ($CityAirport as $key => $valueA) {
							$AirportTitle 	= $valueA->attributes()->Title;
							$AirportCode 	= $valueA->attributes()->Code;
							$AirportLong 	= $valueA->attributes()->Longitude;
							$AirportLan 	= $valueA->attributes()->Latitude;
							if($CityCode == ""){
								$CityCodE = '';
							}else{
								$CityCodE = $CityCode;
							}
							$Value 			= $DestinationTitle . "," . $CityTitle . ',' . $CityCodE . ',' . $AirportTitle.','.$AirportCode;
							$RES .= '<option value="'.$Value.'">';
							$RES .= $DestinationTitle . " - " . $CityTitle;
							if($CityCode != ""){
								$RES .= ' - (' . $CityCode . ') ';
							}
							$RES .=  ' - ' . $AirportTitle.' : ('.$AirportCode.')';
							$RES .= "</option>";
						}
					}else{
						$CityAirport = $valueC->Airport;

						foreach ($CityAirport as $key => $valueA) {
							$AirportTitle 	= $valueA->attributes()->Title;
							$AirportCode 	= $valueA->attributes()->Code;
							$AirportLong 	= $valueA->attributes()->Longitude;
							$AirportLan 	= $valueA->attributes()->Latitude;
							if( stristr($AirportTitle, $q) !== false || stristr($AirportCode, $q) !== false ){
								if($CityCode == ""){
									$CityCodE = '';
								}else{
									$CityCodE = $CityCode;
								}
								$Value 			= $DestinationTitle . "," . $CityTitle . ',' . $CityCodE . ',' . $AirportTitle.','.$AirportCode;
								$RES .= '<option value="'.$Value.'">';
								$RES .= $DestinationTitle . " - " . $CityTitle;
								if($CityCode != ""){
									$RES .= ' - (' . $CityCode . ') ';
								}
								$RES .=  ' - ' . $AirportTitle.' : ('.$AirportCode.')';
								$RES .= "</option>";
							}
						}
					}
				}
			}
		}
	}

	echo $RES;

}

if( isset($_POST['action']) && ($_POST['action'] == "HotelLogin") ){
	$HotelEmail      = addslashes(utf8_encode($_POST['HotelEmail']));
    $HotelPassword   = addslashes(utf8_encode($_POST['HotelPassword']));

    $table 		= "hotels";
    $condition 	= "HotelEmail";
    $value 		= $HotelEmail;
    $condition2 = "HotelPassword";
    $value2 	= $HotelPassword;
    $isHotel = $site->countTableW2C($table,$condition,$value,$condition2,$value2);

    if($isHotel > 0){
    	$HotelLogin = $site->SelectObjectTableW2C($table,$condition,$value,$condition2,$value2,"pid","asc");
    	$_SESSION['HotelLogin'] = $HotelLogin;

    	$table 		= "hotels";
		$champ 		= "HotelLastLogin";
		$last_login = date("Y-m-d H:i:s");
		$pid 		= $HotelLogin->pid;
		$LAST 		= $site->lastLogin($table,$champ,$last_login,$pid);

    	echo "OK";
    }else{
    	echo "NO";
    }

}

if( isset($_POST['action']) && ($_POST['action'] == "HotelImageRemove") ){
	
	$pid	= addslashes(utf8_encode($_POST['pid']));
	$isBook		= $site->countTableWC("hotelimages","pid",$pid);
	if($isBook > 0){
		$DELETE = $site->DelFrom("hotelimages","pid",$pid);
	}
	echo "OK";

}

if( isset($_POST['HotelAction']) && ($_POST['HotelAction'] == "HotelRegister") ){
	
    $HotelName       = addslashes(utf8_encode($_POST['HotelName']));
    $HotelPays       = addslashes(utf8_encode($_POST['HotelPays']));
    $HotelVille      = addslashes(utf8_encode($_POST['HotelVille']));
    $HotelAddress    = addslashes(utf8_encode($_POST['HotelAddress']));
    $HotelLocation   = addslashes(utf8_encode($_POST['HotelLocation']));
    $HotelZipCode    = addslashes(utf8_encode($_POST['HotelZipCode']));
    $HotelDevise     = addslashes(utf8_encode($_POST['HotelDevise']));
    $HotelPhone      = addslashes(utf8_encode($_POST['HotelPhone']));
    $HotelFax        = addslashes(utf8_encode($_POST['HotelFax']));
    $HotelContactLastName  = addslashes(utf8_encode($_POST['HotelContactLastName']));
    $HotelContactFirstName = addslashes(utf8_encode($_POST['HotelContactFirstName']));
    $HotelEmail      = addslashes(utf8_encode($_POST['HotelEmail']));
    $HotelPassword   = addslashes(utf8_encode($_POST['HotelPassword']));
    $HotelLanguage   = addslashes(utf8_encode($_POST['HotelLanguage']));
    $HotelWebsite    = addslashes(utf8_encode($_POST['HotelWebsite']));

	$HotelVerification = md5($HotelName.date("Y-m-d H:i:s"));
	$HotelCreatedOn	 = date("Y-m-d H:i:s");
	$HotelVerif		 = 0;
	$HotelStatus	 = 0;

	$FULLNAME 	= stripslashes(utf8_decode($HotelContactLastName))." ".stripslashes(utf8_decode($HotelContactFirstName));
	$HOTELNAME 	= stripslashes(utf8_decode($HotelName));
	$PAYS       = stripslashes(utf8_decode($HotelPays));
	$ADRESSE    = stripslashes(utf8_decode($HotelAddress));
	$VILLE      = stripslashes(utf8_decode($HotelVille));
	$LOCATION   = stripslashes(utf8_decode($HotelLocation));
	$ZIPCODE    = stripslashes(utf8_decode($HotelZipCode));
	$TELEPHONE  = stripslashes(utf8_decode($HotelPhone));
	$FAX        = stripslashes(utf8_decode($HotelFax));
	$EMAIL      = stripslashes(utf8_decode($HotelEmail));
	$PASSWORD   = stripslashes(utf8_decode($HotelPassword));
	$DEVISE     = stripslashes(utf8_decode($HotelDevise));
	$LANGUAGE   = stripslashes(utf8_decode($HotelLanguage));
	$WEBSITE    = stripslashes(utf8_decode($HotelWebsite));

	$DATUM 		= DTODAY(date("Y-m-d"));
	$URLV		= $WORKPATH.'hotel-verification.php?email='.$EMAIL.'&verif='.$HotelVerification.'';

	$to         = "oussama.dev@dmcbooking.com";
	$from       = "no-reply@emna-voyages.com";
	$from_name  = "Emna voyages";
	$subject    = "Hotel Inscription Verification";
	include_once("hotel-verification-email.php");
	$body       = $msg;
	smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = false);

	echo "OK";

}

if( isset($_POST['action']) && ($_POST['action'] == "BookTour") ){
	$_SESSION['Toutto'] = $_POST['Toutto'];
	echo "OK";
}

if( isset($_POST['action']) && ($_POST['action'] == "mkpChange") ){
	$_SESSION['agnMarkup'] = $_POST['mkp'];
	echo "OOK";
}

if( isset($_POST['action']) && ($_POST['action'] == "BagagePrice") ){
	$P 	= $_POST['P'];
	$BN 	= $_POST['BN'];
	$BW 	= $_POST['BW'];

	$FlightDetail = $_SESSION['FlightDetailRQ'];
	$BaggageRestriction = $FlightDetail['BaggageRestriction'];
	$Fees 	=	$BaggageRestriction['Fees'];
	$Fee 	=	$Fees['Fee'];

	$BagagePrice = "";

	foreach ($Fee as $key => $value) {
		if( ($value['Quantity'] == $BN) && ($value['Weight'] == $BW) ){
			$BagagePrice = $value['Amount'] . ' ' . $value['Currency'];

			$_SESSION['BagagePrice'][$P] = array('Price'=>$BagagePrice, 'Number'=>$BN, 'Weight'=>$BW);
		}
	}

	echo $BagagePrice;
}
?>