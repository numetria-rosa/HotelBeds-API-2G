<?php
require 'vendor/autoload.php'; // Load Composer dependencies

// Define constants and setup
session_start();
$_SESSION['lang'] = 'en'; // Set the language as needed
$hotelBedsEndPoint = 'https://api.test.hotelbeds.com'; // Replace with actual endpoint
$ApiKey = 'warcbuggdvegeszuwybmk84p'; // Replace with actual API key
$XSIGNATURE = 'a4d39ec34ae1b9c7a0d7e5e9d42c4dc75d4ed22c2dbb0c2f3a1f4e8fda59c43e
'; // Replace with actual signature
    
// Include the function (assuming it's in the same file or included)
function CountryRequestHB()
{
    global $hotelBedsEndPoint, $ApiKey, $XSIGNATURE;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $hotelBedsEndPoint . "/hotel-content-api/1.0/locations/countries?fields=all&codes=&language=".$_SESSION['lang']."&from=0&to=250&useSecondaryLanguage=True",
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

    $msgLog = new Monolog\Logger('HotelBedsCountries Request');
    $msgLog->pushHandler(new Monolog\Handler\StreamHandler('./LOGS/hotelbedsrequestresponse.log', Monolog\Logger::INFO));
    $msgLog->info('/hotel-content-api/1.0/locations/countries?fields=all&codes=&language='.$_SESSION['lang'].'&from=0&to=250&useSecondaryLanguage=True');
    $msgLog = new Monolog\Logger('HotelBedsCountries Response');
    $msgLog->pushHandler(new Monolog\Handler\StreamHandler('./LOGS/hotelbedsrequestresponse.log', Monolog\Logger::INFO));
    $msgLog->info($response);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #: " . $err;
    } else {
        $xml = ($response);
        $xml_string = simplexml_load_string($xml);
        $json = json_encode($xml_string);
        $array = json_decode($json, TRUE);
        $_SESSION['CountryRequestHB'] = $array;
        return $array;
    }
}

// Call the function and print the result
$result = CountryRequestHB();
echo '<pre>';
print_r($result);
echo '</pre>';
