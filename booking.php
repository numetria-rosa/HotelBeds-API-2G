<?php
$metaTitle = "DMC Booking : Booking ";
include('files/top-head.php') ?>
<?php
header('Content-Type: text/html; charset=utf-8');
include_once("files/DB_FUNCTION_INC.php");
session_start();
if (!isset($_SESSION['HotelBedsList'])) {
  header("location:" . $WORKPATH);
}
$lang = $_SESSION['lang'];
$content = $hotel_booking_content[$lang];
$site = new SITE();
$DEVISE = stripslashes(utf8_decode('EUR'));
$datecheckin = $_SESSION['SearchHotelHB']['CheckIn'];
$datecheckinFormat = date_format(date_create($datecheckin), "d/m/Y");
$datecheckout = $_SESSION['SearchHotelHB']['CheckOut'];
$datecheckoutFormat = date_format(date_create($datecheckout), "d/m/Y");
$tabledate = explode("-", $datecheckin);
$debut = new DateTime($tabledate[0] . '-' . $tabledate[1] . '-' . $tabledate[2]);
$tabledateout = explode("-", $datecheckout);
$fin = new DateTime($tabledateout[0] . '-' . $tabledateout[1] . '-' . $tabledateout[2]);
$interval = $debut->diff($fin);
$nbnight = $interval->format('%d');
$CheckRoomRateKey = $_SESSION['CheckRoomRateKey'];
$Hotel = $CheckRoomRateKey['hotel']['@attributes'];
$HotelName = $Hotel['name'];
$HotelAddress = $Hotel['zoneName'] . ', ' . $Hotel['destinationName'];
$HotelDestName = $Hotel['destinationName'];
$HotelStars = substr($Hotel['categoryCode'], 0, 1);
$Hotelimage = $Hotel['image'];
$RatingName = $Hotel['categoryName'];
$HotelCurrency = $Hotel['currency'];
$TotalBookingAmount = $Hotel['totalNet'];
$RoomsRatePrices = $_SESSION['RoomsRatePrices'];
$Check_In_Date = datI($Hotel['checkIn']);
$Check_Out_Date = datI($Hotel['checkOut']);
$NumberOfNights = diFF($Hotel['checkIn'], $Hotel['checkOut']);
$NBRooms = 1;
$Rooms = $CheckRoomRateKey['hotel']['rooms']['room'];
if (isset($Rooms[0])) {
  $NBRooms = count($Rooms);
} elseif (isset($Rooms['rates']['rate'][0])) {
  $NBRooms = count($Rooms['rates']['rate']);
}
$_SESSION['TotalBookingAmount'] = $TotalBookingAmount * $_SESSION['MARPER'];
?>
<body>
  <?php include('./files/header.php') ?>
  <section class="layout-pt-md">
    <div class="container">
      <div class="row x-gap-40 y-gap-30 items-center">
        <div class="col-auto">
          <div class="d-flex items-center">
            <div class="size-40 rounded-full flex-center bg-blue-1">
              <i class="icon-check text-16 text-white"></i>
            </div>
            <div class="text-18 fw-500 ml-10"><?php echo $content['Your selection']; ?></div>
          </div>
        </div>
        <div class="col">
          <div class="w-full h-1 bg-border"></div>
        </div>
        <div class="col-auto">
          <div class="d-flex items-center">
            <div class="size-40 rounded-full flex-center bg-blue-1">
              <i class="icon-check text-16 text-white"></i>
            </div>
            <div class="text-18 fw-500 ml-10"><?php echo $content['Your details']; ?></div>
          </div>
        </div>
        <div class="col">
          <div class="w-full h-1 bg-border"></div>
        </div>
        <div class="col-auto">
          <div class="d-flex items-center">
            <div class="size-40 rounded-full flex-center bg-blue-1-05 text-blue-1 fw-500">3</div>
            <div class="text-18 fw-500 ml-10"><?php echo $content['Final step']; ?></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="pt-40 layout-pb-md">
    <div class="container">
      <div class="row">
        <div class="col-xl-7 col-lg-8">
          <?php if (!isset($_SESSION['USER'])) { ?>
            <div class="py-15 px-10 rounded-4 text-15 bg-red-3">
              <?php echo $content['Sign in to book with your saved details or']; ?>
              <a href="/signup.php" class="text-blue-1 fw-500"><?php echo $content['register']; ?></a>
              <?php echo $content['to manage your bookings on the go!']; ?>
            </div>
          <?php } ?>
          <h2 class="text-22 fw-500 mt-40 md:mt-24"></h2>
          <?php
          $AllRooms = 0;
          $AllAdult = 0;
          $AllChild = 0;
          $TotalBookingAmount = 0;
          $NbAdult = 0;
          $NbChild = 0;
          if ($NBRooms == 1) {
            $RoomType = $Rooms['@attributes']['name'];
            $RoomBoard = $Rooms['rates']['rate']['@attributes']['boardName'];
            $Adult = $Rooms['rates']['rate']['@attributes']['adults'];
            $Child = $Rooms['rates']['rate']['@attributes']['children'];
            $Room = $Rooms['rates']['rate']['@attributes']['rooms'];
            $RoomAmountNet = $Rooms['rates']['rate']['@attributes']['net'];
            $RoomAmountTotal = $RoomAmountNet;
            if (isset($Rooms['rates']['rate']['@attributes']['sellingRate'])) {
              $RoomAmountNet = $Rooms['rates']['rate']['@attributes']['sellingRate'];
              $RoomAmountTotal = $RoomAmountNet;
            }
            $rateBreakDownComment = $Rooms['rates']['rate']['@attributes']['rateComments'];
            if (isset($Rooms['rates']['rate']['cancellationPolicies']['cancellationPolicy'])) {
              $cancellationPolicies = $Rooms['rates']['rate']['cancellationPolicies']['cancellationPolicy'];
              if (isset($cancellationPolicies[0])) {
                $CancelPlus = 1;
              } else {
                $CancelPlus = 0;
              }
            }
            if (isset($Rooms['rates']['rate']['rateBreakDown']['rateSupplements'])) {
              $rateBreakDown = $Rooms['rates']['rate']['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
              $RoomAmountNet -= $rateBreakDown['amount'];
              $rateBreakDownName = $rateBreakDown['name'];
              $rateBreakDownFrom = $rateBreakDown['from'];
              $rateBreakDownTo = $rateBreakDown['to'];
              $rateBreakDownNights = $rateBreakDown['nights'];
              $rateBreakDownAmout = $rateBreakDown['amount'];
            }
            $NbAdult += $Adult;
            $NbChild += $Child;
            if (isset($Rooms['rates']['rate']['@attributes']['childrenAges'])) {
              $ChildAges = $Rooms['rates']['rate']['@attributes']['childrenAges'];
            }
          ?>
            <div class="another-toggle filter-toggle">
              <div class="col-md-12 p-0-b">
                <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05 ">
                  <?php echo $Room; ?> x <?php echo $RoomType; ?>, <?php echo $RoomBoard; ?>
                  <?php if ($Adult > 0) { ?>
                    <?php echo ', ' . $Adult; ?> Adult(s)
                  <?php } ?>
                  <?php if ($Child > 0) { ?>
                    <?php echo ', ' . $Child; ?> Child(ren)
                  <?php } ?>
                  <?php
                  $RoomAmountNet2 = (float)(($RoomAmountNet));
                  echo $RoomAmountNet2 * $_SESSION['MARPER'];
                  echo ' ' . $DEVISE;
                  ?>
                </h4>
                <div class="row border-light rounded-4 mt-10 mb-10" style="--bs-gutter-x: 0px;padding:15px;">
                  <div class="col-md-12">
                    <h5 class="text-blue-1 fw-500">
                      <b>Observations</b>
                    </h5>
                    <span class="blok"><?php echo $rateBreakDownComment; ?></span>
                  </div>
                  <?php if (isset($Rooms['rates']['rate']['cancellationPolicies'])) { ?>
                    <div class="col-md-12 mb-20">
                      <?php
                      if ($CancelPlus == 1) {
                        foreach ($cancellationPolicies as $key => $CancellationPolicy) {
                          $CancellationFees = $CancellationPolicy['@attributes']['amount'];
                          $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                          $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                      ?>
                          <div class="row">
                            <div class="col-md-8 text-blue-1 fw-500">
                              <b><?php echo $content['Free Cancellation Before']; ?>
                                <?php echo $CancellationFrom; ?></b>
                            </div>
                            <div class="col-md-3 text-green-2">
                              <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-8">
                              <?php echo $content['From']; ?>
                              <?php echo $CancellationFrom; ?>
                            </div>
                            <div class="col-md-3 text-green-2">
                              <?php
                              if ($DEVISE == 'EUR') {
                                $CancellationFees4 = (float)(($CancellationFees));
                              }
                              echo $CancellationFees4 * $_SESSION['MARPER'];
                              echo ' ' . $DEVISE;
                              ?>
                            </div>
                          </div>
                        <?php
                        }
                      } else {
                        $CancellationFees = $cancellationPolicies['@attributes']['amount'];
                        $CancellationFrom = $cancellationPolicies['@attributes']['from'];
                        $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                        ?>
                        <div class="row">
                          <div class="col-md-8 text-blue-1 fw-500">
                            <b><?php echo $content['Free Cancellation Before']; ?>
                              <?php echo $CancellationFrom; ?></b>
                          </div>
                          <div class="col-md-3  text-green-2">
                            <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-8">
                            <?php echo $content['From']; ?>
                            <?php echo $CancellationFrom; ?>
                          </div>
                          <div class="col-md-3 text-green-2">
                            <?php
                            if ($DEVISE == 'EUR') {
                              $CancellationFees5 = (float)(($CancellationFees));
                            }
                            echo $CancellationFees5 * $_SESSION['MARPER'];
                            echo ' ' . $DEVISE;
                            ?>
                          </div>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                  <?php
                  }
                  $TotalBookingAmount += $RoomAmountTotal;
                  ?>
                </div>
              </div>
            </div>
            <div class="content fix border-light rounded-4 mt-10 mb-10 px-10 py-10">
              <?php
            } else {
              $TotalBookingAmount = 0;
              $NbAdult = 0;
              $NbChild = 0;
              if (isset($Rooms[0])) { ?>
                <div class="content fix">
                  <div class="col-md-12 mb-20">
                    <div class="clear"></div>
                  </div>
                  <?php foreach ($Rooms as $rooms) {
                    if (isset($rooms['rates']['rate'][0])) {
                      foreach ($rooms['rates']['rate'] as $roomsx) {
                        $RoomType = $rooms['@attributes']['name'];
                        $RoomBoard = $roomsx['@attributes']['boardName'];
                        $Adult = $roomsx['@attributes']['adults'];
                        $Child = $roomsx['@attributes']['children'];
                        $Room = $roomsx['@attributes']['rooms'];
                        $RoomAmountNet = $roomsx['@attributes']['net'];
                        $RoomAmountTotal = $RoomAmountNet;
                        if (isset($roomsx['@attributes']['sellingRate'])) {
                          $RoomAmountNet = $roomsx['@attributes']['sellingRate'];
                          $RoomAmountTotal = $RoomAmountNet;
                        }
                        $rateBreakDownComment = $roomsx['@attributes']['rateComments'];
                        if (isset($roomsx['cancellationPolicies']['cancellationPolicy'])) {
                          $cancellationPolicies = $roomsx['cancellationPolicies']['cancellationPolicy'];
                          if (isset($cancellationPolicies[0])) {
                            $CancelPlus = 1;
                          } else {
                            $CancelPlus = 0;
                          }
                        }
                        if (isset($roomsx['rateBreakDown']['rateSupplements'])) {
                          $rateBreakDown = $roomsx['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
                          $RoomAmountNet -= $rateBreakDown['amount'];
                          $rateBreakDownName = $rateBreakDown['name'];
                          $rateBreakDownFrom = $rateBreakDown['from'];
                          $rateBreakDownTo = $rateBreakDown['to'];
                          $rateBreakDownNights = $rateBreakDown['nights'];
                          $rateBreakDownAmout = $rateBreakDown['amount'];
                        }
                        $NbAdult += $Adult;
                        $NbChild += $Child;
                        if (isset($roomsx['@attributes']['childrenAges'])) {
                          $ChildAges = $roomsx['@attributes']['childrenAges'];
                        }
                  ?>
                        <div class="another-toggle filter-toggle">
                          <div class="col-md-12 p-0-b">
                            <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05 ">
                              <?php echo $Room; ?> x <?php echo $RoomType; ?>, <?php echo $RoomBoard; ?>
                              <?php if ($Adult > 0) { ?>
                                <?php echo ', ' . $Adult; ?> <?php echo $content['Adult(s)']; ?>
                              <?php } ?>
                              <?php if ($Child > 0) { ?>
                                <?php echo ', ' . $Child; ?> <?php echo $content['Child(ren)']; ?>
                              <?php } ?>
                              <?php
                              if ($DEVISE == 'EUR') {
                                $RoomAmountNet3 =   (float)(($RoomAmountNet));
                              }
                              echo $RoomAmountNet3 * $_SESSION['MARPER'];
                              echo ' ' . $DEVISE;
                              ?>
                            </h4>
                            <div class="row border-light rounded-4 mt-10 mb-10" style="--bs-gutter-x: 0px;padding:15px;">
                              <div class="col-md-12">
                                <h5 class="text-blue-1 fw-500">
                                  <b> Observations </b>
                                </h5>
                                <span class="blok"><?php echo $rateBreakDownComment; ?></span>
                              </div>
                              <?php if (isset($roomsx['cancellationPolicies'])) { ?>
                                <div class="col-md-12">
                                  <?php
                                  if ($CancelPlus == 1) {
                                    foreach ($cancellationPolicies as $key => $CancellationPolicy) {
                                      $CancellationFees = $CancellationPolicy['@attributes']['amount'];
                                      $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                                      $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                                  ?>
                                      <div class="row">
                                        <div class="col-md-8 green-color">
                                          <b><?php echo $content['Free Cancellation Before']; ?> <?php echo $CancellationFrom; ?></b>
                                        </div>
                                        <div class="col-md-3 text-green-2">
                                          <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-8">
                                          <?php echo $content['From']; ?>
                                          <?php echo $CancellationFrom; ?>
                                        </div>
                                        <div class="col-md-3 text-green-2">
                                          <?php
                                          if ($DEVISE == 'EUR') {
                                            $CancellationFees6 = ceil((float)(($CancellationFees)));
                                          } else {
                                            $CancellationFees6 = ceil((float)(($CancellationFees)));
                                          }
                                          if ($DEVISE == 'EUR') {
                                            $CancellationFees6 = number_format($CancellationFees6, 2, ".", " ");
                                          } else {
                                            $CancellationFees6 = number_format($CancellationFees6, 3, ".", " ");
                                          }
                                          echo $CancellationFees6 * $_SESSION['MARPER'];
                                          echo ' ' . $DEVISE;
                                          ?>
                                        </div>
                                      </div>
                                    <?php
                                    }
                                  } else {
                                    $CancellationFees = $cancellationPolicies['@attributes']['amount'];
                                    $CancellationFrom = $cancellationPolicies['@attributes']['from'];
                                    $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                                    ?>
                                    <div class="row">
                                      <div class="col-md-8 green-color">
                                        <b><?php echo $content['Free Cancellation Before']; ?>
                                          <?php echo $CancellationFrom; ?></b>
                                      </div>
                                      <div class="col-md-3 text-green-2">
                                        <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="col-md-8">
                                        <?php echo $content['From']; ?>
                                        <?php echo $CancellationFrom; ?>
                                      </div>
                                      <div class="col-md-3 text-green-2">
                                        <?php
                                        if ($DEVISE == 'EUR') {
                                          $CancellationFees1 = (float)(($CancellationFees));
                                        }
                                        echo $CancellationFees1 * $_SESSION['MARPER'];
                                        echo ' ' . $DEVISE;
                                        ?>
                                      </div>
                                    </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              <?php
                              }
                              ?>
                              <div class="col-md-12">
                                <h5 class="pull-right" style="margin-top: 15px;">
                                  <?php
                                  if ($DEVISE == 'EUR') {
                                    $RoomAmountNet1 =   (float)(($RoomAmountNet));
                                  }
                                  echo $RoomAmountNet1 * $_SESSION['MARPER'];
                                  echo ' ' . $DEVISE;
                                  ?>
                                </h5>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
                <div class="content fix">
                  <!--- if    isset room 0     ----->
                <?php
                        $TotalBookingAmount += $RoomAmountTotal;
                      }
                    } else {
                      $RoomType = $rooms['@attributes']['name'];
                      $RoomBoard = $rooms['rates']['rate']['@attributes']['boardName'];
                      $Adult = $rooms['rates']['rate']['@attributes']['adults'];
                      $Child = $rooms['rates']['rate']['@attributes']['children'];
                      $Room = $rooms['rates']['rate']['@attributes']['rooms'];
                      $RoomAmountNet = $rooms['rates']['rate']['@attributes']['net'];
                      $RoomAmountTotal = $RoomAmountNet;
                      if (isset($rooms['rates']['rate']['@attributes']['sellingRate'])) {
                        $RoomAmountNet = $rooms['rates']['rate']['@attributes']['sellingRate'];
                        $RoomAmountTotal = $RoomAmountNet;
                      }
                      $rateBreakDownComment = $rooms['rates']['rate']['@attributes']['rateComments'];
                      if (isset($rooms['rates']['rate']['cancellationPolicies']['cancellationPolicy'])) {
                        $cancellationPolicies = $rooms['rates']['rate']['cancellationPolicies']['cancellationPolicy'];
                        if (isset($cancellationPolicies[0])) {
                          $CancelPlus = 1;
                        } else {
                          $CancelPlus = 0;
                        }
                      }
                      if (isset($rooms['rates']['rate']['rateBreakDown']['rateSupplements'])) {
                        $rateBreakDown = $rooms['rates']['rate']['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
                        $RoomAmountNet -= $rateBreakDown['amount'];
                        $rateBreakDownName = $rateBreakDown['name'];
                        $rateBreakDownFrom = $rateBreakDown['from'];
                        $rateBreakDownTo = $rateBreakDown['to'];
                        $rateBreakDownNights = $rateBreakDown['nights'];
                        $rateBreakDownAmout = $rateBreakDown['amount'];
                      }
                      $NbAdult += $Adult;
                      $NbChild += $Child;
                      if (isset($rooms['rates']['rate']['@attributes']['childrenAges'])) {
                        $ChildAges = $rooms['rates']['rate']['@attributes']['childrenAges'];
                      }
                ?>
                <div class="another-toggle filter-toggle">
                  <div class="col-md-12 p-0-b">
                    <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05 ">
                      <?php echo $Room; ?> x <?php echo $RoomType; ?>, <?php echo $RoomBoard; ?>
                      <?php if ($Adult > 0) { ?>
                        <?php echo ', ' . $Adult; ?> <?php echo $content['Adult(s)']; ?>
                      <?php } ?>
                      <?php if ($Child > 0) { ?>
                        <?php echo ', ' . $Child; ?> <?php echo $content['Child(ren)']; ?>
                      <?php } ?>
                      <?php
                      if ($DEVISE == 'EUR') {
                        $RoomAmountNet3 =   (float)(($RoomAmountNet));
                      }
                      echo $RoomAmountNet3 * $_SESSION['MARPER'];
                      echo ' ' . $DEVISE;
                      ?>
                    </h4>
                    <div class="row border-light rounded-4 mt-10 mb-10" style="--bs-gutter-x: 0px;padding:15px;">
                      <div class="col-md-12">
                        <h5 class="text-blue-1 fw-500">
                          <b> Observations </b>
                        </h5>
                        <span class="blok"><?php echo $rateBreakDownComment; ?></span>
                      </div>
                      <?php if (isset($rooms['rates']['rate']['cancellationPolicies'])) { ?>
                        <div class="col-md-12">
                          <?php
                          if ($CancelPlus == 1) {
                            foreach ($cancellationPolicies as $key => $CancellationPolicy) {
                              $CancellationFees = $CancellationPolicy['@attributes']['amount'];
                              $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                              $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                          ?>
                              <div class="row">
                                <div class="col-md-8 green-color">
                                  <b><?php echo $content['Free Cancellation Before']; ?> <?php echo $CancellationFrom; ?></b>
                                </div>
                                <div class="col-md-3 text-green-2">
                                  <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8">
                                  <?php echo $content['From']; ?>
                                  <?php echo $CancellationFrom; ?>
                                </div>
                                <div class="col-md-3 text-green-2">
                                  <?php
                                  if ($DEVISE == 'EUR') {
                                    $CancellationFees6 = ceil((float)(($CancellationFees)));
                                  } else {
                                    $CancellationFees6 = ceil((float)(($CancellationFees)));
                                  }
                                  if ($DEVISE == 'EUR') {
                                    $CancellationFees6 = number_format($CancellationFees6, 2, ".", " ");
                                  } else {
                                    $CancellationFees6 = number_format($CancellationFees6, 3, ".", " ");
                                  }
                                  echo $CancellationFees6 * $_SESSION['MARPER'];
                                  echo ' ' . $DEVISE;
                                  ?>
                                </div>
                              </div>
                            <?php
                            }
                          } else {
                            $CancellationFees = $cancellationPolicies['@attributes']['amount'];
                            $CancellationFrom = $cancellationPolicies['@attributes']['from'];
                            $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                            ?>
                            <div class="row">
                              <div class="col-md-8 green-color">
                                <b><?php echo $content['Free Cancellation Before']; ?> <?php echo $CancellationFrom; ?></b>
                              </div>
                              <div class="col-md-3 text-green-2">
                                <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-8">
                                <?php echo $content['From']; ?>
                                <?php echo $CancellationFrom; ?>
                              </div>
                              <div class="col-md-3 text-green-2">
                                <?php
                                if ($DEVISE == 'EUR') {
                                  $CancellationFees1 = (float)(($CancellationFees));
                                }
                                echo $CancellationFees1 * $_SESSION['MARPER'];
                                echo ' ' . $DEVISE;
                                ?>
                              </div>
                            </div>
                          <?php
                          }
                          ?>
                        </div>
                      <?php
                      }
                      ?>
                      <div class="col-md-12">
                        <h5 class="pull-right" style="margin-top: 15px;">
                          <?php
                          if ($DEVISE == 'EUR') {
                            $RoomAmountNet1 =   ceil((float)(($RoomAmountNet)));
                          }
                          if ($DEVISE == 'EUR') {
                            $RoomAmountNet1 = number_format($RoomAmountNet1, 2, ".", " ");
                          }
                          echo $RoomAmountNet1 * $_SESSION['MARPER'];
                          echo ' ' . $DEVISE;
                          ?>
                        </h5>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="content fix">
                  <!--- if    isset room 0     ----->
              <?php
                      $TotalBookingAmount += $RoomAmountTotal;
                    }
                  }
                } else {
                  $RoomType = $Rooms['@attributes']['name'];
                  $RoomRates = $Rooms['rates']['rate']; ?>
              <div class="content fix">
                <?php
                  foreach ($RoomRates as $Roomrates) {
                    $RoomBoard = $Roomrates['@attributes']['boardName'];
                    $Adult = $Roomrates['@attributes']['adults'];
                    $Child = $Roomrates['@attributes']['children'];
                    $Room = $Roomrates['@attributes']['rooms'];
                    $RoomAmountNet = $Roomrates['@attributes']['net'];
                    $RoomAmountTotal = $RoomAmountNet;
                    if (isset($Roomrates['@attributes']['sellingRate'])) {
                      $RoomAmountNet = $Roomrates['@attributes']['sellingRate'];
                      $RoomAmountTotal = $RoomAmountNet;
                    }
                    $rateBreakDownComment = $Roomrates['@attributes']['rateComments'];
                    if (isset($Roomrates['cancellationPolicies']['cancellationPolicy'])) {
                      $cancellationPolicies = $Roomrates['cancellationPolicies']['cancellationPolicy'];
                      if (isset($cancellationPolicies[0])) {
                        $CancelPlus = 1;
                      } else {
                        $CancelPlus = 0;
                      }
                    }
                    if (isset($Roomrates['rateBreakDown']['rateSupplements'])) {
                      $rateBreakDown = $Roomrates['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
                      $RoomAmountNet -= $rateBreakDown['amount'];
                      $rateBreakDownName = $rateBreakDown['name'];
                      $rateBreakDownFrom = $rateBreakDown['from'];
                      $rateBreakDownTo = $rateBreakDown['to'];
                      $rateBreakDownNights = $rateBreakDown['nights'];
                      $rateBreakDownAmout = $rateBreakDown['amount'];
                    }
                    $NbAdult += $Adult;
                    $NbChild += $Child;
                    if (isset($Roomrates['@attributes']['childrenAges'])) {
                      $ChildAges = $Roomrates['@attributes']['childrenAges'];
                    }
                ?>
                  <div class="another-toggle filter-toggle">
                    <div class="col-md-12 p-0-b">
                      <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05">
                        <?php echo $Room; ?> x <?php echo $RoomType; ?>, <?php echo $RoomBoard; ?>
                        <?php if ($Adult > 0) { ?>
                          <?php echo ', ' . $Adult; ?> Adult(s)
                        <?php } ?>
                        <?php if ($Child > 0) { ?>
                          <?php echo ', ' . $Child; ?> Child(ren)
                        <?php } ?>
                        <?php
                        if ($DEVISE == 'EUR') {
                          $RoomAmountTotal1 = (float)(($RoomAmountTotal));
                        }
                        echo $RoomAmountTotal1 * $_SESSION['MARPER'];
                        echo ' ' . $DEVISE;
                        ?>
                      </h4>
                      <div class="row border-light rounded-4 mt-10 mb-10" style="--bs-gutter-x: 0px;padding:15px;">
                        <div class="col-md-12">
                          <h5 class="text-blue-1 fw-500">
                            <b> Observations </b>
                          </h5>
                          <span class="blok"><?php echo $rateBreakDownComment; ?></span>
                        </div>
                        <?php if (isset($rooms['rates']['rate']['cancellationPolicies'])) { ?>
                          <div class="col-md-12">
                            <?php
                            if ($CancelPlus == 1) {
                              foreach ($cancellationPolicies as $key => $CancellationPolicy) {
                                $CancellationFees = $CancellationPolicy['@attributes']['amount'];
                                $CancellationFrom = $CancellationPolicy['@attributes']['from'];
                                $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                            ?>
                                <div class="row">
                                  <div class="col-md-8 green-color">
                                    <b><?php echo $content['Free Cancellation Before']; ?> <?php echo $CancellationFrom; ?></b>
                                  </div>
                                  <div class="col-md-3 text-green-2">
                                    <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="col-md-8">
                                    <?php echo $content['From']; ?>
                                    <?php echo $CancellationFrom; ?>
                                  </div>
                                  <div class="col-md-3 text-green-2">
                                    <?php
                                    if ($DEVISE == 'EUR') {
                                      $CancellationFees2 = (float)(($CancellationFees));
                                    }
                                    echo $CancellationFees2 * $_SESSION['MARPER'];
                                    echo ' ' . $DEVISE;
                                    ?>
                                  </div>
                                </div>
                              <?php
                              }
                            } else {
                              $CancellationFees = $cancellationPolicies['@attributes']['amount'];
                              $CancellationFrom = $cancellationPolicies['@attributes']['from'];
                              $CancellationFrom = TrimHotelBedsDatum($CancellationFrom);
                              ?>
                              <div class="row">
                                <div class="col-md-8 green-color">
                                  <b><?php echo $content['Free Cancellation Before']; ?>
                                    <?php echo HotelBedsDefault($CancellationFrom); ?></b>
                                </div>
                                <div class="col-md-3 text-green-2">
                                  <b><i class="fa fa-check"></i> <?php echo $content['Free']; ?></b>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8">
                                  <?php echo $content['From']; ?>
                                  <?php echo $CancellationFrom; ?>
                                </div>
                                <div class="col-md-3 text-green-2">
                                  <?php
                                  if ($DEVISE == 'EUR') {
                                    $CancellationFees3 = (float)(($CancellationFees));
                                  }
                                  echo $CancellationFees3 * $_SESSION['MARPER'];
                                  echo ' ' . $DEVISE;
                                  ?>
                                </div>
                              </div>
                            <?php
                            }
                            ?>
                          </div>
                        <?php
                        }
                        ?>
                        <div class="col-md-12">
                          <h5 class="pull-right" style="margin-top: 15px;">
                            <?php
                            if ($DEVISE == 'EUR') {
                              $RoomAmountTotal2 = (float)(($RoomAmountTotal));
                            }
                            echo $RoomAmountTotal2 * $_SESSION['MARPER'];
                            echo ' ' . $DEVISE;
                            ?>
                          </h5>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="content fix">
            <?php
                    $TotalBookingAmount += $RoomAmountTotal;
                  }
                }
            ?> </div><?php
                    }
                      ?>
            <?php if ($NBRooms == 1) { ?>
              <div class="content fix no-padB no-padT">
                <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05" style="text-transform:uppercase;"><?php echo $RoomType ?></h4>
                <?php
                if ($NbAdult > 0) {
                  for ($A = 1; $A <= $NbAdult; $A++) {
                ?>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6 p-0-b">
                          <div class="form-input">
                            <label><?php echo $content['Adult']; ?> N° <?php echo $A; ?></label>
                            <input type="text" name="AdulteFirstName[]" class="form-control  mb-1 input-text" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                          </div>
                        </div>
                        <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                          <div class="form-input">
                            <label></label>
                            <input type="text" name="AdulteLastName[]" class="form-control  mb-1 input-text" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                          </div>
                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                <?php
                  }
                }
                ?>
                <?php if ($NbChild > 0) {
                  for ($K = 1; $K <= $NbChild; $K++) {
                ?>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                          <div class="form-input">
                            <label><?php echo $content['Child']; ?> N° <?php echo $K; ?></label>
                            <input type="text" name="ChildFirstName[]" class="form-control  mb-1 input-text" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                          </div>
                        </div>
                        <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                          <div class="form-input">
                            <label></label>
                            <input type="text" name="ChildLastName[]" class="form-control  mb-1 input-text" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                          </div>
                        </div>
                        <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                          <div class="form-input">
                            <label></label>
                            <input type="text" name="ChildAge[]" class="form-control input-text mb-1" value="<?php echo explode(',', $ChildAges)[$K - 1] ?>" placeholder="Age" required="required" />
                          </div>
                        </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                <?php
                  }
                }
                ?>
              </div>
              <div class="clear"></div>
              <div class="content fix no-padB no-padT">
                <label>Observations</label>
                <div class="form-input row mb-0">
                  <div class="col-sm-12 col-md-12">
                    <textarea name="remark" id="remark" row="6" class="form-control pl-15px input-text2 mb-0" placeholder="Observations "></textarea>
                  </div>
                </div>
              </div>
                </div>
                <?php } else {
                if (isset($Rooms[0])) { ?>
                  <?php foreach ($Rooms as $krooms => $rooms) {
                    if (isset($rooms['rates']['rate'][0])) {
                      foreach ($rooms['rates']['rate'] as $roomsx) {
                        $RoomType = $rooms['@attributes']['name'];
                        $RoomBoard = $roomsx['@attributes']['boardName'];
                        $Adult = $roomsx['@attributes']['adults'];
                        $Child = $roomsx['@attributes']['children'];
                        $Room = $roomsx['@attributes']['rooms'];
                        $RoomAmountNet = $roomsx['@attributes']['net'];
                        $RoomAmountTotal = $RoomAmountNet;
                        if (isset($roomsx['@attributes']['sellingRate'])) {
                          $RoomAmountNet = $roomsx['@attributes']['sellingRate'];
                          $RoomAmountTotal = $RoomAmountNet;
                        }
                        $rateBreakDownComment = $roomsx['@attributes']['rateComments'];
                        if (isset($roomsx['cancellationPolicies']['cancellationPolicy'])) {
                          $cancellationPolicies = $roomsx['cancellationPolicies']['cancellationPolicy'];
                          if (isset($cancellationPolicies[0])) {
                            $CancelPlus = 1;
                          } else {
                            $CancelPlus = 0;
                          }
                        }
                        if (isset($roomsx['rateBreakDown']['rateSupplements'])) {
                          $rateBreakDown = $roomsx['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
                          $RoomAmountNet -= $rateBreakDown['amount'];
                          $rateBreakDownName = $rateBreakDown['name'];
                          $rateBreakDownFrom = $rateBreakDown['from'];
                          $rateBreakDownTo = $rateBreakDown['to'];
                          $rateBreakDownNights = $rateBreakDown['nights'];
                          $rateBreakDownAmout = $rateBreakDown['amount'];
                        }
                        $NbAdult += $Adult;
                        $NbChild += $Child;
                        if (isset($roomsx['@attributes']['childrenAges'])) {
                          $ChildAges = $roomsx['@attributes']['childrenAges'];
                        }
                  ?>
                        <div class="content fix border-light rounded-4 mt-10 mb-10 px-10 py-10">
                          <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05"><?php echo $RoomType ?></h4>
                          <?php
                          if ($Adult > 0) {
                            for ($A = 1; $A <= $Adult; $A++) {
                          ?>
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-input">
                                      <label><?php echo $content['Adult']; ?> N° <?php echo $A; ?></label>
                                      <input type="text" name="AdulteFirstName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                                    </div>
                                  </div>
                                  <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-input">
                                      <label></label>
                                      <input type="text" name="AdulteLastName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                                    </div>
                                  </div>
                                  <div class="clear"></div>
                                </div>
                              </div>
                              <div class="clear"></div>
                          <?php
                            }
                          }
                          ?>
                          <?php
                          if ($Child > 0) {
                            for ($K = 1; $K <= $Child; $K++) {
                          ?>
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-input">
                                      <label><?php echo $content['Child']; ?> N° <?php echo $K; ?></label>
                                      <input type="text" name="ChildFirstName[]" class="form-control input-text  mb-1" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                                    </div>
                                  </div>
                                  <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-input">
                                      <label></label>
                                      <input type="text" name="ChildLastName[]" class="form-control input-text  mb-1" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                                    </div>
                                  </div>
                                  <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-input">
                                      <label></label>
                                      <input type="text" name="ChildAge[]" class="form-control input-text mb-1" value="<?php echo explode(',', $ChildAges)[$K - 1] ?>" placeholder="Age" required="required" />
                                    </div>
                                  </div>
                                  <div class="clear"></div>
                                </div>
                              </div>
                              <div class="clear"></div>
                          <?php
                            }
                          }
                          ?>
                        </div>
                      <?php
                      }
                    } else {
                      $RoomType = $rooms['@attributes']['name'];
                      $RoomBoard = $rooms['rates']['rate']['@attributes']['boardName'];
                      $Adult = $rooms['rates']['rate']['@attributes']['adults'];
                      $Child = $rooms['rates']['rate']['@attributes']['children'];
                      $Room = $rooms['rates']['rate']['@attributes']['rooms'];
                      $RoomAmountNet = $rooms['rates']['rate']['@attributes']['net'];
                      $RoomAmountTotal = $RoomAmountNet;
                      if (isset($rooms['rates']['rate']['@attributes']['sellingRate'])) {
                        $RoomAmountNet = $rooms['rates']['rate']['@attributes']['sellingRate'];
                        $RoomAmountTotal = $RoomAmountNet;
                      }
                      $rateBreakDownComment = $rooms['rates']['rate']['@attributes']['rateComments'];
                      if (isset($rooms['rates']['rate']['cancellationPolicies']['cancellationPolicy'])) {
                        $cancellationPolicies = $rooms['rates']['rate']['cancellationPolicies']['cancellationPolicy'];
                        if (isset($cancellationPolicies[0])) {
                          $CancelPlus = 1;
                        } else {
                          $CancelPlus = 0;
                        }
                      }
                      if (isset($rooms['rates']['rate']['rateBreakDown']['rateSupplements'])) {
                        $rateBreakDown = $rooms['rates']['rate']['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
                        $RoomAmountNet -= $rateBreakDown['amount'];
                        $rateBreakDownName = $rateBreakDown['name'];
                        $rateBreakDownFrom = $rateBreakDown['from'];
                        $rateBreakDownTo = $rateBreakDown['to'];
                        $rateBreakDownNights = $rateBreakDown['nights'];
                        $rateBreakDownAmout = $rateBreakDown['amount'];
                      }
                      $NbAdult += $Adult;
                      $NbChild += $Child;
                      if (isset($rooms['rates']['rate']['@attributes']['childrenAges'])) {
                        $ChildAges = $rooms['rates']['rate']['@attributes']['childrenAges'];
                      }
                      ?>
                      <div class="content fix border-light rounded-4 mt-10 mb-10 px-10 py-10">
                        <h4 class=" py-15 px-10 rounded-4 text-15 bg-blue-1-05"><?php echo $RoomType ?></h4>
                        <?php
                        if ($Adult > 0) {
                          for ($A = 1; $A <= $Adult; $A++) {
                        ?>
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-input">
                                    <label><?php echo $content['Adult']; ?> N° <?php echo $A; ?></label>
                                    <input type="text" name="AdulteFirstName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                                  </div>
                                </div>
                                <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-input">
                                    <label></label>
                                    <input type="text" name="AdulteLastName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                                  </div>
                                </div>
                                <div class="clear"></div>
                              </div>
                            </div>
                            <div class="clear"></div>
                        <?php
                          }
                        }
                        ?>
                        <?php
                        if ($Child > 0) {
                          for ($K = 1; $K <= $Child; $K++) {
                        ?>
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                  <div class="form-input">
                                    <label><?php echo $content['Child']; ?> N° <?php echo $K; ?></label>
                                    <input type="text" name="ChildFirstName[]" class="form-control input-text  mb-1" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                                  </div>
                                </div>
                                <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                  <div class="form-input">
                                    <label></label>
                                    <input type="text" name="ChildLastName[]" class="form-control input-text  mb-1" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                                  </div>
                                </div>
                                <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                  <div class="form-input">
                                    <label></label>
                                    <input type="text" name="ChildAge[]" class="form-control input-text mb-1" value="<?php echo explode(',', $ChildAges)[$K - 1] ?>" placeholder="Age" required="required" />
                                  </div>
                                </div>
                                <div class="clear"></div>
                              </div>
                            </div>
                            <div class="clear"></div>
                        <?php
                          }
                        }
                        ?>
                      </div>
                    <?php
                    }
                  }
                } else {
                  foreach ($RoomRates as $Roomrates) {
                    $RoomBoard = $Roomrates['@attributes']['boardName'];
                    $Adult = $Roomrates['@attributes']['adults'];
                    $Child = $Roomrates['@attributes']['children'];
                    $Room = $Roomrates['@attributes']['rooms'];
                    $RoomAmountNet = $Roomrates['@attributes']['net'];
                    $RoomAmountTotal = $RoomAmountNet;
                    if (isset($Roomrates['@attributes']['sellingRate'])) {
                      $RoomAmountNet = $Roomrates['@attributes']['sellingRate'];
                      $RoomAmountTotal = $RoomAmountNet;
                    }
                    $rateBreakDownComment = $Roomrates['@attributes']['rateComments'];
                    if (isset($Roomrates['cancellationPolicies']['cancellationPolicy'])) {
                      $cancellationPolicies = $Roomrates['cancellationPolicies']['cancellationPolicy'];
                      if (isset($cancellationPolicies[0])) {
                        $CancelPlus = 1;
                      } else {
                        $CancelPlus = 0;
                      }
                    }
                    if (isset($Roomrates['rateBreakDown']['rateSupplements'])) {
                      $rateBreakDown = $Roomrates['rateBreakDown']['rateSupplements']['rateSupplement']['@attributes'];
                      $RoomAmountNet -= $rateBreakDown['amount'];
                      $rateBreakDownName = $rateBreakDown['name'];
                      $rateBreakDownFrom = $rateBreakDown['from'];
                      $rateBreakDownTo = $rateBreakDown['to'];
                      $rateBreakDownNights = $rateBreakDown['nights'];
                      $rateBreakDownAmout = $rateBreakDown['amount'];
                    }
                    $NbAdult += $Adult;
                    $NbChild += $Child;
                    if (isset($Roomrates['@attributes']['childrenAges'])) {
                      $ChildAges = $Roomrates['@attributes']['childrenAges'];
                    }
                    ?>
                    <div class="content fix border-light rounded-4 mt-10 mb-10 px-10 py-10">
                      <h4 class="py-15 px-10 rounded-4 text-15 bg-blue-1-05"><?php echo $RoomType ?></h4>
                      <?php
                      if ($Adult > 0) {
                        for ($A = 1; $A <= $Adult; $A++) {
                      ?>
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                                <div class="form-input">
                                  <label><?php echo $content['Adult']; ?> N° <?php echo $A; ?></label>
                                  <input type="text" name="AdulteFirstName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                                </div>
                              </div>
                              <div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
                                <div class="form-input">
                                  <label></label>
                                  <input type="text" name="AdulteLastName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                                </div>
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                          <div class="clear"></div>
                      <?php
                        }
                      }
                      ?>
                      <?php
                      if ($Child > 0) {
                        for ($K = 1; $K <= $Child; $K++) {
                      ?>
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                <div class="form-input">
                                  <label><?php echo $content['Child']; ?> N° <?php echo $K; ?></label>
                                  <input type="text" name="ChildFirstName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['First name']; ?> " required="required" />
                                </div>
                              </div>
                              <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                <div class="form-input">
                                  <label></label>
                                  <input type="text" name="ChildLastName[]" class="form-control input-text mb-1" value="" placeholder="<?php echo $content['Last name']; ?>" required="required" />
                                </div>
                              </div>
                              <div class="col-xss-6 col-xs-4 col-sm-4 col-md-4">
                                <div class="form-input">
                                  <label></label>
                                  <input type="text" name="ChildAge[]" class="form-control input-text mb-1" value="<?php echo explode(',', $ChildAges)[$K - 1] ?>" placeholder="Age" required="required" readonly />
                                </div>
                              </div>
                              <div class="clear"></div>
                            </div>
                          </div>
                          <div class="clear"></div>
                      <?php
                        }
                      }
                      ?>
                    </div>
                <?php }
                } ?>
                <!-----template-------->
                <div class="content fix no-padB no-padT">
                  <label class="pl-15px">Observations</label>
                  <div class="form-input row mb-0 pa-8 pl-15px">
                    <div class="col-sm-12 col-md-12">
                      <textarea name="remark" id="remark" class="form-control mb-0" placeholder="Observations "></textarea>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <div class="row y-gap-30 pt-40">
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
              <div class="w-full h-1 bg-border mt-40 mb-40"></div>
              <div class="row y-gap-20 items-center justify-between content fix border-light rounded-4 mt-10 mb-10 px-10 py-10">
                <div class="col-12">
                  <form action="<?php echo $WORKPATH ?>stripe.php" method="POST" id="payment-form" class="formpayment">
                    <div class="form-horizontal">
                      <div class="form-input">
                        <div class="row" style="margin:0px">
                          <label class="col-xss-6 col-xs-6 col-sm-6 col-md-6"> <?php echo $content['Name']; ?> </label>
                          <label class="col-xss-6 col-xs-6 col-sm-6 col-md-6">
                            <?php echo $content['Last name']; ?> </label>
                        </div>
                        <div class="row">
                          <div class="col-xss-6 col-xs-6 col-sm-6 col-md-6">
                            <input type="text" class="form-control required mb-0 input-text" placeholder="<?php echo $content['First name']; ?>" name="fname" id="fname">
                          </div>
                          <div class="col-xss-6 col-xs-6 col-sm-6 col-md-6">
                            <input type="text" class="form-control required mb-0 input-text" placeholder="<?php echo $content['Last name']; ?>" name="lname" id="lname">
                          </div>
                        </div>
                        <label class="col-xss-6 col-xs-6 col-sm-6 col-md-6 mt-2">
                          Email </label>
                        <div class="col-sm-12 col-md-12">
                          <input type="email" class="form-control required mb-0" placeholder="Email" name="email" id="pemail">
                          <input type="hidden" name="price" id="pprice" value="<?php echo  number_format($TotalBookingAmount, 3, ".", " ")  ?>">
                          <input type="hidden" name="devise" id="devise" value="<?php echo  $DEVISE ?>">
                        </div>
                      </div>
                      <div class="form-input">
                        <label class="col-xss-6 col-xs-6 col-sm-6 col-md-6" style="margin-top:10px"><?php echo $content['Card Number']; ?></label>
                        <div id="example3-card-number" class="form-control input-tt"></div>
                        <div class="row">
                          <div class="col-xss-6 col-xs-6 col-sm-6 col-md-6" style="margin-top:10px">
                            <label><?php echo $content['Card expiry']; ?></label>
                            <div id="example3-card-expiry" class="form-control input-tt">
                            </div>
                          </div>
                          <div class="col-xss-6 col-xs-6 col-sm-6 col-md-6" style="margin-top:10px">
                            <label>cvc</label>
                            <div id="example3-card-cvc" class="form-control input-tt"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div style="width: 100%;margin-top:10px">
                      <div class="form-checkbox " style="display:flex;align-items:center">
                        <input type="checkbox" name="name" onclick="return false;" checked>
                        <div class="form-checkbox__mark">
                          <div class="form-checkbox__icon icon-check">
                          </div>
                        </div>
                        <p style="margin-left:10px"> <?php echo $content['By proceeding with this booking, I agree to Dmcbooking Terms of Use and Privacy Policy.']; ?> </p>
                      </div>
                    </div>
                    <?php if (isset($_SESSION['USER'])) { ?>
                      <button type="submit" id="confirmpayement" class="button h-60 px-24 -dark-1 bg-blue-1 text-white" style="margin-top:10px"><?php echo $content['Confirm Booking']; ?>
                      </button>
                    <?php } ?>
                    <p id="errorpayment"></p>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-xl-5 col-lg-4">
              <div class="ml-80 lg:ml-40 md:ml-0">
                <div class="px-30 py-30 border-light rounded-4">
                  <div class="text-20 fw-500 mb-30"><?php echo $content['Your booking details']; ?></div>
                  <div class="row x-gap-15 y-gap-20">
                    <div class="col-auto">
                      <img src="<?php echo $Hotelimage ?>" alt="<?php echo $HotelName ?>" title="<?php echo $HotelName ?>" class="size-140 rounded-4 object-cover">
                    </div>
                    <div class="col">
                      <div class="d-flex x-gap-5 pb-10 mt-20">
                        <?php for ($i = 1; $i <= (int) $HotelStars; $i++) {
                          echo '<i class="icon-star text-yellow-1 text-10"></i>';
                        } ?>
                      </div>
                      <div class="lh-17 fw-500"><?php echo $HotelName ?></div>
                      <div class="text-14 lh-15 mt-5"><?php echo $HotelAddress ?></div>
                      <div class="row x-gap-10 y-gap-10 items-center pt-10">
                        <div class="col-auto">
                          <div class="d-flex items-center">
                            <div class="size-30 flex-center rounded-4">
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="border-top-light mt-30 mb-20"></div>
                  <div class="row y-gap-20 justify-between">
                    <div class="col-auto">
                      <div class="text-15"><?php echo $content['Check-in']; ?></div>
                      <div class="fw-500"><?php echo $datecheckinFormat ?></div>
                    </div>
                    <div class="col-auto md:d-none">
                      <div class="h-full w-1 bg-border"></div>
                    </div>
                    <div class="col-auto text-right md:text-left">
                      <div class="text-15"><?php echo $content['Check-out']; ?></div>
                      <div class="fw-500"><?php echo $datecheckoutFormat ?></div>
                    </div>
                  </div>
                  <div class="border-top-light mt-30 mb-20"></div>
                  <div class="">
                    <div class="text-15"><?php echo $content['Total length of stay:']; ?></div>
                    <?php if ($nbnight == 1) { ?>
                      <div class="fw-500"><?php echo $nbnight ?> <?php echo $content['night']; ?></div>
                    <?php } else { ?>
                      <div class="fw-500"><?php echo $nbnight ?> <?php echo $content['nights']; ?></div>
                    <?php } ?>
                  </div>
                  <div class="border-top-light mt-30 mb-20"></div>
                  <div class="row y-gap-20 justify-between items-center room-details">
                    <div class="col-auto">
                      <div class="text-15"><?php echo $content['You selected:']; ?></div>
                      <div class="fw-600"><?php echo $_SESSION['RoomsDetailsDescription']  ?></div>
                    </div>
                  </div>
                </div>
                <div class="px-30 py-30 border-light rounded-4 mt-30">
                  <div class="text-20 fw-500 mb-20"><?php echo $content['Your price summary']; ?></div>
                  <?php echo $_SESSION['RoomsDetailsSummary'] ?>
                  <div class="row y-gap-5 justify-between pt-5">
                    <div class="col-auto">
                      <div class="text-15"><?php echo $content['Booking fees']; ?></div>
                    </div>
                    <div class="col-auto">
                      <div class="text-15"><?php echo $content['FREE']; ?></div>
                    </div>
                  </div>
                  <div class="px-20 py-20 bg-blue-2 rounded-4 mt-20">
                    <div class="row y-gap-5 justify-between">
                      <div class="col-auto">
                        <div class="text-18 lh-13 fw-500"><?php echo $content['Total']; ?></div>
                      </div>
                      <div class="col-auto">
                        <div class="text-18 lh-13 fw-500"><?php echo $_SESSION['RoomsRatePrices'] ?> EUR</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </section>
  <?php include('files/bottom.php') ?>
  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript" src="/js/stripe.js"></script>
</body>
</html>