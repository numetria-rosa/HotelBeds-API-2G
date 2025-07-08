<?php
$hotelBedsEndPoint = "https://api.test.hotelbeds.com";



$ApiKey = "xxxxxxxxxxxxxxxxxxxxxxxxx";
$Secret = "xxxxxxxxxxx";







function XSIGNATURE($ApiKey, $Secret)
{
    $signature = hash("sha256", $ApiKey . $Secret . time());
    return $signature;
}

$XSIGNATURE = XSIGNATURE($ApiKey, $Secret);

use Monolog\Logger;
use Monolog\Handler\StreamHandler;



function HotelsContentSearch($destinationCode)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/hotels?fields=name,countryCode,destinationCode,zoneCode&destinationCode=" . $destinationCode . "&language=ENG". "&segmentCodes=36",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        return $array;
    }
}



function CurrencyRequestHB()
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/types/currencies?fields=all&language=ENG&from=1&to=500&useSecondaryLanguage=false",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['CurrencyRequestHB'] = $array;
        return $array;
    }
}

function CountryRequestHB()
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/locations/countries?fields=all&codes=&language=ENG&from=0&to=250&useSecondaryLanguage=false",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsCountries Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('/hotel-content-api/1.0/locations/countries?fields=all&codes=&language=ENG&from=0&to=250&useSecondaryLanguage=false');
    $msgLog = new Logger('HotelBedsCountries Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['CountryRequestHB'] = $array;
        return $array;
    }
}

function CityRequestHB($isoCode)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/locations/destinations?fields=all&countryCodes=" . $isoCode . "&language=ENG&from=1&to=1000&useSecondaryLanguage=false",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);



    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);

        $_SESSION['CityRequestHB'] = $array;
        return $array;
    }
}

function HotelsRequestHB($isoCode, $cityCode, $lStart, $lEnd)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/hotels?fields=code,name,images,address,description,postalCode,city&destinationCode=" . $cityCode . "&countryCode=" . $isoCode . "&language=ENG&from=" . $lStart . "&to=" . $lEnd . "&useSecondaryLanguage=True"."&segmentCodes=36",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsHotels Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info("/hotel-content-api/1.0/hotels?fields=code,name&destinationCode=" . $cityCode . "&countryCode=" . $isoCode . "&language=ENG&from=" . $lStart . "&to=" . $lEnd . "&useSecondaryLanguage=false");
    $msgLog = new Logger('HotelBedsHotels Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
      
        $_SESSION['HotelsRequestHB'] = $array;
        return $array;
    }
}

function HotelsSearchHB($Stay, $Occupancy, $Hotel, $filter)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    
    // Adding segment filter for golf hotels (code 36)
  //  $segmentFilter = '<filter><segments><segment code="36"/></segments></filter>';
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.0/hotels",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '<availabilityRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" dailyRate="true" language="ENG">' 
        . $Stay 
        . '<occupancies>' . $Occupancy . '</occupancies>' 
      //  . $segmentFilter   // Adding the segment filter here
        . '<hotels>' . $Hotel . '</hotels></availabilityRQ>',
        CURLOPT_HTTPHEADER => array(
            "accept: application/xml",
            "accept-encoding: gzip",
            "Api-key: " . $ApiKey,
            "cache-control: no-cache",
            "content-type: application/xml",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsAvailability Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('<availabilityRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" dailyRate="true" language="ENG">' . $Stay . '<occupancies>' . $Occupancy . '</occupancies>' . '<hotels>' . $Hotel . '</hotels></availabilityRQ>');
    $msgLog = new Logger('HotelBedsAvailability Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
        // Handle error
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['HotelBedsAvailabilityRS'] = $array;
    }
}

function HotelsSearchHBIndex($Stay, $Occupancy, $Hotel, $filter)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();

    // Adding segment filter for golf hotels (code 36)
   // $segmentFilter = '<filter><segments><segment code="36"/></segments></filter>';
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.0/hotels",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '<availabilityRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" dailyRate="true" language="ENG">'
        . $Stay 
        . '<occupancies>' . $Occupancy . '</occupancies>' 
       // . $segmentFilter   // Adding the segment filter here
        . '<hotels>' . $Hotel . '</hotels></availabilityRQ>',
        CURLOPT_HTTPHEADER => array(
            "accept: application/xml",
            "accept-encoding: gzip",
            "Api-key: " . $ApiKey,
            "cache-control: no-cache",
            "content-type: application/xml",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        // Handle error
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['HotelBedsAvailabilityRSIndex'] = $array;
    }
}

function HotelDetails($Hotel)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/hotels/" . $Hotel . "?language=ENG&useSecondaryLanguage=False",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);



    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);

        $array = json_decode($json, TRUE);
           
        $_SESSION['HotelDetailsRS'][$Hotel] = $array;

        return $array['hotel'];
    }
}

function RoomCheckRate($RRK)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.0/checkrates",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '<checkRateRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" language="ENG" upselling="False"><rooms>' . $RRK . '</rooms></checkRateRQ>',
        CURLOPT_HTTPHEADER => array(
            "accept-encoding: gzip",
            "content-type: application/xml",
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsCheckrates Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('<checkRateRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" language="ENG" upselling="False"><rooms>' . $RRK . '</rooms></checkRateRQ>');
    $msgLog = new Logger('HotelBedsCheckrates Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['CheckRoomRateKey'] = $array;
    }
}

