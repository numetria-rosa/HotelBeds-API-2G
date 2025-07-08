<?php
session_start(); // Starts a session

include_once("files/DB_FUNCTION_INC.php");
$site = new SITE();

unset($_SESSION['MARPER']);
$markupdb = $site->SelectMarkup(); // Gets markup (pricing) data from the database
$MARKUP = (($markupdb['markup_b2c']) / 100) + 1; // Calculates the markup value
$MARPER = $MARKUP; 
$_SESSION['MARPER'] = $MARPER; // Stores the calculated markup in the session

if (isset($_POST['action']) && $_POST['action'] == 'searchcountryORcity') {
    $query = $_POST['query'];
    $cities = $site->SelectFromTableOR2('destinations', 'countryCode', 'name', $query);
    $zones = $site->SelectFromTableORzone('zones', 'countryCode', 'name', $query);
    $resultCities = [];
    $resulthotels = [];
    $resultzones = [];

    foreach ($cities as $element) {
        $countryname = $site->SelectFromTableOR3('countries', $element['countryCode']);
        if (isset($countryname[0]['description'])) {
            $resultCities[$element['countryCode']]["country"] = $countryname[0]['description'];
            $resultCities[$element['countryCode']]["value"] = $element['name'] . "," . $countryname[0]['description'];
            $resultCities[$element['countryCode']]["city"] = $element['name'];
        } else {
            $resultCities[$element['countryCode']]["country"] = "";
            $resultCities[$element['countryCode']]["value"] = $element['name'];
            $resultCities[$element['countryCode']]["city"] = $element['name'];
        }
        $resultCities[$element['countryCode']]["data"] = $element['code'];
    }

    $jcities = json_encode(array_values($resultCities));

    foreach ($zones as $IndexZone => $zone) {
        $destination = $site->SelectFromTableWC("destinations", "code", $zone['destinationcode'], "id", "");
        $zones[$IndexZone]['destination'] = $destination[0]['name'];
        $zones[$IndexZone]['countrycode'] = $destination[0]['countryCode'];
    }

    if (isset($zones)) {
        $resultzones = json_encode(array_values($zones));
    } else {
        $resultzones = [];
    }

    $hotelscity = [];
    foreach ($resultCities as $resultcity) {
        array_push($hotelscity, HotelsContentSearch($resultcity['data']));
    }

    if (!$resultCities) {
        foreach ($zones as $resultzone) {
            array_push($hotelscity, HotelsContentSearch($resultzone['destinationcode']));
        }
    }

    foreach ($hotelscity as $hotels) {
        if (isset($hotels['hotels']['hotel'])) {
            foreach ($hotels['hotels']['hotel'] as $Indexhotel => $hotel) {
                if (isset($hotel['name'])) {
                    $resulthotels[$Indexhotel]['name'] = $hotel['name'];
                    $resulthotels[$Indexhotel]['code'] = $hotel['@attributes']['code'];
                    $resulthotels[$Indexhotel]['countryCode'] = $hotel['@attributes']['countryCode'];
                    $resulthotels[$Indexhotel]['destinationCode'] = $hotel['@attributes']['destinationCode'];
                    $resulthotels[$Indexhotel]['zoneCode'] = $hotel['zoneCode'];
                }
            }
        }
    }

    $resulthotels = json_encode(array_values($resulthotels));

    header('Content-Type: application/json');
    echo json_encode(["cities" => $jcities, "zones" => $resultzones, "hotels" => $resulthotels]);
}
?>

