<?php
$metaDescription = "With Dmcbooking.pro Find the perfect stay for your next trip. Explore a wide range of accommodations, from luxury resorts to cozy b&b. Book your room now!";
$metaKeywords = "DMC Booking, Dmcbooking , Dmcbooking.pro, hotel booking, accommodations, travel, reservations, vacation, trips, lodging, resorts, bed and breakfast, online booking, hospitality, travel deals, getaway, destination, luxury hotels, budget hotels";
$metaCanonical = "https://dmcbooking.pro/";
$metaTitle = "DMC Booking : Find & Book Your Perfect Hotel";
include('files/top-head.php')
?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
$site = new SITE();
if (!isset($_SESSION['HotelBedsAvailabilityRSIndex'])) {
  unset($_SESSION['MARPER']);
  $markupdb = $site->SelectMarkup();
  $MARKUP = (($markupdb['markup_b2c']) / 100) + 1;;
  $MARPER = $MARKUP;
  $_SESSION['MARPER'] = $MARPER;
  $TTODAY = date("d/m/Y");
  $TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
  $destinationsIsocode = ["PAR", "LON", "DXB", "PAR", "AMS", "IST"]; // City Codes
 // $CountriesIsocode = ["FRA", "DEU", "USA"]; //  Country codes
  $destinationsName = ["Paris", "London", "Dubai", "Paris", "Amsterdam", "Istanbul"];// City names
 // $CountriesName = ["France","United Kingdom","Germany","United States","Turkey"];// Country names

 /* $destinations = [
    "Paris" => "PAR",
    "London" => "LON",
    "Dubai" => "DXB",
    "Amsterdam" => "AMS",
    "Istanbul" => "IST",
    "France" => "FRA",
    "Germany" => "DEU",
    "United States" => "USA"
];*/
  $randomize = array_rand($destinationsIsocode, 1);
  $CheckInDate = new DateTime();
  $CheckOutDate = new DateTime();
  $CheckInDate->modify('+1 day');
  $CheckOutDate->modify('+2 day');
  $filter = '<filter paymentType="AT_WEB" maxHotels="4"></filter><reviews><review type="HOTELBEDS" maxRate="5" minRate="3" minReviewCount="10"/></reviews>';
  $date1 = $CheckInDate;
  $date2 = $CheckOutDate;
  $Stay = '<stay checkIn="' . $CheckInDate->format('Y-m-d') . '" checkOut="' . $CheckOutDate->format('Y-m-d') . '" />';
 // $selCountryHB = "$CountriesIsocode[$randomize]"; 
  $selCityHB = $destinationsIsocode[$randomize];
  $_SESSION['selCityHBindex'] = $selCityHB;
//$_SESSION['selCountryHBindex'] = $selCountryHB;
  $selHotelHBS = "";
  $selHotelHB = "";
  $CitySearch = $destinationsName[$randomize];
 // $CountrySearch = $CountriesName[$randomize];
  $_SESSION['CitySearchIndex'] = $CitySearch;
  //$_SESSION['CountrySearchIndex'] = $CountrySearch;
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
            $HotelCode = $value['@attributes']['code'];
            $Hotel .= '<hotel>' . $HotelCode . '</hotel>';
            $HH .= '<hotel>' . $HotelCode . '</hotel>';
          }
          $Frex[$i] = $HH;
        }
      }
    } elseif ($XXX['total'] == 1) {
      $HotelCode = $Hotells['@attributes']['code'];
      $Hotel .= '<hotel>' . $HotelCode . '</hotel>';
    }
    $Totl = $XXX['total'];
  } else {
    $Hotel = '<hotel>' . $selHotelHB . '</hotel>';
    $Totl = 1;
  }
  $ActiveRooms = 1;
  $Occupancy = '';
  $Occupancy .= '<occupancy rooms="1" adults="2" children="0"><paxes> <pax type="AD"/></paxes> </occupancy>';
  $_SESSION['Occupancy'] = $Occupancy;
  if ($Totl <= 2000) {
    $newHotelsList = array();
    HotelsSearchHBIndex($Stay, $Occupancy, $Hotel, $filter);
    $NB = $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['@attributes']['total'];
    if ($NB == 0) {
    } elseif ($NB == 1) {
      $Hotels = $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'];
      $Hotel = $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'];
      array_push($newHotelsList, $Hotel);
      unset($_SESSION['HotelBedsAvailabilityRSIndex']);
      $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'][0] = $Hotel;
    } elseif ($NB > 1) {
      $Hotels = $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'];
      if (isset($Hotels)) {
        foreach ($Hotels as $HotelsKey => $Hotel) {
          array_push($newHotelsList, $Hotel);
        }
      }
      $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'] = $newHotelsList;
    }
  } else {
    $newHotelsList = array();
    foreach ($Frex as $FrexKey => $FrexVal) {
      HotelsSearchHBIndex($Stay, $Occupancy, $FrexVal, $filter);
      if (isset($_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'])) {
        $Hotels = $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'];
      }
      if (isset($Hotels)) {
        foreach ($Hotels as $HotelsKey => $Hotel) {
          array_push($newHotelsList, $Hotel);
        }
      }
      $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'] = $newHotelsList;
    }
  }
  $HotelList = $newHotelsList;
  $DEVISE = "EUR";
} else {
  $HotelList = $_SESSION['HotelBedsAvailabilityRSIndex']['hotels']['hotel'];
}
?>
<body>
  <?php include('./files/header.php') ?>
  <section data-anim-wrap="" class="masthead -type-1 z-5" >
    <div  class="masthead__bg"  >
      <img src="#" alt="find next place to visit" title="find next place to visit" data-src="img/backgrounds/golf4.jpg" class="js-lazy">
    </div>
    <div class="container">
      <div class="row justify-center">
        <div class="col-auto">
        <style>
    .elegant-text {
        font-family: "Playfair Display", serif; /* Elegant font */
        font-size: 60px; /* Adjust size as needed */
        color: white;
        text-shadow: -2px -2px 0 black, 2px -2px 0 black, -2px 2px 0 black, 2px 2px 0 black;
        font-weight: bold;
    }

    .elegant-subtext {
        font-family: "Playfair Display", serif; /* Match the heading font */
        font-size: 24px; /* Adjust for elegance */
        color: white;
        text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black;
        font-weight: 500;
    }
