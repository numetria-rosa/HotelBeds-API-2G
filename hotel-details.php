<?php
$metaDescription = "With DMCBooking.pro Explore detailed information and amenities of your chosen hotel with our hotel details page. From room types and rates to facilities and location, make informed decisions for your stay. Book directly with confidence and enjoy a seamless booking experience.";
$metaKeywords = "hotel details, accommodation details, room types, hotel amenities, booking information, hotel rates, facilities, location, direct booking, seamless booking experience, multilingual";
$metaTitle = "DMC Booking :   Explore Hotel Details";
$metaDescriptionFRA = "Avec DMCBooking.pro Explorez la description détaillée de votre hôtel choisi avec notre page de détails de l’hôtel. Faites des choix éclairés pour votre séjour en fonction des chambres, des tarifs, des aménagements et de l'emplacement. Réservez directement en toute confiance et profitez d’une expérience de réservation fluide.";
$metaKeywordsFRA = "détails de l’hôtel, détails de l’hébergement, types de chambres, aménagements de l’hôtel, informations de réservation, tarifs de l’hôtel, emplacement, réservation directe, expérience de réservation transparente, multilingue";
$metaTitleFRA = "DMC Booking : Explorer les détails de l’hôtel";
include('files/top-head.php')
?>
<?php
header('Content-Type: text/html; charset=utf-8');
include_once("files/DB_FUNCTION_INC.php");
session_start();
$site = new SITE();
$lang = $_SESSION['lang'];
$content = $hotel_details_content[$lang];
if (!isset($_SESSION['HotelBedsList'])) {
  header("location:" . $WORKPATH);
}
$HOTELLIST = $_SESSION['HotelBedsList'];
if (isset($HOTELLIST[0])) {
  $HOTEL = $HOTELLIST[$_GET['HOTEL']]['@attributes']['code'];
  $RateCurrencyCode = $HOTELLIST[$_GET['HOTEL']]['@attributes']['currency'];
  $HotelProperty = $HOTELLIST[$_GET['HOTEL']]['rooms']['room'];
} else {
  $HOTEL = $HOTELLIST['@attributes']['code'];
  $RateCurrencyCode = $HOTELLIST['@attributes']['currency'];
  $HotelProperty = $HOTELLIST['rooms']['room'];
}
if (!isset($_SESSION['HotelDetailsRS'][$HOTEL])) {
  HotelDetails($HOTEL);
}
$HotelList = $_SESSION['HotelDetailsRS'];
$HotelId = $HotelList[$HOTEL]['hotel']['@attributes']['code'];
$HotelName = $HotelList[$HOTEL]['hotel']['name'];
$PropertyRating = substr($HotelList[$HOTEL]['hotel']['category']['@attributes']['code'], 0, 1);
$RatingName = $HotelList[$HOTEL]['hotel']['category']['description'];
$Latitude = $HotelList[$HOTEL]['hotel']['coordinates']['@attributes']['latitude'];
$Longitude = $HotelList[$HOTEL]['hotel']['coordinates']['@attributes']['longitude'];
$Location = "";
$Location .= $HotelList[$HOTEL]['hotel']['destination']['name'] . ', ';
$Location .= $HotelList[$HOTEL]['hotel']['country']['description'];
if (isset($HotelList[$HOTEL]['hotel']['images']['image'])) {
  $ThumbNailUrl = 'https://photos.hotelbeds.com/giata/' . $HotelList[$HOTEL]['hotel']['images']['image'][0]['@attributes']['path'];
} else {
  $ThumbNailUrl = $WORKPATH . 'images/hotel-no-image.png';
}
$_SESSION['HotelDetailsImage'] = $ThumbNailUrl;
$ShortDescription = $HotelList[$HOTEL]['hotel']['description'];
$ShortDescription = substr($ShortDescription, 0, 150);
$Point = strrpos($ShortDescription, ".");
$Length = strlen($ShortDescription);
if ($Point > 0) {
  $ShortDescription = substr($ShortDescription, 0, ($Point + 1));
} else {
  $Point = strrpos($ShortDescription, " ");
  $ShortDescription = substr($ShortDescription, 0, ($Point + 1));
  $ShortDescription .= ".";
}
$HotelDescription = $HotelList[$HOTEL]['hotel']['description'];
$HotelAddress = $HotelList[$HOTEL]['hotel']['address'] . ', ';
$HotelAddress .= $HotelList[$HOTEL]['hotel']['postalCode'] . ', ';
$HotelAddress .= $HotelList[$HOTEL]['hotel']['city'];
$HotelAddress = ucwords(strtolower($HotelAddress));
$HotelAddress = nl2br($HotelAddress);
if (isset($HotelList[$HOTEL]['hotel']['images']['image'])) {
  $HotelImages = $HotelList[$HOTEL]['hotel']['images']['image'];
}
$HotelFacilities = $HotelList[$HOTEL]['hotel']['facilities']['facility'];
if (isset($HotelList[$HOTEL]['hotel']['interestPoints']['interestPoint'])) {
  $HotelInterestPoints = $HotelList[$HOTEL]['hotel']['interestPoints']['interestPoint'];
  $interestPoints = 1;
} else {
  $interestPoints = 0;
}
$ROOMS = count($_SESSION['Rooms']);
$SearchHotelHB = $_SESSION['SearchHotelHB'];
$selCountryHB = $SearchHotelHB['Country'];
$selCityHB = $SearchHotelHB['City'];
$selHotelHB = $SearchHotelHB['HotelCode'];
$selHotelHBS = $SearchHotelHB['Hotel'];
$CheckInHB = $SearchHotelHB['CheckIn'];
$CheckOutHB = $SearchHotelHB['CheckOut'];
if (isset($HotelList[$HOTEL]['hotel']['segments']['segment'])) {
  $HotelSegments = $HotelList[$HOTEL]['hotel']['segments']['segment'];
  $HotelSegment = 1;
} else {
  $HotelSegment = 0;
}
$facilityGroups = array(
  70 => array(
    'Id' => '70', 'Title' => 'Facilities', 'Facilities' => array()
  ),
  10 => array(
    'Id' => '10', 'Title' => 'Location', 'Facilities' => array()
  ),
  100 => array(
    'Id' => '100', 'Title' => 'Points of interest', 'Facilities' => array()
  ),
  20 => array(
    'Id' => '20', 'Title' => 'Hotel type', 'Facilities' => array()
  ),
  30 => array(
    'Id' => '30', 'Title' => 'Methods of payment', 'Facilities' => array()
  ),
  40 => array(
    'Id' => '40', 'Title' => 'Distances (in meters)', 'Facilities' => array()
  ),
  61 => array(
    'Id' => '61', 'Title' => 'Room Distribution ', 'Facilities' => array()
  ),
  62 => array(
    'Id' => '62', 'Title' => 'Room distribution Alternative', 'Facilities' => array()
  ),
  71 => array(
    'Id' => '71', 'Title' => 'Catering', 'Facilities' => array()
  ),
  72 => array(
    'Id' => '72', 'Title' => 'Business', 'Facilities' => array()
  ),
  60 => array(
    'Id' => '60', 'Title' => 'Room facilities', 'Facilities' => array()
  ),
  73 => array(
    'Id' => '73', 'Title' => 'Entertainment', 'Facilities' => array()
  ),
  74 => array(
    'Id' => '74', 'Title' => 'Health', 'Facilities' => array()
  ),
  75 => array(
    'Id' => '75', 'Title' => 'Green Programmes - Worldwide', 'Facilities' => array()
  ),
  76 => array(
    'Id' => '76', 'Title' => 'Green Programmes - Europe', 'Facilities' => array()
  ),
  77 => array(
    'Id' => '77', 'Title' => 'Green Programmes - Americas', 'Facilities' => array()
  ),
  78 => array(
    'Id' => '78', 'Title' => 'Green Programmes - Asia-Pacific', 'Facilities' => array()
  ),
  79 => array(
    'Id' => '79', 'Title' => 'Green Programmes - Africa', 'Facilities' => array()
  ),
  80 => array(
    'Id' => '80', 'Title' => 'Meals', 'Facilities' => array()
  ),
  85 => array(
    'Id' => '85', 'Title' => 'Things to keep in mind', 'Facilities' => array()
  ),
  90 => array(
    'Id' => '90', 'Title' => 'Sports', 'Facilities' => array()
  ),
  91 => array(
    'Id' => '91', 'Title' => 'Healthy & Safety (COVID)', 'Facilities' => array()
  ),
);
foreach ($HotelFacilities as $HotelFacility) {
  try {
    array_push($facilityGroups[$HotelFacility['@attributes']['facilityGroupCode']]['Facilities'], $HotelFacility);
    $showFacilities = True;
  } catch (Throwable $t) {
    $showFacilities = False;
  }
}
$ROOMS = count($_SESSION['Rooms']);
$SearchHotelHB = $_SESSION['SearchHotelHB'];
$selCountryHB = $SearchHotelHB['Country'];
$selCityHB = $SearchHotelHB['City'];
$selHotelHB = $SearchHotelHB['HotelCode'];
$selHotelHBS = $SearchHotelHB['Hotel'];
$CheckInHB = $SearchHotelHB['CheckIn'];
$CheckOutHB = $SearchHotelHB['CheckOut'];
unset($_SESSION['ROOM']);
unset($_SESSION['CurrentRoom']);
unset($_SESSION['RoomsRateKey']);
$ROOM = $_SESSION['Rooms'];
$AllRooms = 0;
$AllAdult = 0;
$AllChild = 0;
foreach ($ROOM as $key => $value) {
  $AllRooms += $value['rooms'];
  $AllAdult += $value['adults'];
  $AllChild += $value['children'];
}
$i = 0;
if ($ROOMS > 1) {
  if (isset($HotelProperty[0])) {
    for ($i; $i < $ROOMS; $i++) {
      foreach ($HotelProperty as $key => $H) {
        $RoomName = $H['@attributes']['name'];
        $RoomRates = $H['rates']['rate'];
        if (isset($RoomRates[0])) {
          foreach ($RoomRates as $RateKey => $RoomRate) {
            $RoomNumber = $RoomRate['@attributes']['rooms'];
            $RoomAdults = $RoomRate['@attributes']['adults'];
            $RoomChilds = $RoomRate['@attributes']['children'];
            if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
              $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
              array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
            }
            if ($RoomNumber == $AllRooms && $RoomAdults == $AllAdult && $RoomChilds == $AllChild) {
              $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
              array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
              $Combined = true;
            }
          }
        } else {
          $RoomRate = $RoomRates;
          $RoomNumber = $RoomRate['@attributes']['rooms'];
          $RoomAdults = $RoomRate['@attributes']['adults'];
          $RoomChilds = $RoomRate['@attributes']['children'];
          if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
            $_SESSION['ROOM'][$i][$key] = array('RoomName' => $RoomName);
            array_push($_SESSION['ROOM'][$i][$key], $RoomRate);
          }
          if ($RoomNumber == $AllRooms && $RoomAdults == $AllAdult && $RoomChilds == $AllChild) {
            $_SESSION['ROOM'][$i][$key] = array('RoomName' => $RoomName);
            array_push($_SESSION['ROOM'][$i][$key], $RoomRate);
            $Combined = true;
          }
        }
      }
    }
  } else {
    $H = $HotelProperty;
    $i = 0;
    $key = 0;
    $RateKey = 0;
    $RoomName = $H['@attributes']['name'];
    $RoomRates = $H['rates']['rate'];
    if (isset($RoomRates[0])) {
      foreach ($RoomRates as $RateKey => $RoomRate) {
        $RoomNumber = $RoomRate['@attributes']['rooms'];
        $RoomAdults = $RoomRate['@attributes']['adults'];
        $RoomChilds = $RoomRate['@attributes']['children'];
        if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
          $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
          array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
        }
        if ($RoomNumber == $AllRooms && $RoomAdults == $AllAdult && $RoomChilds == $AllChild) {
          $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
          array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
          $Combined = true;
        }
      }
    } else {
      $RoomRate = $RoomRates;
      $RoomNumber = $RoomRate['@attributes']['rooms'];
      $RoomAdults = $RoomRate['@attributes']['adults'];
      $RoomChilds = $RoomRate['@attributes']['children'];
      $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
      array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
      $Combined = true;
    }
  }
} else {
  if (isset($HotelProperty[0])) {
    foreach ($HotelProperty as $key => $H) {
      $RoomName = $H['@attributes']['name'];
      $RoomRates = $H['rates']['rate'];
      if (isset($RoomRates[0])) {
        foreach ($RoomRates as $RateKey => $RoomRate) {
          $RoomNumber = $RoomRate['@attributes']['rooms'];
          $RoomAdults = $RoomRate['@attributes']['adults'];
          $RoomChilds = $RoomRate['@attributes']['children'];
          if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
            $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
            array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
          }
        }
      } else {
        $RoomRate = $RoomRates;
        $RoomNumber = $RoomRate['@attributes']['rooms'];
        $RoomAdults = $RoomRate['@attributes']['adults'];
        $RoomChilds = $RoomRate['@attributes']['children'];
        $RateKey = $RoomRate['@attributes']['rateKey'];
        if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
          $_SESSION['ROOM'][$i][$key . $RateKey] = array('RoomName' => $RoomName);
          array_push($_SESSION['ROOM'][$i][$key . $RateKey], $RoomRate);
        }
      }
    }
  } else {
    $H = $HotelProperty;
    $RoomName = $H['@attributes']['name'];
    $RoomRates = $H['rates']['rate'];
    if (isset($RoomRates[0])) {
      foreach ($RoomRates as $RateKey => $RoomRate) {
        $RoomNumber = $RoomRate['@attributes']['rooms'];
        $RoomAdults = $RoomRate['@attributes']['adults'];
        $RoomChilds = $RoomRate['@attributes']['children'];
        if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
          $_SESSION['ROOM'][$i][$RateKey] = array('RoomName' => $RoomName);
          array_push($_SESSION['ROOM'][$i][$RateKey], $RoomRate);
        }
      }
    } else {
      $RoomRate = $RoomRates;
      $RoomNumber = $RoomRate['@attributes']['rooms'];
      $RoomAdults = $RoomRate['@attributes']['adults'];
      $RoomChilds = $RoomRate['@attributes']['children'];
      $RateKey = $RoomRate['@attributes']['rateKey'];
      if ($RoomNumber == $ROOM[$i]['rooms'] && $RoomAdults == $ROOM[$i]['adults'] && $RoomChilds == $ROOM[$i]['children']) {
        $_SESSION['ROOM'][$i][$RateKey] = array('RoomName' => $RoomName);
        array_push($_SESSION['ROOM'][$i][$RateKey], $RoomRate);
      }
    }
  }
}
?>

