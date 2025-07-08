<?php
$metaTitle = "DMC Booking : Dashboard Settings";
include('./files/top-head.php') ?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
include("./files/pagination.php");
$TTODAY = date("d/m/Y");
$TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
$site = new Site();
$IDPAYS = stripslashes(utf8_decode($_SESSION['USER']['code_pays']));
$PAYS = $site->SelectObjectTableWC("pays", "alpha2", $IDPAYS, "id_pays", "ASC");
if (isset($PAYS->nom)) {
  $user_pays = stripslashes(utf8_decode($PAYS->nom));
  $id_pays = stripslashes(utf8_decode($PAYS->id_pays));
} else {
  $agn_pays = '';
  $id_pays = '';
}
$IDVILLE = stripslashes(utf8_decode($_SESSION['USER']['code_ville']));
$VILLE = $site->SelectObjectTableW2C("ville", "id_pays", $id_pays, "id_ville", $IDVILLE, "nom_fra", "ASC");
if (isset($VILLE->nom_fra)) {
  $user_ville = stripslashes(utf8_decode($VILLE->nom_fra));
} else {
  $user_ville = '';
}
if (!isset($_SESSION['USER'])) {
  header("location:/");
}
?>
<body>
  <div class="container">
    <div class="header-margin"></div>
    <?php include('./files/backoffice/header.php') ?>
    <div class="row" data-x="dashboard" data-x-toggle="-is-sidebar-open">
      <?php $currentnav = "settings";
      include('./files/backoffice/menu.php') ?>
      <div class="dashboard__main col-md-9 col-12">
        <div class="dashboard__content box-bg ">
          <div class="profile_commonHead">
            <div class="profile_commonIcons"><span><img src="img/dashboard/sidebar/gear.svg" alt="settings" title="settings" class="mr-15"></span></div>
            <div class="profile_commonText">
              <h5>Paramètres</h5>
              <p>Modifier les paramètres de votre compte</p>
            </div>
          </div>
          <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
              <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
                <div class="col-auto">
                  <button class="profile-tab tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Personal Information</button>
                </div>
                <div class="col-auto">
                  <button class="password-tab tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-3">Change Password</button>
                </div>
              </div>
              <div class="tabs__content pt-30 js-tabs-content">
                <div class="profile-tab tabs__pane -tab-item-1 is-tab-el-active">
                  <div class="col-xl-9">
                    <form method="post" action="userAction.php">
                      <input type="hidden" value="UserUpDateProfil" name="action" />
                      <div class="row x-gap-20 y-gap-20">
                        <div class="col-md-6">
                          <div class="form-input ">
                            <input type="text" name="firstname" value="<?php echo $_SESSION['USER']['firstname'] ?>" required>
                            <label class="lh-1 text-16 text-light-1">First Name</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-input ">
                            <input type="text" name="lastname" value="<?php echo $_SESSION['USER']['lastname'] ?>">
                            <label class="lh-1 text-16 text-light-1">Last Name</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-input ">
                            <input type="text" value="<?php echo $_SESSION['USER']['email'] ?> " readonly>
                            <label class="lh-1 text-16 text-light-1">Email</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-input ">
                            <input type="text" name="telephone" value="<?php echo $_SESSION['USER']['telephone'] ?> ">
                            <label class="lh-1 text-16 text-light-1">Phone Number</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-input ">
                            <input type="text" name="address" value="<?php echo $_SESSION['USER']['adresse'] ?>" required>
                            <label class="lh-1 text-16 text-light-1">Address</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-input ">
                            <select id="cln_pays" name="cln_pays" class="w-100 select_profil" required>
                              <?php
                              $table = "countries";
                              $ord = "description";
                              $dir = "ASC";
                              $STATE = $site->SelectFromTableORD($table, $ord, $dir);
                              print_r($STATE);
                              foreach ($STATE as $state) {
                                $alpha = $state['isoCode'];
                                $nom = utf8_decode(utf8_encode($state['description']));
                                if ($state['isoCode'] == $IDPAYS) {
                              ?>
                                  <option value="<?php echo $alpha; ?>" selected><?php echo $nom; ?></option>
                                <?php
                                } else {
                                ?>
                                  <option value="<?php echo $alpha; ?>"><?php echo $nom; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                            <label class="lh-1 text-16 text-light-1">Select Country</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-input ">
                            <select id="cln_ville" name="cln_ville" class="w-100 select_profil" required>
                              <?php
                              $table = "ville";
                              $champ = "id_pays";
                              $value = $id_pays;
                              $ord = "nom_eng";
                              $dir = "ASC";
                              $CITY = $site->SelectFromTableWC($table, $champ, $value, $ord, $dir);
                              foreach ($CITY as $city) {
                                $nom = utf8_decode(utf8_encode($city['nom_eng']));
                                $id_ville = $city['id_ville'];
                                if ($id_ville == $IDVILLE) {
                              ?>
                                  <option value="<?php echo $id_ville; ?>" selected><?php echo $nom; ?></option>
                                <?php
                                } else {
                                ?>
                                  <option value="<?php echo $id_ville; ?>"><?php echo $nom; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                            <label class="lh-1 text-16 text-light-1">City</label>
                          </div>
                        </div>
                      </div>
                  </div>
                  <?php if (isset($_GET['update'])) {
                    echo '<p class="success"> Your profile information has been updated </p> <br> ';
                  } ?>
                  <div class="d-inline-block pt-30">
                    <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                      Save Changes <div class="icon-arrow-top-right ml-15"></div>
                    </button>
                  </div>
                  </form>
                </div>
                <div class="password-tab tabs__pane -tab-item-3">
                  <div class="col-xl-9">
                    <form method="post" action="userAction.php" id="passwordform">
                      <input type="hidden" value="UpdatePasswordProfil" name="action" />
                      <?php if (isset($_GET['updatePass'])) {
                        echo '<p class="success"> Your profile information has been updated </p> <br> ';
                      } ?>
                      <?php if (isset($_GET['error'])) {
                        echo '<p class="error-get">Your current password is incorrect </p><br> ';
                      } ?>
                      <p class="error"></p>
                      <div class="row x-gap-20 y-gap-20">
                        <div class="col-12">
                          <div class="form-input ">
                            <input name="currentpassword" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 6 Letters' : ''); " required>
                            <label class="lh-1 text-16 text-light-1">Current Password</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-input ">
                            <input id="password" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 6 Letters' : ''); " required />
                            <label class="lh-1 text-14 text-light-1">Password</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-input ">
                            <input class="form-control mb-5" id="password_two" name="password_two" type="password" required>
                            <label class="lh-1 text-14 text-light-1">Confirm Password</label>
                          </div>
                        </div>
                        <div class="d-inline-block pt-30">
                          <button id="sendbtn" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            Save Changes <div class="icon-arrow-top-right ml-15"></div>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
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
  <script>
    $("#sendbtn").click(function(e) {
      if (document.getElementById("passwordform").checkValidity()) {
        if (($('#password').val() != $('#password_two').val())) {
          e.preventDefault();
          $('.error').html('Please enter same passwords')
        } else {
          $("#passwordform").submit();
        }
      }
    });
  </script>
  <script>
    $("#cln_pays").change(function(e) {
      var dataStringChangeCity = 'alpha=' + $(this).val() + '&action=change_city';
      $.ajax({
        type: "POST",
        url: "userAction.php",
        data: dataStringChangeCity,
        cache: false,
        success: function(data) {
          $("#cln_ville").empty().append(data);
        }
      });
    })
    var activeTab = window.location.hash;
    if (activeTab == "#password") {
      $('.profile-tab').removeClass('is-tab-el-active');
      $('.password-tab').addClass('is-tab-el-active');
    }
  </script>
</body>
</html>