</style>

<div class="text-center" style="position: relative; z-index: 1; margin-top: 200px;"> 
    <h1 class="elegant-text">Step Up to the Ultimate Golf Experience</h1>
    <p class="elegant-subtext mt-6 md:mt-10">Exclusive Deals</p>
</div>



                    <!-- Search Box-->
          <div  class="tabs -underline mt-60 js-tabs">
            <div class="tabs__content mt-30 md:mt-20 js-tabs-content">
              <div class="tabs__pane -tab-item-1 is-tab-el-active">
                <div class="mainSearch -w-900 bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-100">
                  <div class="button-grid items-center">
                    <div class="searchMenu-loc px-30 lg:py-20 lg:px-0 js-form-dd js-liverSearch">
                      <div data-x-dd-click="searchMenu-loc">
                        <p class="text-15 fw-500 ls-2 lh-16">Location</p>
                        <div class="text-15 text-light-1 ls-2 lh-16">
                          <input autocomplete="off" type="search" placeholder="Where are you going?" class="js-search js-dd-focus" id="search">
                          <p class="error"></p>
                        </div>
                      </div>
                      <div class="searchMenu-loc__field shadow-2 js-popup-window" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                        <div class="bg-white px-30 py-30 sm:py-15 rounded-4 results-list">
                          <div class="ring">
                            <div class="lds-dual-ring"></div>
                          </div>
                          <div class="y-gap-5 js-results">
                          </div>
                          <div class="y-gap-5 js-results-hotels">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="searchMenu-date px-30 lg:py-20 lg:px-0 js-form-dd js-calendar">
                      <div data-x-dd-click="searchMenu-date">
                        <p class="text-15 fw-500 ls-2 lh-16">Check in - Check out</p>
                        <div class="text-15 text-light-1 ls-2 lh-16">
                          <input type="text" name="daterange" value="" id="daterange" />
                        </div>
                      </div>
                      <div class="searchMenu-date__field shadow-2" data-x-dd="searchMenu-date" data-x-dd-toggle="-is-active">
                      </div>
                    </div>
                    <div class="searchMenu-guests px-30 lg:py-20 lg:px-0 js-form-dd js-form-counters">
                      <div data-x-dd-click="searchMenu-guests">
                        <p class="text-15 fw-500 ls-2 lh-16">Guest</p>
                        <div class="text-15 text-light-1 ls-2 lh-16">
                          <span class="js-count-room">1 room 1 adult 0 children</span>
                        </div>
                      </div>
                      <div class="searchMenu-guests__field shadow-2" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                        <div class="bg-white px-30 py-30 rounded-4">
                          <div class="d-flex y-gap-10 justify-start items-center">
                            <div class="mr-5">
                              <div class="text-15 fw-500">Rooms</div>
                              <div>
                                <select class="rounded-4 border-light px-5 h-50 text-14" id="RoomsSelect">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>
                              </div>
                            </div>
                            <div class="mr-5">
                              <div class="text-15 fw-500">Adults</div>
                              <select class="adultsselect0 rounded-4 border-light px-5 h-50 text-14">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                            </div>
                            <div class="mr-5">
                              <div class="text-15  fw-500">Children</div>
                              <select class="childselect0 rounded-4 border-light px-5 h-50 text-14">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                            </div>
                          </div>
                          <div class="pax-wrapper"></div>
                        </div>
                      </div>
                    </div>
                    <div class="button-item">
                      <button class="mainSearch__submit button -dark-1 h-60 px-35 col-12 rounded-100 bg-blue-1 text-white">
                        <i class="icon-search text-20 mr-10"></i>
                        Search
                      </button>
                    </div>
                    <!-- Button search 
                <div class="button-item">
                  <button class="custom-button h-60 px-35 col-12 rounded-100">
                    <i class="icon-search text-20 mr-10"></i>
                    Search
                  </button>
                </div>
                Button search -->


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  
 
 <section class="layout-pt-md-0 " style="margin-top: 400px;" >
    <div data-anim-wrap="" class="container">
      <div  class="row justify-center text-center">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title">Top Golf-Friendly Destinations</h2>
            <p class=" sectionTitle__text mt-5 sm:mt-0">Discover these prime travel spots that offer excellent golf experiences.






