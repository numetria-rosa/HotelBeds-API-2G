<?php include('./files/top-head-backoffice.php') ?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
include("./files/pagination.php");
$TTODAY = date("d/m/Y");
$TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
$site = new Site();
if (!isset($_SESSION['USER'])) {
    header("location:/");
}
?>
<style>
    .dataTables_filter {
        margin-bottom: 20px;
    }
</style>
<body>
    <div class="container">
        <div class="header-margin"></div>
        <?php include('./files/backoffice/header.php') ?>
        <div class="row" data-x="dashboard" data-x-toggle="-is-sidebar-open">
            <?php $currentnav = "booking";
            include('./files/backoffice/menu.php') ?>
            <div class="dashboard__main col-md-9 col-12">
                <div class="dashboard__content box-bg">
                    <div class="profile_commonHead">
                        <div class="profile_commonIcons"><span><img src="img/dashboard/sidebar/booking2.svg" alt="reservations" title="reservations" class="mr-15"></span></div>
                        <div class="profile_commonText">
                            <h5>Réservations</h5>
                            <p>Gérez et visualisez vos réservations</p>
                        </div>
                    </div>
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="tabs -underline-2 js-tabs">
                            <div class="tabs__content pt-30 js-tabs-content">
                                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                                    <div>
                                        <div class="single-field relative d-flex items-center md:d-none pb-10 justify-between">
                                            <input class="pl-50 border-light text-dark-1 h-50 rounded-8" id="search" type="text" placeholder="Rechercher...">
                                            <!--the following second input with display =none is used to prevent google chrome filling the input field with the stored username-->
                                            <input style="display:none;" type="text">
                                            <button class="absolute d-flex items-center h-full">
                                                <i class="icon-search text-20 px-15 text-dark-1"></i>
                                            </button>
                                        </div>
                                        <table class="table-3 -border-bottom col-12" id="datatable">
                                            <thead class="bg-light-2">
                                                <tr>
                                                    <th>Booking Number</th>
                                                    <th>Destination</th>
                                                    <th>Hotel name</th>
                                                    <th>Booking Date</th>
                                                    <th>Checkin-Date</th>
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
                                                $ord = "starttime";
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
                                                $pagination = getPaginationString($page, $NbBooking, $limit_end, $adjacents = 1, $targetpage = $WORKPATH . "Dashboard-booking.php?PAGE=", $pagestring = "");
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
                                                    $TYPE4 = '';
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
                                                    }
                                                    $agent = $BookingDetail['pidagent'];
                                                    $AGENT = '';
                                                    $AGENCE = "";
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
                                                    $newCheckInDate = str_replace('-', '', $BookingDetail['checkindate']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <p class="mt-10 mb-10"><?php echo $BookingReference ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="mt-10 mb-10"><?php echo $CityName ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="mt-10 mb-10"><?php echo $HotelName ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="mt-10 mb-10"><?php echo $starttime ?></p>
                                                        </td>
                                                        <td class="lh-16">
                                                            <p>Check in <?php echo $CheckInDate ?><br>Check out : <?php echo $CheckOutDate ?></p>
                                                        </td>
                                                        <td class="fw-500">
                                                            <p class="mt-10 mb-10"><?php echo $GrossAmount ?> EUR </p>
                                                        </td>
                                                        <td>
                                                            <div class="mt-10 mb-10"><span class=" rounded-100 py-4 px-10 text-center text-14 fw-500 <?php if ($Etat == "CONFIRMED") {
                                                                                                                                                            echo 'success-bg';
                                                                                                                                                        } else {
                                                                                                                                                            echo 'cancel-bg';
                                                                                                                                                        } ?>"><?php echo $Etat  ?></span< /div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown js-dropdown js-actions-<?php echo $Pid ?>-active">
                                                                <div class="dropdown__button d-flex items-center rounded-4 text-blue-1 bg-blue-1-05 text-14 px-15 py-5" data-el-toggle=".js-actions-<?php echo $Pid ?>-toggle" data-el-toggle-active=".js-actions-<?php echo $Pid ?>-active">
                                                                    <span class="js-dropdown-title">Actions</span>
                                                                    <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                                                                </div>
                                                                <div class="toggle-element -dropdown-2 js-click-dropdown js-actions-<?php echo $Pid ?>-toggle">
                                                                    <div class="text-14 fw-500 ">
                                                                        <a href="<?php echo $ROOTFOLDER?>/invoices/voucherhtml.php?BookingId=<?php echo $Pid ?>" target="_blank" class="d-block js-dropdown-link">Details</a>
                                                                        <a href="<?php echo $ROOTFOLDER?>/invoices/voucherhb.php?BookingId=<?php echo $Pid ?>" target="_blank" class="d-block js-dropdown-link">Voucher</a>
                                                                        <!--  <a target="_blank" href="/invoices/proformahb.php?BookingId=<?php echo $Pid ?>" class="d-block js-dropdown-link">Proforma</a>-->
                                                                        <?php if ($newCheckInDate > date('Ymd') && $Etat == "CONFIRMED" && $cancellationFrom != "") { ?>
                                                                            <div><a href="#" attr="<?php echo $Pid ?>" class="Click-here d-block js-dropdown-link">Cancel</a></div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="custom-model-main custom-model-main<?php echo $Pid ?>">
                                                        <div class="custom-model-inner">
                                                            <div class="close-btn close-btn<?php echo $Pid ?>" attr="<?php echo $Pid ?>">×</div>
                                                            <div class="custom-model-wrap">
                                                                <div class="pop-up-content-wrap">
                                                                    <div class="alert alert-error fix" style="margin-top:10px;" id="77-1774289">
                                                                        <?php
                                                                        if ($CurrentStatus == "vouchered" && $BookingServiceType == "hotelsbeds" && $Cancellation == 'true') {
                                                                            if ($newCheckInDate > date('Ymd')) {
                                                                        ?>
                                                                                <div class="alert alert-error fix" style="margin-top:10px;" id="<?php echo $Id; ?>">
                                                                                    <?php $totalhcp = 0;
                                                                                    foreach ($ARRHBCP as $k => $HBCPL) { ?>
                                                                                        <?php
                                                                                        echo '<strong class="dark-blue-color">';
                                                                                        ?>
                                                                                        <?php if (count($ARRHBCP) > 1) { ?>
                                                                                            <b>Room N°
                                                                                                <?php echo $k + 1; ?> :</b>
                                                                                        <?php } ?>
                                                                                        <b>Free Cancellation from
                                                                                            <?php echo HotelBedsDefault($HBCPL[0]); ?></b>
                                                                                        <br>
                                                                                        <?php
                                                                                        $totalhcp = $totalhcp + (float)FormatNumber($HBCPL[1]);
                                                                                        echo '</strong>';
                                                                                        $opening_date = new DateTime($cancellationFrom);
                                                                                        $current_date = new DateTime();
                                                                                        ?>
                                                                                    <?php } ?>
                                                                                    <?php if (count($ARRHBCP) > 1) { ?>
                                                                                        <strong class="dark-blue-color"><b>Cancellation fees
                                                                                                <?php echo $totalhcp; ?> </b></strong>
                                                                                    <?php } ?>
                                                                                    <hr>
                                                                                    <button class="success-bg button btn-small sky-blue1 conditionAnnulationHB" p="<?php echo $Id; ?>" style="float:right;padding:10px">Cancel Reservation
                                                                                    </button>
                                                                                </div>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="bg-overlay"></div>
                                                    </div>
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
                                <?php echo $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script src="<?php echo $WORKPATH ?>js/jquery-3.6.3.min.js"></script>
    <script src="<?php echo $WORKPATH ?>js/vendors.js"></script>
    <script src="<?php echo $WORKPATH ?>js/main.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var oTable = $('#datatable').DataTable({
                "bPaginate": true,
                "orderable": false,
                "pageLength": 5,
                /*   "order": [],*/
            });
            $('#search').keyup(function() {
                oTable.search($(this).val()).draw();
            })
        });
        $(".Click-here").on('click', function() {
            $(".custom-model-main" + $(this).attr("attr")).addClass('model-open');
        });
        $(".close-btn, .bg-overlay").click(function() {
            $(".custom-model-main" + $(this).attr("attr")).removeClass('model-open');
        });
        $(".conditionAnnulationHB").on("click", function() {
            target = '#' + $(this).attr('p');
            HotelId = $(this).attr('p');
            var action = 'conditionAnnulationHB';
            var dataString = 'HotelId=' + HotelId + '&action=' + action;
            $.ajax({
                type: 'POST',
                url: 'actions.php',
                data: dataString,
                success: function(msg, data, settings) {
                    if (data == 'success') {
                        window.location.reload();
                    }
                }
            });
        });
    </script>
</body>
</html>