function createBookingHB($HolderName, $HolderSurname, $BookingReference, $RRK, $RRKS)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.2/bookings",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '<bookingRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" language="ENG"><holder name="' . $HolderName . '" surname="' . $HolderSurname . '"/><clientReference>' . $BookingReference . '</clientReference><rooms>' . $RRK . '</rooms><remark>' . $RRKS . '</remark></bookingRQ>',
        CURLOPT_HTTPHEADER => array(
            "accept-encoding: gzip",
            "content-type: application/xml",
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsBooking Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('<bookingRQ xmlns="http://www.hotelbeds.com/schemas/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" language="ENG"><holder name="' . $HolderName . '" surname="' . $HolderSurname . '"/><clientReference>' . $BookingReference . '</clientReference><rooms>' . $RRK . '</rooms><remark>' . $RRKS . '</remark></bookingRQ>');
    $msgLog = new Logger('HotelBedsBooking Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);

        $_SESSION['RoomBookingRS'] = $array;
    }
}

function CancelBookingHB($Id)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.0/bookings/" . $Id . "?cancellationFlag=CANCELLATION&language=ENG",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => array(
            "accept-encoding: gzip",
            "content-type: application/xml",
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsBookingCancel Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('/hotel-api/1.0/bookings/' . $Id . '?cancellationFlag=CANCELLATION&language=ENG');
    $msgLog = new Logger('HotelBedsBookingCancel Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);


    $curl2 = curl_init();
    curl_setopt_array($curl2, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.0/bookings/" . $Id . "",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "accept-encoding: gzip",
            "content-type: application/xml",
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response2 = curl_exec($curl2);
    $err2 = curl_error($curl2);

    $msgLog = new Logger('HotelBedsBookingDetail Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('/hotel-api/1.0/bookings/' . $Id . '');
    $msgLog = new Logger('HotelBedsBookingDetail Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response2);

    curl_close($curl);
    curl_close($curl2);

    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['conditionAnnulationHB'] = $array;
        if (isset($array['error']['message'])) {
            $Error = $array['error']['message'];
            $Error = str_replace('Invalid data. ', '', $Error);
            $Pos = strpos($Error, 'CancellationToken');
            if ($Pos === false) {
            } else {
                $Error = substr($Error, 0, $Pos);
            }
            echo '<strong class="dark-blue-color">';
            print_r($Error);
            echo '</strong>';
        } elseif (isset($array['booking'])) {
            $Result = $array['booking'];
            $xml2 = ($response2);
            $xml_string2 = simplexml_load_string($xml2);
            $json2 = json_encode($xml_string2);
            $array2 = json_decode($json2, TRUE);
            $_SESSION['BookingDetails'] = $array2;
            $Result2 = $array2['booking'];

            if (isset($Result['modificationPolicies'])) {
                if (isset($Result['modificationPolicies']['@attributes'])) {
                    $site = new SITE();
                    $PidAgence = $_SESSION['USER']['id'];
                    $CurrentCredit = $_SESSION['USER']['credit'];
                    $BOOKING = $site->SelectObjectTableWC('booking', 'id', $Id, 'pid', 'ASC');
                    if ($Result2['@attributes']['pendingAmount'] == '0.00') {
                        $GrossAmount = $BOOKING->grossamount;
                        $CREDIT = $CurrentCredit + $GrossAmount;
                        $UpdateCredit = $site->updateAgenceCredit($PidAgence, $CREDIT);
                        $_SESSION['AGENCE'] = $site->SelectObjectTableWC('user', 'id', $PidAgence, 'id', 'ASC');
                    } else {
                        $pendingAmount = $Result2['@attributes']['pendingAmount'];
                        if ($pendingAmount != $BOOKING->totalcharges) {
                            $newAmount = ($BOOKING->totalcharges) - ($pendingAmount);
                            $CREDIT = $CurrentCredit + ($newAmount * $BOOKING->convertion);
                            $UpdateCredit = $site->updateAgenceCredit($PidAgence, $CREDIT);
                            $_SESSION['AGENCE'] = $site->SelectObjectTableWC('user', 'id', $PidAgence, 'id', 'ASC');
                        }
                    }

                    $RefBooking = $Result['@attributes']['reference'];
                    $UpdateBooking = $site->BookingUpdateStatusHB($RefBooking);
                    $dateCancel = date('Y-m-d H:i:s');
                    $CancelBooking = $site->BookingCancelHB($RefBooking, $dateCancel);
                }
            }
            unset($_SESSION['conditionAnnulationHB']);
            echo '<strong class="dark-blue-color">';
            print_r('Réservation annulée.');
            echo '</strong>';
        }
    }
}

function getBookingDetail($REF)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-api/1.0/bookings/" . $REF . "",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "accept-encoding: gzip",
            "content-type: application/xml",
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $msgLog = new Logger('HotelBedsBookingDetail Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('/hotel-api/1.0/bookings/' . $REF . '');
    $msgLog = new Logger('HotelBedsBookingDetail Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
        $array = '';
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['getBookingDetail'] = $array;
        $res = $array;
    }

    return $array;
}

function CityRequestFromToHB($newStart, $newEnd,$isoCode)
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/locations/destinations?fields=code,countryCode,name&language=ENG&from=" . $newStart . "&to=" . $newEnd . "&useSecondaryLanguage=false",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/xml",
            "Api-key: " . $ApiKey,
            "Cache-Control: no-cache",
            "X-Signature: " . $XSIGNATURE
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $msgLog = new Logger('HotelBedsDestinations Request');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info('/hotel-content-api/1.0/locations/destinations?fields=code,name&countryCodes=' . $isoCode . '&language=ENG&from=1&to=1000&useSecondaryLanguage=false');
    $msgLog = new Logger('HotelBedsDestinations Response');
    $msgLog->pushHandler(new StreamHandler('./LOGS/hotelbedsrequestresponse.log', Logger::INFO));
    $msgLog->info($response);
    curl_close($curl);
    if ($err) {
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['CityRequestHB'] = $array;
        return $array;
    }
}
