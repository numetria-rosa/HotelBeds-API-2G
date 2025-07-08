<?php
use Spipu\Html2Pdf\Html2Pdf;

session_start();

include_once("../files/DB_FUNCTION_INC.php");
require_once $Path.'/files/html2pdf/vendor/autoload.php';

if (!isset($_SESSION['USER'])) {
    header("location:" . $WORKPATH . "home/");
}
$BOOKCPP="";
$ROOMS_TAN="";
$BOOK_RR ="";
$site = new SITE();
$USER = $_SESSION['USER'];
$BookingId = $_GET['BookingId'];
$NB = $site->countTableWC("booking", "pid", $BookingId);
$PaxAges="";

    $USER = stripslashes(utf8_decode($USER['username']));

    $AGN_BAS = 0;

    $BOOKING = $site->SelectObjectTableWC("booking", "pid", $BookingId, "pid", "ASC");

    if ($_SESSION['USER']['id']!=$BOOKING->agentid){
        header("location:" . $WORKPATH . "backoffice.php");
    }

    $BOOK_REFHB = stripslashes(utf8_decode($BOOKING->id));
    $BOOK_REF = stripslashes(utf8_decode($BOOKING->bookingreference));
    $BOOK_LT = stripslashes(utf8_decode($BOOKING->leadertitle));
    $BOOK_LFN = stripslashes(utf8_decode($BOOKING->leaderfirstname));
    $BOOK_LLN = stripslashes(utf8_decode($BOOKING->leaderlastname));

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

    $BOOK_STT = stripslashes(utf8_decode($BOOKING->starttime));
    $BOOK_STT = date("d-m-Y", strtotime($BOOK_STT));

    $BOOK_PRICE_CLIENT = stripslashes(utf8_decode($BOOKING->grossamount));
    $BOOK_PRIX_NET = stripslashes(utf8_decode($BOOKING->grossamount));

    $BOOK_ST = stripslashes(utf8_decode($BOOKING->bookingservicetype));
    $BOOK_OPT = "";
    $BOOK_DEVISE = stripslashes(utf8_decode($BOOKING->currencycode));
    $BOOK_MSG = '';
    $BOOK_LCT=stripslashes(utf8_decode($BOOKING->latitude)).'/'.stripslashes(utf8_decode($BOOKING->longitude));
    $BOOK_ROOMS = $site->SelectFromTableWC("bookingrooms", "pidbooking", $BookingId, "pid", "ASC");
    foreach ($BOOK_ROOMS as $BOOK_ROOM) {
        $BOOK_ROOM_PID = $BOOK_ROOM['pid'];
        $BOOK_ROOM_NB = $BOOK_ROOM['numberofroom'];
        $BOOK_ROOM_TYPE = stripslashes(utf8_decode($BOOK_ROOM['roomtypedescription']));
        $BOOK_ROOM_CODE = stripslashes(utf8_decode($BOOK_ROOM['code']));
        $ROOMS_TA = $site->SelectFromTableW2C("bookingroomdetails", "pidroom", $BOOK_ROOM_PID, "passengertype", "adult", "pid", "ASC");
        $ROOMS_TA_NB = count($ROOMS_TA);
        foreach ($ROOMS_TA as $ROOMS_TAD) {
            $SALUTATION = stripslashes(utf8_decode($ROOMS_TAD['salutation']));
            $FIRSTNAME = stripslashes(utf8_decode($ROOMS_TAD['firstname']));
            $LASTNAME = stripslashes(utf8_decode($ROOMS_TAD['lastname']));
            $ROOMS_TAN .= $SALUTATION . ' ' . $FIRSTNAME . ' ' . $LASTNAME . '<br>';
        }

        $ROOMS_TC = $site->SelectFromTableW2C("bookingroomdetails", "pidroom", $BOOK_ROOM_PID, "passengertype", "child", "pid", "ASC");
        $ROOMS_TC_NB = count($ROOMS_TC);

        $ROOMS_TK = $site->SelectFromTableW2C("bookingroomdetails", "pidroom", $BOOK_ROOM_PID, "passengertype", "baby", "pid", "ASC");

        foreach ($ROOMS_TC as $ROOMS_TKK) {
          $PaxAges.=$ROOMS_TKK['age'].'(y/o) ';
        }

        $ROOMS_TK_NB = count($ROOMS_TK);

        $ROOMS_TCN = "";
        foreach ($ROOMS_TC as $ROOMS_TCD) {
            $FIRSTNAME = stripslashes(utf8_decode($ROOMS_TCD['firstname']));
            $LASTNAME = stripslashes(utf8_decode($ROOMS_TCD['lastname']));
            $AGE = stripslashes(utf8_decode($ROOMS_TCD['age']));

            $ROOMS_TCN .= $FIRSTNAME . ' ' . $LASTNAME . ' : ' . $AGE . ' ans<br>';
        }

        $ROOMS_RATE = $site->SelectObjectTableWC("bookingroomrates", "pidroom", $BOOK_ROOM_PID, "pid", "ASC");
        $ROOMS_RATE_BoardName = stripslashes(utf8_decode($ROOMS_RATE->rateBoardName));


        $ROOMS_CP = $site->SelectObjectTableWC("bookingroomcp", "pidBooking", $BookingId, "pid", "ASC");
        $ROOMS_RATE = $site->SelectObjectTableWC("bookingroomrates", "pidroom", $BOOK_ROOM_PID, "pid", "ASC");
        $ROOMS_RATE_Comments = stripslashes(utf8_decode($ROOMS_RATE->rateComments));
        $ROOMS_RATE_Unit = stripslashes(utf8_decode($ROOMS_RATE->rateRooms));


             $BOOKCPP.='
          <tr>
                <td><span id="cancellationconcept_77#H#1">'.$BOOK_ROOM_TYPE.'</span>  </td>

                <td><span id="cancellation_date_77#H#1">'.$ROOMS_CP->cancellationFrom.'</span></td>
            <td><span id="cancellation_unit_77#H#1">1</span></td>
            <td class="price"><strong><span id="cancellation_price_77#H#1">'.$ROOMS_CP->cancellationAmount.' '.$ROOMS_CP->Devise.'</span></strong></td>
        </tr>';

        $BOOK_RR .= '<tr>
                        <td>'.$ROOMS_RATE_Unit.'</td>
                        <td><span id="typeroom_0">
                        '.$BOOK_ROOM_TYPE.'
                        </span></td>
                        <td><span id="typereg_0">'.$ROOMS_RATE_BoardName.'</span></td>
                        <td style="text-align:right"><span id="numberadults_0">'.$ROOMS_TA_NB.' Adultes</span>,
                            <span id="number_childs">'.$ROOMS_TC_NB.' Enfants </span>,
                            <span id="number_childs">'.$ROOMS_TK_NB.' Enfants </span>
                        </td>

                    </tr>';



    }


    $XXX = utf8_decode(stripslashes($BOOKING->SupplierName));

    $YYY = stripslashes(utf8_decode($BOOKING->SupplierVatNumber));
    $ZZZ = $BOOKING->id;
    $SITE_NAME2 = 'Payable through <b style="color:#01b7f2;">' . $XXX . '</b>, acting as agent for the service operating company, details of which can be provided upon request.
                    VAT: <b style="color:#01b7f2;">' . $YYY . '</b> Reference: <b style="color:#01b7f2;">' . $ZZZ . '</b>.';
                    $BOOK_CHK2 = '<table cellspacing="0" cellpadding="0" style="width: 100%; text-align: center; font-size: 10pt; font-style:italic; margin-top: 0px;">
                    <tr>
                        <td style="width:100%; padding: 8px 15px; background:none !important; border-bottom:none !important; border-left:none !important; border-right:none !important; color:#000;">Veuillez imprimer ce bon voucher et le pr&eacute;senter &agrave; la r&eacute;ception &agrave; votre arriv&eacute;e &agrave; l\'hôtel</td>
                    </tr>
                </table>';


    try {
        ob_start();
        include dirname(__FILE__) . '/proforma-contenthb.php';
        $content = ob_get_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($CONTENT);
        $html2pdf->Output('-hotel-voucher-.pdf');
        $html2pdf->Output('vouchers/-hotel-voucher-', 'F');
    } catch (Html2PdfException $e) {
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }

?>