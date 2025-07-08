<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();


include_once("files/DB_FUNCTION_INC.php");
$site = new SITE();

unset($_SESSION['MARPER']);
$markupdb = $site->SelectMarkup();
$MARKUP = (($markupdb['markup_b2c']) / 100) + 1;
$MARPER = $MARKUP;
$_SESSION['MARPER'] = $MARPER;

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

    print_r(json_encode(["cities" => $jcities, "zones" => $resultzones, "hotels" => $resulthotels]));
}

if (isset($_POST['action']) && ($_POST['action'] == "hotelSearch")) {

    unset($_SESSION['Rooms']);
    unset($_SESSION['newHotelsList']);
    unset($_SESSION['HotelBedsAvailabilityRS']);
    unset($_SESSION['RR']);
    unset($_SESSION['Occupancy']);
    unset($_SESSION['NbHotelsPages']);
    unset($_SESSION['NbHotels']);
    unset($_SESSION['HotelDetailsRS']);
    unset($_SESSION['Rooms']);
    unset($_SESSION['HotelBedsList']);
    unset($_SESSION['ROOM']);
    unset($_SESSION['CurrentRoom']);
    unset($_SESSION['zoneCode']);
    unset($_SESSION['hotelDetailList']);

    $filter = '<filter paymentType="AT_WEB"></filter>';
    /* $filter = '<filter paymentType="AT_WEB"></filter><reviews><review type="HOTELBEDS" maxRate="5" minRate="0" minReviewCount="1"/></reviews>'; */

    if (isset($_POST['Filters'])) {
        $filterdata = explode(',', $_POST['Filters']);
        if ($filterdata[0] != "") {
            $filter = '<filter paymentType="AT_WEB" minRate="' . $filterdata[1] . '" maxRate="' . $filterdata[2] . '" minCategory="' . $filterdata[0] . '" maxCategory="' . $filterdata[0] . '"></filter>';
        } else {
            $filter = '<filter paymentType="AT_WEB" minRate="' . $filterdata[1] . '" maxRate="' . $filterdata[2] . '"></filter>';
        }
    }

    if (isset($_POST['arrBoards'])) {
        if ($_POST['arrBoards'] != "") {
            $filter .= '<boards included="true">';
            $boardsFilter = explode(",", $_POST['arrBoards']);
            foreach ($boardsFilter as $boardsFilterValue) {
                $filter .= '<board>' . $boardsFilterValue . '</board>';
            }
            $filter .= '</boards>';
        }
    }

    if (isset($_POST['arrAccommodations'])) {
        if ($_POST['arrAccommodations'] != "") {
            $filter .= '<accommodations>';
            $AccommodationsFilter = explode(",", $_POST['arrAccommodations']);
            foreach ($AccommodationsFilter as $AccommodationsFilterValue) {
                $filter .= '<accommodation>' . strtoupper($AccommodationsFilterValue) . '</accommodation>';
            }
            $filter .= '</accommodations>';
        }
    }



    $CheckIn = $_POST['CheckInDate'];
    $CheckOut = $_POST['CheckOutDate'];

    $date1 = new DateTime($CheckIn);
    $date2 = new DateTime($CheckOut);
    $days  = $date2->diff($date1)->format('%a');

    $Stay = '<stay checkIn="' . $CheckIn . '" checkOut="' . $CheckOut . '" />';

    $selCountryHB = $_POST['selCountryHB'];
    $selCityHB = $_POST['selCityHB'];

    if (isset($_POST['hotelCode'])) {
        $selHotelHBS = $_POST['hotel'];
        $selHotelHB = $_POST['hotelCode'];
    } else {
        $selHotelHBS = "";
        $selHotelHB = "";
    }

    if (isset($_POST['zoneCode'])) {
        $_SESSION['zoneCode'] = $_POST['zoneCode'];
        $_SESSION['CitySearch'] = $_POST['Cityname'];
    } else {
        $_SESSION['CitySearch'] = $_POST['Cityname'];
    }

    $_SESSION['SearchHotelHB'] = array('nights' => $days, 'Country' => $selCountryHB, 'City' => $selCityHB, 'ZoneCode' => $_POST['zoneCode'], 'HotelCode' => $selHotelHB, 'Hotel' => $selHotelHBS, 'CheckIn' => $_POST['CheckInDate'], 'CheckOut' => $_POST['CheckOutDate']);

    // add new session to compare it with url 
    $searchHBRefresh = array(
        'CityName' => $_POST['Cityname'],
        'CheckIn' => $_POST['CheckInDate'],
        'CheckOut' => $_POST['CheckOutDate'],
        'City' => $_POST['selCityHB'],
        'selCountryHB' => '',
        'action' => 'hotelSearch',
        'Rooms' => $_POST['ActiveRooms'],

    );

    for ($active = 0; $active < $_POST['ActiveRooms']; $active++) {
        $searchHBRefresh['Adults' . $active] = $_POST['adultsselect' . $active];
        $searchHBRefresh['Children' . $active] = $_POST['childselect' . $active];
        if ($_POST['childselect' . $active] > 0) {
            for ($i = 1; $i <= $_POST['childselect' . $active]; $i++) {
                $searchHBRefresh['Age' . $active . '-' . $i] = $_POST['ageselect' . $active . '-' . $i];
            }
        }
    }
    $_SESSION['SearchHBRefresh'] = $searchHBRefresh;



    $lStart = 1;
    $lEnd = 1000;


    $_SESSION['sortHB'] = 'minRate';


    $sortHB = $_SESSION['sortHB'];

    if ($selHotelHBS == '') {
        $XXX = HotelsRequestHB($selCountryHB, $selCityHB, $lStart, $lEnd);

        $Hotel = '';

        $Hotells = $XXX['hotels']['hotel'];
        if ($XXX['total'] > 1) {
            foreach ($Hotells as $value) {
                $_SESSION['hotelDetailList'][$value['@attributes']['code']] = $value;
                $HotelCode = $value['@attributes']['code'];
                $Hotel .= '<hotel>' . $HotelCode . '</hotel>';
            }


            $Frex[0] = $Hotel;

            if ($XXX['total'] > 1000) {
                $Totl = $XXX['total'];
                $nbReqHotel = ceil($Totl / 1000);
                $newStart = 1;
                $newEnd = 1000;
                for ($i = 1; $i < $nbReqHotel; $i++) {
                    $HH = '';
                    $newStart += 1000;
                    $newEnd += 1000;

                    $XXX = HotelsRequestHB($selCountryHB, $selCityHB, $newStart, $newEnd);
                    $Hotells = $XXX['hotels']['hotel'];
                    foreach ($Hotells as $value) {
                        $_SESSION['hotelDetailList'][$value['@attributes']['code']] = $value;
                        $HotelCode = $value['@attributes']['code'];
                        $Hotel .= '<hotel>' . $HotelCode . '</hotel>';
                        $HH .= '<hotel>' . $HotelCode . '</hotel>';
                    }
                    $Frex[$i] = $HH;
                }
            }
        } elseif ($XXX['total'] == 1) {
            $_SESSION['hotelDetailList'][$Hotells['@attributes']['code']] = $Hotells;
            $HotelCode = $Hotells['@attributes']['code'];
            $Hotel .= '<hotel>' . $HotelCode . '</hotel>';
        }


        $Totl = $XXX['total'];
    } else {
        $_SESSION['hotelDetailList'][$selHotelHB] = HotelDetails($selHotelHB);
        $Hotel = '<hotel>' . $selHotelHB . '</hotel>';
        $Totl = 1;
    }

    $ActiveRooms = $_POST['ActiveRooms'];


    for ($active = 0; $active < $ActiveRooms; $active++) {

        $Room = $active;
        $Adult = $_POST['adultsselect' . $Room];
        $Infant = $_POST['childselect' . $Room];
        $Age = array();
        if ($Infant > 0) {
            for ($i = 1; $i <= $Infant; $i++) {
                $age = $_POST['ageselect' . $Room . '-' . $i];
                array_push($Age, $age);
            }
        }

        $_SESSION['Rooms'][$Room] = array('rooms' => 1, 'adults' => $Adult, 'children' => $Infant, 'age' => $Age);
        $_SESSION['RR'][$Room] = array('adults' => $Adult, 'children' => $Infant, 'age' => $Age);
    }

    $NRR = count($_SESSION['RR']);

    if ($NRR == 1) {
        $Occupancy = '';
        $Rooms = $_SESSION['Rooms'];
        foreach ($Rooms as $Room) {
            $rooms = $Room['rooms'];
            $adults = $Room['adults'];
            $children = $Room['children'];
            $age = $Room['age'];
            $Occupancy .= '<occupancy rooms="' . $rooms . '" adults="' . $adults . '" children="' . $children . '">';
            $Occupancy .= '<paxes>';

            if ($adults > 0) {
                for ($i = 0; $i < $adults; $i++) {
                    $Occupancy .= '<pax type="AD"/>';
                }
            }

            if ($children > 0) {
                for ($i = 0; $i < $children; $i++) {
                    $Occupancy .= '<pax type="CH" age="' . $age[$i] . '"/>';
                }
            }

            $Occupancy .= '</paxes>';
            $Occupancy .= '</occupancy>';
        }
    } elseif ($NRR == 2) {
        $RSR = array_diff_assoc_recursive($_SESSION['RR'][0], $_SESSION['RR'][1]);
        if (!empty($RSR)) {
            $Occupancy = '';
            $Rooms = $_SESSION['Rooms'];
            foreach ($Rooms as $Room) {
                $rooms = $Room['rooms'];
                $adults = $Room['adults'];
                $children = $Room['children'];
                $age = $Room['age'];
                $Occupancy .= '<occupancy rooms="' . $rooms . '" adults="' . $adults . '" children="' . $children . '">';
                $Occupancy .= '<paxes>';

                if ($adults > 0) {
                    for ($i = 0; $i < $adults; $i++) {
                        $Occupancy .= '<pax type="AD"/>';
                    }
                }

                if ($children > 0) {
                    for ($i = 0; $i < $children; $i++) {
                        $Occupancy .= '<pax type="CH" age="' . $age[$i] . '"/>';
                    }
                }

                $Occupancy .= '</paxes>';
                $Occupancy .= '</occupancy>';
            }
        } else {
            $Occupancy = '';
            $Rooms = $_SESSION['Rooms'];
            $rooms = 2;
            $adults = 0;
            $children = 0;
            foreach ($Rooms as $Room) {
                $adults += $Room['adults'];
                $children += $Room['children'];
            }
            $Occupancy .= '<occupancy rooms="' . $rooms . '" adults="' . $adults . '" children="' . $children . '">';
            $Occupancy .= '<paxes>';
            if ($adults > 0) {
                for ($i = 0; $i < $adults; $i++) {
                    $Occupancy .= '<pax type="AD"/>';
                }
            }
            if ($children > 0) {
                foreach ($Rooms as $Room) {
                    $age = $Room['age'];
                    $CH = $Room['children'];
                    for ($i = 0; $i < $CH; $i++) {
                        $Occupancy .= '<pax type="CH" age="' . $age[$i] . '"/>';
                    }
                }
            }

            $Occupancy .= '</paxes>';
            $Occupancy .= '</occupancy>';
        }
    }

    if ($NRR == 3) {
        $RSR0 = array_diff_assoc_recursive($_SESSION['RR'][0], $_SESSION['RR'][1]);
        $RSR1 = array_diff_assoc_recursive($_SESSION['RR'][0], $_SESSION['RR'][2]);
        $RSR2 = array_diff_assoc_recursive($_SESSION['RR'][1], $_SESSION['RR'][2]);

        if (!empty($RSR0) || !empty($RSR1) || !empty($RSR2)) {
            $Occupancy = '';
            $Rooms = $_SESSION['Rooms'];
            foreach ($Rooms as $Room) {
                $rooms = $Room['rooms'];
                $adults = $Room['adults'];
                $children = $Room['children'];
                $age = $Room['age'];
                $Occupancy .= '<occupancy rooms="' . $rooms . '" adults="' . $adults . '" children="' . $children . '">';
                $Occupancy .= '<paxes>';

                if ($adults > 0) {
                    for ($i = 0; $i < $adults; $i++) {
                        $Occupancy .= '<pax type="AD"/>';
                    }
                }

                if ($children > 0) {
                    for ($i = 0; $i < $children; $i++) {
                        $Occupancy .= '<pax type="CH" age="' . $age[$i] . '"/>';
                    }
                }

                $Occupancy .= '</paxes>';
                $Occupancy .= '</occupancy>';
            }
        } elseif (empty($RSR0) && empty($RSR1) && empty($RSR2)) {
            $Occupancy = '';
            $Rooms = $_SESSION['Rooms'];
            $rooms = 3;
            $adults = 0;
            $children = 0;
            foreach ($Rooms as $Room) {
                $adults += $Room['adults'];
                $children += $Room['children'];
            }
            $Occupancy .= '<occupancy rooms="' . $rooms . '" adults="' . $adults . '" children="' . $children . '">';
            $Occupancy .= '<paxes>';
            if ($adults > 0) {
                for ($i = 0; $i < $adults; $i++) {
                    $Occupancy .= '<pax type="AD"/>';
                }
            }
            if ($children > 0) {
                foreach ($Rooms as $Room) {
                    $age = $Room['age'];
                    $CH = $Room['children'];
                    for ($i = 0; $i < $CH; $i++) {
                        $Occupancy .= '<pax type="CH" age="' . $age[$i] . '"/>';
                    }
                }
            }

            $Occupancy .= '</paxes>';
            $Occupancy .= '</occupancy>';
        }
    }

    $_SESSION['Occupancy'] = $Occupancy;
    $_SESSION['Zoneslist'] = [];
    if ($Totl <= 2000) {

        $newHotelsList = array();
        HotelsSearchHB($Stay, $Occupancy, $Hotel, $filter);

        $NB = $_SESSION['HotelBedsAvailabilityRS']['hotels']['@attributes']['total'];

        if ($NB == 0) {
        } elseif ($NB == 1) {
            $Hotels = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];

            $Hotel = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
            array_push($newHotelsList, $Hotel);
            unset($_SESSION['HotelBedsAvailabilityRS']);
            $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'][0] = $Hotel;
        } elseif ($NB > 1) {
            $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'] = array_sort($_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'], $sortHB, $order = SORT_ASC);
            $Hotels = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
            if (isset($_SESSION['zoneCode'])) {
                $filterCode = $_SESSION['zoneCode'];
                foreach ($Hotels as $HotelsKey => $Hotel) {
                    if ($Hotel['@attributes']['zoneCode'] == $filterCode) {
                        $_SESSION['Zoneslist'][$Hotel['@attributes']['zoneCode']] = $Hotel['@attributes']['zoneName'];
                        array_push($newHotelsList, $Hotel);
                    }
                }
            } else {
                foreach ($Hotels as $HotelsKey => $Hotel) {
                    $_SESSION['Zoneslist'][$Hotel['@attributes']['zoneCode']] = $Hotel['@attributes']['zoneName'];
                    array_push($newHotelsList, $Hotel);
                }
            }
            $newHotelsList = array_sort($newHotelsList, $sortHB, $order = SORT_ASC);
            $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'] = $newHotelsList;
        }
    } else {
        $newHotelsList = array();
        foreach ($Frex as $FrexKey => $FrexVal) {
            HotelsSearchHB($Stay, $Occupancy, $FrexVal, $filter);
            $Hotels = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
            if (isset($_SESSION['zoneCode'])) {
                $filterCode = $_SESSION['zoneCode'];
                foreach ($Hotels as $HotelsKey => $Hotel) {
                    if ($Hotel['@attributes']['zoneCode'] == $filterCode) {
                        $_SESSION['Zoneslist'][$Hotel['@attributes']['zoneCode']] = $Hotel['@attributes']['zoneName'];
                        array_push($newHotelsList, $Hotel);
                    }
                }
            } else {
                foreach ($Hotels as $HotelsKey => $Hotel) {
                    $_SESSION['Zoneslist'][$Hotel['@attributes']['zoneCode']] = $Hotel['@attributes']['zoneName'];
                    array_push($newHotelsList, $Hotel);
                }
            }
            $newHotelsList = array_sort($newHotelsList, $sortHB, $order = SORT_ASC);
            $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'] = $newHotelsList;
        }
    }

   
    $lastrow = end($newHotelsList);

    if (!isset($_POST['Filters'])) {
        $_SESSION['lastpricefinal'] = $lastrow['@attributes']['minRate'];
    }
    $nbHotels = count($newHotelsList);

    $nbItemPerPage = 10;

    $_SESSION['NbHotelsPages'] = ceil($nbHotels / $nbItemPerPage);
    $_SESSION['NbHotels'] = $nbHotels;

    if ($nbHotels > $nbItemPerPage) {
        $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'] = array_chunk($newHotelsList, $nbItemPerPage, true);
    }

    $_SESSION['HotelBedsList'] = $newHotelsList;

    $selCountryHBName = $site->SelectCountryName('countries', $selCountryHB);
    $selCityHBName = $site->SelectCityName('destinations', $selCityHB);

    $_SESSION['CountryName'] = $selCountryHBName[0]['description'];
    $_SESSION['CityName'] = $selCityHBName[0]['name'];
    $_SESSION['DestinationName'] = $_POST['destination-searchHB'];


    $_SESSION['boards'] = '';
    $HotelList = $_SESSION['HotelBedsList'];
    $boardCode = [];
    $boardName = [];
    $accomodationCode = [];
    $accomodationName = [];

    if (isset($HotelList)) {
        $_SESSION['filtrageTotal'] = $HotelList;
    }

    $HotelNB = $_SESSION['NbHotels'];

    if ($HotelNB > 1) {
        if ($_SESSION['NbHotelsPages'] > 1) {
            $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'][0];
            $HotelList = array_sort($HotelList, $sortHB, $order = SORT_ASC);
        } else {
            $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
            $HotelList = array_sort($HotelList, $sortHB, $order = SORT_ASC);
        }
    } elseif ($HotelNB == 1) {

        $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
        $HotelList = array_sort($HotelList, $sortHB, $order = SORT_ASC);
    }

    if (!isset($_POST['Filters'])) {
        $_SESSION['firstpricefinal'] = $HotelList[0]['@attributes']['minRate'];
    }
    $boardCode = [];
    $boardName = [];
    $accomodationCode = [];
    $accomodationName = [];

    if (isset($HotelList)) {
        $B = 0;
        foreach ($HotelList as $key => $H) {
            if (isset($H['rooms']['room'][0]['rates']['rate'][0])) {
                $BoardCode = $H['rooms']['room'][0]['rates']['rate'][0]['@attributes']['boardCode'];
                $BoardName = $H['rooms']['room'][0]['rates']['rate'][0]['@attributes']['boardName'];
            } elseif (isset($H['rooms']['room'][0]['rates']['rate'])) {
                $BoardCode = $H['rooms']['room'][0]['rates']['rate']['@attributes']['boardCode'];
                $BoardName = $H['rooms']['room'][0]['rates']['rate']['@attributes']['boardName'];
            } elseif (isset($H['rooms']['room']['rates']['rate'][0])) {
                $BoardCode = $H['rooms']['room']['rates']['rate'][0]['@attributes']['boardCode'];
                $BoardName = $H['rooms']['room']['rates']['rate'][0]['@attributes']['boardName'];
            } elseif (isset($H['rooms']['room']['rates']['rate'])) {
                $BoardCode = $H['rooms']['room']['rates']['rate']['@attributes']['boardCode'];
                $BoardName = $H['rooms']['room']['rates']['rate']['@attributes']['boardName'];
            }

            if (!in_array($BoardCode, $boardCode)) {
                $boardCode[$key] = $BoardCode;
                $boardName[$key] = $BoardName;
                $_SESSION[$BoardCode] = '';
            }
        }
    }


    $_SESSION['boardCode'] = array_values($boardCode);
    $_SESSION['boardName'] = array_values($boardName);


    print_r($_SESSION['HotelBedsList']);
}

