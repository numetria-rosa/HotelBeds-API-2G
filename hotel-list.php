<?php
$metaDescription = "With DMCBooking.pro Find Browse our extensive hotel list to find the perfect accommodation for your next trip. Discover a wide range of options, from luxury resorts to budget-friendly stays, in top destinations worldwide. Book your ideal hotel with our user-friendly platform.";
$metaKeywords = "hotel list, accommodations, lodging, hotel search, travel, resorts, budget hotels, luxury hotels, booking platform, travel accommodations";
$metaTitle = "DMC Booking : Explore Hotel List";
include('files/top-head.php')
?>
<?php
header('Content-Type: text/html; charset=utf-8');
include_once("files/DB_FUNCTION_INC.php");
session_start();
$site = new SITE();
$sortHB = $_SESSION['sortHB'];
$HotelNB = $_SESSION['NbHotels'];
if ($HotelNB > 1) {
  if ($_SESSION['NbHotelsPages'] > 1) {
    $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'][0];
    $HotelList1 = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
  } else {
    $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
    $HotelList1 = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
  }
} else if ($HotelNB == 1) {
  $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
  $HotelList1 = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'];
}
//$HotelList1 = array_sort($HotelList1, $sortHB, $order = SORT_DESC);
//print("<pre>".print_r($HotelList1,true)."</pre>");
XSIGNATURE($ApiKey, $Secret);
if (isset($_GET['PAGE'])) {
  if (isset($_SESSION['HotelBedsAvailabilityRS'])) {
    $P = $_GET['PAGE'];
    if ($P > 1) {
      $newP = $P - 1;
    } else {
      $newP = $P - 1;
    }
    unset($_SESSION['HotelDetailsRS']);
    $HotelList = $_SESSION['HotelBedsAvailabilityRS']['hotels']['hotel'][$newP];
    $HotelList = array_sort($HotelList, $sortHB, $order = SORT_ASC);
  } else {
    $HotelList = [];
  }
}
$SearchHotelHB = $_SESSION['SearchHotelHB'];
$selCountryHB = $SearchHotelHB['Country'];
$selCityHB = $SearchHotelHB['City'];
$selHotelHB = $SearchHotelHB['HotelCode'];
$selHotelHBS = $SearchHotelHB['Hotel'];
$CheckInHB = $SearchHotelHB['CheckIn'];
$CheckOutHB = $SearchHotelHB['CheckOut'];
$BookDetails = '';
$BDRooms = $_SESSION['Rooms'];
$BookDetails = substr($BookDetails, 0, -1);
$DEVISE = "EUR";
if ($_SESSION['firstpricefinal'] <= 0) {
  $_SESSION['firstpricefinal'] = 1;
}
$currentQueryString = $_SERVER['QUERY_STRING'];
parse_str($currentQueryString, $urlData);
$place = ($urlData['Place'] != "destination") ? ($urlData['Place']) : ($_SESSION['CitySearch']);
?>
<body>
  <?php include('./files/header.php') ?>
  <section class="layout-pt-md">
    <div class="container">
      <div class="row y-gap-10 items-center justify-between">
        <div class="col-auto">
          <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
            <div class="col-auto">
              <a href="index.php">Home</a>
            </div>
            <div class="col-auto">
              <div class="">></div>
            </div>
            <?php
            if ($place != null) {
              echo "<div class='col-auto'>
                    <div class='text-dark-1'>" . $place . "</div>
                 </div>
                 <div class='col-auto'>
                    <div class=''>></div>
                 </div>";
            } ?>
            <div class="col-auto">
              <div class="text-dark-1"> Hotel List</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="layout-pt-md-a">
    <div class="container">
      <div class="row y-gap-30">
        <div class="col-xl-3">
          <aside class="y-gap-20">
            <div class="sidebar__item -no-border">
              <div class="px-20 py-20 bg-light-2 rounded-4">
                <h5 class="text-18 fw-500 mb-12">Search Hotel</h5>
                <div class="row y-gap-20 pt-20">
                  <div class="col-12">
                    <div class="searchMenu-loc px-20 py-10 bg-white rounded-4 js-form-dd js-liverSearch">
                      <div data-x-dd-click="searchMenu-loc">
                        <h4 class="text-15 fw-500 ls-2 lh-16">Location</h4>
                        <div class="text-15 text-light-1 ls-2 lh-16">
                          <input autocomplete="off" type="search" placeholder="Where are you going?" class="js-search js-dd-focus" id="search" value="<?php echo $_SESSION['CitySearch'] ?>">
                          <p class="error"></p>
                        </div>
                      </div>
                      <div class="searchMenu-loc__field shadow-2 js-popup-window" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                        <div class="bg-white px-30 py-30 sm:px-0 sm:py-15 rounded-4 results-list">
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
                  </div>
                  <div class="col-12">
                    <div class="searchMenu-date px-20 py-10 bg-white rounded-4 -left js-form-dd js-calendar">
                      <div data-x-dd-click="searchMenu-date">
                        <h4 class="text-15 fw-500 ls-2 lh-16">Check in - Check out</h4>
                        <div class="text-15 text-light-1 ls-2 lh-16">
                          <input type="text" name="daterangeList" value="" id="daterangeList" />
                        </div>
                      </div>
                      <div class="searchMenu-date__field shadow-2" data-x-dd="searchMenu-date" data-x-dd-toggle="-is-active">
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="searchMenu-guests px-20 py-10 bg-white rounded-4 js-form-dd js-form-counters">
                      <div data-x-dd-click="searchMenu-guests">
                        <h4 class="text-15 fw-500 ls-2 lh-16">Guest</h4>
                        <div class="text-15 text-light-1 ls-2 lh-16">
                          <span class="js-count-room">1 room </span>
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
                  </div>
                  <div class="col-12">
                    <div class="button-item">
                      <button class="mainSearch__submit button -dark-1 h-60 px-35 col-12 rounded-100 bg-blue-1 text-white">
                        <i class="icon-search text-20 mr-10"></i>
                        Search
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="sidebar__item ">
              <h5 class="text-18 fw-500 mb-5 ">Search by property name</h5>
              <div class="single-field relative d-flex items-center py-10">
                <input type="text" class="pl-20 border-light text-dark-1 h-50 rounded-8" name="selHotelHBS" id="selHotelHBS" placeholder="Hotel name" value="" autocomplete="off">
                <input type="hidden" class="input-text full-width" name="selHotelHB" id="selHotelHB" value="<?php echo $codeHotel ?>" />
                <input type="hidden" class="input-text full-width" name="selCityHB" id="selCityHB" value="<?php echo $selCityHB ?>" />
                <input type="hidden" class="input-text full-width" name="selCountryHB" id="selCountryHB" value="<?php echo $selCountryHB ?>" />
                <input type="hidden" class="input-text full-width" name="numPage" id="numPage" />
                <div id="display" class="no-display px-20 py-10  rounded-4 px-20 py-20 bg-white"></div>
                <button class="absolute d-flex items-center h-full" style="right:0px" id="hotelSearch">
                  <i class="icon-search text-20 px-15 text-dark-1"></i>
                </button>
              </div>
            </div>
            <div class="sidebar__item ">
              <h5 class="text-18 fw-500 mb-5 ">Zone</h5>
              <div class="single-field relative d-flex items-center py-10">
                <select id="Zones" name="ZoneCode" class="w-100 select_profil">
                  <?php if (!isset($_SESSION['zoneCode'])) { ?>
                    <option value="All">All</option>
                  <?php } ?>
                  <?php foreach ($_SESSION['Zoneslist'] as $kzone => $zone) { ?>
                    <option value="<?php echo $kzone ?>"><?php echo $zone ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="sidebar__item">
              <h5 class="text-18 fw-500 mb-10">Boards</h5>
              <div class="sidebar-checkbox">
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox">
                        <input type="checkbox" value="HB" name="boards">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10"> Half board </div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox">
                        <input type="checkbox" value="AI" name="boards">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10"> ALL INCLUSIVE </div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox">
                        <input type="checkbox" value="RO" name="boards">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Room only</div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox">
                        <input type="checkbox" value="BB" name="boards">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">BED AND BREAKFAST</div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox">
                        <input type="checkbox" value="FB" name="boards">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">FULL BOARD</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="sidebar__item pb-30">
              <h5 class="text-18 fw-500 mb-10">Price</h5>
              <div class="row x-gap-10 y-gap-30">
                <div class="col-12">
                  <div class="js-price-rangeSlider">
                    <div class="text-14 fw-500"></div>
                    <div class="d-flex justify-between mb-20">
                      <div class="text-15 text-dark-1">
                        <span class="js-lower"></span>
                        -
                        <span class="js-upper"></span>
                      </div>
                    </div>
                    <div class="px-5">
                      <div class="js-slider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="sidebar__item">
              <h5 class="text-18 fw-500 mb-10">Star Rating</h5>
              <div class="row x-gap-10 y-gap-10 pt-10 StarRating">
                <div class="col-auto">
                  <button class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100" value="1">1</button>
                </div>
                <div class="col-auto">
                  <button class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100" value="2">2</button>
                </div>
                <div class="col-auto">
                  <button class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100" value="3">3</button>
                </div>
                <div class="col-auto">
                  <button class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100" value="4">4</button>
                </div>
                <div class="col-auto">
                  <button class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100" value="5">5</button>
                </div>
              </div>
            </div>
            <div class="sidebar__item">
              <h5 class="text-18 fw-500 mb-10">Accommodations</h5>
              <div class="sidebar-checkbox">
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox ">
                        <input type="checkbox" value="Apartment" name="Accommodations">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Apartment</div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox ">
                        <input type="checkbox" value="Residence" name="Accommodations">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Residence </div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox ">
                        <input type="checkbox" value="Hotel" name="Accommodations">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Hotel</div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox ">
                        <input type="checkbox" value="Aparthotel" name="Accommodations">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Aparthotel </div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox ">
                        <input type="checkbox" value="Resort" name="Accommodations">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Resort </div>
                    </div>
                  </div>
                </div>
                <div class="row y-gap-10 items-center justify-between">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="form-checkbox ">
                        <input type="checkbox" value="Hostel" name="Accommodations">
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check"></div>
                        </div>
                      </div>
                      <div class="text-15 ml-10">Hostel </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="button-item">
              <button class="mainFilter__submit button -dark-1 h-60 px-35 col-12 rounded-100 bg-blue-1 text-white">
                <i class="icon-search text-20 mr-10"></i>
                Filter
              </button>
            </div>
          </aside>
        </div>
        <div class="col-xl-9">
          <?php if (isset($_SESSION['HotelBedsAvailabilityRS'])) { ?>
            <div class="row y-gap-10 items-center justify-between">
              <div class="col-auto">
                <?php if ($place != null) {
                  echo "<div class='text-18'><span class='fw-500'>" . $HotelNB . " properties</span> in " . $place . "</div>";
                } ?>

              </div>
              <div class="col-auto">
                <div class="row x-gap-20 y-gap-20">
                  <div class="col-auto">
                    <button class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1">
                      <i class="icon-up-down text-14 mr-10"></i>
                      Top picks for your search
                    </button>
                  </div>
                  <div class="col-auto d-none lg:d-block">
                    <button data-x-click="filterPopup" class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1">
                      <i class="icon-up-down text-14 mr-10"></i>
                      Filter
                    </button>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="mt-30"></div>
          <div class="row y-gap-30">
            <?php
            if (isset($_SESSION['NbHotels'])) {
              if ($HotelNB == 0) {
            ?>
                <div class="hotel-list listing-style3 hotel image-box">
                  <article class="box">
                    <div class="details col-sm-12 col-md-12">
                      <div>
                        <div style="border:none; padding: 0;">
                          <h4 class="box-title" style="text-align: center; width: 100%"> Aucun Hotel
                            trouvé pour cette période </h4>
                        </div>
                      </div>
                    </div>
                  </article>
                </div>
                <?php
              } else {
                $B = 0;
                foreach ($HotelList as $key => $H) {
                  $B += 1;
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
                  if (!isset($HotelBedsListFilterZone[$HotelZoneName])) {
                    $HotelBedsListFilterZone[$HotelZoneName] = array();
                    $HotelBedsListFilterZone[$HotelZoneName]['HotelZoneCode'] = $HotelZoneCode;
                    $HotelBedsListFilterZone[$HotelZoneName]['zoneName'] = $HotelZoneName;
                  }
                  $Location = $H['@attributes']['destinationName'];
                  if (isset($_SESSION['hotelDetailList'][$HotelId]['images'])) {
                    $ThumbNailUrl = 'https://photos.hotelbeds.com/giata/' . $_SESSION['hotelDetailList'][$HotelId]['images']['image'][0]['@attributes']['path'];
                  } else {
                    $ThumbNailUrl = $WORKPATH . 'img/noimage.jpg';
                  }
                  $TotalCharges = $H['@attributes']['minRate'];
                  $RateCurrencyCode = $H['@attributes']['currency'];
                  $Currency = 1;
                  if ($DEVISE == "TND") {
                    $EURTND = 1;
                  } else {
                    $EURTND = 1;
                  }
                  $HotelDescription = $_SESSION['hotelDetailList'][$HotelId]['description'];
                  $HotelDescription = substr($HotelDescription, 0, 150);
                  $Point = strrpos($HotelDescription, ".");
                  $Length = strlen($HotelDescription);
                  if ($Point > 0) {
                    $HotelDescription = substr($HotelDescription, 0, ($Point + 1));
                  } else {
                    $Point = strrpos($HotelDescription, " ");
                    $HotelDescription = substr($HotelDescription, 0, ($Point + 1));
                    $HotelDescription .= ".";
                  }
                  $HotelAddress = '';
                  if (isset($_SESSION['hotelDetailList'][$HotelId]['address'])) {
                    $HotelAddress .= $_SESSION['hotelDetailList'][$HotelId]['address'] . ', ';
                  }
                  if (isset($_SESSION['HotelsRequestHB'][$HotelId]['postalCode'])) {
                    $HotelAddress .= $_SESSION['hotelDetailList'][$HotelId]['postalCode'] . ', ';
                  }
                  if (isset($_SESSION['hotelDetailList'][$HotelId]['city'])) {
                    $HotelAddress .= $_SESSION['hotelDetailList'][$HotelId]['city'];
                  }
                  $HotelAddress = ucwords(strtolower($HotelAddress));
                  $OfferPercent = 0;
                  if (isset($H['rooms']['room'][0]['rates']['rate'][0]['offers'])) {
                    if (isset($H['rooms']['room'][0]['rates']['rate'][0]['offers']['offer']['@attributes']['amount'])) {
                      $hasOffer = $H['rooms']['room'][0]['rates']['rate'][0]['offers']['offer']['@attributes']['amount'];
                      $OfferPercent = ceil(abs(($hasOffer / $TotalCharges) * 100));
                    } else {
                      $hasOffer = $H['rooms']['room'][0]['rates']['rate'][0]['offers']['offer'][0]['@attributes']['amount'];
                      $OfferPercent = ceil(abs(($hasOffer / $TotalCharges) * 100));
                    }
                  }
                  if (isset($H['rooms']['room'][0])) {
                    $RoomName = $H['rooms']['room'][0]['@attributes']['name'];
                  } else {
                    $RoomName = $H['rooms']['room']['@attributes']['name'];
                  }
                  $cancellationPolicy = '';
                  $CancellationMsg = "";
                  $CancellationFrom = "";
                  $Cancellation = 0;
                  if (isset($H['rooms']['room'][0]['rates']['rate'][0])) {
                    $BoardCode = $H['rooms']['room'][0]['rates']['rate'][0]['@attributes']['boardCode'];
                    $BoardName = $H['rooms']['room'][0]['rates']['rate'][0]['@attributes']['boardName'];
                    $nbadults = $H['rooms']['room'][0]['rates']['rate'][0]['@attributes']['adults'];
                    if (isset($H['rooms']['room'][0]['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'])) {
                      $Cancellation = 1;
                      if (isset($H['rooms']['room'][0]['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'][0])) {
                        foreach ($H['rooms']['room'][0]['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'] as $key => $CancellationPolicy) {
                          if (isset($CancellationPolicy['@attributes']['from'])) {
                            $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          } else {
                            $CancellationFrom = $CancellationPolicy['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          }
                          $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        }
                      } else {
                        $CancellationPolicies = $H['rooms']['room'][0]['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'];
                        $CancellationFrom = $CancellationPolicies['@attributes']['from'];
                        $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                        $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        $CancellationDefault = $CancellationPolicies['@attributes']['from'];
                        $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                      }
                    }
                  } else if (isset($H['rooms']['room'][0]['rates']['rate'])) {
                    $BoardCode = $H['rooms']['room'][0]['rates']['rate']['@attributes']['boardCode'];
                    $BoardName = $H['rooms']['room'][0]['rates']['rate']['@attributes']['boardName'];
                    $nbadults = $H['rooms']['room'][0]['rates']['rate']['@attributes']['adults'];
                    if (isset($H['rooms']['room'][0]['rates']['rate']['cancellationPolicies']['cancellationPolicy'])) {
                      $Cancellation = 1;
                      if (isset($H['rooms']['room'][0]['rates']['rate']['cancellationPolicies']['cancellationPolicy'][0])) {
                        foreach ($H['rooms']['room'][0]['rates']['rate']['cancellationPolicies']['cancellationPolicy'][0] as $key => $CancellationPolicy) {
                          if (isset($CancellationPolicy['@attributes']['from'])) {
                            $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          } else {
                            $CancellationFrom = $CancellationPolicy['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          }
                          $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        }
                      } else {
                        $CancellationPolicies = $H['rooms']['room'][0]['rates']['rate']['cancellationPolicies']['cancellationPolicy'];
                        $CancellationFrom = $CancellationPolicies['@attributes']['from'];
                        $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                        $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        $CancellationDefault = $CancellationPolicies['@attributes']['from'];
                        $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                      }
                    }
                  } else if (isset($H['rooms']['room']['rates']['rate'][0])) {
                    $BoardCode = $H['rooms']['room']['rates']['rate'][0]['@attributes']['boardCode'];
                    $BoardName = $H['rooms']['room']['rates']['rate'][0]['@attributes']['boardName'];
                    $nbadults = $H['rooms']['room']['rates']['rate'][0]['@attributes']['adults'];
                    if (isset($H['rooms']['room']['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'])) {
                      $Cancellation = 1;
                      if (isset($H['rooms']['room']['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'][0])) {
                        foreach ($H['rooms']['room']['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'][0] as $key => $CancellationPolicy) {
                          if (isset($CancellationPolicy['@attributes']['from'])) {
                            $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          } else {
                            $CancellationFrom = $CancellationPolicy['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          }
                          $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        }
                      } else {
                        $CancellationPolicies = $H['rooms']['room']['rates']['rate'][0]['cancellationPolicies']['cancellationPolicy'];
                        $CancellationFrom = $CancellationPolicies['@attributes']['from'];
                        $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                        $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        $CancellationDefault = $CancellationPolicies['@attributes']['from'];
                        $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                      }
                    }
                  } else if (isset($H['rooms']['room']['rates']['rate'])) {
                    $BoardCode = $H['rooms']['room']['rates']['rate']['@attributes']['boardCode'];
                    $BoardName = $H['rooms']['room']['rates']['rate']['@attributes']['boardName'];
                    $nbadults = $H['rooms']['room']['rates']['rate']['@attributes']['adults'];
                    if (isset($H['rooms']['room']['rates']['rate']['cancellationPolicies']['cancellationPolicy'])) {
                      $Cancellation = 1;
                      if (isset($H['rooms']['room']['rates']['rate']['cancellationPolicies']['cancellationPolicy'][0])) {
                        foreach ($H['rooms']['room']['rates']['rate']['cancellationPolicies']['cancellationPolicy'][0] as $key => $CancellationPolicy) {
                          if (isset($CancellationPolicy['@attributes']['from'])) {
                            $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          } else {
                            $CancellationFrom = $CancellationPolicy['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          }
                          $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        }
                      } else {
                        $CancellationPolicies = $H['rooms']['room']['rates']['rate']['cancellationPolicies']['cancellationPolicy'];
                        $CancellationFrom = $CancellationPolicies['@attributes']['from'];
                        $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                        $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                        $CancellationDefault = $CancellationPolicies['@attributes']['from'];
                        $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                      }
                    }
                  }
                  $MarkupP = 0;
                  $TotalChargeEUR = $TotalCharges * $_SESSION['MARPER'];
                ?>
                  <div class="col-12">
                    <div class="border-top-light pt-30">
                      <div class="row x-gap-20 y-gap-20">
                        <div class="col-md-auto">
                          <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                            <div class="cardImage__content">
                              <img class="col-12 js-lazy" src="<?php echo $ThumbNailUrl ?>" data-src="<?php echo $ThumbNailUrl ?>" alt="hotel image" title="hotel image">
                            </div>
                          </div>
                        </div>
                        <div class="col-md">
                          <h3 class="text-18 lh-16 fw-500 d-flex align-items-center">
                            <?php echo $HotelName ?><br class="lg:d-none">
                            <div class="d-inline-block ml-10">
                              <?php for ($i = 1; $i <= (int) $PropertyRating; $i++) {
                                echo '<i class="icon-star text-10 text-yellow-2"></i>';
                              } ?>
                            </div>
                          </h3>
                          <div class="row x-gap-10 y-gap-10 items-center pt-10">
                            <div class="col-auto">
                              <p class="text-14"><?php echo $HotelAddress ?></p>
                            </div>
                            <div class="col-auto">
                              <div class="size-3 rounded-full bg-light-1"></div>
                            </div>
                          </div>
                          <div class="text-14 lh-15 mt-5">
                            <div class="fw-500"><?php echo $BoardName ?></div>
                            <div class="text-light-1"><?php echo $RoomName ?></div>
                          </div>
                          <?php if ($Cancellation == 1) { ?>
                            <div class="text-14 text-green-2 lh-15 mt-5">
                              <div class="fw-500">Free cancellation </div>
                              <div class="">From <?php echo $CancellationDefault; ?></div>
                            </div>
                          <?php } ?>
                        </div>
                        <div class="col-md-auto text-right md:text-left">
                          <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                            <div class="col-auto">
                              <div class="text-14 lh-14 fw-500"></div>
                              <div class="text-14 lh-14 text-light-1"></div>
                            </div>
                            <div class="col-auto">
                              <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 <?php if ((int) $PropertyRating != 0) echo 'bg-blue-1'; ?>"><?php echo (int) $PropertyRating ?> <?php if ((int) $PropertyRating != 0) echo '<i class="icon-star text-10 ml-5 text-yellow-2"></i>'; ?></div>
                            </div>
                          </div>
                          <div class="">
                            <div class="text-14 text-light-1 mt-5 md:mt-20"><?php print_r($_SESSION['SearchHotelHB']['nights']) ?> nights, <?php print_r($_SESSION['Rooms'][0]['adults']) ?> adult, <?php print_r($_SESSION['Rooms'][0]['children']) ?> children </div>
                            <div class="text-22 lh-12 fw-600 mt-5"><?php echo $TotalChargeEUR ?> EUR</div>
                            <a target="_blank" href="<?php echo $WORKPATH . 'hotel-details.php?source=' . $urlData['source'] . '&HOTEL=' . $HOTEL; ?>" class="button -md -dark-1 bg-blue-1 text-white mt-5">
                              See Availability <div class="icon-arrow-top-right ml-15"></div>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php
                }
              }
            } else {
              ?>
              <div class="spinner">
                <div class="lds-facebook">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
          <?php if (isset($_SESSION['HotelBedsAvailabilityRS'])) { ?>
            <div class="border-top-light mt-30 pt-30">
              <div class="row x-gap-10 y-gap-20 justify-center md:justify-center">
                <ul class="pagination">
                  <?php
                  $currentQueryString = $_SERVER['QUERY_STRING'];
                  if (isset($_GET['PAGE'])) {
                    $currentQueryString = strstr($currentQueryString, "&PAGE=", true);
                    $page_no = $_GET['PAGE'];
                    $page_no = substr($P, 0, 4);
                    $previous_page = $page_no - 1;
                    $next_page = $page_no + 1;
                    $total_no_of_pages = $_SESSION['NbHotelsPages'];
                    $second_last = $total_no_of_pages - 1;
                    $adjacents = "2";
                  } else {
                    $page_no = 1;
                    $previous_page = $page_no - 1;
                    $next_page = $page_no + 1;
                    $total_no_of_pages = $_SESSION['NbHotelsPages'];
                    $second_last = $total_no_of_pages - 1;
                    $adjacents = "2";
                  }
                  ?>
                  <ul class="pagination">
                    <?php if ($page_no > 1) {
                      echo "<li><a href='?$currentQueryString&PAGE=1'><button class='button -blue-1 size-40 rounded-full border-light'><i class='icon-chevron-left text-12'></i><i class='icon-chevron-left text-12'></i></button></a></li>";
                    } ?>
                    <li <?php if ($page_no <= 1) {
                          echo "class='disabled'";
                        } ?>>
                      <a <?php if ($page_no > 1) {
                            echo "href='?$currentQueryString&PAGE=$previous_page'";
                          } ?>><button class='button -blue-1 size-40 rounded-full border-light'><i class='icon-chevron-left text-12'></i></button></a>
                    </li>
                    <?php
                    if ($total_no_of_pages <= 10) {
                      for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                        if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";
                        } else {
                          echo "<li><a href='?$currentQueryString&PAGE=$counter'>$counter</a></li>";
                        }
                      }
                    } elseif ($total_no_of_pages > 10) {
                      if ($page_no <= 4) {
                        for ($counter = 1; $counter < 8; $counter++) {
                          if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                          } else {
                            echo "<li><a href='?$currentQueryString&PAGE=$counter'>$counter</a></li>";
                          }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?$currentQueryString&PAGE=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?$currentQueryString&PAGE=$total_no_of_pages'>$total_no_of_pages</a></li>";
                      } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo "<li><a href='?$currentQueryString&PAGE=1'>1</a></li>";
                        echo "<li><a href='?$currentQueryString&PAGE=2'>2</a></li>";
                        echo "<li><a>...</a></li>";
                        for (
                          $counter = $page_no - $adjacents;
                          $counter <= $page_no + $adjacents;
                          $counter++
                        ) {
                          if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                          } else {
                            echo "<li><a href='?$currentQueryString&PAGE=$counter'>$counter</a></li>";
                          }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?$currentQueryString&PAGE=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?$currentQueryString&PAGE=$total_no_of_pages'>$total_no_of_pages</a></li>";
                      } else {
                        echo "<li><a href='?$currentQueryString&PAGE=1'>1</a></li>";
                        echo "<li><a href='?$currentQueryString&PAGE=2'>2</a></li>";
                        echo "<li><a>...</a></li>";
                        for (
                          $counter = $total_no_of_pages - 6;
                          $counter <= $total_no_of_pages;
                          $counter++
                        ) {
                          if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                          } else {
                            echo "<li><a href='?$currentQueryString&PAGE=$counter'>$counter</a></li>";
                          }
                        }
                      }
                    }
                    ?>
                    <li <?php if ($page_no >= $total_no_of_pages) {
                          echo "class='disabled'";
                        } ?>>
                      <a <?php if ($page_no < $total_no_of_pages) {
                            echo "href='?$currentQueryString&PAGE=$next_page'";
                          } ?>><button class='button -blue-1 size-40 rounded-full border-light'><i class='icon-chevron-right text-12'></i></button></a>
                    </li>
                    <?php if ($page_no < $total_no_of_pages) {
                      echo "<li><a href='?$currentQueryString&PAGE=$total_no_of_pages'><button class='button -blue-1 size-40 rounded-full border-light'><i class='icon-chevron-right text-12'></i><i class='icon-chevron-right text-12'></i></button></a></li>";
                    } ?>
                  </ul>
              </div>
            <?php } ?>
            </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  if ($place != null && array_key_exists($place, $descriptions)) {
    echo "<section class='layout-pt-md-a'>
  <div class='container desc'>
      <h2>Explore and find Hotels in " . $place . " </h2></br>
      <p>" . $descriptions[$place] . "</p>
  </div>
</section>";
  }
  ?>
  <section class="layout-pt-md-a layout-pb-md">
    <div data-anim-wrap="" class="container">
      <div class="row y-gap-20 justify-between items-end">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title">Looking for the perfect stay?</h2>
            <p class=" sectionTitle__text mt-5 sm:mt-0">Travelers with similar searches booked these properties</p>
          </div>
        </div>
      </div>
      <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist ">
        <?php
        $B = 0;
        foreach ($HotelList as $key => $H) {
          $B += 1;
          if ($B == 5) {
            break;
          }
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
          if (!isset($HotelBedsListFilterZone[$HotelZoneName])) {
            $HotelBedsListFilterZone[$HotelZoneName] = array();
            $HotelBedsListFilterZone[$HotelZoneName]['HotelZoneCode'] = $HotelZoneCode;
            $HotelBedsListFilterZone[$HotelZoneName]['zoneName'] = $HotelZoneName;
          }
          $Location = $H['@attributes']['destinationName'];
          if (!isset($_SESSION['HotelDetailsRS'][$HotelId])) {
            HotelDetails($HotelId);
          }
          if (isset($_SESSION['HotelDetailsRS'][$HotelId]['hotel']['images'])) {
            $ThumbNailUrl = 'https://photos.hotelbeds.com/giata/' . $_SESSION['HotelDetailsRS'][$HotelId]['hotel']['images']['image'][0]['@attributes']['path'];
          } else {
            $ThumbNailUrl = $WORKPATH . 'img/noimage.jpg';
          }
          $TotalCharges = $H['@attributes']['minRate'];
          $RateCurrencyCode = $H['@attributes']['currency'];
          $HotelDescription = $_SESSION['HotelDetailsRS'][$HotelId]['hotel']['description'];
          $HotelDescription = substr($HotelDescription, 0, 150);
          $Point = strrpos($HotelDescription, ".");
          $Length = strlen($HotelDescription);
          if ($Point > 0) {
            $HotelDescription = substr($HotelDescription, 0, ($Point + 1));
          } else {
            $Point = strrpos($HotelDescription, " ");
            $HotelDescription = substr($HotelDescription, 0, ($Point + 1));
            $HotelDescription .= ".";
          }
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
          if (isset($H['rooms']['room'][0]['rates']['rate'][0]['offers'])) {
            if (isset($H['rooms']['room'][0]['rates']['rate'][0]['offers']['offer']['@attributes']['amount'])) {
              $hasOffer = $H['rooms']['room'][0]['rates']['rate'][0]['offers']['offer']['@attributes']['amount'];
              $OfferPercent = ceil(abs(($hasOffer / $TotalCharges) * 100));
            } else {
              $hasOffer = $H['rooms']['room'][0]['rates']['rate'][0]['offers']['offer'][0]['@attributes']['amount'];
              $OfferPercent = ceil(abs(($hasOffer / $TotalCharges) * 100));
            }
          }
          $TotalChargeEUR = $TotalCharges * $_SESSION['MARPER'];
          if (isset($H['reviews']['review'])) {
            $reviews = $H['reviews']['review'];
          }
        ?>
          <div class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
            <div class="SearchByhotel hotelsCard -type-1 " id="<?php echo $HotelId ?>">
              <div class="hotelsCard__image">
                <div class="cardImage ratio ratio-1:1">
                  <div class="cardImage__content">
                    <img class="rounded-4 col-12" src="<?php echo $ThumbNailUrl ?>" alt="hotel image" title="hotel image">
                  </div>
                </div>
              </div>
              <div class="hotelsCard__content mt-10">
                <h4 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                  <span><?php echo $HotelName ?></span>
                  <div class="d-inline-block ml-10">
                    <?php for ($i = 1; $i <= (int) $PropertyRating; $i++) {
                      echo '<i class="icon-star text-10 text-yellow-2"></i>';
                    } ?>
                  </div>
                </h4>
                <p class="text-light-1 lh-14 text-14 mt-5"> <?php echo $HotelAddress ?> </p>
                <?php if (isset($reviews)) { ?>
                  <div class="d-flex items-center mt-20">
                    <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white"><?php echo $reviews['@attributes']['rate'] ?></div>
                    <div class="text-14 text-dark-1 fw-500 ml-10">Exceptional</div>
                    <div class="text-14 text-light-1 ml-10"><?php echo $reviews['@attributes']['reviewCount'] ?> reviews</div>
                  </div>
                <?php } ?>
                <div class="mt-5">
                  <div class="fw-500">
                    Starting from <span class="text-blue-1">
                      <?php echo $TotalChargeEUR ?> EUR
                    </span>
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
    </div>
  </section>
  <?php
  if (array_key_exists($place, $faqs)) {
    echo "<section class='layout-pt-md-a layout-pb-md'>
   <div class='container'>
     <div class='row y-gap-20'>
        <div class='col-lg-4'>
            <h2 class='text-30 fw-500'>
                 FAQs about  " . $place . "
             </h2>
         </div>
         <div class='col-lg-8'>
             <div class='accordion -simple row y-gap-20 js-accordion'>";
    foreach ($faqs[$place] as $key => $value) {
      echo "
                 <div class='col-12'>
                     <div class='accordion__item px-20 py-20 border-light rounded-4'>
                         <div class='accordion__button d-flex items-center'>
                             <div class='accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20'>
                                 <i class='icon-plus'></i>
                                 <i class='icon-minus'></i>
                             </div>
                             <div class='button text-dark-1'>" . $key . "</div>
                         </div>
                         <div class='accordion__content'>
                             <div class='pt-20 pl-60'>
                                 <p class='text-15'>" . $value . "</p>
                             </div>
                         </div>
                     </div>
                 </div>";
    };
    echo " </div>
         </div>
     </div>
 </div>
</section>";
  }
  ?>
  </main>
  <div class="langMenu is-hidden js-langMenu" data-x="lang" data-x-toggle="is-hidden">
    <div class="langMenu__bg" data-x-click="lang"></div>
    <div class="langMenu__content bg-white rounded-4">
      <div class="d-flex items-center justify-between px-30 py-20 sm:px-15 border-bottom-light">
        <div class="text-20 fw-500 lh-15">Select your language</div>
        <button class="pointer" data-x-click="lang">
          <i class="icon-close"></i>
        </button>
      </div>
      <div class="modalGrid px-30 py-30 sm:px-15 sm:py-15">
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">English</div>
            <div class="text-14 lh-15 mt-5 js-title">United States</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Türkçe</div>
            <div class="text-14 lh-15 mt-5 js-title">Turkey</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Español</div>
            <div class="text-14 lh-15 mt-5 js-title">España</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Français</div>
            <div class="text-14 lh-15 mt-5 js-title">France</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Italiano</div>
            <div class="text-14 lh-15 mt-5 js-title">Italia</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">English</div>
            <div class="text-14 lh-15 mt-5 js-title">United States</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Türkçe</div>
            <div class="text-14 lh-15 mt-5 js-title">Turkey</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Español</div>
            <div class="text-14 lh-15 mt-5 js-title">España</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Français</div>
            <div class="text-14 lh-15 mt-5 js-title">France</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Italiano</div>
            <div class="text-14 lh-15 mt-5 js-title">Italia</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">English</div>
            <div class="text-14 lh-15 mt-5 js-title">United States</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Türkçe</div>
            <div class="text-14 lh-15 mt-5 js-title">Turkey</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Español</div>
            <div class="text-14 lh-15 mt-5 js-title">España</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Français</div>
            <div class="text-14 lh-15 mt-5 js-title">France</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Italiano</div>
            <div class="text-14 lh-15 mt-5 js-title">Italia</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">English</div>
            <div class="text-14 lh-15 mt-5 js-title">United States</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Türkçe</div>
            <div class="text-14 lh-15 mt-5 js-title">Turkey</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Español</div>
            <div class="text-14 lh-15 mt-5 js-title">España</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Français</div>
            <div class="text-14 lh-15 mt-5 js-title">France</div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Italiano</div>
            <div class="text-14 lh-15 mt-5 js-title">Italia</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="currencyMenu is-hidden js-currencyMenu" data-x="currency" data-x-toggle="is-hidden">
    <div class="currencyMenu__bg" data-x-click="currency"></div>
    <div class="currencyMenu__content bg-white rounded-4">
      <div class="d-flex items-center justify-between px-30 py-20 sm:px-15 border-bottom-light">
        <div class="text-20 fw-500 lh-15">Select your currency</div>
        <button class="pointer" data-x-click="currency">
          <i class="icon-close"></i>
        </button>
      </div>
      <div class="modalGrid px-30 py-30 sm:px-15 sm:py-15">
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">United States dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">USD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Australian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">AUD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Brazilian real</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BRL</span>
              - R$
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Bulgarian lev</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BGN</span>
              - лв.
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Canadian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">CAD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">United States dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">USD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Australian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">AUD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Brazilian real</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BRL</span>
              - R$
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Bulgarian lev</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BGN</span>
              - лв.
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Canadian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">CAD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">United States dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">USD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Australian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">AUD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Brazilian real</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BRL</span>
              - R$
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Bulgarian lev</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BGN</span>
              - лв.
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Canadian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">CAD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">United States dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">USD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Australian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">AUD</span>
              - $
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Brazilian real</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BRL</span>
              - R$
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Bulgarian lev</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">BGN</span>
              - лв.
            </div>
          </div>
        </div>
        <div class="modalGrid__item js-item">
          <div class="py-10 px-15 sm:px-5 sm:py-5">
            <div class="text-15 lh-15 fw-500 text-dark-1">Canadian dollar</div>
            <div class="text-14 lh-15 mt-5">
              <span class="js-title">CAD</span>
              - $
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('files/bottom.php') ?>
  <script type='text/javascript'>
    <?php
    $js_array = json_encode($_SESSION['Rooms']);
    echo "var roomsarr = " . $js_array . ";\n";
    ?>
  </script>
  <script>
    window.search = true;
    window.isoCode = "<?php echo $SearchHotelHB['City'] ?>";
    window.zoneCode = "<?php echo $SearchHotelHB['ZoneCode'] ?>";
    window.searchvalue = '<?php echo $_SESSION['CitySearch'] ?>';
    var startdate = new Date('<?php echo $CheckInHB ?>');
    startdate.setDate(startdate.getDate());
    var enddate = new Date('<?php echo $CheckOutHB ?>');
    enddate.setDate(enddate.getDate());
    window.start = moment('<?php echo $CheckInHB ?>').format('YYYY-MM-DD');
    window.end = moment('<?php echo $CheckOutHB ?>').format('YYYY-MM-DD');
    $(function() {
      $('input[name="daterangeList"]').daterangepicker({
          opens: "left",
          startDate: startdate,
          endDate: enddate,
          minDate: startdate,
          locale: {
            format: "DD/MM/YYYY",
          },
        },
        function(start, end, label) {
          window.start = start.format("YYYY-MM-DD")
          window.end = end.format("YYYY-MM-DD")
        }
      );
    });
    $(document).ready(function() {
      if (roomsarr != undefined) {
        let cnt = roomsarr.length;
        $('#RoomsSelect').val(cnt).trigger('change');
        for (let i = 0; i < cnt; i++) {
          $('.adultsselect' + i).val(roomsarr[i]['adults']);
          $('.childselect' + i).val(roomsarr[i]['children']);
          $('.childselect' + i).trigger('change');
          if (parseInt(roomsarr[i]['children']) > 0) {
            for (let j = 1; j <= parseInt(roomsarr[i]['children']); j++) {
              $('.ageselect' + i + '-' + j).val(roomsarr[i]['age'][j - 1]);
            }
          }
        }
      }
    });
    $("#selHotelHBS").keyup(function() {
      var country = $('#selCountryHB').val();
      var city = $('#selCityHB').val();
      var selHotelHB = $(this).val();
      if (selHotelHB == '' || selHotelHB.length <= 2) {
        $("#display").hide();
      } else {
        $("#display").show();
      }
      var dataString = 'country=' + country + '&city=' + city + '&selHotelHBS=' + selHotelHB + '&action=searchHotelHB';
      if (selHotelHB.length > 3) {
        $.ajax({
          type: "POST",
          url: "/actions.php",
          data: dataString,
          cache: false,
          success: function(html) {
            $("#display").html(html);
            $("#display").removeClass('no-display');
            $("#display button").click(function() {
              window.hotel = $(this).attr('name');
              window.hotelCode = $(this).attr('id');
              $('#selHotelHBS').val($(this).attr('name'));
              $('#selHotelHBS').attr('codeHotel', $(this).attr('id'));
              $("#display").hide();
            });
          }
        });
      }
      return false;
    });
    $('#hotelSearch').click(function() {
      $('.mainSearch__submit').trigger('click');
    });
    $('#Zones').change(function() {
      window.zoneCode = $(this).val();
      window.searchvalue = $("#Zones option:selected").text();
      $('.mainSearch__submit').trigger('click');
    });
    const targets = document.querySelectorAll(".js-price-rangeSlider");
    targets.forEach((el) => {
      const slider = el.querySelector(".js-slider");
      noUiSlider.create(slider, {
        start: [0, <?php echo ceil($_SESSION['lastpricefinal'] + 1) ?>],
        step: 10,
        connect: true,
        range: {
          min: <?php echo ceil($_SESSION['firstpricefinal'] - 1) ?>,
          max: <?php echo ceil($_SESSION['lastpricefinal'] + 1) ?>,
        },
        format: {
          to: function(value) {
            return "€ " + Math.round(value);
          },
          from: function(value) {
            return Math.round(value);
          },
        },
      });
      const snapValues = [
        el.querySelector(".js-lower"),
        el.querySelector(".js-upper"),
      ];
      slider.noUiSlider.on("update", function(values, handle) {
        snapValues[handle].innerHTML = values[handle];
      });
    });
    $('.StarRating button').click(function() {
      $('.StarRating button').removeClass('active-star');
      $(this).addClass('active-star');
    });
  </script>
  <script src='js/reloadInfo.js'></script>
  <?php
  $currentQueryString = $_SERVER['QUERY_STRING'];
  parse_str($currentQueryString, $urlData);
  if (
    isset($urlData['CityName'], $urlData['City'], $urlData['CheckIn'], $urlData['CheckOut'], $urlData['Rooms'])
  ) {
    $dataMatches = true;
    $keysToCompare = array('CityName', 'City', 'CheckIn', 'CheckOut', 'Rooms');
    foreach ($keysToCompare as $key) {
      if (!isset($_SESSION['SearchHBRefresh'][$key]) || $urlData[$key] != $_SESSION['SearchHBRefresh'][$key]) {
        $dataMatches = false;
        break;
      }
    }
    if ($dataMatches) {
      for ($active = 0; $active < $urlData['Rooms']; $active++) {
        $adultKey = 'Adults' . $active;
        $childrenKey = 'Children' . $active;
        if (
          !isset($urlData[$adultKey], $urlData[$childrenKey]) ||
          $urlData[$adultKey] != $_SESSION['SearchHBRefresh'][$adultKey] ||
          $urlData[$childrenKey] != $_SESSION['SearchHBRefresh'][$childrenKey]
        ) {
          $dataMatches = false;
          break;
        }
        if ($urlData[$childrenKey] > 0) {
          for ($i = 1; $i <= $urlData[$childrenKey]; $i++) {
            $ageKey = 'Age' . $active . '-' . $i;
            if (!isset($urlData[$ageKey]) || $urlData[$ageKey] != $_SESSION['SearchHBRefresh'][$ageKey]) {
              $dataMatches = false;
              break;
            }
          }
        }
      }
    }
    if (!$dataMatches) {
      echo '
      <script>
      reloadInfo();
      </script>';
    }
  } else {
    echo '
    <script>
    reloadDefaultInfo();
    </script>';
  }
  ?>
</body>
</html>