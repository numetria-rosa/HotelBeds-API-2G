<?php
$metaDescription = "Forgot your password? No worries! Reset your Dmcbooking.pro password quickly and securely. Enter your email address to receive the instructions.";
$metaKeywords = "DMC Booking, forget password";
$metaCanonical = "https://dmcbooking.pro/forget-password.php";
$metaTitle = "DMC Booking : Forget password page for dmcbooking.pro";
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
        <form method="POST" action="userAction.php" id="password-recovery">
            <div class="container">
                <div class="row justify-center">
                    <div class="col-xl-6 col-lg-7 col-md-9">
                        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                            <div class="row y-gap-20">
                                <div class="col-12">
                                    <h1 class="text-22 fw-500">Password Recovery</h1>
                                    <p class="error"><?php if (isset($_GET['error'])) {
                                                            echo 'Account not found';
                                                        } ?></p>
                                </div>
                                <input type="hidden" name="action" value="UserLogin">
                                <div class="col-12">
                                    <div class="form-input ">
                                        <input type="hidden" name="action" value="UserforgetPassword">
                                        <input type="email" name="email" required="">
                                        <label class="lh-1 text-14 text-light-1">Please Enter your Email</label>
                                    </div>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6Lc35CklAAAAACXHRG-ujDsbzG_c0Gxv7gh3X7oy" data-callback="correctCaptcha"></div>
                                <div class="col-12">
                                    <button id="sendbtn" class="button py-20 -dark-1 bg-blue-1 text-white" style="width:100%">
                                        Send <div class="icon-arrow-top-right ml-15"></div>
                                    </button>
                                </div>
                            </div>
                            <p><?php if (isset($_GET['email'])) {
                                    echo 'Password recovery mail has been sent !';
                                } ?></p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php include('files/bottom.php') ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        $("#sendbtn").click(function(e) {
            if (document.getElementById("password-recovery").checkValidity()) {
                e.preventDefault();
                if (grecaptcha.getResponse()) {
                    $('#password-recovery').submit();
                }
            }
        });
    </script>
</body>
</html>