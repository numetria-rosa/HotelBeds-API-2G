<?php
function searchForId($value, $CAR) {
   foreach ($CAR as $key => $val) {
       if ($val[0] === $value) {
           return $key;
       }
   }
   return null;
}

function isDateBetweenDates(DateTime $date, DateTime $startDate, DateTime $endDate) {
    return $date > $startDate && $date < $endDate;
}

function urlTR($str)
{
	if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
	$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
	$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace(array('`[^a-z]`i','`[-]+`'), '', $str);
	$str = strtolower( trim($str, '-') );
	return $str;
}

date_default_timezone_set("Africa/Tunis");
setlocale(LC_TIME, "fr_FR");

function newPassengerType($paxReferenceType){
  switch ($paxReferenceType) {
    case 'ADT': $Kind = 'Adulte'; break;
    case 'CHD' : $Kind = 'Enfant'; break;
    case 'INF': $Kind = 'Bébé';   break;
    case 'IN' : $Kind = 'Bébé';   break;
    
    default   : $Kind = 'Adulte'; break;
  }
  return $Kind;
}

function CPDATUM($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	
	$format = 'Ymd';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	
	$TTT 		= $Tjour . '/' . $Tmois . '/' . $Tyear ;
	
	return $TTT;
}

function DATUMLLFR($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc");
	
	$format = 'Y-m-d H:i:s';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tday . ' ' . $Tjour . ' ' . $Tmois  . ' ' . $Tyear  . ' &agrave; ' . $Thour  . 'h' . $Tminute. ':' . $Tseconde ;
	
	return $TTT;
}

function datumSTR($x){
	$j=substr($x,6,2);
	$m=substr($x,4,2);
	$y=substr($x,0,4);
	$x=$y."-".$m."-".$j;
	return $x;
}

function datumS($x){
	$x=substr($x,0,10);
	return $x;
}

function datumE($x){
	$x=substr($x,13,10);
	return $x;
}

function dat($x){
		
	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			
	$j=substr($x,0,2);
	$m=substr($x,3,2);
	$y=substr($x,6,4);
	$x=$y."".$m."".$j;
	return $x;
}

function datI($x){
		
	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			
	$j=substr($x,6,2);
	$m=substr($x,4,2);
	$y=substr($x,0,4);
	$x=$j."/".$m."/".$y;
	return $x;
}
function datII($x){
		
	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			
	$j=substr($x,8,2);
	$m=substr($x,5,2);
	$y=substr($x,0,4);
	$x=$j."/".$m."/".$y;
	return $x;
}

function Loc($val){
		
	$loc = strstr($val, ',', true);
	return $loc;
}

function DATUM($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	
	$format = 'Y-m-d H:i:s';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconds	= $date->format('i');		 //Seconds...
	
	$TTT 		= $Tday . ', ' . $Tjour . ' ' . $Tmois . ', ' . $Tyear ;
	
	return $TTT;
}

function DTODAY($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	
	$format = 'Y-m-d';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	//$Thour	= $date->format('H');		 //Heure...
	//$Tminute	= $date->format('m');		 //Minute...
	//$Tseconds	= $date->format('i');		 //Seconds...
	
	$TTT 		= $Tday . ', ' . $Tjour . ' ' . $Tmois . ', ' . $Tyear ;
	
	return $TTT;
}


function HH($val){
	
	$format = 'YmdHi';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	
	$TTT 		= $Thour  . 'h' . $Tminute ;
	
	return $TTT;
}

function DD($val){
	
	$format = 'Y-m-d H:i:s';

	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	
	$TTT 		= $Tjour . ' ' . $Tmois  . ' ' . $Tyear ;
	
	return $TTT;
}

function DATUML($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc");
	
	$format = 'Y-m-d H:i:s';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tday . ' ' . $Tjour . ' ' . $Tmois  . ' ' . $Tyear  . ' &agrave; ' . $Thour  . 'h' . $Tminute. ':' . $Tseconde ;
	
	return $TTT;
}

