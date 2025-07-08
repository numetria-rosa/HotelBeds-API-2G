<?php
require 'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$msgLog = new Logger('RequestResponseLogs');
$msgLog->pushHandler(new StreamHandler('./LOGS/requestresponse.log', Logger::INFO));

function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if (is_array($v2)) {
                        foreach ($v2 as $k3 => $v3) {
                            if ($k3 == $on) {
                                $sortable_array[$k] = $v3;
                            }
                        }
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
function array_sort_grp($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
function array_sort_grp_desc($array, $on, $order=SORT_DESC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
function searchForId($value, $CAR) {
   foreach ($CAR as $key => $val) {
       if ($val[0] === $value) {
           return $key;
       }
   }
   return null;
}

function getUserIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
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

function array_diff_assoc_recursive($array1, $array2)
{
	foreach($array1 as $key => $value)
	{
		if(is_array($value))
		{
			if(!isset($array2[$key]))
			{
				$difference[$key] = $value;
			}
			elseif(!is_array($array2[$key]))
			{
				$difference[$key] = $value;
			}
			else
			{
				$new_diff = array_diff_assoc_recursive($value, $array2[$key]);
				if($new_diff != FALSE)
				{
					$difference[$key] = $new_diff;
				}
			}
		}
		elseif(!isset($array2[$key]) || $array2[$key] != $value)
		{
			$difference[$key] = $value;
		}
	}
	return !isset($difference) ? 0 : $difference;
}

function sortBy($field, &$array, $direction = 'asc')
{
    usort($array, create_function('$a, $b', '
        $a = $a["' . $field . '"];
        $b = $b["' . $field . '"];

        if ($a == $b) return 0;

        $direction = strtolower(trim($direction));

        return ($a ' . (strtolower(trim($direction)) == 'desc' ? '>' : '<') .' $b) ? -1 : 1;
    '));

    return true;
}

function markup($val){
	$Markup = 1 + ($val / 100);
	return $Markup;
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

function flightDatumConvert($val){
	$y 	= substr($val,6,4);
	$m 	= substr($val,3,2);
	$j 	= substr($val,0,2);
	$h 	= substr($val,11,2);
	$i 	= substr($val,14,2);

	$x 	= $y."-".$m."-".$j." ".$h.":".$i.":00";
	return $x;
}

function FlightDatum($val){

	$format = 'd/m/Y H:i';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $date->format('N');		 //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); 		 //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...

	$TTT 		= $Tyear . '-' . $Tmois . '-' . $Tjour . ' ' . $Thour  . ':' . $Tminute ;

	return $TTT;
}

function TrimHotelBedsDatum($val){
	$val = str_replace('T', ' ', $val);
    $posPlus    = strrpos($val, "+");
    $Length     = strlen($val);

    if($posPlus > 0){
        $val = substr($val, 0,($posPlus));
    }
	$val = substr($val,0,19);
    return $val;
}

function HotelBedsDefault($val){
	// 2018-03-10T23:59:00+08:00
	$format = 'Y-m-d H:i:s';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $date->format('N');		 //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); 		 //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...

	$TTT 		= $Tjour . '/' . $Tmois . '/' . $Tyear ;

	return $TTT;
}

function HotelBedsDatum($val){
	$format = 'Y-m-d H:i:s';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $date->format('N');		 //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); 		 //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...

	$TTT 		= $Tjour . '/' . $Tmois . '/' . $Tyear . ', ' . $Thour  . ':' . $Tminute ;

	return $TTT;
}

function datumSTR($x){
	$j=substr($x,6,2);
	$m=substr($x,4,2);
	$y=substr($x,0,4);
	$x=$y."-".$m."-".$j;
	return $x;
}
function datNN($x){

	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

	$j=substr($x,0,2);
	$m=substr($x,3,2);
	$y=substr($x,6,4);

	$x=$y.$m.$j;
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
	$x=$y."-".$m."-".$j;
	return $x;
}

function datHB($x){

	$j=substr($x,0,2);
	$m=substr($x,3,2);
	$y=substr($x,6,4);
	$x=$y."-".$m."-".$j;
	return $x;
}

function datI($x){

	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

	$j=substr($x,8,2);
	$m=substr($x,5,2);
	$y=substr($x,0,4);
	$x=$j."/".$m."/".$y;
	return $x;
}
function datAI($x){

	$j=substr($x,8,2);
	$m=substr($x,5,2);
	$y=substr($x,0,4);

	$hi=substr($x,11,5);
	$x='<b>'.$j."/".$m."/".$y.'</b> à <b>'.$hi.'</b>';
	return $x;
}

function datAID($x){
	$y=substr($x,0,4);
	return '/'.$y;
}

function FormatNumber($x){
	$x = number_format($x,3,'.',' ');
	return $x;
}

function FormatNumberCD($x){
	$x = number_format($x,3,'.','');
	return $x;
}

function Loc($val){

	$loc = strstr($val, ',', true);
	return $loc;
}

function HotelBedsAcDefault($val){
	$format = 'Y-m-d H:i:s';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $date->format('N');		 //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $date->format('m'); 		 //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...

	$TTT 		= $Tjour . '/' . $Tmois . '/' . $Tyear .' &agrave; ' . $Thour . ':' . $Tminute ;

	return $TTT;
}


function TrimHotelBedsDatumA($val){
	$val = str_replace('T', ' ', $val);
    $posPlus    = strrpos($val, ".");
    $Length     = strlen($val);

    if($posPlus > 0){
        $val = substr($val, 0,($posPlus));
    }

    return $val;
}

function TrimHotelBedsDatumAC($val){
	$val = str_replace('T', ' ', $val);
    $posPlus    = strrpos($val, "+");
    $Length     = strlen($val);

    if($posPlus > 0){
        $val = substr($val, 0,($posPlus));
    }

    $posPlus    = strrpos($val, ".");
    $Length     = strlen($val);
    if($posPlus > 0){
        $val = substr($val, 0,($posPlus));
    }

    return $val;
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

	$TTT 		= $Tjour . ' ' . $Tmois . ' ' . $Tyear . '</strong> &agrave; <strong class="blue-color">' . $Thour  . ':' . $Tminute  . ':' . $Tseconds ;

	return $TTT;
}

function newDATUM($val){

  $JOUR   = array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
  $MOIS   = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

  $format = 'Y-m-d H:i:s';

  $date     = DateTime::createFromFormat($format, $val);
  $Tday     = $JOUR[$date->format('N')]; //Date....
  $Tjour    = $date->format('d');    //Jour....
  $Tmois    = $MOIS[$date->format('n')]; //Mois....
  $Tyear    = $date->format('Y');    //Annee...
  $Thour    = $date->format('H');    //Heure...
  $Tminute  = $date->format('i');    //Minute...
  $Tseconds = $date->format('i');    //Seconds...

  $TTT    = $Tjour . ' ' . $Tmois . ' ' . $Tyear . ' &agrave; ' . $Thour  . ':' . $Tminute  . ':' . $Tseconds ;

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

function XXXX($val){

	$format = 'd/m/Y';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tjour 		= $date->format('j');		 //Jour....
	$Tmois 		= $date->format('n'); 		//Mois....
	$Tyear 		= $date->format('Y');		 //Annee...

	$TTT 		= $Tyear . '-' . $Tmois . '-' . $Tjour ;

	return $TTT;
}

function DATUML($val){

	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc");

	$format = 'YmdHi';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...

	$TTT 		= $Tday . ' ' . $Tjour . ' ' . $Tmois  . '<br>'  . '&agrave; ' . $Thour  . 'h' . $Tminute ;

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

function DATUMLLEN($val){

	$JOUR		= array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
	$MOIS		= array("","Jan","Feb","Mar","Avp","Mai","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

	$format = 'Y-m-d H:i:s';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...
	$Tseconde	= $date->format('s');		 //Minute...

	$TTT 		= $Tday . ' ' . $Tmois . ' ' . $Tjour  . ', ' . $Tyear  . ' at ' . $Thour  . 'h' . $Tminute. ':' . $Tseconde ;

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


function smtpmailer($to, $from = "noreply@emna-voyages.com", $from_name = "Emna voyages", $subject, $body, $is_gmail = true) {
	global $error, $NOREPLY_SMTP, $NOREPLY_PORT, $NOREPLY_HOST, $NOREPLY_EMAIL, $NOREPLY_PASS;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	if ($is_gmail) {
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Username = 'resa@emna-voyages.com';
		$mail->Password = 'resa123++';
	} else {
		$mail->SMTPSecure = $NOREPLY_SMTP;
		$mail->Host = $NOREPLY_HOST;
		$mail->Port = $NOREPLY_PORT;
		$mail->Username = $NOREPLY_EMAIL;
		$mail->Password = $NOREPLY_PASS;;
	}
	$mail->CharSet = 'UTF-8';
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

function smtpmailerVoucher($to, $from = '$NOREPLY_EMAIL', $from_name = '$SITE_NAME', $subject, $body, $is_gmail = true, $Attachment) {
	global $error, $NOREPLY_SMTP, $NOREPLY_PORT, $NOREPLY_HOST, $NOREPLY_EMAIL, $NOREPLY_PASS;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	if ($is_gmail) {
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Username = 'resa@emna-voyages.com';
		$mail->Password = 'resa123++';
	} else {
		$mail->SMTPSecure = $NOREPLY_SMTP;
		$mail->Port = $NOREPLY_PORT;
		$mail->Host = $NOREPLY_HOST;
		$mail->Username = $NOREPLY_EMAIL;
		$mail->Password = $NOREPLY_PASS;;
	}
	$mail->CharSet = 'UTF-8';
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->IsHTML(true);
	$mail->AddAddress($to);
	if($Attachment != ''){
		$mail->AddAttachment('../vouchers/'.$Attachment);
	}
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


function GetElements( $an_array, $start, $elements ) {
    return array_slice( $an_array, $start, $elements );
}

function NbWeek($Start,$End,$D){
	$begin 	= new DateTime( $Start );
	$end   	= new DateTime( $End );
	$nb 	= 0;
	for($i = $begin; $i < $end; $i->modify('+1 day')){
	    $date = $i->format("Ymd");
	    $day = date("w", strtotime($date));
	    if($D == 0){

	    }
	    if($D == 1){
	    	if($day == 6){
		      $nb += 1;
		    }else{
		    }
	    }
	    if($D == 2){
	    	if($day == 5 || $day == 6){
		      $nb += 1;
		    }else{
		    }
	    }

	}

	return $nb;
}

function newNbWeek($Start,$D){
	$begin 	= new DateTime( $Start );
	$nb 	= 0;
    $date = $begin->format("Ymd");
    $day = date("w", strtotime($date));
    if($D == 1){
    	if($day == 6){
	      $nb += 1;
	    }else{
	    }
    }
    if($D == 2){
    	if($day == 5 || $day == 6){
	      $nb += 1;
	    }
    }

	return $nb;
}

function dateDiff($checkin,$checkout)
{
	$checkin 	= substr($checkin, 6, 4).'-'.substr($checkin, 3, 2).'-'.substr($checkin, 0, 2);
	$checkout 	= substr($checkout, 6, 4).'-'.substr($checkout, 3, 2).'-'.substr($checkout, 0, 2);
	$datetime1 = new DateTime($checkin);
	$datetime2 = new DateTime($checkout);
	$interval = $datetime1->diff($datetime2);
	$Diff = $interval->format('%a');
	if ($Diff == 1) {
	 	$TT = $Diff.' Nuit';
	}else{
		$TT = $Diff.' Nuits';
	}
	return $TT;
}

function dateDiffNB($checkin,$checkout)
{
	$checkin 	= substr($checkin, 6, 4).'-'.substr($checkin, 3, 2).'-'.substr($checkin, 0, 2);
	$checkout 	= substr($checkout, 6, 4).'-'.substr($checkout, 3, 2).'-'.substr($checkout, 0, 2);
	$datetime1 = new DateTime($checkin);
	$datetime2 = new DateTime($checkout);
	$interval = $datetime1->diff($datetime2);
	$Diff = $interval->format('%a');

	return $Diff;
}

function dateDiffNBHB($checkin,$checkout)
{
	$datetime1 = new DateTime($checkin);
	$datetime2 = new DateTime($checkout);
	$interval = $datetime1->diff($datetime2);
	$Diff = $interval->format('%a');

	return $Diff;
}

function diFF($checkin,$checkout)
{
	$datetime1 = new DateTime($checkin);
	$datetime2 = new DateTime($checkout);
	$interval = $datetime1->diff($datetime2);
	$Diff = $interval->format('%a');
	if ($Diff == 1) {
	 	$TT = $Diff.' Nuit';
	}else{
		$TT = $Diff.' Nuits';
	}
	return $TT;
}

function THEDATE($val){

	$JOUR		= array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
	$MOIS		= array("","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc");

	$format = 'd/m/Y';

	$date 		= DateTime::createFromFormat($format, $val);
	$Tday 		= $JOUR[$date->format('N')]; //Date....
	$Tjour 		= $date->format('d');		 //Jour....
	$Tmois 		= $MOIS[$date->format('n')]; //Mois....
	$Tyear 		= $date->format('Y');		 //Annee...
	$Thour		= $date->format('H');		 //Heure...
	$Tminute	= $date->format('i');		 //Minute...

	$TTT 		= $Tday . ', ' . $Tjour . ' ' . $Tmois . ', ' . $Tyear ;

	return $TTT;
}


function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function randomResa( $length = 8 ) {
    $chars = "0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
function datumSTRZ($x){
	$j=substr($x,6,2);
	$m=substr($x,4,2);
	$y=substr($x,0,4);
	$x=$j.'/'.$m.'/'.$y;
	return $x;
}

function UniqueId($nb_char = 8){

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

?>