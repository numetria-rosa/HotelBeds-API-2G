<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
//ini_set('max_execution_time', 0);
$site = new SITE();
if(!isset($_SESSION['sortHB'])){
	$_SESSION['sortHB'] = 'minRate';
}

$sortHB = $_SESSION['sortHB'];
$email = $_POST['email'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$price = $_SESSION['TotalBookingAmount']*100;
$BookingReference = 'B2CHB_' . randomResa(6);


unset($_SESSION['MARPER']);
$markupdb = $site->SelectMarkup();
$MARKUP = (($markupdb['markup_b2c']) / 100) + 1;;
$MARPER = $MARKUP;
$_SESSION['MARPER']=$MARPER;


try {
    require_once('stripe/vendor/autoload.php');
    \Stripe\Stripe::setApiKey($stripeSecretkey);
    $token  = $_POST['stripeToken'];

    $response = \Stripe\Charge::create(array(
        //'customer' => $customer->id,
        'amount' => (int)$price,
        'currency' => "eur",
        'source' => $token,
        'description' => $BookingReference,
        // "source" => "tok_mastercard", // obtained with Stripe.js
        //"metadata" => array("order_id" => "6735")
    ));
    //print_r($response->jsonSerialize()) ;die();
    $paymenyResponse = $response->jsonSerialize();
    // check whether the payment is successful
    if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
        // transaction details
        $amountPaid = $paymenyResponse['amount'];
        $balanceTransaction = $paymenyResponse['balance_transaction'];
        $paidCurrency = $paymenyResponse['currency'];
        $paymentStatus = $paymenyResponse['status'];
        $paymentDate = date("Y-m-d H:i:s");
		$cardExpYear=$paymenyResponse['exp_year'];
		$cardExpMonth=$paymenyResponse['exp_month'];
		$cardCVC=$paymenyResponse ['source']['cvc_check'];
		$cardNumber=$paymenyResponse ['source']['last4'];
        $PidAgent = $_SESSION['USER']['id'];
      
        //insert tansaction details into database
        include_once("files/DB_INC.php");
		$db = new Db();
		$db->connect();
        $insertTransactionSQL = "INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status,bookingreference,userid) VALUES('". $balanceTransaction ."', '". $balanceTransaction ."', '". $email ."', '". $_SESSION['TotalBookingAmount'] ."', '". $paidCurrency ."', '". $paymentStatus ."', '". $BookingReference ."', '". $PidAgent ."')";
        $db->query( $insertTransactionSQL);
        $lastInsertId =$db->insert_id();
        //if order inserted successfully
        if($lastInsertId && $paymentStatus == 'succeeded'){
            $paymentMessage = "The payment was successful. Order ID: { $lastInsertId}";
        } else{
            $paymentMessage = "failed";
        }

    } else{
        $paymentMessage = "failed";
    }

    $_SESSION["message"] = $paymentMessage;

    if ($paymentStatus == 'succeeded'){

                $AdulteFirstNames = $_POST['AdulteFirstName'];
                $AdulteFirstName = explode(',', $AdulteFirstNames);
                $AdulteLastNames = $_POST['AdulteLastName'];
                $AdulteLastName = explode(',', $AdulteLastNames);
                $ChildFirstNames = $_POST['ChildFirstName'];
                $ChildLastNames = $_POST['ChildLastName'];
                $ChildAges = $_POST['ChildAge'];
                if ($ChildFirstNames != ',') {
                    $ChildFirstName = explode(',', $ChildFirstNames);
                    $ChildLastName = explode(',', $ChildLastNames);
                    $ChildAge = explode(',', $ChildAges);
                }
                $Remarks = $_POST['Remark'];
                $RRKS = '<remark>' . $Remarks . '</remark>';
                //$RRKS 	 = '';
                $RoomsRateKey = $_SESSION['RoomsRateKey'];
                $RRK = '';
                $HolderName = $AdulteLastName[0];
                $HolderSurname = $AdulteFirstName[0];
                $test=0;
                foreach ($RoomsRateKey as $Value) {
                    $test=$test+1;
                    $RoomRateKey = $Value['RoomRateKey'];
                    $RoomNumber = $Value['RoomNumber'];
                   
                    $RoomAdults = $Value['RoomAdults'];
                    $RoomChilds = $Value['RoomChilds'];
                   
                    if ($RoomNumber == 1) {
                        $RRK .= '<room rateKey="' . $RoomRateKey . '">';
                        $RRK .= '<paxes>';
                        if ($RoomAdults > 0) {
                            for ($i = 0; $i < $RoomAdults; $i++) {
                                $RRK .= '<pax roomId="' . $RoomNumber . '" type="AD" name="' . $AdulteLastName[$i] . '" surname="' . $AdulteFirstName[$i] . '"/>';
                            }
                            for ($i = 0; $i < $RoomAdults; $i++) {
                                array_shift($AdulteLastName);
                                array_shift($AdulteFirstName);
                            }
                        }
                        if ($RoomChilds > 0) {
                            for ($i = 0; $i < $RoomChilds; $i++) {
                                $RRK .= '<pax roomId="' . $RoomNumber . '" type="CH" age="' . $ChildAge[$i] . '" name="' . $ChildLastName[$i] . '" surname="' . $ChildFirstName[$i] . '"/>';
                            }
                            for ($i = 0; $i < $RoomChilds; $i++) {
                                array_shift($ChildLastName);
                                array_shift($ChildFirstName);
                            }
                        }
                        $RRK .= '</paxes>';
                        $RRK .= '</room>';
                        
                    } else if ($RoomNumber!=count($RoomsRateKey)){

                        $RRK .= '<room rateKey="' . $RoomRateKey . '">';

                        $RRK .= '<paxes>';

                     
                        for ($j = 1; $j <= $RoomNumber; $j++) {

                        if ($RoomAdults > 0) {

                            for ($i = 0; $i < (int)$RoomAdults/$RoomNumber; $i++) {
                                $RRK .= '<pax roomId="' . $j . '" type="AD" name="' . $AdulteLastName[$i] . '" surname="' . $AdulteFirstName[$i] . '"/>';
                            }
                            
                            for ($i = 0; $i < (int)$RoomAdults/$RoomNumber; $i++) {
                                array_shift($AdulteLastName);
                                array_shift($AdulteFirstName);
                            }

                        }
                        
                       }
                        $RRK .= '</paxes>';


                        $RRK .= '</room>';

                    } else {
                        $RRK .= '<room rateKey="' . $RoomRateKey . '">';
                        for ($j = 1; $j <= $RoomNumber; $j++) {
                            $RRK .= '<paxes>';
                            if ($RoomAdults > 0) {
                                $RRK .= '<pax roomId="' . $j . '" type="AD" name="' . $AdulteLastName[0] . '" surname="' . $AdulteFirstName[0] . '"/>';
                                array_shift($AdulteLastName);
                                array_shift($AdulteFirstName);
                            }
                            if ($RoomChilds > 0) {
                                $RRK .= '<pax roomId="' . $j . '" type="CH" age="' . $ChildAge[0] . '" name="' . $ChildLastName[0] . '" surname="' . $ChildFirstName[0] . '"/>';
                                array_shift($ChildLastName);
                                array_shift($ChildFirstName);
                            }
                            $RRK .= '</paxes>';
                        }
                        $RRK .= '</room>';
                    }
                }
              
              createBookingHB($HolderName, $HolderSurname, $BookingReference, $RRK, $RRKS);
    
               /*  $path = "http://localhost/files/hbbooking.xml";
                 $xmlfile = file_get_contents($path);
                 $xml_string = simplexml_load_string($xmlfile);
                 $json = json_encode($xml_string);
                 $array = json_decode($json, TRUE);
                 $_SESSION['RoomBookingRS'] = $array;   */
    
                if (isset($_SESSION['RoomBookingRS']['error'])) {
                    $Error = $_SESSION['RoomBookingRS']['error']['message'];
                    $Pos = strrpos($Error, ':');
                    if ($Pos === false) {
                    } else {
                        $Error = substr($Error, 0, $Pos);
                    }
                    print_r($Error);
                }

                if (isset($_SESSION['RoomBookingRS']['booking'])) {
                    $RoomBookingRS = $_SESSION['RoomBookingRS'];
                    $BookingRS = $_SESSION['RoomBookingRS']['booking'];
                    $TotalAdults = 0;
                    $TotalChildren = 0;
                    foreach ($_SESSION['RoomsRateKey'] as $key => $Value) {
                        $TotalAdults += $Value['RoomAdults'];
                        $TotalChildren += $Value['RoomChilds'];
                    }
               
                    $markupdb = 0;
                    $DEVISE = stripslashes(utf8_decode('EUR'));
                 
                  
                    
                    $datecheckin=$_SESSION['SearchHotelHB']['CheckIn'];
                    $datecheckout=$_SESSION['SearchHotelHB']['CheckOut'];

                    $tabledate= explode("-", $datecheckin);
                    $debut = new DateTime($tabledate[0].'-'.$tabledate[1].'-'.$tabledate[2]); 
                    $tabledateout= explode("-", $datecheckout);
                    $fin = new DateTime($tabledateout[0].'-'.$tabledateout[1].'-'.$tabledateout[2]);
                    $interval = $debut->diff($fin);
                    $nbnight= $interval->format('%d');
               
                    $markupdb = 0;

                    $MARKUP =  1;
                    $PERCENT = 1;

                    


                    $TotalRooms = count($_SESSION['Rooms']);


                    $BookingServiceType = 'hotelsbeds';
                    $PidAgence = $_SESSION['USER']['id'];
                    $PidAgent = $_SESSION['USER']['id'];
                    $Id = $BookingRS['@attributes']['reference'];
                    $BookingReference = $BookingRS['@attributes']['clientReference'];
                    $StartTime = $BookingRS['@attributes']['creationDate'];
                    $StartTime .= ' ' . date('H:i:s');
                    $EndTime = $StartTime;
                    $CurrentStatus = $BookingRS['@attributes']['status'];
                    if ($CurrentStatus == 'CONFIRMED') {
                        $CurrentStatus = 'vouchered';
                    }
                    $CreationUser = $BookingRS['@attributes']['creationUser'];
                    $TotalCharges = $BookingRS['@attributes']['totalNet'] ;
                    $RateCurrencyCode = $BookingRS['@attributes']['currency'];
                   

                    $EUREXCH = 1;
                    $CurrChange = 1;
                    $GrossAmount = $_SESSION['RoomsRatePrices'];
                    $TotalMarkup = $GrossAmount ;    

    
                    $PendingAmount = $BookingRS['@attributes']['pendingAmount'];
                    $CurrencyCode = $BookingRS['@attributes']['currency'];
                    $Cancellation = $BookingRS['modificationPolicies']['@attributes']['cancellation'];
                    $Modification = $BookingRS['modificationPolicies']['@attributes']['modification'];
                    $LeaderTitle = '';
                    $LeaderFirstName = addslashes(utf8_encode($BookingRS['holder']['@attributes']['surname']));
                    $LeaderLastName = addslashes(utf8_encode($BookingRS['holder']['@attributes']['name']));
                    $HotelRS = $BookingRS['hotel'];
                    $CheckInDate = $HotelRS['@attributes']['checkIn'];
                    $CheckOutDate = $HotelRS['@attributes']['checkOut'];
                    $SelectedNights = dateDiffNBHB($CheckInDate, $CheckOutDate);
                    $LocalHotelId = $HotelRS['@attributes']['code'];
                    $HotelName = addslashes(utf8_encode($HotelRS['@attributes']['name']));
                    $CategoryCode = $HotelRS['@attributes']['categoryCode'];
                    $CategoryName = addslashes(utf8_encode($HotelRS['@attributes']['categoryName']));
                    $DestinationCode = $HotelRS['@attributes']['destinationCode'];
                    $CountryName = addslashes(utf8_encode($HotelRS['@attributes']['destinationName']));
                    $CityId = $HotelRS['@attributes']['zoneCode'];
                    $CityName = addslashes(utf8_encode($HotelRS['@attributes']['zoneName']));
                    $Latitude = $HotelRS['@attributes']['latitude'];
                    $Longitude = $HotelRS['@attributes']['longitude'];
                    if (isset($_SESSION['HotelDetailsRS'][$LocalHotelId]['hotel']['address'])) {
                        $Address = $_SESSION['HotelDetailsRS'][$LocalHotelId]['hotel']['address'];
                    } else {
                        $Address = '';
                    }
                    $Address = addslashes(utf8_encode($Address));
                    $hotelPhone = '';
                    if (isset($_SESSION['HotelDetailsRS'][$LocalHotelId]['hotel']['phones'])) {
                        $Phones = $_SESSION['HotelDetailsRS'][$LocalHotelId]['hotel']['phones'];
                        if (isset($Phones['phone'])) {
                            $phone = $Phones['phone'];
                            $hotelPhone = '';
                            if (isset($phone[0])) {
                                foreach ($phone as $value) {
                                    $hotelPhone .= $value['phoneType'] . ' : ' . $value['phoneNumber'] . ' \n';
                                }
                            } else {
                                $hotelPhone .= $value['phoneType'] . ' : ' . $value['phoneNumber'] . ' \n';
                            }
                        }
                    } else {
                        $Phones = '';
                    }
                    $SupplierName = $HotelRS['supplier']['@attributes']['name'];
                    $SupplierVatNumber = $HotelRS['supplier']['@attributes']['vatNumber'];
                    $Remark = addslashes(utf8_encode($Remarks));
                    $Convertion = $EUREXCH;
                    $INSERT = $site->ResaBookingHB($Id, $BookingReference, $TotalCharges, $TotalMarkup, $Convertion, $LeaderTitle, $LeaderFirstName, $LeaderLastName, $CurrencyCode, $LocalHotelId, $HotelName, $CountryName, $CityName, $CityId, $CategoryCode, $CategoryName, $DestinationCode, $Latitude, $Longitude, $Address, $hotelPhone, $CurrentStatus, $TotalAdults, $TotalChildren, $TotalRooms, $CheckInDate, $CheckOutDate, $GrossAmount, $SelectedNights, $StartTime, $EndTime, $BookingServiceType, $PidAgence, $PidAgent, $CreationUser, $PendingAmount, $Cancellation, $Modification, $SupplierName, $SupplierVatNumber, $Remark);
                    $SELECT = $site->SelectLastObjectTable('booking', 'pid', 'DESC');
                    $PidBooking = $SELECT->pid;
                    $RoomsRS = $HotelRS['rooms']['room'];
                    if (isset($RoomsRS[0])) {
                        foreach ($RoomsRS as $key => $RoomRS) {
                            $Roomstatus = $RoomRS['@attributes']['status'];
                            $RoomId = $RoomRS['@attributes']['id'];
                            $RoomCode = $RoomRS['@attributes']['code'];
                            $RoomName = addslashes(utf8_encode($RoomRS['@attributes']['name']));
                            $INSERT = $site->ResaBookingRoomsHB($RoomName, $RoomCode, $Roomstatus, $PidBooking, $RoomId);
                            $SELECT = $site->SelectLastObjectTable('bookingrooms', 'pid', 'DESC');
                            $PidRoom = $SELECT->pid;
                            $RoomPaxes = $RoomRS['paxes']['pax'];
                            if (isset($RoomPaxes[0])) {
                                foreach ($RoomPaxes as $key => $RoomPax) {
                                    $Roomid = $RoomPax['@attributes']['roomId'];
                                    $RoomType = $RoomPax['@attributes']['type'];
                                    if ($RoomType == 'AD') {
                                        $RoomType = 'adult';
                                    } elseif ($RoomType == 'CH') {
                                        $RoomType = 'child';
                                    }
                                    if (isset($RoomPax['@attributes']['name'])) {
                                        $RoomLastName = addslashes(utf8_encode($RoomPax['@attributes']['name']));
                                        $RoomFirstName = addslashes(utf8_encode($RoomPax['@attributes']['surname']));
                                        $RoomAge = 0;
                                        if (isset($RoomPax['@attributes']['age'])) {
                                            $RoomAge = $RoomPax['@attributes']['age'];
                                        }
                                        $INSERT = $site->ResaBookingRoomHB($RoomFirstName, $RoomLastName, $RoomType, $RoomAge, $PidRoom, $Roomid);
                                    }
                                }
                            } else {
                                $Roomid = $RoomPaxes['@attributes']['roomId'];
                                $RoomType = $RoomPaxes['@attributes']['type'];
                                if ($RoomType == 'AD') {
                                    $RoomType = 'adult';
                                } elseif ($RoomType == 'CH') {
                                    $RoomType = 'child';
                                }
                                if (isset($RoomPaxes['@attributes']['name'])) {
                                    $RoomLastName = addslashes(utf8_encode($RoomPaxes['@attributes']['name']));
                                    $RoomFirstName = addslashes(utf8_encode($RoomPaxes['@attributes']['surname']));
                                    $RoomAge = 0;
                                    if (isset($RoomPaxes['@attributes']['age'])) {
                                        $RoomAge = $RoomPaxes['@attributes']['age'];
                                    }
                                    $INSERT = $site->ResaBookingRoomHB($RoomFirstName, $RoomLastName, $RoomType, $RoomAge, $PidRoom, $Roomid);
                                }
                            }
                            $RoomRates = $RoomRS['rates']['rate'];
                            if (isset($RoomRates[0])) {
                                foreach ($RoomRates as $key => $RoomRate) {
                                    $rateClass = $RoomRate['@attributes']['rateClass'];
                                    $rateNet = $RoomRate['@attributes']['net'];
                                    $rateSelling = $RoomRate['@attributes']['sellingRate'];
                                    $rateHotel = $RoomRate['@attributes']['hotelMandatory'];
                                    $rateComments = addslashes(utf8_encode($RoomRate['@attributes']['rateComments']));
                                    $ratePaymentType = $RoomRate['@attributes']['paymentType'];
                                    $ratePackaging = $RoomRate['@attributes']['packaging'];
                                    $rateBoardCode = $RoomRate['@attributes']['boardCode'];
                                    $rateBoardName = addslashes(utf8_encode($RoomRate['@attributes']['boardName']));
                                    $rateRooms = $RoomRate['@attributes']['rooms'];
                                    $rateAdults = $RoomRate['@attributes']['adults'];
                                    $rateChildren = $RoomRate['@attributes']['children'];
                                    $INSERT = $site->ResaBookingRoomRatesHB($rateClass, $rateNet, $rateSelling, $rateHotel, $rateComments, $ratePaymentType, $ratePackaging, $rateBoardCode, $rateBoardName, $rateRooms, $rateAdults, $rateChildren, $PidRoom);
                                    $SELECT = $site->SelectLastObjectTable('bookingroomrates', 'pid', 'DESC');
                                    $PidRates = $SELECT->pid;
                                    $cancellationPolicy = $RoomRates['cancellationPolicies']['cancellationPolicy'];
                                    if (!isset($cancellationPolicy[0])) {
                                        $cancellationAmount = $cancellationPolicy['@attributes']['amount'];
                                        $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                        $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH ) ;
                                        $cancellationFrom = $cancellationPolicy['@attributes']['from'];
                                        $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                    } else {
                                        foreach ($cancellationPolicy as $cancellationPolicys) {
                                            $cancellationAmount = $cancellationPolicys['@attributes']['amount'];
                                            $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                            $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                            $cancellationFrom = $cancellationPolicys['@attributes']['from'];
                                            $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                        }
                                    }
                                    $RoomTaxes = $RoomRate['taxes'];
                                    $RoomTaxesIncluded = $RoomTaxes['@attributes']['allIncluded'];
                                    $RoomTax = $RoomTaxes['tax'];
                                    $RoomTaxIncluded = $RoomTax['@attributes']['included'];
                                    $RoomTaxAmount = $RoomTax['@attributes']['amount'];
                                    $RoomTaxCurrency = $RoomTax['@attributes']['included'];
                                    $INSERT = $site->ResaBookingRoomTaxesHB($RoomTaxesIncluded, $RoomTaxIncluded, $RoomTaxAmount, $RoomTaxCurrency, $PidRates);
                                    if (isset($RoomRates['rateBreakDown'])) {
                                        $rateBreakDown = $RoomRates['rateBreakDown'];
                                        if (isset($rateBreakDown['rateSupplements'])) {
                                            $rateSupplements = $rateBreakDown['rateSupplements'];
                                            $rateSupplement = $rateSupplements['rateSupplement'];
                                            if (isset($rateSupplement['@attributes'])) {
                                                $rateSupplementCode = $rateSupplement['@attributes']['code'];
                                                $rateSupplementName = addslashes(utf8_encode($rateSupplement['@attributes']['name']));
                                                $rateSupplementFrom = $rateSupplement['@attributes']['from'];
                                                $rateSupplementTo = $rateSupplement['@attributes']['to'];
                                                $rateSupplementAmount = $rateSupplement['@attributes']['amount'];
                                                $rateDiscountNights = $rateSupplement['@attributes']['nights'];
                                                $rateDiscountPax = $rateSupplement['@attributes']['paxNumber'];
                                            } else {
                                                $rateSupplementCode = '';
                                                $rateSupplementName = '';
                                                $rateSupplementFrom = '';
                                                $rateSupplementTo = '';
                                                $rateSupplementAmount = '';
                                                $rateDiscountNights = '';
                                                $rateDiscountPax = '';
                                            }
                                        } else {
                                            $rateSupplementCode = '';
                                            $rateSupplementName = '';
                                            $rateSupplementFrom = '';
                                            $rateSupplementTo = '';
                                            $rateSupplementAmount = '';
                                            $rateDiscountNights = '';
                                            $rateDiscountPax = '';
                                        }
                                        if (isset($rateBreakDown['rateDiscounts'])) {
                                            $rateDiscounts = $rateBreakDown['rateDiscounts'];
                                            $rateDiscount = $rateDiscounts['rateDiscount'];
                                            if (isset($rateDiscount[0])) {
                                                foreach ($rateDiscount as $key => $RateDiscount) {
                                                    $rateDiscountCode = $RateDiscount['@attributes']['code'];
                                                    $rateDiscountName = addslashes(utf8_encode($RateDiscount['@attributes']['name']));
                                                    $rateDiscountAmount = $RateDiscount['@attributes']['amount'];
    
                                                    $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                                }
                                            } else {
                                                $rateDiscountCode = $rateDiscount['@attributes']['code'];
                                                $rateDiscountName = addslashes(utf8_encode($rateDiscount['@attributes']['name']));
                                                $rateDiscountAmount = $rateDiscount['@attributes']['amount'];
    
                                                $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                            }
                                        }
                                    }
                                }
                            } else {
                                $rateClass = $RoomRates['@attributes']['rateClass'];
                                $rateNet = $RoomRates['@attributes']['net'];
                                $rateSelling = $RoomRates['@attributes']['sellingRate'];
                                $rateHotel = $RoomRates['@attributes']['hotelMandatory'];
                                $rateComments = utf8_encode(addslashes($RoomRates['@attributes']['rateComments']));
                                $ratePaymentType = $RoomRates['@attributes']['paymentType'];
                                $ratePackaging = $RoomRates['@attributes']['packaging'];
                                $rateBoardCode = $RoomRates['@attributes']['boardCode'];
                                $rateBoardName = addslashes(utf8_encode($RoomRates['@attributes']['boardName']));
                                $rateRooms = $RoomRates['@attributes']['rooms'];
                                $rateAdults = $RoomRates['@attributes']['adults'];
                                $rateChildren = $RoomRates['@attributes']['children'];
                                $INSERT = $site->ResaBookingRoomRatesHB($rateClass, $rateNet, $rateSelling, $rateHotel, $rateComments, $ratePaymentType, $ratePackaging, $rateBoardCode, $rateBoardName, $rateRooms, $rateAdults, $rateChildren, $PidRoom);
                                $SELECT = $site->SelectLastObjectTable('bookingroomrates', 'pid', 'DESC');
                                $PidRates = $SELECT->pid;
                                $cancellationPolicy = $RoomRates['cancellationPolicies']['cancellationPolicy'];
                                if (!isset($cancellationPolicy[0])) {
                                    $cancellationAmount = $cancellationPolicy['@attributes']['amount'];
                                    $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                    $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                    $cancellationFrom = $cancellationPolicy['@attributes']['from'];
                                    $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                } else {
                                    foreach ($cancellationPolicy as $cancellationPolicys) {
                                        $cancellationAmount = $cancellationPolicys['@attributes']['amount'];
                                        $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                        $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                        $cancellationFrom = $cancellationPolicys['@attributes']['from'];
                                        $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                    }
                                }
                                $RoomTaxes = $RoomRates['taxes'];
                                $RoomTaxesIncluded = $RoomTaxes['@attributes']['allIncluded'];
                                $RoomTax = $RoomTaxes['tax'];
                                $RoomTaxIncluded = $RoomTax['@attributes']['included'];
                                $RoomTaxAmount = $RoomTax['@attributes']['amount'];
                                $RoomTaxCurrency = $RoomTax['@attributes']['included'];
                                $INSERT = $site->ResaBookingRoomTaxesHB($RoomTaxesIncluded, $RoomTaxIncluded, $RoomTaxAmount, $RoomTaxCurrency, $PidRates);
                                if (isset($RoomRates['rateBreakDown'])) {
                                    $rateBreakDown = $RoomRates['rateBreakDown'];
                                    if (isset($rateBreakDown['rateSupplements'])) {
                                        $rateSupplements = $rateBreakDown['rateSupplements'];
                                        $rateSupplement = $rateSupplements['rateSupplement'];
                                        if (isset($rateSupplement['@attributes'])) {
                                            $rateSupplementCode = $rateSupplement['@attributes']['code'];
                                            $rateSupplementName = addslashes(utf8_encode($rateSupplement['@attributes']['name']));
                                            $rateSupplementFrom = $rateSupplement['@attributes']['from'];
                                            $rateSupplementTo = $rateSupplement['@attributes']['to'];
                                            $rateSupplementAmount = $rateSupplement['@attributes']['amount'];
                                            $rateDiscountNights = $rateSupplement['@attributes']['nights'];
                                            $rateDiscountPax = $rateSupplement['@attributes']['paxNumber'];
                                        } else {
                                            $rateSupplementCode = '';
                                            $rateSupplementName = '';
                                            $rateSupplementFrom = '';
                                            $rateSupplementTo = '';
                                            $rateSupplementAmount = '';
                                            $rateDiscountNights = '';
                                            $rateDiscountPax = '';
                                        }
                                    } else {
                                        $rateSupplementCode = '';
                                        $rateSupplementName = '';
                                        $rateSupplementFrom = '';
                                        $rateSupplementTo = '';
                                        $rateSupplementAmount = '';
                                        $rateDiscountNights = '';
                                        $rateDiscountPax = '';
                                    }
                                    if (isset($rateBreakDown['rateDiscounts'])) {
                                        $rateDiscounts = $rateBreakDown['rateDiscounts'];
                                        $rateDiscount = $rateDiscounts['rateDiscount'];
                                        if (isset($rateDiscount[0])) {
                                            foreach ($rateDiscount as $key => $RateDiscount) {
                                                $rateDiscountCode = $RateDiscount['@attributes']['code'];
                                                $rateDiscountName = addslashes(utf8_encode($RateDiscount['@attributes']['name']));
                                                $rateDiscountAmount = $RateDiscount['@attributes']['amount'];
    
                                                $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                            }
                                        } else {
                                            $rateDiscountCode = $rateDiscount['@attributes']['code'];
                                            $rateDiscountName = addslashes(utf8_encode($rateDiscount['@attributes']['name']));
                                            $rateDiscountAmount = $rateDiscount['@attributes']['amount'];
    
                                            $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $Roomstatus = $RoomsRS['@attributes']['status'];
                        $RoomId = $RoomsRS['@attributes']['id'];
                        $RoomCode = $RoomsRS['@attributes']['code'];
                        $RoomName = addslashes(utf8_encode($RoomsRS['@attributes']['name']));
                        $INSERT = $site->ResaBookingRoomsHB($RoomName, $RoomCode, $Roomstatus, $PidBooking, $RoomId);
                        $SELECT = $site->SelectLastObjectTable('bookingrooms', 'pid', 'DESC');
                        $PidRoom = $SELECT->pid;
                        $RoomPaxes = $RoomsRS['paxes']['pax'];
                        if (isset($RoomPaxes[0])) {
                            foreach ($RoomPaxes as $key => $RoomPax) {
                                $Roomid = $RoomPax['@attributes']['roomId'];
                                $RoomType = $RoomPax['@attributes']['type'];
                                if ($RoomType == 'AD') {
                                    $RoomType = 'adult';
                                } elseif ($RoomType == 'CH') {
                                    $RoomType = 'child';
                                }
                                if (isset($RoomPax['@attributes']['name'])) {
                                    $RoomLastName = addslashes(utf8_encode($RoomPax['@attributes']['name']));
                                    $RoomFirstName = addslashes(utf8_encode($RoomPax['@attributes']['surname']));
                                    $RoomAge = 0;
                                    if (isset($RoomPax['@attributes']['age'])) {
                                        $RoomAge = $RoomPax['@attributes']['age'];
                                    }
                                    $INSERT = $site->ResaBookingRoomHB($RoomFirstName, $RoomLastName, $RoomType, $RoomAge, $PidRoom, $Roomid);
                                }
                            }
                        } else {
                            $Roomid = $RoomPaxes['@attributes']['roomId'];
                            $RoomType = $RoomPaxes['@attributes']['type'];
                            if ($RoomType == 'AD') {
                                $RoomType = 'adult';
                            } elseif ($RoomType == 'CH') {
                                $RoomType = 'child';
                            }
                            if (isset($RoomPaxes['@attributes']['name'])) {
                                $RoomLastName = addslashes(utf8_encode($RoomPaxes['@attributes']['name']));
                                $RoomFirstName = addslashes(utf8_encode($RoomPaxes['@attributes']['surname']));
                                $RoomAge = 0;
                                if (isset($RoomPaxes['@attributes']['age'])) {
                                    $RoomAge = $RoomPaxes['@attributes']['age'];
                                }
                                $INSERT = $site->ResaBookingRoomHB($RoomFirstName, $RoomLastName, $RoomType, $RoomAge, $PidRoom, $Roomid);
                            }
                        }
                        $RoomRates = $RoomsRS['rates']['rate'];
                        if (isset($RoomRates[0])) {
                            foreach ($RoomRates as $key => $RoomRate) {
                                $rateClass = $RoomRate['@attributes']['rateClass'];
                                $rateNet = $RoomRate['@attributes']['net'];
                                $rateSelling = $RoomRate['@attributes']['sellingRate'];
                                $rateHotel = $RoomRate['@attributes']['hotelMandatory'];
                                $rateComments = utf8_encode(addslashes($RoomRate['@attributes']['rateComments']));
                                $ratePaymentType = $RoomRate['@attributes']['paymentType'];
                                $ratePackaging = $RoomRate['@attributes']['packaging'];
                                $rateBoardCode = $RoomRate['@attributes']['boardCode'];
                                $rateBoardName = addslashes(utf8_encode($RoomRate['@attributes']['boardName']));
                                $rateRooms = $RoomRate['@attributes']['rooms'];
                                $rateAdults = $RoomRate['@attributes']['adults'];
                                $rateChildren = $RoomRate['@attributes']['children'];
                                $INSERT = $site->ResaBookingRoomRatesHB($rateClass, $rateNet, $rateSelling, $rateHotel, $rateComments, $ratePaymentType, $ratePackaging, $rateBoardCode, $rateBoardName, $rateRooms, $rateAdults, $rateChildren, $PidRoom);
                                $SELECT = $site->SelectLastObjectTable('bookingroomrates', 'pid', 'DESC');
                                $PidRates = $SELECT->pid;
                                $cancellationPolicy = $RoomRates['cancellationPolicies']['cancellationPolicy'];
                                if (!isset($cancellationPolicy[0])) {
                                    $cancellationAmount = $cancellationPolicy['@attributes']['amount'];
                                    $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                    $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                    $cancellationFrom = $cancellationPolicy['@attributes']['from'];
                                    $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                } else {
                                    foreach ($cancellationPolicy as $cancellationPolicys) {
                                        $cancellationAmount = $cancellationPolicys['@attributes']['amount'];
                                        $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                        $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                        $cancellationFrom = $cancellationPolicys['@attributes']['from'];
                                        $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                    }
                                }
                                $RoomTaxes = $RoomRate['taxes'];
                                $RoomTaxesIncluded = $RoomTaxes['@attributes']['allIncluded'];
                                $RoomTax = $RoomTaxes['tax'];
                                $RoomTaxIncluded = $RoomTax['@attributes']['included'];
                                $RoomTaxAmount = $RoomTax['@attributes']['amount'];
                                $RoomTaxCurrency = $RoomTax['@attributes']['included'];
                                $INSERT = $site->ResaBookingRoomTaxesHB($RoomTaxesIncluded, $RoomTaxIncluded, $RoomTaxAmount, $RoomTaxCurrency, $PidRates);
                                if (isset($RoomRates['rateBreakDown'])) {
                                    $rateBreakDown = $RoomRates['rateBreakDown'];
                                    if (isset($rateBreakDown['rateSupplements'])) {
                                        $rateSupplements = $rateBreakDown['rateSupplements'];
                                        $rateSupplement = $rateSupplements['rateSupplement'];
                                        if (isset($rateSupplement['@attributes'])) {
                                            $rateSupplementCode = $rateSupplement['@attributes']['code'];
                                            $rateSupplementName = addslashes(utf8_encode($rateSupplement['@attributes']['name']));
                                            $rateSupplementFrom = $rateSupplement['@attributes']['from'];
                                            $rateSupplementTo = $rateSupplement['@attributes']['to'];
                                            $rateSupplementAmount = $rateSupplement['@attributes']['amount'];
                                            $rateDiscountNights = $rateSupplement['@attributes']['nights'];
                                            $rateDiscountPax = $rateSupplement['@attributes']['paxNumber'];
                                        } else {
                                            $rateSupplementCode = '';
                                            $rateSupplementName = '';
                                            $rateSupplementFrom = '';
                                            $rateSupplementTo = '';
                                            $rateSupplementAmount = '';
                                            $rateDiscountNights = '';
                                            $rateDiscountPax = '';
                                        }
                                    } else {
                                        $rateSupplementCode = '';
                                        $rateSupplementName = '';
                                        $rateSupplementFrom = '';
                                        $rateSupplementTo = '';
                                        $rateSupplementAmount = '';
                                        $rateDiscountNights = '';
                                        $rateDiscountPax = '';
                                    }
                                    if (isset($rateBreakDown['rateDiscounts'])) {
                                        $rateDiscounts = $rateBreakDown['rateDiscounts'];
                                        $rateDiscount = $rateDiscounts['rateDiscount'];
                                        if (isset($rateDiscount[0])) {
                                            foreach ($rateDiscount as $key => $RateDiscount) {
                                                $rateDiscountCode = $RateDiscount['@attributes']['code'];
                                                $rateDiscountName = addslashes(utf8_encode($RateDiscount['@attributes']['name']));
                                                $rateDiscountAmount = $RateDiscount['@attributes']['amount'];
                                                $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                            }
                                        } else {
                                            $rateDiscountCode = $rateDiscount['@attributes']['code'];
                                            $rateDiscountName = addslashes(utf8_encode($rateDiscount['@attributes']['name']));
                                            $rateDiscountAmount = $rateDiscount['@attributes']['amount'];
                                            $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                        }
                                    }
                                }
                            }
                        } else {
                            $rateClass = $RoomRates['@attributes']['rateClass'];
                            $rateNet = $RoomRates['@attributes']['net'];
                            $rateSelling = 0;
                            if (isset($RoomRates['@attributes']['sellingRate'])) {
                                $rateSelling = $RoomRates['@attributes']['sellingRate'];
                            }
                            $rateHotel = 0;
                            if (isset($RoomRates['@attributes']['hotelMandatory'])) {
                                $rateHotel = $RoomRates['@attributes']['hotelMandatory'];
                            }
                            $rateComments = utf8_encode(addslashes($RoomRates['@attributes']['rateComments']));
                            $ratePaymentType = $RoomRates['@attributes']['paymentType'];
                            $ratePackaging = $RoomRates['@attributes']['packaging'];
                            $rateBoardCode = $RoomRates['@attributes']['boardCode'];
                            $rateBoardName = addslashes(utf8_encode($RoomRates['@attributes']['boardName']));
                            $rateRooms = $RoomRates['@attributes']['rooms'];
                            $rateAdults = $RoomRates['@attributes']['adults'];
                            $rateChildren = $RoomRates['@attributes']['children'];
                            $INSERT = $site->ResaBookingRoomRatesHB($rateClass, $rateNet, $rateSelling, $rateHotel, $rateComments, $ratePaymentType, $ratePackaging, $rateBoardCode, $rateBoardName, $rateRooms, $rateAdults, $rateChildren, $PidRoom);
                            $SELECT = $site->SelectLastObjectTable('bookingroomrates', 'pid', 'DESC');
                            $PidRates = $SELECT->pid;
                            $cancellationPolicy = $RoomRates['cancellationPolicies']['cancellationPolicy'];
                            if (!isset($cancellationPolicy[0])) {
                                $cancellationAmount = $cancellationPolicy['@attributes']['amount'];
                                $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                $cancellationFrom = $cancellationPolicy['@attributes']['from'];
                                $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                            } else {
                                foreach ($cancellationPolicy as $cancellationPolicys) {
                                    $cancellationAmount = $cancellationPolicys['@attributes']['amount'];
                                    $cancellationAmount=$cancellationAmount*$_SESSION['MARPER'];
                                    $cancellationAmountDevise =  ($cancellationAmount * $EUREXCH );
                                    $cancellationFrom = $cancellationPolicys['@attributes']['from'];
                                    $INSERT = $site->ResaBookingRoomCancelPolicyHB($cancellationAmount , $cancellationFrom, $PidRates, $PidBooking,$cancellationAmountDevise,$DEVISE);
                                }
                            }
                            if (isset($RoomRates['taxes'])) {
                                $RoomTaxes = $RoomRates['taxes'];
                                $RoomTaxesIncluded = $RoomTaxes['@attributes']['allIncluded'];
                                $RoomTax = $RoomTaxes['tax'];
                                $RoomTaxIncluded = $RoomTax['@attributes']['included'];
                                $RoomTaxAmount = $RoomTax['@attributes']['amount'];
                                $RoomTaxCurrency = $RoomTax['@attributes']['included'];
    
                                $INSERT = $site->ResaBookingRoomTaxesHB($RoomTaxesIncluded, $RoomTaxIncluded, $RoomTaxAmount, $RoomTaxCurrency, $PidRates);
                            }
                            if (isset($RoomRates['rateBreakDown'])) {
                                $rateBreakDown = $RoomRates['rateBreakDown'];
                                if (isset($rateBreakDown['rateSupplements'])) {
                                    $rateSupplements = $rateBreakDown['rateSupplements'];
                                    $rateSupplement = $rateSupplements['rateSupplement'];
                                    if (isset($rateSupplement['@attributes'])) {
                                        $rateSupplementCode = $rateSupplement['@attributes']['code'];
                                        $rateSupplementName = addslashes(utf8_encode($rateSupplement['@attributes']['name']));
                                        $rateSupplementFrom = $rateSupplement['@attributes']['from'];
                                        $rateSupplementTo = $rateSupplement['@attributes']['to'];
                                        $rateSupplementAmount = $rateSupplement['@attributes']['amount'];
                                        $rateDiscountNights = $rateSupplement['@attributes']['nights'];
                                        $rateDiscountPax = $rateSupplement['@attributes']['paxNumber'];
                                    } else {
                                        $rateSupplementCode = '';
                                        $rateSupplementName = '';
                                        $rateSupplementFrom = '';
                                        $rateSupplementTo = '';
                                        $rateSupplementAmount = '';
                                        $rateDiscountNights = '';
                                        $rateDiscountPax = '';
                                    }
                                } else {
                                    $rateSupplementCode = '';
                                    $rateSupplementName = '';
                                    $rateSupplementFrom = '';
                                    $rateSupplementTo = '';
                                    $rateSupplementAmount = '';
                                    $rateDiscountNights = '';
                                    $rateDiscountPax = '';
                                }
                                if (isset($rateBreakDown['rateDiscounts'])) {
                                    $rateDiscounts = $rateBreakDown['rateDiscounts'];
                                    $rateDiscount = $rateDiscounts['rateDiscount'];
                                    if (isset($rateDiscount[0])) {
                                        foreach ($rateDiscount as $key => $RateDiscount) {
                                            $rateDiscountCode = $RateDiscount['@attributes']['code'];
                                            $rateDiscountName = addslashes(utf8_encode($RateDiscount['@attributes']['name']));
                                            $rateDiscountAmount = $RateDiscount['@attributes']['amount'];
                                            $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                        }
                                    } else {
                                        $rateDiscountCode = $rateDiscount['@attributes']['code'];
                                        $rateDiscountName = addslashes(utf8_encode($rateDiscount['@attributes']['name']));
                                        $rateDiscountAmount = $rateDiscount['@attributes']['amount'];
                                        $INSERT = $site->ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates);
                                    }
                                }
                            }
                        }
                    }
                    
                    unset($_SESSION['RR']);
                    unset($_SESSION['HotelBedsAvailabilityRS']);
                    unset($_SESSION['HotelDetailsRS']);
                    unset($_SESSION['RoomBookingRS']);
                    unset($_SESSION['RoomsRatePrices']);
                    unset($_SESSION['Rooms']);
                    unset($_SESSION['ROOM']);
                    unset($_SESSION['CurrentRoom']);
                    unset($_SESSION['RoomsRateKey']);
                    unset($_SESSION['CheckRoomRateKey']);
                    unset($_SESSION['TotalBookingAmount']);
                    echo 'DONE';
                }
         
       
    }

} catch(\Stripe\Error\Card $e) {
    die($e->return);
}

?>