function DATUMR($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc");
	
	$format = 'YmdHis';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tday . ' ' . $Tjour . ' ' . $Tmois  . ' ' . $Tyear  . ' &agrave; ' . $Thour  . ':' . $Tminute. ':' . $Tseconde ;
	
	return $TTT;
}

function DATUMRESA($val){
	
	$MOIS		= array("","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc");
	
	$format = 'Y-m-d';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tjour . '-' . $Tmois  . '-' . $Tyear ;
	
	return $TTT;
}

function DATUMREPORT($val){
	
	$format = 'd/m/Y';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tyear . '-' . $Tmois  . '-' . $Tjour . ' 00:00:00' ;
	
	return $TTT;
}

function DATUMREPORTSTART($val){
	
	$format = 'd/m/Y';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tyear . '-' . $Tmois  . '-' . $Tjour . ' 00:00:00' ;
	
	return $TTT;
}


function DATUMREPORTEND($val){
	
	$format = 'd/m/Y';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tyear . '-' . $Tmois  . '-' . $Tjour . ' 23:59:59' ;
	
	return $TTT;
}

function DATUMREPORTLike($val){
	
	$format = 'd/m/Y';
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...
	
	$TTT 		= $Tyear . '-' . $Tmois  . '-' . $Tjour ;
	
	return $TTT;
}

function LASTCOO($val){
	
	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	
	$format = 'YmdHis';
	
	$val=str_replace('-','',$val);
	$val=str_replace(':','',$val);
	$val=str_replace(' ','',$val);
	
	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	
	if( ( $date->format('m') == date('m') ) && ( $Tjour == date('d') ) ){
		$TTT 		= 'Aujourd\'hui &agrave; ' . $Thour  . 'h' . $Tminute ;
	}elseif( ( $date->format('m') == date('m') ) && ( $Tjour == (date('d')-1) ) ){
		$TTT 		= 'Hier &agrave; ' . $Thour  . 'h' . $Tminute ;
	}else{
		$TTT 		= $Tday . ' ' . $Tjour . ' ' . $Tmois  . ' ' . $Tyear  . ' &agrave; ' . $Thour  . 'h' . $Tminute ;
	}
	
	return $TTT;
}

require 'vendor/autoload.php';

function smtpmailer($to, $from = "noreply@emna-voyages.com", $from_name = "Emna voyages", $subject, $body, $is_gmail = true) {
	global $error, $NOREPLY_SMTP, $NOREPLY_PORT, $NOREPLY_HOST, $NOREPLY_EMAIL, $NOREPLY_PASS;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true; 
	if ($is_gmail) {
		$mail->SMTPSecure = 'tls'; 
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;  
		$mail->Username = 'mailemnavoyages@gmail.com';  
		$mail->Password = 'EmnaEmv7694';   
	} else {
		$mail->SMTPSecure = $NOREPLY_SMTP; 
		$mail->Port = $NOREPLY_PORT;  
		$mail->Host = $NOREPLY_HOST;
		$mail->Username = $NOREPLY_EMAIL;  
		$mail->Password = $NOREPLY_PASS;
	}

	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->IsHTML(true);
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}

function save_image($inPath,$outPath){ //Download images from remote server
    $in=    fopen($inPath, "rb");
    $out=   fopen($outPath, "wb");
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

function getExt($str){
    $i = strrpos($str,".");
    if (!$i) { return ""; } 
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

function getExtension($str) 
{
    $i = strrpos($str,".");
    if (!$i) { return ""; } 
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "à l'instant";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "il y a une minute";
        }
        else{
            return "il y a $minutes minutes";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "il y a une heure";
        }else{
            return "il y a $hours heures";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "hier";
        }else{
            return "il y a $days jours";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "il y a une semaine";
        }else{
            return "il y a $weeks semaines";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "il y a un mois";
        }else{
            return "il y a $months mois";
        }
    }
    //Years
    else{
        if($years==1){
            return "il y a une année";
        }else{
            return "il y a $years années";
        }
    }
}