</p>
          </div>
        </div>
      </div>
      <div class="row y-gap-40 justify-between pt-40 sm:pt-20">
        <div  class="col-xl-3 col-md-4 col-sm-6 searchBydest" attr="MCM" name="Monaco">
          <div href="#" class="citiesCard -type-3 d-block rounded-4 ">
            <div class="citiesCard__image ratio ratio-1:1">
              <img class="img-ratio js-lazy" src="#" data-src="img/destinations/mo.jpg" alt="Monaco" title="Monaco">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h3 class="text-26 fw-600 text-white">Monaco</h3>
            </div>
          </div>
        </div>
        <div  class="col-xl-6 col-md-4 col-sm-6 searchBydest" attr="CPT" name="Cape Town">
          <div class="citiesCard -type-3 d-block rounded-4 h-full">
            <div class="citiesCard__image ">
              <img class="img-ratio js-lazy" src="#" data-src="img/destinations/cp.jpg" alt="Cape Town" title="Cape Town">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h3 class="text-26 fw-600 text-white">Cape Town</h3>
            </div>
          </div>
        </div>
        <div  class="col-xl-3 col-md-4 col-sm-6 searchBydest" attr="DXB" name="Dubai">
          <div href="#" class="citiesCard -type-3 d-block rounded-4 ">
            <div class="citiesCard__image ratio ratio-1:1">
              <img class="img-ratio js-lazy" src="#" data-src="img/destinations/2/Dubai.webp" alt="Dubai" title="Dubai">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h3 class="text-26 fw-600 text-white">Dubai</h3>
            </div>
          </div>
        </div>
        <div  class="col-xl-6 col-md-4 col-sm-6 searchBydest" attr="LTT" name="Saint Tropez">
          <div class="citiesCard -type-3 d-block rounded-4 h-full">
            <div class="citiesCard__image ">
              <img class="img-ratio js-lazy" src="#" data-src="img/destinations/st.jpg" alt="Saint Tropez" title="Saint Tropez">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h3 class="text-26 fw-600 text-white">Saint Tropez</h3>
            </div>
          </div>
        </div>
        <div  class="col-xl-3 col-md-4 col-sm-6 searchBydest" attr="DOH" name="Doha">
          <div class="citiesCard -type-3 d-block rounded-4 ">
            <div class="citiesCard__image ratio ratio-1:1">
              <img class="img-ratio js-lazy" src="#" data-src="img/destinations/doha.jpg" alt="Doha" title="Doha">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h3 class="text-26 fw-600 text-white">Doha</h3>
            </div>
          </div>
        </div>
        <div  class="col-xl-3 col-md-4 col-sm-6 searchBydest" attr="NYC" name="New York">
          <div class="citiesCard -type-3 d-block rounded-4">
            <div class="citiesCard__image ratio ratio-1:1">
              <img class="img-ratio js-lazy" src="#" data-src="img/destinations/ny.jpeg" alt="New York" title="New York">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h3 class="text-26 fw-600 text-white">New York City</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  <section class="layout-pt-md-0 " style="margin-top: 100px;">
  <div data-anim-wrap="" class="container">
    <div class="row y-gap-20 justify-between items-end">
      <div class="col-auto">
        <div class="sectionTitle -md">
          <h2 class="sectionTitle__title">Searching for Your Ideal Stay?</h2>
          <p class="sectionTitle__text mt-5 sm:mt-0">Discover the properties other golf enthusiasts are booking for their perfect getaway.






