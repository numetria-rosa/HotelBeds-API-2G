<?php
require_once dirname(__FILE__).'/files/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
session_start();
include_once("files/DB_FUNCTION_INC.php");
if (!isset($_SESSION['SuperSuperAdmin'])) {
    header("location:" . $WORKPATH . "home/");
}
$site = new SITE();
$BlueStar = array(29, 24, 144, 40, 39, 145, 146, 148);
$BookingId = $_GET['BookingId'];
$BOOKING    = $site->SelectObjectTableWC("booking","pid",$BookingId,"pid","ASC");
$USER       = $site->SelectObjectTableWC("user","id",$BOOKING->agentid,"id","ASC");

$NB = $site->countTableWC("booking", "pid", $BookingId);

if ($NB == 0) {
    header("location:" . $WORKPATH . "/reservations.php");
} else {
    $USER = stripslashes(utf8_decode($USER->username));
    $USERB = $site->SelectObjectTableWC("user","id",$BOOKING->agentid,"id","ASC");
    if (  $USERB->canal == "B2C") {
        $AGN_LOGO = "logocte.png";
    } else if ($USERB->logo != "") {
        $AGN_LOGO = $USERB->logo;
    } else {
        $AGN_LOGO = "logocte.png";
    }
    $EMV_LOGO = "emnavo.jpg";
    $AGN_BAS = 0;
    $BOOKING = $site->SelectObjectTableWC("booking", "pid", $BookingId, "pid", "ASC");
    $AGN_CODE   = stripslashes(utf8_decode($USERB->code_devise));
    $BOOK_REF = stripslashes(utf8_decode($BOOKING->bookingreference));
    $BOOK_LT = stripslashes(utf8_decode($BOOKING->leadertitle));
    $BOOK_LFN = stripslashes(utf8_decode($BOOKING->leaderfirstname));
    $BOOK_LLN = stripslashes(utf8_decode($BOOKING->leaderlastname));
    $VHPF_ADDRESS3 = "<b>".$SITE_NAME."</b><br/>
                26, rue Mohamed Ali<br/>
                3000 - Sfax - Tunisie<br/>
                Tél. : +216 74 210 911 / +216 74 210 840<br/>
                Email : helpdesk@emna-voyages.com";
    if ($BOOK_LFN != '') {
        $BOOK_CLIENTPRINCIPAL = '<tr>
            <td style="width:30%; text-align:right; padding-right:5px;">Nom du client</td>
            <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_LT . ' ' . $BOOK_LFN . ' ' . $BOOK_LLN . '</td>
        </tr>';
    }

    $BOOK_HID = stripslashes(utf8_decode($BOOKING->localhotelid));
    $BOOK_HN = stripslashes(utf8_decode($BOOKING->hotelname));
    $BOOK_HN = strtolower($BOOK_HN);
    $BOOK_HN = ucwords($BOOK_HN);
    $BOOK_HA = stripslashes(utf8_decode($BOOKING->hoteladdress));
    $BOOK_HA = strtolower($BOOK_HA);
    $BOOK_HA = ucwords($BOOK_HA);
    $BOOK_TEL = stripslashes(utf8_decode($BOOKING->hotelphone));
    $BOOK_TEL = strtolower($BOOK_TEL);
    $BOOK_TEL = ucwords($BOOK_TEL);
    $BOOK_TEL = nl2br($BOOK_TEL);
    $BOOK_HC = stripslashes(utf8_decode($BOOKING->countryname));
    $BOOK_Hc = stripslashes(utf8_decode($BOOKING->cityname));
    $BOOK_HS = stripslashes(utf8_decode($BOOKING->categoryName));
    $BOOK_HS = strtolower($BOOK_HS);
    $BOOK_HS = ucwords($BOOK_HS);

    $BOOK_CE = stripslashes(utf8_decode($BOOKING->contactemail));
    $BOOK_CM = stripslashes(utf8_decode($BOOKING->contactmobile));

    $BOOK_TA = stripslashes(utf8_decode($BOOKING->totaladults));
    $BOOK_TC = stripslashes(utf8_decode($BOOKING->totalchildren));
    $BOOK_TK = stripslashes(utf8_decode($BOOKING->totalkids));
    $BOOK_TAT = $BOOK_TA + $BOOK_TC + $BOOK_TK;

    $BOOK_TR = stripslashes(utf8_decode($BOOKING->totalrooms));
    $BOOK_SN = stripslashes(utf8_decode($BOOKING->selectednights));
    $BOOK_CID = stripslashes(utf8_decode($BOOKING->checkindate));
    $BOOK_COD = stripslashes(utf8_decode($BOOKING->checkoutdate));
    $BOOK_Agent = stripslashes(utf8_decode($BOOKING->pidagent));
    $BOOK_STT = stripslashes(utf8_decode($BOOKING->starttime));
    $BOOK_DEVISE = stripslashes(utf8_decode($BOOKING->agencydevise));
    $BOOK_STT = DATUMLLFR($BOOK_STT);

    $BOOK_ST = stripslashes(utf8_decode($BOOKING->bookingservicetype));
    $BOOK_OPT = "";

    $SITE_NAME3 = '';

    $BOOK_DET = '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">
                    <tr>
                        <th style="width:100%; padding: 8px 15px;background-color: #cd015a;">D&Eacute;TAILS DE VOTRE S&Eacute;JOUR</th>
                    </tr>
                </table>
                
                <table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Hôtel</td>
                        <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $BOOK_HN . ' &nbsp;&nbsp; ' . $BOOK_HS . '</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Adresse de l\'h&ocirc;tel</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_HA . '</td>
                    </tr>

                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Pays de l\'h&ocirc;tel</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_HC . '</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">T&eacute;l&eacute;phone</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_TEL . '</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Date d\'arriv&eacute;e</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . datII($BOOK_CID) . '</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Date de d&eacute;part</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . datII($BOOK_COD) . '</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Dur&eacute;e du s&eacute;jour</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_SN . ' nuit(s)</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Nombre de personnes</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_TAT . '</td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%; text-align:right; padding-right:5px; font-weight:bold;">Nombre de chambres</td>
                        <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_TR . '</td>
                    </tr>
                </table>';
                $BOOK_PRIX          = stripslashes(utf8_decode($BOOKING->totalcharges));
                $BOOK_PRIX_CURR     = stripslashes(utf8_decode($BOOKING->currencycode));
                $BOOK_PRIX_CONVERT  = stripslashes(utf8_decode($BOOKING->convertion));
                if ($canal='B2B'){
                    $BOOK_PRIX_CLIENT   = stripslashes(utf8_decode($BOOKING->totalmarkup));
                }else{
                    $BOOK_PRIX_CLIENT   = stripslashes(utf8_decode($BOOKING->grossamount)); 
                }
              
                $BOOK_PRIX_NET      = stripslashes(utf8_decode($BOOKING->grossamount));



    $BOOK_RR = "";
 
        $BOOK_ROOMS = $site->SelectFromTableWC("bookingrooms", "pidbooking", $BookingId, "pid", "ASC");
        foreach ($BOOK_ROOMS as $BOOK_ROOM) {
            $BOOK_ROOM_PID = $BOOK_ROOM['pid'];
            $BOOK_ROOM_NB = $BOOK_ROOM['numberofroom'];
            $BOOK_ROOM_TYPE = stripslashes(utf8_decode($BOOK_ROOM['roomtypedescription']));
            $BOOK_ROOM_CODE = stripslashes(utf8_decode($BOOK_ROOM['code']));
            if ($BOOK_ROOM_CODE != '') {
                $BOOK_ROOM_TYPE .= ' (' . $BOOK_ROOM_CODE . ') ';
            }

            $ROOMS_TA = $site->SelectFromTableW2C("bookingroomdetails", "pidroom", $BOOK_ROOM_PID, "passengertype", "adult", "pid", "ASC");
            $ROOMS_TA_NB = count($ROOMS_TA);
            $ROOMS_TAN = "";
            foreach ($ROOMS_TA as $ROOMS_TAD) {
                $SALUTATION = stripslashes(utf8_decode($ROOMS_TAD['salutation']));
                $FIRSTNAME = stripslashes(utf8_decode($ROOMS_TAD['firstname']));
                $LASTNAME = stripslashes(utf8_decode($ROOMS_TAD['lastname']));

                $ROOMS_TAN .= $SALUTATION . ' ' . $FIRSTNAME . ' ' . $LASTNAME . '<br>';
            }

            $ROOMS_TC = $site->SelectFromTableW2C("bookingroomdetails", "pidroom", $BOOK_ROOM_PID, "passengertype", "child", "pid", "ASC");
            $ROOMS_TC_NB = count($ROOMS_TC);
            $ROOMS_TCN = "";
            foreach ($ROOMS_TC as $ROOMS_TCD) {
                $FIRSTNAME = stripslashes(utf8_decode($ROOMS_TCD['firstname']));
                $LASTNAME = stripslashes(utf8_decode($ROOMS_TCD['lastname']));
                $AGE = stripslashes(utf8_decode($ROOMS_TCD['age']));

                $ROOMS_TCN .= $FIRSTNAME . ' ' . $LASTNAME . ' : ' . $AGE . ' ans<br>';
            }

            $ROOMS_TK = $site->SelectFromTableW2C("bookingroomdetails", "pidroom", $BOOK_ROOM_PID, "passengertype", "baby", "pid", "ASC");
            $ROOMS_TK_NB = count($ROOMS_TK);

            if ($BOOK_ST == 'hotelsbeds') {
                $ROOMS_RATE = $site->SelectObjectTableWC("bookingroomrates", "pidroom", $BOOK_ROOM_PID, "pid", "ASC");
                $ROOMS_RATE_BoardName = '<br>' . stripslashes(utf8_decode($ROOMS_RATE->rateBoardName));
            } else {
                $ROOMS_RATE_BoardName = '';
            }

            $BOOK_RR .= '
                            <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11px; ">
                                <tr>
                                    <th style="width:30%;">Type de Chambre</th>
                                    <th style="width:30%;">Nom des Clients</th>
                                    <th style="width:15%;">Adultes</th>
                                    <th style="width:15%;">Enfants</th>
                                    <th style="width:10%;">Bébés</th>
                                </tr>
                                <tr>
                                    <td style="width:30%;">' . $BOOK_ROOM_TYPE . $ROOMS_RATE_BoardName . '</td>
                                    <td style="width:30%;">' . $ROOMS_TAN . $ROOMS_TCN . '</td>
                                    <td style="width:15%;">' . $ROOMS_TA_NB . '</td>
                                    <td style="width:15%;">' . $ROOMS_TC_NB . '</td>
                                    <td style="width:10%;">' . $ROOMS_TK_NB . '</td>
                                </tr>
                            </table>
                            ';
            if ($BOOK_ST == 'hotelsbeds') {
                $ROOMS_RATE = $site->SelectObjectTableWC("bookingroomrates", "pidroom", $BOOK_ROOM_PID, "pid", "ASC");
                $ROOMS_RATE_Comments = stripslashes(utf8_decode($ROOMS_RATE->rateComments));

                $BOOK_RR .= '
                            <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11px; ">
                                <tr>
                                    <th style="width:100%;">Rate Comments</th>
                                </tr>
                                <tr>
                                    <td style="width:100%;">' . $ROOMS_RATE_Comments . '</td>
                                </tr>
                            </table>
                            ';
            }
        }
    

    if ($BOOK_OPT != '') {
        $OPT = explode(',', $BOOK_OPT);
        if ($OPT[0] == 1) {
            $BOOK_RR .= '
                        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11px; ">
                            <tr>
                                <th style="width:50%;">Option</th>
                            </tr>
                            <tr>
                                <td style="width:50%;">HD City Tour Supplement</td>
                            </tr>
                        </table>
                        ';
        }

        if ($OPT[1] == 1) {
            $BOOK_RR .= '
                        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11pt; ">
                            <tr>
                                <th style="width:50%;">Option</th>
                            </tr>
                            <tr>
                                <td style="width:50%;">HD City Tour + Princess Island with Lunch Supplement</td>
                            </tr>
                        </table>
                        ';
        }

    }


    if (in_array($BOOK_HID, $BlueStar)) {
        $BOOK_RR .= '
                    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11pt; ">
                        <tr>
                            <td style="width:50%;">Garanted by : Blue Star</td>
                        </tr>
                    </table>
                    ';
    }

    $BOOK_CHK = '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 10pt; margin-top: 10px;">
                    <tr>
                        <th style="width:100%; padding: 8px 15px; background-color:#81a1b6; border-bottom:1px thin #81a1b6; color:#fff;">Vous pouvez effectuer votre check-in &agrave; partir de 14:00 et le check-out doit &ecirc;tre effectu&eacute; au plus tard &agrave; 12:00</th>
                    </tr>
                </table>';

    $BOOK_CHK2 = '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: center; font-size: 10pt; font-style:italic; margin-top: 0px;">
                    <tr>
                        <td style="width:100%; padding: 8px 15px; background:none !important; border-bottom:none !important; border-left:none !important; border-right:none !important; color:#000;">Veuillez imprimer ce bon voucher et le pr&eacute;senter &agrave; la r&eacute;ception &agrave; votre arriv&eacute;e &agrave; l\'hôtel</td>
                    </tr>
                </table>';


    if ($BOOK_ST == 'hotelbedsactivity') {
        $ActivityDetails = $site->SelectObjectTableWC('activityDetail', 'pidBooking', $BookingId, 'pid', 'ASC');
        $activityName = stripslashes(utf8_decode($ActivityDetails->activityName));
        $activityCommentText = stripslashes(utf8_decode($ActivityDetails->activityCommentText));
        $activityType = stripslashes(utf8_decode($ActivityDetails->activityType));
        $activityModalityName = stripslashes(utf8_decode($ActivityDetails->activityModalityName));

        $BOOK_DET = '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">
                            <tr>
                                <th style="width:100%; padding: 8px 15px;">D&Eacute;TAILS DE VOTRE ' . $activityType . '</th>
                            </tr>
                        </table>
                        
                        <table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">
                            <tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Activit&eacute;</td>
                                <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $activityName . '</td>
                            </tr>

                            <tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Langue</td>
                                <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $activityModalityName . '</td>
                            </tr>

                            <tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Destination</td>
                                <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $BOOK_Hc . ' - ' . $BOOK_HC . '</td>
                            </tr>
                            
                            <tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Date du ' . $activityType . '</td>
                                <td style="width:70%; text-align:left; padding-left:5px;">' . datII($BOOK_CID) . '</td>
                            </tr>
                            
                            <tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">' . $activityType . ' valable jusqu\'au</td>
                                <td style="width:70%; text-align:left; padding-left:5px;">' . datII($BOOK_COD) . '</td>
                            </tr>
                            
                            <tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Nombre de personnes</td>
                                <td style="width:70%; text-align:left; padding-left:5px;">' . $BOOK_TA . '</td>
                            </tr>
                        </table>';

        $BOOK_DET .= '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">
                            <tr>
                                <th style="width:100%; padding: 8px 15px;">D&Eacute;TAILS DES PAX</th>
                            </tr>
                        </table>';

        $BOOK_DET .= '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">';
        $NbPaxes = $site->countTableWC('activityPaxes', 'pidBooking', $BookingId);
        $Width = 70 / $NbPaxes;
        $ActivityPaxes = $site->SelectFromTableWC('activityPaxes', 'pidBooking', $BookingId, 'pid', 'ASC');
        $PaxFullNames = '';
        $PaxAges = '';
        $PaxTypes = '';
        $PaxConfirmationCodes = '';
        $PaxConfirmationUnitTypes = '';
        $PaxEntranceDoors = '';
        $PaxGates = '';
        $PaxRows = '';
        $PaxSeats = '';

        foreach ($ActivityPaxes as $ActivityPaxe) {
            $paxName = stripslashes(utf8_decode($ActivityPaxe['paxName']));
            $paxSurname = stripslashes(utf8_decode($ActivityPaxe['paxSurname']));
            $PaxFullNames .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $paxName . ' ' . $paxSurname . '</td>';

            $paxAge = stripslashes(utf8_decode($ActivityPaxe['paxAge']));
            if ($paxAge == 1) {
                $PaxAges .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $paxAge . ' year</td>';
            } else {
                $PaxAges .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $paxAge . ' years</td>';
            }

            $paxType = stripslashes(utf8_decode($ActivityPaxe['paxType']));
            if ($paxType == 'AD') {
                $paxType = 'Adult';
            }
            if ($paxType == 'CH') {
                $paxType = 'Child';
            }
            $PaxTypes .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $paxType . '</td>';

            $paxConfirmationCode = stripslashes(utf8_decode($ActivityPaxe['paxConfirmationCode']));
            $PaxConfirmationCodes .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $paxConfirmationCode . '</td>';
            $paxConfirmationUnitType = stripslashes(utf8_decode($ActivityPaxe['paxConfirmationUnitType']));
            $PaxConfirmationUnitTypes .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $paxConfirmationUnitType . '</td>';

            $seatEntranceDoor = stripslashes(utf8_decode($ActivityPaxe['seatEntranceDoor']));
            $PaxEntranceDoors .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $seatEntranceDoor . '</td>';

            $seatGate = stripslashes(utf8_decode($ActivityPaxe['seatGate']));
            $PaxGates .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $seatGate . '</td>';

            $seatRow = stripslashes(utf8_decode($ActivityPaxe['seatRow']));
            $PaxRows .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $seatRow . '</td>';

            $seatSeat = stripslashes(utf8_decode($ActivityPaxe['seatSeat']));
            $PaxSeats .= '<td style="width:' . $Width . '%; text-align:left; padding-left:5px;">' . $seatSeat . '</td>';
        }
        $BOOK_DET .= '<tr>
                            <td style="width:30%; text-align:right; padding-right:5px;">Nom &amp; Pr&eacute;nom</td>' . $PaxFullNames . '
                        </tr>';

        $BOOK_DET .= '<tr>
                            <td style="width:30%; text-align:right; padding-right:5px;">Type</td>' . $PaxTypes . '
                        </tr>';

        if ($paxConfirmationCode != '') {
            $BOOK_DET .= '<tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Confirmation Code</td>' . $PaxConfirmationCodes . '
                            </tr>';

            $BOOK_DET .= '<tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Confirmation Unit Type</td>' . $PaxConfirmationUnitTypes . '
                            </tr>';
        }

        if ($seatEntranceDoor != '') {
            $BOOK_DET .= '<tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Entrance Doors</td>' . $PaxEntranceDoors . '
                            </tr>';

            $BOOK_DET .= '<tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Gates</td>' . $PaxGates . '
                            </tr>';

            $BOOK_DET .= '<tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Rows</td>' . $PaxRows . '
                            </tr>';

            $BOOK_DET .= '<tr>
                                <td style="width:30%; text-align:right; padding-right:5px;">Seats</td>' . $PaxSeats . '
                            </tr>';
        }


        $BOOK_DET .= '</table>';

    }

    $SITE_NAME2 = 'Payable par C2S';
    $HBBOOK_REF = '';
    $HBBOOK_REF .= ' <tr>
                        <td style="width:30%; text-align:right; padding-right:5px;">Date de Réservation</td>
                        <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $BOOK_STT . '</td>
                    </tr>';


    if ($BOOK_ST == 'hotelsbeds') {
        $AGN_LOGO = "hotelbeds.PNG";
        $XXX = utf8_decode(stripslashes($BOOKING->SupplierName));
        $YYY = stripslashes(utf8_decode($BOOKING->SupplierVatNumber));
        $ZZZ = $BOOKING->id;
        $SITE_NAME2 = 'Payable through <b style="color:#01b7f2;">' . $XXX . '</b>, acting as agent for the service operating company, details of which can be provided upon request. 
                        VAT: <b style="color:#01b7f2;">' . $YYY . '</b> Reference: <b style="color:#01b7f2;">' . $ZZZ . '</b>.';
        $HBBOOK_REF = ' <tr>
                            <td style="width:30%; text-align:right; padding-right:5px;">Supplier Booking Number</td>
                            <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $ZZZ . '</td>
                        </tr>';
    }

 
    if ($BOOK_ST == 'carthagehotels') {
        $ZZZ = $BOOKING->id;
        $HBBOOK_REF = '<tr>
            <td style="width:30%; text-align:right; padding-right:5px;">Supplier Booking Number</td>
            <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $ZZZ . '</td>
        </tr>';
        $HBBOOK_REF .= ' <tr>
            <td style="width:30%; text-align:right; padding-right:5px;">Date de Réservation</td>
            <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $BOOK_STT . '</td>
        </tr>';
    }
   

 

    try {
        ob_start();
        include dirname(__FILE__) . '/proforma-content.php';
        $content = ob_get_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($CONTENT);
        $html2pdf->Output('' . $USER . '-hotel-proforma-' . $BOOK_REF . '.pdf');
        $html2pdf->Output('proformas/' . $USER . '-hotel-proforma-' . $BOOK_REF . '.pdf', 'F');
    } catch (Html2PdfException $e) {
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }


}