if (isset($_POST['action']) && ($_POST['action'] == "AddRoomRateKey")) {
    $SearchUniqueId = $_POST['SearchUniqueId'];
    $RoomNumber = $_POST['RoomNumber'];
    $RoomAdults = $_POST['RoomAdults'];
    $RoomChilds = $_POST['RoomChilds'];
    $RoomRateKey = $_POST['RoomRateKey'];
    $RoomName = strtolower($_POST['RoomName']);
    $RoomName = ucfirst($RoomName);
    $RoomName = addslashes(utf8_encode($RoomName));
    $RoomBoard = addslashes(utf8_encode($_POST['RoomBoard']));
    $RoomPrice = $_POST['RoomPrice'];

    $DEVISE = stripslashes(utf8_decode('EUR'));

    $RoomsRateKey['RoomRateKey'] = $RoomRateKey;
    $RoomsRateKey['RoomName'] = $RoomName;
    $RoomsRateKey['RoomBoard'] = $RoomBoard;
    $RoomsRateKey['RoomPrice'] = $RoomPrice;
    $RoomsRateKey['RoomNumber'] = $RoomNumber;
    $RoomsRateKey['RoomAdults'] = $RoomAdults;
    $RoomsRateKey['RoomChilds'] = $RoomChilds;
    $RoomsNumber = $_POST['RoomsNumber'];
    $_SESSION['RoomsRateKey'][$SearchUniqueId] = $RoomsRateKey;

    $NbRoomsRateKey = count($_SESSION['RoomsRateKey']);

    if ($NbRoomsRateKey == $RoomsNumber) {
        $RES['Details'] = '';
        $RES['DetailsSummary'] = '';
        $RES['Price'] = 0;

        $Array = $_SESSION['RoomsRateKey'];

        foreach ($Array as $Key => $Value) {
            if ($Value['RoomNumber'] > 1) {
                $RES['Details'] .= '<p class="fw-500">' . stripslashes(utf8_decode($Value['RoomNumber'])) . 'x ' . stripslashes(utf8_decode($Value['RoomName'])) . ' ' . stripslashes(utf8_decode($Value['RoomBoard'])) . '</p>';
                $RES['DetailsSummary'] .= '<div class="row y-gap-5 justify-between">
            <div class="col-auto">
              <div class="text-15">' . stripslashes(utf8_decode($Value['RoomNumber'])) . 'x ' . stripslashes(utf8_decode($Value['RoomName'])) . ' ' . stripslashes(utf8_decode($Value['RoomBoard'])) . '</div>
            </div>
            <div class="col-auto">
              <div class="text-15">' . $Value['RoomPrice'] . ' EUR</div>
            </div>
          </div>';
            } else {
                $RES['Details'] .= '<p class="fw-500">' . stripslashes(utf8_decode($Value['RoomName'])) . ' ' . stripslashes(utf8_decode($Value['RoomBoard'])) . '</p>';
                $RES['DetailsSummary'] .= '<div class="row y-gap-5 justify-between">
            <div class="col-auto">
              <div class="text-15">' . stripslashes(utf8_decode($Value['RoomName'])) . ' ' . stripslashes(utf8_decode($Value['RoomBoard'])) . '</div>
            </div>
            <div class="col-auto">
              <div class="text-15">' . $Value['RoomPrice'] . ' EUR</div>
            </div>
          </div>';
            }
            $RES['Price'] += $Value['RoomPrice'];
        }
        $_SESSION['RoomsRatePrices'] = $RES['Price'];
        $_SESSION['RoomsDetailsDescription'] = $RES['Details'];
        $_SESSION['RoomsDetailsSummary'] = $RES['DetailsSummary'];
        $RES['Price'] .= ' ' . $DEVISE;

        echo json_encode($RES);
    } else {
        echo "OK";
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'RoomRateKeyForm') {
    unset($_SESSION['CheckRoomRateKey']);
    $RoomsRateKey = $_SESSION['RoomsRateKey'];
    $RRK = '';
    foreach ($RoomsRateKey as $Value) {
        $RoomRateKey = $Value['RoomRateKey'];
        $RRK .= '<room rateKey="' . $RoomRateKey . '"/>';
    }
    RoomCheckRate($RRK);
    if (isset($_POST['image'])) {
        $_SESSION['CheckRoomRateKey']['hotel']['@attributes']['image'] = $_POST['image'];
    }
    header("location:" . $WORKPATH . "booking.php");
}

if (isset($_POST['action']) && $_POST['action'] == 'conditionAnnulationHB') {

    $Id = $_POST['HotelId'];
    CancelBookingHB($Id);
}

if (isset($_POST['action']) && $_POST['action'] == 'searchHotelHB') {

    $selCountryHB = $_POST['country'];
    $selCityHB = $_POST['city'];
    $selHotelHB = $_POST['selHotelHBS'];
    $HotelList = $_SESSION['HotelBedsList'];
    $RR = '';
    if ($selHotelHB != '' && strlen($selHotelHB) > 3) {
        foreach ($HotelList as $key => $H) {
            if (isset($H['@attributes']['code'])) {
                $HotelCode = $H['@attributes']['code'];
                $HotelName = strtolower($H['@attributes']['name']);

                $pos = strpos($HotelName, strtolower($selHotelHB));
                if ($pos !== FALSE) {
                    $RR .= '<button id="' . $HotelCode . '" name="' . ucwords($HotelName) . '" class="-link d-block col-12 text-left rounded-4  py-3-3 js-search-option">
                    <div class="d-flex">
                      <div class="icon-bed text-light-1 text-20 pt-4"></div>
                      <div class="ml-10">
                        <div class="text-15 lh-12 fw-500 js-search-option-target">' . ucwords($HotelName) . '</div>
                        <div style="display:none" class="js-search-option-target-hotelcode">' . $HotelCode . '</div>
                      </div>
                    </div>
                  </button>';
                } else {
                }
            }
        }
    } else {
    }
    echo $RR;
}