</p>
        </div>
      </div>
    </div>

    <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist">
      <?php
       $B = 0;
       $count = 0; // Initialize counter to limit the number of hotels
       foreach ($HotelList as $key => $H) {
         if ($count >= 10) break; // Stop after 10 hotels
         $B += 1;
         $count++; // Increment the counter
        if (isset($_SESSION['idHotelSearched']) && $HotelNB == 1) {
          $HOTEL = $_SESSION['idHotelSearched'];
        } else {
          $HOTEL = $key;
        }
        $HotelId = $H['@attributes']['code'];
        $HotelName = $H['@attributes']['name'];
        $PropertyRating = substr($H['@attributes']['categoryCode'], 0, 1);
        $RatingName = ucfirst(strtolower($H['@attributes']['categoryName']));
        $HotelZoneCode = $H['@attributes']['zoneCode'];
        $HotelZoneName = $H['@attributes']['zoneName'];
        $Location = $H['@attributes']['destinationName'];

        if (!isset($_SESSION['HotelDetailsRS'][$HotelId])) {
          HotelDetails($HotelId);
        }
        $ThumbNailUrl = isset($_SESSION['HotelDetailsRS'][$HotelId]['hotel']['images'])
          ? 'https://photos.hotelbeds.com/giata/' . $_SESSION['HotelDetailsRS'][$HotelId]['hotel']['images']['image'][0]['@attributes']['path']
          : $WORKPATH . 'img/noimage.jpg';

        $TotalCharges = $H['@attributes']['minRate'];
        $RateCurrencyCode = $H['@attributes']['currency'];
        $HotelDescription = substr($_SESSION['HotelDetailsRS'][$HotelId]['hotel']['description'], 0, 150);
        $HotelDescription = rtrim($HotelDescription, ".") . ".";

        $HotelAddress = '';
        if (isset($_SESSION['HotelDetailsRS'][$HotelId]['hotel']['address'])) {
          $HotelAddress .= $_SESSION['HotelDetailsRS'][$HotelId]['hotel']['address'] . ', ';
        }
        if (isset($_SESSION['HotelDetailsRS'][$HotelId]['hotel']['postalCode'])) {
          $HotelAddress .= $_SESSION['HotelDetailsRS'][$HotelId]['hotel']['postalCode'] . ', ';
        }
        if (isset($_SESSION['HotelDetailsRS'][$HotelId]['hotel']['city'])) {
          $HotelAddress .= $_SESSION['HotelDetailsRS'][$HotelId]['hotel']['city'];
        }
        $HotelAddress = ucwords(strtolower($HotelAddress));

        $TotalChargeEUR = $TotalCharges * $_SESSION['MARPER'];

        ?>
        <div class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
          <div class="SearchByhotel hotelsCard -type-1" id="<?php echo $HotelId ?>">
            <div class="hotelsCard__image">
              <div class="cardImage ratio ratio-1:1">
                <div class="cardImage__content">
                  <img class="rounded-4 col-12" src="<?php echo $ThumbNailUrl ?>" alt="<?php echo $HotelName ?>" title="<?php echo $HotelName ?>">
                </div>
              </div>
            </div>
            <div class="hotelsCard__content mt-10">
              <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                <span><?php echo $HotelName ?></span>
                <div class="d-inline-block ml-10">
                  <?php for ($i = 1; $i <= (int)$PropertyRating; $i++) {
                    echo '<i class="icon-star text-10 text-yellow-2"></i>';
                  } ?>
                </div>
              </h3>
              <p class="text-light-1 lh-14 text-14 mt-5"><?php echo $HotelAddress ?></p>
              <div class="mt-5">
                <div class="fw-500">
                  Starting from <span class="text-blue-1"><?php echo $TotalChargeEUR ?> EUR</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

  <section class="layout-pt-md-0 layout-pb-lg " style="margin-top: 50px;">
    <div class="container">
      <div class="row">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title">Popular Countries</h2>
            <p class=" sectionTitle__text mt-5 sm:mt-0">Here you can see the Most Popular Countries</p>
          </div>
        </div>
      </div>
      <div class="tabs -pills pt-40 js-tabs">
        <div class="tabs__controls d-flex js-tabs-controls">
          <div>
            <button class="tabs__button fw-500 text-15 px-30 py-15 rounded-4 js-tabs-button is-tab-el-active " data-tab-target=".-tab-item-1">Countries</button>
          </div>
          <div>
            <button class="tabs__button fw-500 text-15 px-30 py-15 rounded-4 js-tabs-button " data-tab-target=".-tab-item-2">Destinations</button>
          </div>


        </div>
        <div class="tabs__content pt-30 js-tabs-content">
          <div class="tabs__pane -tab-item-1 is-tab-el-active">
            <div class="row y-gap-10">
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="country-france.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">France</div>
                    <div class="text-14 text-light-1">3574 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="country-turkey.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Turkey</div>
                    <div class="text-14 text-light-1">1858 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="country-italy.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Italy</div>
                    <div class="text-14 text-light-1">1924 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="united-arab-emirates.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">UAE</div>
                    <div class="text-14 text-light-1">980 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="country-spain.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Spain</div>
                    <div class="text-14 text-light-1">1062 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="japan.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Japan</div>
                    <div class="text-14 text-light-1">1448 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">USA</div>
                    <div class="text-14 text-light-1">1258 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="brazil.php">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Brazil</div>
                    <div class="text-14 text-light-1">396 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Iceland</div>
                    <div class="text-14 text-light-1">166 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Egypt</div>
                    <div class="text-14 text-light-1">224 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Greece</div>
                    <div class="text-14 text-light-1">654 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Indonesia</div>
                    <div class="text-14 text-light-1">952 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Morocco</div>
                    <div class="text-14 text-light-1">544 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Australia</div>
                    <div class="text-14 text-light-1">624 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Thailand</div>
                    <div class="text-14 text-light-1">1462 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Czech Republic</div>
                    <div class="text-14 text-light-1">483 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Netherlands</div>
                    <div class="text-14 text-light-1">740 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">Canada</div>
                    <div class="text-14 text-light-1">378 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">South Africa</div>
                    <div class="text-14 text-light-1">240 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
              <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                <a href="#">
                  <div class="d-block ">
                    <div class="text-15 fw-500">New Zealand</div>
                    <div class="text-14 text-light-1">180 hotels and other accommodation</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="tabs__pane -tab-item-2">

            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2" style="overflow: hidden;">
              <div class="swiper-wrapper" aria-live="polite" style="margin-left: 3%;">



                <div class="swiper-slide  " role="group" aria-label=" 1/ 6">
                  <div class="">
                    <a href="destination.php?destination=Paris&code=PAR">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Paris, France</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Hammamet&code=HMM">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Hammamet, Tunisia</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Istanbul&code=IST">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Istanbul, Turkey</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Amsterdam&code=AMS">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Amsterdam, Netherlands</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide  " role="group" aria-label=" 1/ 6">
                  <div class="">
                    <a href="destination.php?destination=Rome&code=ROE">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Rome, Italy</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Dubai&code=DXB">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Dubai, UAE</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Bangkok&code=BKK">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Bangkok, Thailand</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Santorini&code=SAT">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Santorini, Greece</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide  " role="group" aria-label=" 1/ 6">
                  <div class="">
                    <a href="destination.php?destination=New York City&code=NYC">
                      <div class="d-block ">
                        <div class="text-15 fw-500">New York City, USA</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Cairo&code=CAI">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Cairo, Egypt</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Rio de Janeiro&code=RIO">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Rio de Janeiro, Brazil</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Prague&code=PRG">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Prague, Czech Republic</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide  " role="group" aria-label=" 1/ 6">
                  <div class="">
                    <a href="destination.php?destination=Tokyo&code=NRT">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Tokyo, Japan</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Riyadh&code=RUH">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Riyadh, Saudi Arabia</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Bali&code=BAI">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Bali, Indonesia</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Belgrade&code=BJY">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Belgrade, Serbia</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide  " role="group" aria-label=" 1/ 6">

                  <div class="">
                    <a href="destination.php?destination=Barcelona&code=BCN">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Barcelona, Spain</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Marrakech&code=RAK">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Marrakech, Morocco</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Delhi&code=DEL">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Delhi, India</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                  <div class="">
                    <a href="destination.php?destination=Reykjavik&code=REK">
                      <div class="d-block ">
                        <div class="text-15 fw-500">Reykjavik, Iceland</div>
                        <div class="text-14 text-light-1">Explore Available Hotels</div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev swiper-button-disabled" disabled="" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-479a6cf6a4ce7e63" aria-disabled="true">
                <i class="icon icon-chevron-left text-12"></i>
              </button>
              <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-479a6cf6a4ce7e63" aria-disabled="false">
                <i class="icon icon-chevron-right text-12"></i>
              </button>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <section class="mb-30">
    <div class="container ">
      <div class="row justify-center text-center ">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title">Why Choose Us</h2>
            <p class=" sectionTitle__text mt-5 sm:mt-0">Enjoy A User-Friendly Dmc booking Site</p>
          </div>
        </div>
      </div>
      <div class="row y-gap-40 justify-between pt-50">
        <div class="col-lg-3 col-sm-6">
          <div class="featureIcon -type-1 ">
            <div class="d-flex justify-center">
              <img src="#" data-src="img/featureIcons/3/1gg.svg" alt="Best Price Guarantee" title="Best Price Guarantee" class="js-lazy">
            </div>
            <div class="text-center mt-30">
              <h3 class="text-18 fw-500">Best Price Guarantee</h3>
              <p class="text-15 mt-10">Our Best Price Guarantee means that you can be sure of booking at the best rate. </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="featureIcon -type-1 ">
            <div class="d-flex justify-center">
              <img src="#" data-src="img/featureIcons/3/2gg.svg" alt="Easy & Quick Booking" title="Easy & Quick Booking" class="js-lazy">
            </div>
            <div class="text-center mt-30">
              <h3 class="text-18 fw-500">Easy & Quick Booking</h3>
              <p class="text-15 mt-10">A simple,3-click hassle-free booking experience.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="featureIcon -type-1 ">
            <div class="d-flex justify-center">
              <img src="#" data-src="img/featureIcons/3/3gg.svg" alt="Customer Care 24/7" title="Customer Care 24/7" class="js-lazy">
            </div>
            <div class="text-center mt-30">
              <h3 class="text-18 fw-500">Customer Care 24/7</h3>
              <p class="text-15 mt-10">Fast & efficient response around the clock.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include('files/bottom.php'); ?>
<script>
  var startdate = new Date();
  startdate.setDate(startdate.getDate() + 1);
  var enddate = new Date();
  enddate.setDate(enddate.getDate() + 2);
  window.start = moment(startdate).format("YYYY-MM-DD");
  window.end = moment(enddate).format("YYYY-MM-DD");

  $(function() {
    $('input[name="daterange"]').daterangepicker({
        opens: "center",
        startDate: startdate,
        endDate: enddate,
        minDate: startdate,
        locale: {
          format: "DD/MM/YYYY",
        },
      },
      function(start, end, label) {
        window.start = start.format("YYYY-MM-DD");
        window.end = end.format("YYYY-MM-DD");
      }
    );
  });

  $(".SearchByhotel").click(function(e) {
    window.hotelCode = $(this).attr('id');
    window.isoCode = "<?php echo $_SESSION['selCityHBindex']; ?>";
    window.searchvalue = "<?php echo $_SESSION['CitySearchIndex']; ?>";
    let Checkin = window.start;
    let Checkout = window.end;
    let selCountryHB = "";
    let selCityHB = window.isoCode;
    var dataStringSearchPax = "";
    for (let i = 0; i < $("#RoomsSelect").val(); i++) {
      dataStringSearchPax =
        dataStringSearchPax +
        "adultsselect" +
        i +
        "=" +
        $(".adultsselect" + i).val() +
        "&";
      if ($(".childselect" + i).val() > 0) {
        dataStringSearchPax =
          dataStringSearchPax +
          "childselect" +
          i +
          "=" +
          $(".childselect" + i).val() +
          "&";
        for (let y = 1; y <= $(".childselect" + i).val(); y++) {
          dataStringSearchPax =
            dataStringSearchPax +
            "ageselect" +
            i +
            "-" +
            y +
            "=" +
            $(".ageselect" + i + "-" + y).val() +
            "&";
        }
      } else {
        dataStringSearchPax =
          dataStringSearchPax + "childselect" + i + "=0&";
      }
    }
    dataStringSearchPax =
      dataStringSearchPax + "ActiveRooms=" + $("#RoomsSelect").val();

    var dataStringSearchHB = "";
    if (window.hotelCode) {
      dataStringSearchHB =
        "Cityname=" +
        window.searchvalue +
        "&hotel=" +
        window.hotel +
        "&hotelCode=" +
        window.hotelCode +
        "&CheckInDate=" +
        Checkin +
        "&CheckOutDate=" +
        Checkout +
        "&selCityHB=" +
        selCityHB +
        "&selCountryHB=&action=hotelSearch&" +
        dataStringSearchPax;
    } else {
      if (window.zoneCode) {
        dataStringSearchHB =
          "Cityname=" +
          window.searchvalue +
          "&zoneCode=" +
          window.zoneCode +
          "&CheckInDate=" +
          Checkin +
          "&CheckOutDate=" +
          Checkout +
          "&selCityHB=" +
          selCityHB +
          "&selCountryHB=&action=hotelSearch&" +
          dataStringSearchPax;
      } else {
        dataStringSearchHB =
          "Cityname=" +
          window.searchvalue +
          "&CheckInDate=" +
          Checkin +
          "&CheckOutDate=" +
          Checkout +
          "&selCityHB=" +
          selCityHB +
          "&selCountryHB=&action=hotelSearch&" +
          dataStringSearchPax;
      }
    }

    $.ajax({
      type: "POST",
      url: "actions.php",
      data: dataStringSearchHB,
      cache: false,
      success: function(json) {
        window.location.href =
          WORKPATH +
          "hotel-list.php?CityName=" +
          window.searchvalue +
          "&City=" +
          selCityHB +
          "&CheckIn=" +
          Checkin +
          "&CheckOut=" +
          Checkout +
          "&Rooms=1&Adults0=1";
      },
      error: function(request, status, error) {
        $(".error").html("");
        $(".mainSearch__submit > i").attr("class", "");
        $(".mainSearch__submit > i").addClass("icon-search text-20 mr-10");
      },
    });
  });
</script>
</body>
</html>




    
  