function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function id_unique($nb_char = 8){
	$id_unique = "";
	srand( (double)microtime()*rand(1000000,9999999) ); // Genere un nombre aléatoire
	$arrChar = array(); // Nouveau tableau contenant tous les caractères A-Za-z0-9
	for( $i=65; $i<90; $i++ ) {
		array_push( $arrChar, chr($i) ); // Ajoute A-Z au tableau
		array_push( $arrChar, strtolower( chr( $i ) ) ); // Ajouter a-z au tableau
	}
	for( $i=48; $i<57; $i++ ) {
		array_push( $arrChar, chr( $i ) ); // Ajoute 0-9 au tableau
	}
	for( $i=0; $i< $nb_char; $i++ ) {
		$id_unique .= $arrChar[rand( 0, count( $arrChar ) )]; // Ecrit un aléatoire
	}
	return $id_unique;
}

function permalink($str)
{
	if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
	$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
	$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
	$str = strtolower( trim($str, '-') );
	return $str;
}


function TachesGsa($tache,$usedTable){
	$Return = array();
	
	switch ($tache) {
	    case 'login'	: $Tache = 'Ouverture de Session '; break;
	    case 'insert'	: $Tache = 'Ajout '; break;
	    case 'update'	: $Tache = 'Modification '; break;
	    case 'delete'	: $Tache = 'Suppression '; break;
	    default 		: $Tache = '';
	}
	$Return['Tache'] = $Tache;

	switch ($usedTable) {
	    case 'agence'				: 	$Operation = 'Agences'; break;
	    case 'booking'				: 	$Operation = 'Réservations'; break;
	    case 'bookingroomdetails'	: 	$Operation = 'Modification'; break;
	    case 'deposit'				: 	$Operation = 'Déposits'; break;
	    case 'devises'				: 	$Operation = 'Devises'; break;
	    case 'hotelamenitie'		: 	$Operation = 'Activités'; break;
	    case 'hotelamenities'		: 	$Operation = 'Activités'; break;
	    case 'hotelcontract'		: 	$Operation = 'Contrats Directs'; break;
	    case 'hotelcontractmeal'	: 	$Operation = 'Contrats Directs - Arrangements'; break;
	    case 'hotelcontractperiod'	: 	$Operation = 'Contrats Directs - Périodes'; break;
	    case 'hotelcontractreduction': 	$Operation = 'Contrats Directs - Réductions'; break;
	    case 'hotelcontractsupp'	: 	$Operation = 'Contrats Directs - Suppléments'; break;
	    case 'hotelimages'			: 	$Operation = 'Hôtels - Images'; break;
	    case 'hotelroomsmeal'		: 	$Operation = 'Hôtels - Arrangements'; break;
	    case 'hotelroomssupp'		: 	$Operation = 'Hôtels - Suppléments'; break;
	    case 'hotelroomstype'		: 	$Operation = 'Hôtels - Chambres'; break;
	    case 'hotels'				: 	$Operation = 'Hôtels'; break;
	    case 'hotelsbank'			: 	$Operation = 'Hôtels - Banques'; break;
	    case 'hotelsstars'			: 	$Operation = 'Hôtels - Etoiles'; break;
	    case 'pays'					: 	$Operation = 'Pays'; break;
	    case 'superworkers'			: 	$Operation = 'Utilisateurs'; break;
	    case 'tours'				: 	$Operation = 'Tours'; break;
	    case 'toursimages'			: 	$Operation = 'Tours - Images'; break;
	    case 'toursoption'			: 	$Operation = 'Tours - Options'; break;
	    case 'ville'				: 	$Operation = 'Villes'; break;
	    case 'workers'				: 	$Operation = 'Utilisateurs'; break;
		case 'user'				    : 	$Operation = 'Utilisateurs'; break;
		case 'markup'				: 	$Operation = 'Markup'; break;
	    default 					: 	$Operation = '';
	}
	$Return['Operation'] = $Operation;

	return $Return;
}


function soldeXml()
{
    $request  = "http://web2.allintravel.com/ws/index.php?";
	$request .= "action=agent_credit_check";
	$request .= "&username=emna";
	$request .= "&password=voyages@321";
	$request .= '&gzip=yes';

	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Decompress
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip'); 
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$request);
	// Execute
	$result=curl_exec($ch);
	$result = gzdecode($result);
	// Closing
	curl_close($ch);

	return $result;

}










?>
