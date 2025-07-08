<?php
include_once("files/DB_FUNCTION_INC.php");
session_start();
$site = new SITE();

$current_url = $_SERVER['QUERY_STRING'];
parse_str($current_url, $urlData);
$hotelSlug = ($urlData['hotel'] != null) ? ($urlData['hotel']) : ("hyatt-paris-madeleine-paris");
$hotel = $site->SelectHotelData($hotelSlug);

$metaDescription = "With Dmcbooking.pro Discover the allure of " . $hotel[0]['name'] . " hotel in " . $hotel[0]['city'] . ". Immerse yourself in comfort at our exquisite hotel. Explore our world-class facilities, stunning accommodations, and unparalleled service. Book your stay now and experience true hospitality at " . $hotel[0]['name'] . " in " . $hotel[0]['city'] . "";
$metaKeywords = "Dmcbooking.pro, " . $hotel[0]['name'] . ' ' . $hotel[0]['city'] . "hotel details, accommodation details, hotel amenities, booking information, facilities, location, seamless booking experience";
$metaTitle = "DMC Booking :   Explore " . $hotel[0]['name'] . "Hotel Details";
$metaCanonical = "https://dmcbooking.pro/hotel.php?hotel=" . $hotel[0]['slug'];
include('files/top-head.php')
?>
<?php
header('Content-Type: text/html; charset=utf-8');

$HotelName = $hotel[0]['name'];
$HotelImages = json_decode($hotel[0]['images'], true);

$HotelFacilities = json_decode($hotel[0]['facilities'], true);
$HotelFacilities = $HotelFacilities['facility'];

$HotelInterestPoints = json_decode($hotel[0]['interestPoints'], true);
$HotelInterestPoints = $HotelInterestPoints['interestPoint'];

if ($HotelInterestPoints != null) {
  $interestPoints = 1;
} else {
  $interestPoints = 0;
}

