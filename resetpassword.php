<?php
$metaDescription = "Reset your DMC Booking password securely and regain access to your account. Follow the instructions to create a new password and continue enjoying seamless booking experiences and exclusive travel deals.";
$metaKeywords = "DMC Booking, reset password, password reset";
$metaTitle = "DMC Booking : Reset password";
include('files/top-head.php') ?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
$TTODAY = date("d/m/Y");
$TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
require_once './jwt/jwt_utils.php';
if (!$_GET['auth']) {
    header("location:index.php");
} else {
    $is_jwt_valid = is_jwt_valid($_GET['auth']);
    if ($is_jwt_valid === TRUE) {
    } else {
        header("location:index.php");
    }
}
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
                                    <p class="error"></p>
                                </div>
                                <input type="hidden" name="action" value="UpdatePassword">
                                <div class="col-12">
                                    <div class="form-input ">
                                        <input id="password" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 6 Letters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" required />
                                        <label class="lh-1 text-14 text-light-1">Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input ">
                                        <input class="form-control mb-5" id="password_two" name="password_two" type="password" pattern="^\S{6,}$" required>
                                        <label class="lh-1 text-14 text-light-1">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button id="sendbtn" class="button py-20 -dark-1 bg-blue-1 text-white" style="width:100%">
                                        Send <div class="icon-arrow-top-right ml-15"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php include('files/bottom.php') ?>
    <script>
        $("#sendbtn").click(function(e) {
            if (document.getElementById("password-recovery").checkValidity()) {
                if ($('#password').val() != $('#password_two').val()) {
                    e.preventDefault();
                    $('.error').html('Please enter same passwords')
                } else {
                    $("#password-recovery").submit();
                }
            }
        });
    </script>
</body>
</html>