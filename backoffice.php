<?php
$metaTitle = "DMC Booking : Booking History";
include('files/top-head.php') ?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
include("files/pagination.php");
$TTODAY = date("d/m/Y");
$TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
$site = new Site();
?>
<body data-barba="wrapper">
    <div class="preloader js-preloader">
        <div class="preloader__wrap">
            <div class="preloader__icon">
                <svg width="38" height="37" viewbox="0 0 38 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1_41)">
                        <path d="M32.9675 13.9422C32.9675 6.25436 26.7129 0 19.0251 0C11.3372 0 5.08289 6.25436 5.08289 13.9422C5.08289 17.1322 7.32025 21.6568 11.7327 27.3906C13.0538 29.1071 14.3656 30.6662 15.4621 31.9166V35.8212C15.4621 36.4279 15.9539 36.92 16.561 36.92H21.4895C22.0965 36.92 22.5883 36.4279 22.5883 35.8212V31.9166C23.6849 30.6662 24.9966 29.1071 26.3177 27.3906C30.7302 21.6568 32.9675 17.1322 32.9675 13.9422V13.9422ZM30.7699 13.9422C30.7699 16.9956 27.9286 21.6204 24.8175 25.7245H23.4375C25.1039 20.7174 25.9484 16.7575 25.9484 13.9422C25.9484 10.3587 25.3079 6.97207 24.1445 4.40684C23.9229 3.91841 23.6857 3.46886 23.4347 3.05761C27.732 4.80457 30.7699 9.02494 30.7699 13.9422ZM20.3906 34.7224H17.6598V32.5991H20.3906V34.7224ZM21.0007 30.4014H17.0587C16.4167 29.6679 15.7024 28.8305 14.9602 27.9224H16.1398C16.1429 27.9224 16.146 27.9227 16.1489 27.9227C16.152 27.9227 23.0902 27.9224 23.0902 27.9224C22.3725 28.8049 21.6658 29.6398 21.0007 30.4014ZM19.0251 2.19765C20.1084 2.19765 21.2447 3.33365 22.1429 5.3144C23.1798 7.60078 23.7508 10.6649 23.7508 13.9422C23.7508 16.6099 22.8415 20.6748 21.1185 25.7245H16.9322C15.2086 20.6743 14.2994 16.6108 14.2994 13.9422C14.2994 10.6649 14.8706 7.60078 15.9075 5.3144C16.8057 3.33365 17.942 2.19765 19.0251 2.19765V2.19765ZM7.28053 13.9422C7.28053 9.02494 10.3184 4.80457 14.6157 3.05761C14.3647 3.46886 14.1273 3.91841 13.9059 4.40684C12.7425 6.97207 12.102 10.3587 12.102 13.9422C12.102 16.7584 12.9462 20.7176 14.6126 25.7245H13.2259C9.33565 20.6126 7.28053 16.5429 7.28053 13.9422Z" fill="#3554D1"></path>
                    </g>
                    <defs>
                        <clippath id="clip0_1_41">
                            <rect width="36.92" height="36.92" fill="white" transform="translate(0.540039)"></rect>
                        </clippath>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="preloader__title">Dmcbooking</div>
    </div>
    <div class="header-margin"></div>
    <?php include('./files/backoffice/header.php') ?>
    <div class="dashboard" data-x="dashboard" data-x-toggle="-is-sidebar-open">
        <div class="dashboard__main">
            <div class="dashboard__content bg-light-2" style="min-height:80vh">
                <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
                    <div class="col-auto">
                        <h1 class="text-30 lh-14 fw-600">Booking History</h1>
                        <div class="text-15 text-light-1">Lorem ipsum dolor sit amet, consectetur.</div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
                <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                    <div class="tabs -underline-2 js-tabs">
                        <div class="tabs__content pt-30 js-tabs-content">
                            <div class="tabs__pane -tab-item-1 is-tab-el-active">
                                <div>
                                    <table class="table-3 -border-bottom col-12">
                                        <thead class="bg-light-2">
                                            <tr>
                                                <th>Booking Number</th>
                                                <th>Destination</th>
                                                <th>Hotel name</th>
                                                <th>Booking Date</th>
                                                <th>Checkin-Date</th>
                                                <th>Cancellation</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $table = "booking";
                                            $champ = "agentid";
                                            $value = $_SESSION['USER']['id'];
                                            $champ2 = "currentstatus";
                                            $value2 = "vouchered";
                                            $ord = "pid";
                                            $dir = "DESC";
                                            $page = 1;
                                            if (isset($_GET['PAGE']) && $_GET['PAGE'] != "") {
                                                $page = (int)$_GET['PAGE'];
                                            }
                                            $limit_end = 5;
                                            $limit_start = ($page * $limit_end) - $limit_end;
                                            $NbBooking = $site->countTableWC($table, $champ, $value);
                                            if (isset($_POST['action']) && ($_POST['action'] == "FilterReservations")) {
                                                $checkin = $_POST['CheckInDate'];
                                                $checkout = $_POST['CheckOutDate'];
                                                $nbreserv = $_POST['SelectedValue'];
                                                $BookingDetails = $site->selectW1CLIMITDATE($table, $champ, $value, $ord, $dir, $limit_start, $limit_end, $checkin, $checkout, $nbreserv);
                                            } else {
                                                $BookingDetails = $site->selectW1CLIMIT($table, $champ, $value, $ord, $dir, $limit_start, $limit_end);
                                            }
                                            $pagination = getPaginationString($page, $NbBooking, $limit_end, $adjacents = 1, $targetpage = $WORKPATH . "backoffice.php?PAGE=", $pagestring = "/#reservations");
                                            foreach ($BookingDetails as $BookingDetail) {
                                                $Pid = $BookingDetail['pid'];
                                                $Id = $BookingDetail['id'];
                                                $AgentId = $BookingDetail['agentid'];
                                                $BookingReference = $BookingDetail['bookingreference'];
                                                $TotalCharges = $BookingDetail['totalcharges'];
                                                $LeaderTitle = $BookingDetail['leadertitle'];
                                                $LeaderFirstName = stripslashes(utf8_decode($BookingDetail['leaderfirstname']));
                                                $LeaderLastName = stripslashes(utf8_decode($BookingDetail['leaderlastname']));
                                                $Leader = $LeaderTitle . " " . $LeaderLastName . " " . $LeaderFirstName;
                                                $LeaderPhoneNumber = stripslashes(utf8_decode($BookingDetail['contactmobile']));
                                                $CurrencyCode = $BookingDetail['currencycode'];
                                                $LocalHotelId = $BookingDetail['localhotelid'];
                                                $HotelName = stripslashes(utf8_decode($BookingDetail['hotelname']));
                                                $CountryName = stripslashes(utf8_decode($BookingDetail['countryname']));
                                                $CityName = stripslashes(utf8_decode($BookingDetail['cityname']));
                                                $CityId = $BookingDetail['cityid'];
                                                $HotelAddress1 = stripslashes(utf8_decode($BookingDetail['hoteladdress']));
                                                $CurrentStatus = $BookingDetail['currentstatus'];
                                                $TotalAdults = $BookingDetail['totaladults'];
                                                $TotalChildren = $BookingDetail['totalchildren'];
                                                $TotalRooms = $BookingDetail['totalrooms'];
                                                $CheckInDate = $BookingDetail['checkindate'];
                                                $CheckOutDate = $BookingDetail['checkoutdate'];
                                                $GrossAmount = $BookingDetail['grossamount'];
                                                $TotalMarkup = $BookingDetail['totalmarkup'];
                                                $HotelPhone = $BookingDetail['hotelphone'];
                                                $SelectedNights = $BookingDetail['selectednights'];
                                                $BookingServiceType = $BookingDetail['bookingservicetype'];
                                                $starttime = $BookingDetail['starttime'];
                                                $EURTND = $BookingDetail['convertion'];
                                                $CategoryCode = $BookingDetail['categoryCode'];
                                                $CategoryName = $BookingDetail['categoryName'];
                                                $DestinationCode = $BookingDetail['destinationCode'];
                                                $Cancellation = $BookingDetail['cancellation'];
                                                $Modification = $BookingDetail['modification'];
                                                if ($Modification == $BookingDetail['totalcharges']) {
                                                    $Modification = $GrossAmount;
                                                } else {
                                                    $CONV = $GrossAmount / $BookingDetail['totalcharges'];
                                                    $CONV = round($CONV, 3);
                                                    $Modification = (float)$Modification * $CONV;
                                                }
                                                $SupplierName = $BookingDetail['SupplierName'];
                                                $SupplierVatNumber = $BookingDetail['SupplierVatNumber'];
                                                $TYPE = ' soap-icon-hotel blue-color ';
                                                $TYPE4 = 'Emna Voyages';
                                                if ($CurrentStatus == 'cancelled') {
                                                    $TYPE2 = ' cancelled ';
                                                    $TYPE3 = '  ';
                                                } else {
                                                    $TYPE2 = '';
                                                    $TYPE3 = ' blue-bg ';
                                                }
                                                if ($CurrentStatus == "vouchered") {
                                                    $Etat = "CONFIRMED";
                                                    $EtatColor = ' green-bg';
                                                } elseif ($CurrentStatus == "cancelled") {
                                                    $Etat = "cancelled";
                                                    $EtatColor = '';
                                                } elseif ($CurrentStatus == "refused") {
                                                    $Etat = "REFUSED";
                                                    $EtatColor = ' red-bg';
                                                } else {
                                                    $Etat = "EN ATTENTE";
                                                    $EtatColor = ' yellow-bg';
                                                }
                                                $agent = $BookingDetail['pidagent'];
                                                $AGENT = '';
                                                $AGENCE = "EmnaVoyages";
                                                $StartTime = $BookingDetail['starttime'];
                                                $EndTime = $BookingDetail['endtime'];
                                                $BookingRooms = $site->SelectFromTableWC("bookingrooms", "pidbooking", $Pid, "pid", "ASC");
                                                $isVoucher = 0;
                                                if ($BookingServiceType == 'hotelsbeds' && $Cancellation == 'true') {
                                                    $HBCP = $site->SelectObjectTableHBCP("bookingroomcp", "pidBooking", $Pid, "pid", "ASC");
                                                    $ARRHBCP = [];
                                                    foreach ($HBCP as $hbc) {
                                                        $cancellationFrom = TrimHotelBedsDatum($hbc['cancellationFrom']);
                                                        $cancellationAmount = ((float)$hbc['cancellationfeesDevise']);
                                                        array_push($ARRHBCP, [$cancellationFrom, $cancellationAmount]);
                                                    }
                                                } else {
                                                    $cancellationFrom = '';
                                                    $cancellationAmount = '';
                                                }
                                                if ($BookingServiceType == "hotelbedsactivity") {
                                                    $ActivityDetails = $site->SelectObjectTableWC('activityDetail', 'pidBooking', $Pid, 'pid', 'ASC');
                                                    $activityName = stripslashes(utf8_decode($ActivityDetails->activityName));
                                                    $activityCommentText = stripslashes(utf8_decode($ActivityDetails->activityCommentText));
                                                    $ActivityCancellations = $site->SelectFromTableWC('activityCancellation', 'pidBooking', $Pid, 'pid', 'ASC');
                                                    $CancellationDefault = '';
                                                    foreach ($ActivityCancellations as $ActivityCancellation) {
                                                        $cancellationFrom = TrimHotelBedsDatumA($ActivityCancellation['cancellationDateFrom']);
                                                        $cancellationAmount = ($ActivityCancellation['cancellationAmount']) * $EURTND;
                                                        $CancellationDefault .= '<b>Annulation gratuite avant le ' . HotelBedsAcDefault($cancellationFrom) . '</b><br>';
                                                        $CancellationDefault .= '<b>Frais d\'Annulation : ' . $cancellationAmount . ' ' . $DEVISE . '</b><br>';
                                                    }
                                                    $CancellationDefault = substr($CancellationDefault, 0, -4);
                                                    $nbVoucher = $site->countTableWC('activityVouchers', 'pidBooking', $Pid);
                                                    if ($nbVoucher > 0) {
                                                        $isVoucher = 1;
                                                        $Voucher = $site->SelectObjectTableW3C('activityVouchers', 'pidBooking', $Pid, 'VoucherLanguage', 'ENG', 'VoucherMimeType', 'application/pdf', 'pid', 'ASC');
                                                        $VoucherUrl = $Voucher->VoucherUrl;
                                                    }
                                                    $HotelName = $activityName;
                                                } ?>
                                                <tr>
                                                    <td><?php echo $BookingReference ?></td>
                                                    <td><?php echo $CountryName ?> <?php echo $CityName ?></td>
                                                    <td><?php echo $HotelName ?></td>
                                                    <td><?php echo $starttime ?></td>
                                                    <td><?php echo $CancellationDefault ?></td>
                                                    <td class="lh-16">Check in <?php echo $CheckInDate ?><br>Check out : <?php echo $CheckOutDate ?></td>
                                                    <td class="fw-500"><?php echo $TotalCharges ?> EUR</td>
                                                    <td><span class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-yellow-4 text-yellow-3"><?php echo $Etat  ?></span></td>
                                                    <td>
                                                        <div class="dropdown js-dropdown js-actions-1-active">
                                                            <div class="dropdown__button d-flex items-center rounded-4 text-blue-1 bg-blue-1-05 text-14 px-15 py-5" data-el-toggle=".js-actions-1-toggle" data-el-toggle-active=".js-actions-1-active">
                                                                <span class="js-dropdown-title">Actions</span>
                                                                <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                                                            </div>
                                                            <div class="toggle-element -dropdown-2 js-click-dropdown js-actions-1-toggle">
                                                                <div class="text-14 fw-500 ">
                                                                    <a href="/invoices/voucherhb.php?BookingId=<?php echo $Pid ?>" target="_blank" class="d-block js-dropdown-link">Voucher</a>
                                                                    <a target="_blank" href="/invoices/proformahb.php?BookingId=<?php echo $Pid ?>" class="d-block js-dropdown-link">Proforma</a>
                                                                    <div><a href="#" class="d-block js-dropdown-link">Cancel</a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-30">
                        <div class="row justify-between">
                            <div class="col-auto">
                                <button class="button -blue-1 size-40 rounded-full border-light">
                                    <i class="icon-chevron-left text-12"></i>
                                </button>
                            </div>
                            <div class="col-auto">
                                <div class="row x-gap-20 y-gap-20 items-center">
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full">1</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full">3</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full bg-light-2">4</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full">5</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full">...</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full">20</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="button -blue-1 size-40 rounded-full border-light">
                                    <i class="icon-chevron-right text-12"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script src="<?php echo $WORKPATH ?>js/jquery-3.6.3.min.js"></script>
    <script src="<?php echo $WORKPATH ?>js/vendors.js"></script>
    <script src="<?php echo $WORKPATH ?>js/main.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>
</html>
