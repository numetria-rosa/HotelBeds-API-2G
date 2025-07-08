<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); */
$WORKPATH		= "https://dmcbooking.pro/admin/";
$WORKPATH2      = "https://dmcbooking.pro/";
$SITE_NAME 	 	= "DmcBooking";
$SITE_CSS 	 	= "DmcBooking";
$SITE_PHONE	 	= "(+216) 72 248 557";
$SITE_PHONE_GZ 	= "+21672248557";
$BOOKING_EMAIL 	= "booking@dmcbooking.pro";
$RESA_EMAIL 	= "resa@dmcbooking.pro";
$NOREPLY_EMAIL 	= "noreply@dmcbooking.pro";
$NOREPLY_PASS  	= "LQduJi9ck";
$NOREPLY_HOST  	= "ssl0.ovh.net";
$NOREPLY_SMTP  	= "ssl";
$NOREPLY_PORT  	= 465;

$VHPF_IMG		= "https://i.imgur.com/nm6W0ng.png";
$VHPF_ADDRESS	= "<b>".$SITE_NAME."</b><br/>
                26, rue Mohamed Ali<br/>
                3000 - Sfax - Tunisie<br/>
                Tél. : +216 74 210 911 / +216 74 210 840<br/>
                Email : helpdesk@dmcbooking.pro";

$VHPF_ADDRESS2	= "26, rue Mohamed Ali, 3000 - Sfax - Tunisie";
$VHPF_BGIMG		= '';
$VHPF_ADDRESS3	= "<b>".$SITE_NAME."</b><br/>
                26, rue Mohamed Ali<br/>
                3000 - Sfax - Tunisie<br/>
                Tél. : +216 74 210 911 / +216 74 210 840<br/>
                Email : helpdesk@dmcbooking.pro";

$NOREPLY_EMAIL2	= "helpdesk@dmcbooking.pro";

$WHEREAMI   = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$WHEREAMIURL= htmlspecialchars( $WHEREAMI, ENT_QUOTES, 'UTF-8' );

$MOIS 		= array("Janvier","F&eacute;vrier","Mars","Avril","Mai","Juin","Juillet","Ao&ucirc;t","Septembre","Octobre","Novembre","D&eacute;cembre");
$LANGUAGE	= array('FRA' => 'French' , 'ENG' => 'English' , 'SPA' => 'Spanish' , 'ITA' => 'Italian' , 'RUS' => 'Russian' );
$QTYCODE	= array('700' => 'Kg' , '701' => 'Pounds' , '702' => 'Nil' , 'C' => 'Special Charge' , 'N' => 'Pièce(s)' , 'S' => 'Taille' , 'V' => 'Valeur' , 'W' => 'Poids');

$RealChange = 3;
?>