$coordinates = json_decode($hotel[0]['coordinates'], true);
$Latitude = $coordinates['@attributes']['latitude'];
$Longitude = $coordinates['@attributes']['longitude'];

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
            echo "<div class='col-auto'>
                    <div class='text-dark-1'>" . ucfirst(strtolower($hotel[0]['city'])) . "</div>
                 </div>
                 <div class='col-auto'>
                    <div class=''>></div>
                 </div>"; ?>
            <div class="col-auto">
              <div class="text-dark-1"> Hotel List</div>
            </div>
            <div class="col-auto">
              <div class="">></div>
            </div>
            <div class="col-auto">
              <div class="text-dark-1"> <?php echo $hotel[0]['name'];  ?></div>
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
                <a href="#overview">Overview</a>
              </div>
              <div class="col-auto">
                <a href="#rooms">Rooms</a>
              </div>
              <div class="col-auto">
                <a href="#reviews">Reviews</a>
              </div>
              <div class="col-auto">
                <a href="#facilities">Facilities</a>
              </div>
              <div class="col-auto">
                <a href="#faq">Faq</a>
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
              <h1 class="text-30 sm:text-25 fw-600"><?php echo $hotel[0]['name'] ?></h1>
            </div>
            <div class="col-auto">
              <?php
              $stars = substr($hotel[0]['categoryCode'], 0, 1);
              for ($i = 1; $i <= (int)$stars; $i++) {
                echo '<i class="icon-star text-10 text-yellow-2"></i>';
              } ?>
            </div>
          </div>
          <div class="row x-gap-20 y-gap-20 items-center">
            <div class="col-auto">
              <div class="d-flex items-center text-15 text-light-1">
                <i class="icon-location-2 text-16 mr-5"></i>
                <?php echo $hotel[0]['address'] . ", " . ucfirst(strtolower($hotel[0]['city'])); ?>
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
                <?php }  ?>

                <div class="row x-gap-15 y-gap-15 items-center">
                  <div class="col-auto">
                    <div class="text-14">
                      <h3 type="button" class="pa-8 no-margin validate-bg full-width text-center"></h3>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                      Confirm Reservation <div class="icon-arrow-top-right ml-15"></div>
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
            foreach ($HotelImages['image'] as $HotelImage) {
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
                        See All Photos
                      </a>
                      <?php foreach ($HotelImages['image'] as $IndexHotelImagegallery => $HotelImagegallery) {
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
                <h3 class="text-22 fw-500">Property highlights</h3>
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
                <h2 class="text-22 fw-500 pt-40 border-top-light">Overview</h2>
                <p class="text-dark-1 text-15 mt-20">
                  <?php echo $hotel[0]['description'] ?>
                </p>
              </div>
              <div class="col-12">
                <?php if ($showFacilities) {
                  echo "<h3 class='text-22 fw-500 pt-40 border-top-light'>Most Popular Facilities</h3>
                <div class='row y-gap-10 pt-20'>";
                  $incfacility = 0;
                  foreach ($HotelFacilities as $hotelfacility) {
                    $facilityDesc = $site->SelectFacilities($hotelfacility['@attributes']['facilityCode'], $hotelfacility['@attributes']['facilityGroupCode']);
                    $incfacility = $incfacility + 1;
                    if ($incfacility < 10) { ?>
                      <div class="col-md-5">
                        <div class="d-flex x-gap-15 y-gap-15 items-center">
                          <?php if (isset($hotelfacility['@attributes']['number'])) { ?>
                            <div class="text-15"><?php echo $hotelfacility['@attributes']['number'] . ' ' . $facilityDesc['description'] ?></div>
                          <?php } ?>
                        </div>
                      </div>
                <?php }
                  }
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
                  <h4 class="text-18 lh-15 fw-500">This property is in high demand!</h4>
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
              <div id="g-mapdisplay" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $Latitude ?>,<?php echo $Longitude ?>&key=xxxxxxxxxxxx></iframe></div><a class="googlecoder" rel="nofollow" href="https://www.bootstrapskins.com/themes" id="get-data-for-embed-map"></a>
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
                  <div class="text-14 fw-500 ml-10">Exceptional location - Inside city center</div>
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex items-center">
                  <i class="icon-pedestrian text-20 text-blue-1"></i>
                  <div class="text-14 fw-500 ml-10">Exceptional for walking</div>
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
              <a href="#interestPoints" class="d-block text-14 fw-500 underline text-blue-1 mt-10">Show More</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <div class="container">
    <div class="border-top-light mt-30"></div>
  </div>
  <div id="facilities"></div>
  <section class="mt-40 mb-40">
    <div class="container">
      <?php if ($showFacilities) {
        echo "<h3 class='text-22 fw-500'>Facilities of " . $HotelName . " </h3>
      <div class='row x-gap-40 y-gap-40'>
        <div class='col-sm-4 col-6'>
          <div class='row x-gap-40 y-gap-40 pt-20'>";
        foreach ($facilityGroups as $facilitygrp) { ?>
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
                          <?php
                          $facilityDesc = $site->SelectFacilities($facility['@attributes']['facilityCode'], $facility['@attributes']['facilityGroupCode']);
                          if (isset($facility['@attributes']['number'])) {
                          ?>
                            <?php echo $facility['@attributes']['number'] . ' ' . $facilityDesc['description'] ?>
                          <?php } else { ?>
                            <?php echo $facilityDesc['description'] ?>
                          <?php } ?>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
      <?php }
        }
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
                    <?php
                    $facilityDesc = $site->SelectFacilities($facility['@attributes']['facilityCode'], $facility['@attributes']['facilityGroupCode']);
                    if (isset($facility['@attributes']['number'])) { ?>
                      <?php echo $facility['@attributes']['number'] . ' ' . $facilityDesc['description'] ?>
                    <?php } else { ?>
                      <?php echo $facilityDesc['description'] ?>
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
            <h3 class="text-22 fw-500">Hotel surroundings</h3>
          </div>
        </div>
        <div class="row x-gap-50 y-gap-30 pt-20 pb-20">
          <div class="col-lg-12 col-md-12">
            <div class="d-flex items-center">
              <i class="icon-nearby text-20 mr-10"></i>
              <div class="text-16 fw-500">What's nearby</div>
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