<body>
  <?php include('./files/header.php') ?>
  <section class="layout-pt-md">
    <div class="container">
      <div class="row y-gap-10 items-center justify-between">
        <div class="col-auto">
          <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
            <div class="col-auto">
              <a href="index.php"><?php echo $content['Home']; ?></a>
            </div>
            <div class="col-auto">
              <div class="">></div>
            </div>
            <?php
            $currentQueryString = $_SERVER['QUERY_STRING'];
            parse_str($currentQueryString, $urlData);
            if ($urlData['source'] != "search") {
              echo " <div class='col-auto'>
                     <div class='text-dark-1'>" . $urlData['source'] . " </div>
                     </div>
                     <div class='col-auto'>
                        <div class=''>></div>
                     </div>";
            }
            echo "<div class='col-auto'>
                    <div class='text-dark-1'>" . $_SESSION['CitySearch'] . "</div>
                 </div>
                 <div class='col-auto'>
                    <div class=''>></div>
                 </div>"; ?>
            <div class="col-auto">
              <div class="text-dark-1"> <?php echo $content['Hotel List']; ?></div>
            </div>
            <div class="col-auto">
              <div class="">></div>
            </div>
            <div class="col-auto">
              <div class="text-dark-1"> <?php echo $HotelName;  ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="singleMenu js-singleMenu">
    <div class="singleMenu__content">
      <div class="container">
        <div class="row y-gap-20 justify-between items-center">
          <div class="col-auto">
            <div class="singleMenu__links row x-gap-30 y-gap-10">
              <div class="col-auto">
                <a href="#overview"><?php echo $content['Overview']; ?></a>
              </div>
              <div class="col-auto">
                <a href="#rooms"><?php echo $content['Rooms']; ?></a>
              </div>
              <div class="col-auto">
                <a href="#reviews"><?php echo $content['Reviews']; ?></a>
              </div>
              <div class="col-auto">
                <a href="#facilities"><?php echo $content['Facilities']; ?></a>
              </div>
              <div class="col-auto">
                <a href="#faq"><?php echo $content['Faq']; ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="pt-40">
    <div class="container">
      <div class="row y-gap-20 justify-between items-end">
        <div class="col-auto">
          <div class="row x-gap-20  items-center">
            <div class="col-auto">
              <h1 class="text-30 sm:text-25 fw-600"><?php echo $HotelName ?></h1>
            </div>
            <div class="col-auto">
              <?php for ($i = 1; $i <= (int) $PropertyRating; $i++) {
                echo '<i class="icon-star text-10 text-yellow-2"></i>';
              } ?>
            </div>
          </div>
          <div class="row x-gap-20 y-gap-20 items-center">
            <div class="col-auto">
              <div class="d-flex items-center text-15 text-light-1">
                <i class="icon-location-2 text-16 mr-5"></i>
                <?php echo $HotelAddress ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <div class="row x-gap-15 y-gap-15 items-center">
            <div class="update-search clearfix card-detail" style="display: none;">
              <form action="<?php echo $WORKPATH; ?>actions.php" method="post">
                <input type="hidden" name="action" value="RoomRateKeyForm">
                <?php if (isset($HotelImages)) { ?>
                  <input type="hidden" name="image" value="<?php echo "https://photos.hotelbeds.com/giata/bigger/" . $HotelImages[0]['@attributes']['path']; ?>">
                <?php } else { ?>
                  <input type="hidden" name="image" value="/img/noimage.jpg">
                <?php } ?>
                <div class="row x-gap-15 y-gap-15 items-center">
                  <div class="col-auto">
                    <div class="text-14">
                      <h3 type="button" class="pa-8 no-margin validate-bg full-width text-center"></h3>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                      <?php echo $content['Confirm Reservation']; ?> <div class="icon-arrow-top-right ml-15"></div>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="galleryGrid -type-1 pt-30">
          <?php
          if (isset($HotelImages) && $HotelImages != '') {
            $inc = 0;
            foreach ($HotelImages as $HotelImage) {
              if (isset($HotelImage['@attributes']['path'])) {
                $HotelImagebg = "https://photos.hotelbeds.com/giata/bigger/" . $HotelImage['@attributes']['path'];
              } else {
                $HotelImagebg = '';
              }
              $inc = $inc + 1;
              if ($inc == 1) {
                if (isset($HotelImage['@attributes']['path'])) {
                  $FImagebg = "https://photos.hotelbeds.com/giata/bigger/" . $HotelImage['@attributes']['path'];
                } else {
                  $FImagebg = '';
                }
              };
              if ($inc <= 5) {
          ?>
                <div class="galleryGrid__item relative d-flex">
                  <img src="<?php echo $HotelImagebg ?>" alt="hotel image" title="hotel image" class="rounded-4" <?php if ($inc == 1) {
                                                                                                                    echo 'style="height:350px";';
                                                                                                                  } else {
                                                                                                                    echo ('style="height:170px";');
                                                                                                                  }; ?>>
                  <div class="absolute px-20 py-20 col-12 d-flex justify-end">
                  </div>
                  <?php if ($inc == 5) {
                  ?>
                    <div class="absolute px-10 py-10 col-12 h-full d-flex justify-end items-end">
                      <a href="<?php echo $FImagebg ?>" class="button -blue-1 px-24 py-15 bg-white text-dark-1 js-gallery" data-gallery="gallery0">
                        <?php echo $content['See All Photos']; ?>
                      </a>
                      <?php foreach ($HotelImages as $IndexHotelImagegallery => $HotelImagegallery) {
                        if (isset($HotelImagegallery['@attributes']['path'])) {
                          $HotelImagebg = "https://photos.hotelbeds.com/giata/bigger/" . $HotelImagegallery['@attributes']['path'];
                        } else {
                          $HotelImagebg = '';
                        }
                      ?>
                        <a href="<?php echo $HotelImagebg ?>" class="js-gallery" data-gallery="gallery0"></a>
                      <?php } ?>
                    </div>
                  <?php
                  } ?>
                </div>
            <?php
              }
            }
          } else {
            ?>
            <img src="/img/noimage.jpg" alt="no image" title="no image" class="rounded-4">
          <?php
          }
          ?>
        </div>
      </div>
  </section>
  <section class="pt-30">
    <div class="container">
      <div class="row y-gap-30">
        <div class="col-xl-8">
          <div class="row y-gap-40">
            <?php if ($HotelSegment == 1) { ?>
              <div class="col-12">
                <h3 class="text-22 fw-500"><?php echo $content['Property highlights']; ?></h3>
              <?php } ?>
              <div class="row y-gap-20 pt-30">
                <?php if ($HotelSegment == 1) {
                  if (isset($HotelSegments[0])) {
                    foreach ($HotelSegments as $hotelsegment) {
                ?>
                      <div class="col-lg-3 col-6">
                        <div class="text-center">
                          <i class="icon-city text-24 text-blue-1"></i>
                          <div class="text-15 lh-1 mt-10"><?php echo $hotelsegment['description'] ?></div>
                        </div>
                      </div>
                    <?php
                    }
                  } else {
                    ?>
                    <div class="col-lg-3 col-6">
                      <div class="text-center">
                        <i class="icon-city text-24 text-blue-1"></i>
                        <div class="text-15 lh-1 mt-10"><?php echo $HotelSegments['description'] ?></div>
                      </div>
                    </div>
                  <?php
                  } ?>
              </div>
            <?php
                }
            ?>
              </div>
              <div id="overview" class="col-12">
                <h2 class="text-22 fw-500 pt-40 border-top-light"><?php echo $content['Overview']; ?></h2>
                <p class="text-dark-1 text-15 mt-20">
                  <?php echo $HotelDescription ?>
                </p>
              </div>
              <div class="col-12">
                <?php if ($showFacilities) {
                  echo "<h3 class='text-22 fw-500 pt-40 border-top-light'>" . $content['Most Popular Facilities'] . "</h3>";
                } ?>
                <div class="row y-gap-10 pt-20">
                  <?php $incfacility = 0;
                  foreach ($HotelFacilities as $hotelfacility) {
                    $incfacility = $incfacility + 1;
                    if ($incfacility < 10) { ?>
                      <div class="col-md-5">
                        <div class="d-flex x-gap-15 y-gap-15 items-center">
                          <?php if (isset($hotelfacility['@attributes']['number'])) { ?>
                            <div class="text-15"><?php echo $hotelfacility['@attributes']['number'] . ' ' . $hotelfacility['description'] ?></div>
                          <?php } ?>
                        </div>
                      </div>
                  <?php }
                  } ?>
                </div>
              </div>
              <div class="col-12">
                <div class="px-24 py-20 rounded-4 bg-green-1">
                  <div class="row x-gap-20 y-gap-20 items-center">
                    <div class="col-auto">
                      <div class="flex-center size-60 rounded-full bg-white">
                        <i class="icon-star text-yellow-1 text-30"></i>
                      </div>
                    </div>
                    <div class="col-auto">
                      <h4 class="text-18 lh-15 fw-500"><?php echo $content['This property is in high demand!']; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="ml-50 lg:ml-0">
            <div class="px-30 py-30 border-light rounded-4 mt-30">
              <div style="overflow:hidden;max-width:100%;width:300px;height:170px;">
                <div id="g-mapdisplay" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $Latitude ?>,<?php echo $Longitude ?>&key=xxxxxxxxxxxxxxx></iframe></div><a class="googlecoder" rel="nofollow" href="https://www.bootstrapskins.com/themes" id="get-data-for-embed-map"></a>
                <style>
                  #g-mapdisplay img {
                    max-height: none;
                    max-width: none !important;
                    background: none !important;
                  }
                </style>
              </div>
              <div class="row y-gap-10 mt-5">
                <div class="col-12">
                  <div class="d-flex items-center">
                    <i class="icon-award text-20 text-blue-1"></i>
                    <div class="text-14 fw-500 ml-10"><?php echo $content['Exceptional location - Inside city center']; ?></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex items-center">
                    <i class="icon-pedestrian text-20 text-blue-1"></i>
                    <div class="text-14 fw-500 ml-10"><?php echo $content['Exceptional for walking']; ?></div>
                  </div>
                </div>
              </div>
              <div class="border-top-light mt-15 mb-15"></div>
              <?php if ($interestPoints == 1) { ?>
                <div class="text-15 fw-500">Popular landmarks</div>
                <?php $hotelinterestpointinc = 1;
                foreach ($HotelInterestPoints as $hotelinterestpoint) {
                  $hotelinterestpointinc = $hotelinterestpointinc + 1;
                  if ($hotelinterestpointinc > 3) {
                    break;
                  }
                ?>
                  <div class="d-flex justify-between pt-10">
                    <div class="text-14"><?php echo $hotelinterestpoint['@attributes']['poiName'] ?></div>
                    <div class="text-14 text-light-1"><?php echo ((int)$hotelinterestpoint['@attributes']['distance'] / 1000) ?> km</div>
                  </div>
                <?php }
                ?>
                <a href="#interestPoints" class="d-block text-14 fw-500 underline text-blue-1 mt-10"><?php echo $content['Show More']; ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="rooms" class="pt-30">
    <div class="container">
      <div class="row pb-20">
        <div class="col-auto">
          <h3 class="text-22 fw-500"><?php echo $content['Available Rooms']; ?></h3>
        </div>
      </div>
      <?php
      if (!isset($Combined)) {
        for ($i = 0; $i < $ROOMS; $i++) {
          if (!isset($_SESSION['ROOM'][$i])) {
            continue;
          }
          unset($_SESSION['CurrentRoom']);
          $Rooms = $_SESSION['ROOM'][$i];
          $j = 0;
          $N = count($Rooms);
          $KEYS = array_keys($Rooms);
          $SearchUniqueId = random_password();
          $CurrentRoom = current($Rooms);
      ?>
          <div class="border-light rounded-4 px-30 py-30 sm:px-20 sm:py-20">
            <div class="row y-gap-20">
              <div class="col-12">
                <h3 class="text-18 fw-500 mb-15 rounded-4 bg-green-1"><span class="roomnbrs"><?php echo $content['ROOM'] . ' N °' . ($i + 1) ?> </span></h3>
                <div class="roomGrid">
                  <div class="roomGrid__header">
                    <div><?php echo $content['Room Type']; ?></div>
                    <div><?php echo $content['Board Type']; ?></div>
                    <div><?php echo $content['Sleeps']; ?></div>
                    <div><?php echo $content['Price']; ?></div>
                    <div><?php echo $content['Select Rooms']; ?></div>
                  </div>
                  <div class="roomGrid__grid">
                    <div class="y-gap-0">
                      <?php
                      foreach ($Rooms as $key => $Room) {
                        $j += 1;
                        if ($j <= $N) {
                          $SectionUniqueId = random_password();
                          $RoomRateKey = $Room[0]['@attributes']['rateKey'];
                          $RoomRateClass = $Room[0]['@attributes']['rateClass'];
                          $RoomRateType = $Room[0]['@attributes']['rateType'];
                          if ($RoomRateType == 'RECHECK') {
                            $RRateKey = '<room rateKey="' . $RoomRateKey . '"/>';
                            RoomCheckRate($RRateKey);
                            if (isset($_SESSION['CheckRoomRateKey']['hotel']['rooms']['room']['rates']['rate'])) {
                              $Room[0] = $_SESSION['CheckRoomRateKey']['hotel']['rooms']['room']['rates']['rate'];
                            }
                          }
                          $Nbadlults = $Room[0]['@attributes']['adults'];
                          $RoomRateNet = $Room[0]['@attributes']['net'];
                          if (isset($Room[0]['@attributes']['allotment'])) {
                            $RoomRateAllotment = $Room[0]['@attributes']['allotment'];
                          } else {
                            $RoomRateAllotment = 1;
                          }
                          $RoomNumber = $Room[0]['@attributes']['rooms'];
                          $RoomAdults = $Room[0]['@attributes']['adults'];
                          $RoomChilds = $Room[0]['@attributes']['children'];
                          if (isset($Room[0]['@attributes']['sellingRate'])) {
                            $RoomRatesellingRate = $Room[0]['@attributes']['sellingRate'];
                            $sellingRate = 1;
                          } else {
                            $sellingRate = 0;
                          }
                          $RoomRatePaymentType = $Room[0]['@attributes']['paymentType'];
                          $RoomRatePackaging = $Room[0]['@attributes']['packaging'];
                          $RoomRateBoardCode = $Room[0]['@attributes']['boardCode'];
                          $RoomRateBoardName = $Room[0]['@attributes']['boardName'];
                          $hasCancel = 0;
                          if (isset($Room[0]['cancellationPolicies']['cancellationPolicy'])) {
                            $hasCancel = 1;
                            $CancellationPolicies = $Room[0]['cancellationPolicies']['cancellationPolicy'];
                            $CancellationMsg = '';
                            if (isset($CancellationPolicies[0])) {
                              $CancellationDefault = $CancellationPolicies[0]['@attributes']['from'];
                              foreach ($CancellationPolicies as $key => $CancellationPolicy) {
                                $CancellationFees = $CancellationPolicy['@attributes']['amount'];
                                $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                                $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                                $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                                $CancellationFees = ceil((float)($CancellationFees));
                              }
                              $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                              $date = new DateTime($CancellationDefault);
                              $now = new DateTime();
                              if ($date < $now) {
                                $hasCancel = 0;
                              }
                            } else {
                              $CancellationFees = $CancellationPolicies['@attributes']['amount'];
                              $CancellationFrom = $CancellationPolicies['@attributes']['from'];
                              $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                              $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                              $CancellationFees = ceil((float)($CancellationFees));
                              $CancellationDefault = $CancellationPolicies['@attributes']['from'];
                              $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                              $date = new DateTime($CancellationDefault);
                              $now = new DateTime();
                              if ($date < $now) {
                                $hasCancel = 0;
                              }
                            }
                          }
                          $hasOffer = 0;
                          $oldRate = 0;
                          $OfferPercent = 0;
                          if (isset($Room[0]['offers'])) {
                            $hasOffer = 1;
                            $offerName = '';
                            $OfferPercent = 0;
                            if ($sellingRate == 1) {
                              if (isset($Room[0]['offers']['offer'][0])) {
                                $RoomOffers = $Room[0]['offers']['offer'];
                                foreach ($RoomOffers as $RoomOffer) {
                                  $ReduRate = $RoomOffer['@attributes']['amount'];
                                  $oldRate += $RoomRatesellingRate - $ReduRate;
                                  $offerName .= $RoomOffer['@attributes']['name'] . '<br>';
                                  $OfferPercent += ceil(abs(($ReduRate / $RoomRatesellingRate) * 100));
                                }
                              } else {
                                $ReduRate = $Room[0]['offers']['offer']['@attributes']['amount'];
                                $oldRate += $RoomRatesellingRate - $ReduRate;
                                $offerName = $Room[0]['offers']['offer']['@attributes']['name'];
                                $OfferPercent += ceil(abs(($ReduRate / $RoomRatesellingRate) * 100));
                              }
                            } else {
                              if (isset($Room[0]['offers']['offer'][0])) {
                                $RoomOffers = $Room[0]['offers']['offer'];
                                foreach ($RoomOffers as $RoomOffer) {
                                  $ReduRate = $RoomOffer['@attributes']['amount'];
                                  $oldRate += $RoomRateNet - $ReduRate;
                                  $offerName .= $RoomOffer['@attributes']['name'] . '<br>';
                                  $OfferPercent += ceil(abs(($ReduRate / $RoomRateNet) * 100));
                                }
                              } else {
                                $ReduRate = $Room[0]['offers']['offer']['@attributes']['amount'];
                                $oldRate += $RoomRateNet - $ReduRate;
                                $offerName = $Room[0]['offers']['offer']['@attributes']['name'];
                                $OfferPercent += ceil(abs(($ReduRate / $RoomRateNet) * 100));
                              }
                            }
                          }
                          $CurrentRoom = current($Rooms);
                          $NextRoom = next($Rooms);
                          if (isset($oldRate)) {
                            $oldRate = $oldRate * $_SESSION['MARPER'];
                          }
                          if (isset($RoomRatesellingRate)) {
                            $RoomRatesellingRate = $RoomRatesellingRate * $_SESSION['MARPER'];
                          }
                          $RoomRateNet = $RoomRateNet * $_SESSION['MARPER'];
                      ?>
                          <?php
                          if (isset($_SESSION['CurrentRoom'])) {
                            if ($_SESSION['CurrentRoom'] != $CurrentRoom['RoomName']) {
                              echo ' <hr class="sep">';
                            }
                          }
                          ?>
                          <div class="roomGrid__content <?php echo 'RateKey' . $SearchUniqueId . '-' . $SectionUniqueId . '' ?> <?php echo 'RateKey' . $SearchUniqueId  ?>">
                            <div>
                              <?php
                              if (!isset($_SESSION['CurrentRoom'])) {
                                $_SESSION['CurrentRoom'] = $CurrentRoom['RoomName'];
                                echo '<a href="#" class="d-block text-15 fw-500 wrap-text text-blue-1 mt-15">' . $CurrentRoom['RoomName'] . '</a>';
                              } else if ($_SESSION['CurrentRoom'] != $CurrentRoom['RoomName']) {
                                $_SESSION['CurrentRoom'] = $CurrentRoom['RoomName'];
                                echo '<a href="#" class="d-block text-15 fw-500 wrap-text text-blue-1 mt-15">' . $CurrentRoom['RoomName'] . '</a>';
                              }
                              ?>
                              <?php
                              echo '<input type="hidden" value="' . $CurrentRoom['RoomName'] . '" class="RoomName' . $SectionUniqueId . '">';
                              ?>
                            </div>
                            <div>
                              <div class="text-15 fw-500 boardname"><?php echo $RoomRateBoardName ?></div>
                              <?php if ($hasCancel) { ?>
                                <div class="y-gap-8">
                                  <div class="d-flex items-center text-green-2">
                                    <i class="icon-check text-12 mr-10 "></i>
                                    <div class="text-15"><?php echo $content['Free Cancellation']; ?></div>
                                  </div>
                                  <div class="d-flex items-center text-green-2">
                                    <i class="icon-check text-12 mr-10"></i>
                                    <div class="text-15"><?php echo $content['Before']; ?> <?php echo $CancellationDefault; ?></div>
                                  </div>
                                  <?php if ($RoomRateAllotment > 5) { ?>
                                    <div class="d-flex items-center text-green-2">
                                      <i class="icon-check text-12 mr-10"></i>
                                      <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                    </div>
                                  <?php } else if ($RoomRateAllotment == 1) { ?>
                                    <div class="d-flex items-center text-red-2">
                                      <i class="icon-close text-12 mr-10"></i>
                                      <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Room Left']; ?></div>
                                    </div>
                                  <?php } else { ?>
                                    <div class="d-flex items-center text-red-2">
                                      <i class="icon-close text-12 mr-10"></i>
                                      <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                    </div>
                                  <?php } ?>
                                </div>
                              <?php } else { ?>
                                <div class="d-flex items-center text-red-2">
                                  <i class="icon-close text-12 mr-10"></i>
                                  <div class="text-15"> <?php echo $content['Non refundable']; ?> </div>
                                </div>
                                <?php if ($RoomRateAllotment > 5) { ?>
                                  <div class="d-flex items-center text-green-2">
                                    <i class="icon-check text-12 mr-10"></i>
                                    <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                  </div>
                                <?php } else if ($RoomRateAllotment == 1) { ?>
                                  <div class="d-flex items-center text-red-2">
                                    <i class="icon-close text-12 mr-10"></i>
                                    <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Room Left']; ?></div>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex items-center text-red-2">
                                    <i class="icon-close text-12 mr-10"></i>
                                    <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                  </div>
                                <?php } ?>
                              <?php } ?>
                            </div>
                            <div>
                              <div class="d-flex items-center text-light-1">
                                <?php for ($a = 0; $a < ($RoomAdults + $RoomChilds); $a++) { ?>
                                  <div class="icon-man text-24"></div>
                                <?php } ?>
                              </div>
                            </div>
                            <div>
                              <?php
                              if ($hasOffer == 1) {
                                if ($sellingRate == 1) {
                              ?>
                                  <div class="text-18 lh-15 fw-500 text-red-2" style="text-decoration-line: line-through;"><?php echo $oldRate ?> EUR</div>
                                  <div class="text-18 lh-15 fw-500"><?php echo $RoomRatesellingRate ?> EUR</div>
                                <?php } else { ?>
                                  <div class="text-18 lh-15 fw-500 text-red-2" style="text-decoration-line: line-through;"><?php echo $oldRate ?> EUR</div>
                                  <div class="text-18 lh-15 fw-500 RoomRatePrice"><?php echo $RoomRateNet ?> EUR</div>
                                <?php }
                              } else {
                                if ($sellingRate == 1) { ?>
                                  <div class="text-18 lh-15 fw-500"><?php echo $RoomRatesellingRate ?> EUR</div>
                                <?php } else { ?>
                                  <div class="text-18 lh-15 fw-500 RoomRatePrice"><?php echo $RoomRateNet ?> EUR</div>
                              <?php }
                              } ?>
                              <div class="text-14 lh-18 text-light-1"><?php echo $content['Includes taxes and charges']; ?></div>
                            </div>
                            <div>
                              <input type="hidden" name="action" value="RoomRateKeyForm">
                              <input type="hidden" class="RoomRateKey" name="RoomRateKey" rn="<?php echo $RoomNumber; ?>" value="<?php echo $RoomRateKey; ?>">
                              <input type="hidden" class="RoomAdults" name="RoomAdults" value="<?php echo $RoomAdults; ?>">
                              <input type="hidden" class="RoomChilds" name="RoomChilds" value="<?php echo $RoomChilds; ?>">
                              <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white AddRoomRateKey" id="<?php echo $SectionUniqueId; ?>" ui="<?php echo $SearchUniqueId; ?>">
                                <?php echo $content['Select Room']; ?> <div class="icon-arrow-top-right ml-15"></div>
                              </button>
                            </div>
                          </div>
                      <?php
                        }
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <input type="hidden" id="RoomsNumber" value="<?php echo $ROOMS; ?>">
      <?php
      } else {
        $i = 0;
        $Rooms = $_SESSION['ROOM'][$i];
        $j = 0;
        $N = count($Rooms);
        $KEYS = array_keys($Rooms);
        $SearchUniqueId = random_password();
      ?>
        <div class="border-light rounded-4 px-30 py-30 sm:px-20 sm:py-20">
          <div class="row y-gap-20">
            <div class="col-12">
              <h3 class="text-18 fw-500 mb-15 rounded-4 bg-green-1"><span class="roomnbrs"><?php echo 'ROOMS'  ?> </span></h3>
              <div class="roomGrid">
                <div class="roomGrid__header">
                  <div><?php echo $content['Room Type']; ?></div>
                  <div><?php echo $content['Board Type']; ?></div>
                  <div><?php echo $content['Sleeps']; ?></div>
                  <div><?php echo $content['Price']; ?></div>
                  <div><?php echo $content['Select Rooms']; ?></div>
                </div>
                <div class="roomGrid__grid">
                  <div class="y-gap-0">
                    <?php
                    foreach ($Rooms as $key => $Room) {
                      $j += 1;
                      if ($j <= $N) {
                        $SectionUniqueId = random_password();
                        $RoomRateKey = $Room[0]['@attributes']['rateKey'];
                        $RoomRateClass = $Room[0]['@attributes']['rateClass'];
                        $RoomRateType = $Room[0]['@attributes']['rateType'];
                        if ($RoomRateType == 'RECHECK') {
                          $RRateKey = '<room rateKey="' . $RoomRateKey . '"/>';
                          RoomCheckRate($RRateKey);
                          if (isset($_SESSION['CheckRoomRateKey']['hotel']['rooms']['room']['rates']['rate'])) {
                            $Room[0] = $_SESSION['CheckRoomRateKey']['hotel']['rooms']['room']['rates']['rate'];
                          }
                        }
                        $Nbadlults = $Room[0]['@attributes']['adults'];
                        $RoomRateNet = $Room[0]['@attributes']['net'];
                        if (isset($Room[0]['@attributes']['allotment'])) {
                          $RoomRateAllotment = $Room[0]['@attributes']['allotment'];
                        } else {
                          $RoomRateAllotment = 1;
                        }
                        $RoomNumber = $Room[0]['@attributes']['rooms'];
                        $RoomAdults = $Room[0]['@attributes']['adults'];
                        $RoomChilds = $Room[0]['@attributes']['children'];
                        if (isset($Room[0]['@attributes']['sellingRate'])) {
                          $RoomRatesellingRate = $Room[0]['@attributes']['sellingRate'];
                          $sellingRate = 1;
                        } else {
                          $sellingRate = 0;
                        }
                        $RoomRatePaymentType = $Room[0]['@attributes']['paymentType'];
                        $RoomRatePackaging = $Room[0]['@attributes']['packaging'];
                        $RoomRateBoardCode = $Room[0]['@attributes']['boardCode'];
                        $RoomRateBoardName = $Room[0]['@attributes']['boardName'];
                        $hasCancel = 0;
                        if (isset($Room[0]['cancellationPolicies']['cancellationPolicy'])) {
                          $hasCancel = 1;
                          $CancellationPolicies = $Room[0]['cancellationPolicies']['cancellationPolicy'];
                          $CancellationMsg = '';
                          if (isset($CancellationPolicies[0])) {
                            $CancellationDefault = $CancellationPolicies[0]['@attributes']['from'];
                            foreach ($CancellationPolicies as $key => $CancellationPolicy) {
                              $CancellationFees = $CancellationPolicy['@attributes']['amount'];
                              $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                              $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                              $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                              $CancellationFees = ceil((float)($CancellationFees));
                            }
                            $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                            $date = new DateTime($CancellationDefault);
                            $now = new DateTime();
                            if ($date < $now) {
                              $hasCancel = 0;
                            }
                          } else {
                            $CancellationFees = $CancellationPolicies['@attributes']['amount'];
                            $CancellationFrom = $CancellationPolicies['@attributes']['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                            $CancellationMsg .= HotelBedsDatum($CancellationFrom) . ' ';
                            $CancellationFees = ceil((float)($CancellationFees));
                            $CancellationDefault = $CancellationPolicies['@attributes']['from'];
                            $CancellationDefault = TrimHotelBedsDatum($CancellationDefault);
                            $date = new DateTime($CancellationDefault);
                            $now = new DateTime();
                            if ($date < $now) {
                              $hasCancel = 0;
                            }
                          }
                        }
                        $hasOffer = 0;
                        $oldRate = 0;
                        $OfferPercent = 0;
                        if (isset($Room[0]['offers'])) {
                          $hasOffer = 1;
                          $offerName = '';
                          $OfferPercent = 0;
                          if ($sellingRate == 1) {
                            if (isset($Room[0]['offers']['offer'][0])) {
                              $RoomOffers = $Room[0]['offers']['offer'];
                              foreach ($RoomOffers as $RoomOffer) {
                                $ReduRate = $RoomOffer['@attributes']['amount'];
                                $oldRate += $RoomRatesellingRate - $ReduRate;
                                $offerName .= $RoomOffer['@attributes']['name'] . '<br>';
                                $OfferPercent += ceil(abs(($ReduRate / $RoomRatesellingRate) * 100));
                              }
                            } else {
                              $ReduRate = $Room[0]['offers']['offer']['@attributes']['amount'];
                              $oldRate += $RoomRatesellingRate - $ReduRate;
                              $offerName = $Room[0]['offers']['offer']['@attributes']['name'];
                              $OfferPercent += ceil(abs(($ReduRate / $RoomRatesellingRate) * 100));
                            }
                          } else {
                            if (isset($Room[0]['offers']['offer'][0])) {
                              $RoomOffers = $Room[0]['offers']['offer'];
                              foreach ($RoomOffers as $RoomOffer) {
                                $ReduRate = $RoomOffer['@attributes']['amount'];
                                $oldRate += $RoomRateNet - $ReduRate;
                                $offerName .= $RoomOffer['@attributes']['name'] . '<br>';
                                $OfferPercent += ceil(abs(($ReduRate / $RoomRateNet) * 100));
                              }
                            } else {
                              $ReduRate = $Room[0]['offers']['offer']['@attributes']['amount'];
                              $oldRate += $RoomRateNet - $ReduRate;
                              $offerName = $Room[0]['offers']['offer']['@attributes']['name'];
                              $OfferPercent += ceil(abs(($ReduRate / $RoomRateNet) * 100));
                            }
                          }
                        }
                        $CurrentRoom = current($Rooms);
                        $NextRoom = next($Rooms);
                    ?>
                        <?php
                        if (isset($_SESSION['CurrentRoom'])) {
                          if ($_SESSION['CurrentRoom'] != $CurrentRoom['RoomName']) {
                            echo ' <hr class="sep">';
                          }
                        }
                        ?>
                        <div class="roomGrid__content <?php echo 'RateKey' . $SearchUniqueId . '-' . $SectionUniqueId . '' ?> <?php echo 'RateKey' . $SearchUniqueId  ?>">
                          <div>
                            <?php
                            if (!isset($_SESSION['CurrentRoom'])) {
                              $_SESSION['CurrentRoom'] = $CurrentRoom['RoomName'];
                              echo '<a href="#" class="d-block text-15 fw-500 wrap-text text-blue-1 mt-15">' . $RoomNumber . ' x ' . $CurrentRoom['RoomName'] . '</a>';
                            } else if ($_SESSION['CurrentRoom'] != $CurrentRoom['RoomName']) {
                              $_SESSION['CurrentRoom'] = $CurrentRoom['RoomName'];
                              echo '<a href="#" class="d-block text-15 fw-500 wrap-text text-blue-1 mt-15">' . $RoomNumber . ' x ' . $CurrentRoom['RoomName'] . '</a>';
                            }
                            ?>
                            <?php
                            echo '<input type="hidden" value="' . $CurrentRoom['RoomName'] . '" class="RoomName' . $SectionUniqueId . '">';
                            ?>
                          </div>
                          <div>
                            <div class="text-15 fw-500 boardname"><?php echo $RoomRateBoardName ?></div>
                            <?php if ($hasCancel) { ?>
                              <div class="y-gap-8">
                                <div class="d-flex items-center text-green-2">
                                  <i class="icon-check text-12 mr-10 "></i>
                                  <div class="text-15"><?php echo $content['Free Cancellation']; ?></div>
                                </div>
                                <div class="d-flex items-center text-green-2">
                                  <i class="icon-check text-12 mr-10"></i>
                                  <div class="text-15"><?php echo $content['Before']; ?> <?php echo $CancellationDefault; ?></div>
                                </div>
                                <?php if ($RoomRateAllotment > 5) { ?>
                                  <div class="d-flex items-center text-green-2">
                                    <i class="icon-check text-12 mr-10"></i>
                                    <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                  </div>
                                <?php } else if ($RoomRateAllotment == 1) { ?>
                                  <div class="d-flex items-center text-red-2">
                                    <i class="icon-close text-12 mr-10"></i>
                                    <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Room Left']; ?></div>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex items-center text-red-2">
                                    <i class="icon-close text-12 mr-10"></i>
                                    <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                  </div>
                                <?php } ?>
                              </div>
                            <?php } else { ?>
                              <div class="d-flex items-center text-red-2">
                                <i class="icon-close text-12 mr-10"></i>
                                <div class="text-15"> <?php echo $content['Non refundable']; ?> </div>
                              </div>
                              <?php if ($RoomRateAllotment > 5) { ?>
                                <div class="d-flex items-center text-green-2">
                                  <i class="icon-check text-12 mr-10"></i>
                                  <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                </div>
                              <?php } else if ($RoomRateAllotment == 1) { ?>
                                <div class="d-flex items-center text-red-2">
                                  <i class="icon-close text-12 mr-10"></i>
                                  <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Room Left']; ?></div>
                                </div>
                              <?php } else { ?>
                                <div class="d-flex items-center text-red-2">
                                  <i class="icon-close text-12 mr-10"></i>
                                  <div class="text-15"> <?php echo $RoomRateAllotment; ?> <?php echo $content['Rooms Left']; ?></div>
                                </div>
                              <?php } ?>
                            <?php } ?>
                          </div>
                          <div>
                            <div class="d-flex items-center text-light-1">
                              <?php for ($a = 0; $a < ($RoomAdults + $RoomChilds); $a++) { ?>
                                <div class="icon-man text-24"></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div>
                            <?php
                            if ($hasOffer == 1) {
                              if ($sellingRate == 1) {
                            ?>
                                <div class="text-18 lh-15 fw-500 text-red-2" style="text-decoration-line: line-through;"><?php echo $oldRate ?> EUR</div>
                                <div class="text-18 lh-15 fw-500"><?php echo $RoomRatesellingRate ?> EUR</div>
                              <?php } else { ?>
                                <div class="text-18 lh-15 fw-500 text-red-2" style="text-decoration-line: line-through;"><?php echo $oldRate ?> EUR</div>
                                <div class="text-18 lh-15 fw-500 RoomRatePrice"><?php echo $RoomRateNet ?> EUR</div>
                              <?php }
                            } else {
                              if ($sellingRate == 1) { ?>
                                <div class="text-18 lh-15 fw-500"><?php echo $RoomRatesellingRate ?> EUR</div>
                              <?php } else { ?>
                                <div class="text-18 lh-15 fw-500 RoomRatePrice"><?php echo $RoomRateNet ?> EUR</div>
                            <?php }
                            } ?>
                            <div class="text-14 lh-18 text-light-1"><?php echo $content['Includes taxes and charges']; ?></div>
                          </div>
                          <div>
                            <input type="hidden" name="action" value="RoomRateKeyForm">
                            <input type="hidden" class="RoomRateKey" name="RoomRateKey" rn="<?php echo $RoomNumber; ?>" value="<?php echo $RoomRateKey; ?>">
                            <input type="hidden" class="RoomAdults" name="RoomAdults" value="<?php echo $RoomAdults; ?>">
                            <input type="hidden" class="RoomChilds" name="RoomChilds" value="<?php echo $RoomChilds; ?>">
                            <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white AddRoomRateKey" id="<?php echo $SectionUniqueId; ?>" ui="<?php echo $SearchUniqueId; ?>">
                              <?php echo $content['Select Room']; ?> <div class="icon-arrow-top-right ml-15"></div>
                            </button>
                          </div>
                        </div>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" id="RoomsNumber" value="1">
      <?php
      }
      ?>
    </div>
  </section>
  <div class="container">
    <div class="border-top-light mt-30"></div>
  </div>
  <div id="facilities"></div>
  <section class="mt-40 mb-40">
    <div class="container">
      <?php if ($showFacilities) {
        echo "<h3 class='text-22 fw-500'>" . $content['Facilities of'] . " " . $HotelName . " </h3>";
      } ?>
      <div class="row x-gap-40 y-gap-40">
        <div class="col-sm-4 col-6">
          <div class="row x-gap-40 y-gap-40 pt-20">
            <?php foreach ($facilityGroups as $facilitygrp) { ?>
              <?php if (!empty($facilitygrp['Facilities']) && $facilitygrp['Id'] == 70) { ?>
                <div class="col-xl-12">
                  <div class="row y-gap-30">
                    <div class="col-12">
                      <div class="">
                        <div class="d-flex items-center text-16 fw-500">
                          <?php echo $facilitygrp['Title'] ?>
                        </div>
                        <ul class="text-15 pt-10">
                          <?php foreach ($facilitygrp['Facilities'] as $facility) { ?>
                            <li class="d-flex items-center">
                              <i class="icon-check text-10 mr-20"></i>
                              <?php if (isset($facility['@attributes']['number'])) { ?>
                                <?php echo $facility['@attributes']['number'] . ' ' . $facility['description'] ?>
                              <?php } else { ?>
                                <?php echo $facility['description'] ?>
                              <?php } ?>
                            </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>
        <div class="col-sm-8 col-6">
          <div class="row x-gap-40 y-gap-40 pt-20">
            <?php foreach ($facilityGroups as $facilitygrp) { ?>
              <?php if (!empty($facilitygrp['Facilities']) && $facilitygrp['Id'] != 70) { ?>
                <div class="col-md-4 col-sm-6">
                  <div class="d-flex items-center text-16 fw-500">
                    <?php echo $facilitygrp['Title'] ?>
                  </div>
                  <ul class="text-15 pt-10">
                    <?php $facilitygrpinc = 1;
                    foreach ($facilitygrp['Facilities'] as $facility) {
                      $facilitygrpinc = $facilitygrpinc + 1; ?>
                      <?php if ($facilitygrpinc == 8) break; ?>
                      <li class="d-flex items-center">
                        <i class="icon-check text-10 mr-20"></i>
                        <?php if (isset($facility['@attributes']['number'])) { ?>
                          <?php echo $facility['@attributes']['number'] . ' ' . $facility['description'] ?>
                        <?php } else { ?>
                          <?php echo $facility['description'] ?>
                        <?php } ?>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
            <?php }
            } ?>
          </div>
        </div>
  </section>
  <?php if ($interestPoints == 1) { ?>
    <section class="pt-40 pb-40" id="interestPoints">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-22 fw-500"><?php echo $content['Hotel surroundings']; ?></h3>
          </div>
        </div>
        <div class="row x-gap-50 y-gap-30 pt-20 pb-20">
          <div class="col-lg-12 col-md-12">
            <div class="d-flex items-center">
              <i class="icon-nearby text-20 mr-10"></i>
              <div class="text-16 fw-500"><?php echo $content['What\'s nearby']; ?></div>
            </div>
            <div class="row y-gap-10 pt-10">
              <?php foreach ($HotelInterestPoints as $hotelinterestpoint) { ?>
                <div class="col-12">
                  <div class="row items-center justify-between">
                    <div class="col-auto">
                      <div class="text-15"><?php echo $hotelinterestpoint['@attributes']['poiName'] ?></div>
                    </div>
                    <div class="col-auto">
                      <div class="text-15 text-right"><?php echo ((int)$hotelinterestpoint['@attributes']['distance'] / 1000) ?> km</div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="border-top-light"></div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
  <?php include('files/bottom.php') ?>
  <script>
    HOME = '<?php echo $WORKPATH; ?>';
  </script>
  <script>
    $(".AddRoomRateKey").on("click", function() {
      RoomRateKey = $(this).parent().find('.RoomRateKey').val();
      RoomNumber = $(this).parent().find('.RoomRateKey').attr('rn');
      RoomAdults = $(this).parent().find('.RoomAdults').val();
      RoomChilds = $(this).parent().find('.RoomChilds').val();
      SearchUniqueId = $(this).attr('ui');
      SectionUniqueId = $(this).attr('id');
      var action = 'AddRoomRateKey';
      RoomsNumber = $('#RoomsNumber').val();
      RoomName = $('.RoomName' + SectionUniqueId + '').val();
      RoomBoard = $('.RateKey' + SearchUniqueId + '-' + SectionUniqueId + ' .boardname').html();
      RoomPrice = $('.RateKey' + SearchUniqueId + '-' + SectionUniqueId + ' .RoomRatePrice').html();
      RoomPrice = RoomPrice.replace(' EUR', '');
      RoomPrice = RoomPrice.replace(' ', '');
      var regex = /[+-]?\d+(\.\d+)?/g;
      RoomPrice = RoomPrice.match(regex).map(function(v) {
        return parseFloat(v);
      });
      RoomPrice = RoomPrice[0];
      var dataString = 'SearchUniqueId=' + SearchUniqueId + '&RoomRateKey=' + RoomRateKey + '&RoomNumber=' + RoomNumber + '&RoomAdults=' + RoomAdults + '&RoomChilds=' + RoomChilds + '&RoomName=' + RoomName + '&RoomBoard=' + RoomBoard + '&RoomPrice=' + RoomPrice + '&RoomsNumber=' + RoomsNumber + '&action=' + action;
      $.ajax({
        type: 'POST',
        url: HOME + '/actions.php',
        data: dataString,
        success: function(msg, data, settings) {
          if (data == 'success') {
            $(".RateKey" + SearchUniqueId + " .AddRoomRateKey").removeClass('bg-blue-1');
            $(".RateKey" + SearchUniqueId + " .AddRoomRateKey").addClass('bg-silver-1');
            $(".RateKey" + SearchUniqueId + " .AddRoomRateKey").removeClass('bg-green-2');
            $('#' + SectionUniqueId + '').removeClass('bg-blue-1');
            $('#' + SectionUniqueId + '').addClass('bg-green-2');
            numItems = $('.AddRoomRateKey.bg-green-2').length;
            console.log(numItems);
            if (RoomsNumber == numItems) {
              var response = JSON.parse(msg);
              $('.update-search h3').html(response['Price']);
              $('.update-search').show();
              $('html, body').animate({
                scrollTop: $('.update-search').offset().top - 60
              }, 'fast');
              return false;
            }
          }
        }
      });
    });
  </script>
</body>
</html>
