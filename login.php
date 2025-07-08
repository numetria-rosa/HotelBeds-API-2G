<?php
$metaDescription = "Login to DMC Booking to access exclusive travel deals and manage your bookings effortlessly. Sign in now to plan your next adventure!";
$metaKeywords = "DMC Booking, login, travel deals, bookings, adventure, tourism, vacation, holidays";
$metaCanonical = "https://dmcbooking.pro/login.php";
$metaTitle = "DMC Booking : Login page for dmcbooking.pro";
include('files/top-head.php') ?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
$TTODAY = date("d/m/Y");
$TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
?>
<body>
  <?php include('./files/header.php') ?>
  <section class="layout-pt-lg layout-pb-lg bg-blue-2">
    <form method="POST" action="userAction.php">
      <div class="container">
        <div class="row justify-center">
          <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
              <div class="row y-gap-20">
                <div class="col-12">
                  <h1 class="text-22 fw-500">Welcome back</h1>
                  <p class="mt-10">Don't have an account yet? <a href="signup.php" class="text-blue-1">Sign up for free</a></p>
                  <p class="error"><?php if (isset($_GET['error'])) {
                                      echo 'Your email or Password is incorrect';
                                    } ?></p>
                </div>
                <input type="hidden" name="action" value="UserLogin">
                <div class="col-12">
                  <div class="form-input ">
                    <input type="email" name="email" required="">
                    <label class="lh-1 text-14 text-light-1">Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-input ">
                    <input type="password" name="password" required="">
                    <label class="lh-1 text-14 text-light-1">Password</label>
                  </div>
                </div>
                <div class="col-12">
                  <a href="forget-password.php" class="text-14 fw-500 text-blue-1 underline">Forgot your password?</a>
                </div>
                <div class="col-12">
                  <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white" style="width:100%">
                    Sign In <div class="icon-arrow-top-right ml-15"></div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div hidden>
      Login to DMC Booking to access exclusive travel deals and manage your bookings effortlessly. Sign in now to plan your next adventure!
      Login to DMC Booking to access exclusive travel deals and manage your bookings effortlessly. Sign in now to plan your next adventure!
      Login to DMC Booking to access exclusive travel deals and manage your bookings effortlessly. Sign in now to plan your next adventure!
    </div>
  </section>
  <?php include('files/bottom.php') ?>
</body>
</html>