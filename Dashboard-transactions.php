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
            <?php $currentnav = "trans";
            include('./files/backoffice/menu.php') ?>
            <div class="dashboard__main col-md-9 col-12">
                <div class="dashboard__content box-bg">
                    <div class="profile_commonHead">
                        <div class="profile_commonIcons"><span><img src="img/dashboard/icons/2.svg" alt="transactions" title="transactions" class="mr-15"></span></div>
                        <div class="profile_commonText">
                            <h5>Liste des Transactions</h5>
                            <p>Gérez et visualisez vos Deposits</p>
                        </div>
                    </div>
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="tabs -underline-2 js-tabs">
                            <div class="tabs__content pt-30 js-tabs-content">
                                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                                    <div>
                                        <div class="single-field relative d-flex items-center md:d-none pb-10 justify-between">
                                            <input class="pl-50 border-light text-dark-1 h-50 rounded-8" id="search" type="text" placeholder="Rechercher...">
                                            <input style="display:none;" type="text">
                                            <button class="absolute d-flex items-center h-full">
                                                <i class="icon-search text-20 px-15 text-dark-1"></i>
                                            </button>
                                        </div>
                                        <table class="table-3 -border-bottom col-12" id="datatable">
                                            <thead class="bg-light-2">
                                                <tr>
                                                    <th>Transaction number</th>
                                                    <th>email</th>
                                                    <th>Booking reference</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $page = 1;
                                                if (isset($_GET['PAGETR']) && $_GET['PAGETR'] != "") {
                                                    $page = $_GET['PAGETR'];
                                                }
                                                $table = "payments";
                                                $champ = "userid";
                                                $value = $_SESSION['USER']['id'];
                                                $ord = "id";
                                                $dir = "desc";
                                                $limit_end = 10;
                                                $limit_start = ($page * $limit_end) - $limit_end;
                                                $NbTR = $site->countTableWC($table, $champ, $value);
                                                $paginationSell = getPaginationString($page, $NbTR, $limit_end, $adjacents = 1, $targetpage = $WORKPATH . "Dashboard-transactions.php?PAGETR=", $pagestring = "");
                                                $transactions = $site->selectW1CLIMIT($table, $champ, $value, $ord, $dir, $limit_start, $limit_end);
                                                foreach ($transactions as $transaction) {
                                                    $payid = $transaction['payment_id'];
                                                    $emailtr = $transaction['payer_email'];
                                                    $curr = $transaction['currency'];
                                                    $amount = $transaction['amount'];
                                                    $bookingref = $transaction['bookingreference'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $payid; ?></td>
                                                        <td><?php echo $emailtr; ?></td>
                                                        <td><?php echo $bookingref; ?></td>
                                                        <td><?php echo $amount . ' ' . $curr; ?></td>
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
                                <?php echo $paginationSell; ?>
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
    </script>
</body>
</html>