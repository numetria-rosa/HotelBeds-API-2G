<?php
$metaDescription = "Sign up for Dmcbooking.pro to unlock access to amazing travel deals, unique booking experiences. Join us now and start planning your dream vacation!";
$metaKeywords = "DMC Booking, sign up, travel deals, personalized recommendations, booking, vacation planning, travel, tourism, adventure";
$metaCanonical = "https://dmcbooking.pro/signup.php";
$metaTitle = "DMC Booking : SignUp page for dmcbooking.pro";
include('files/top-head.php') ?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
$TTODAY = date("d/m/Y");
$TTOMORROW = date("d/m/Y", strtotime('tomorrow'));
$formkey = md5("key" . microtime() . rand(1, 999999));

if (!is_array($_SESSION['formkeys'])) {
    $_SESSION['formkeys'] = array();
}
$_SESSION['formkeys'][$formkey] = date("Y-m-d H:i:s");
?>
<body>
    <?php include('./files/header.php') ?>
    <section class="layout-pt-lg layout-pb-lg bg-blue-2">
        <form action="userAction.php" method="POST" id="register-form">
            <div class="container">
                <div class="row justify-center">
                    <div class="col-xl-6 col-lg-7 col-md-9">
                        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                            <div class="row y-gap-20">
                                <div class="col-12">
                                    <h1 class="text-22 fw-500">Sign in or create an account</h1>
                                    <p class="mt-10">Already have an account? <a href="login.php" class="text-blue-1">Log in</a></p>
                                    <p class="error"></p>
                                </div>
                                <input type="hidden" name="action" value="UserRegister">
                                <div class="col-12">
                                    <div class="form-input ">
                                        <input type="text" name="firstname" required>
                                        <label class="lh-1 text-14 text-light-1">First Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input ">
                                        <input type="text" name="lastname">
                                        <label class="lh-1 text-14 text-light-1">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input ">
                                        <input type="email" name="email" required id="register_email">
                                        <label class="lh-1 text-14 text-light-1">Email</label>
                                    </div>
                                </div>
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
                                <div class='req'>
                                    <label for='tokentt'></label>
                                    <input type='text' name='tokentt'>
                                </div>
                                <!-- <div class="g-recaptcha" data-sitekey="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" data-callback="correctCaptcha"></div> -->
                                <div class="col-12">
                                    <button id="register" class="button py-20 -dark-1 bg-blue-1 text-white mt-5" style="width:100%">
                                        Sign In <div class="icon-arrow-top-right ml-15"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="formkey" value="<?= $formkey ?>">
            <input style="visibility: hidden" type="text" name="formkeyCheck" value="formkeyCheck">
        </form>
        <div hidden>
            Sign up for DMC Booking to unlock access to amazing travel deals, personalized recommendations, and hassle-free booking experiences. Join us now and start planning your dream vacation!
            Sign up for DMC Booking to unlock access to amazing travel deals, personalized recommendations, and hassle-free booking experiences. Join us now and start planning your dream vacation!
            Sign up for DMC Booking to unlock access to amazing travel deals, personalized recommendations, and hassle-free booking experiences. Join us now and start planning your dream vacation!
        </div>
    </section>
    <?php include('files/bottom.php') ?>
    <!-- <script src="https://www.google.com/recaptcha/api.js"></script> -->
    <script>
        $(document).ready(function() {
            $(".req").hide();
        });
        $("#register").click(function(e) {
            if (document.getElementById("register-form").checkValidity()) {
                e.preventDefault();
                var dataStringUserCheck =
                    "email=" +
                    encodeURIComponent($("#register_email").val()) +
                    "&action=UserCheck";
                $.ajax({
                    type: "POST",
                    url: "userAction.php",
                    data: dataStringUserCheck,
                    cache: false,
                    success: function(json) {
                        var data = JSON.parse(json);
                        if (data == "0") {
                            if ($('#password').val() != $('#password_two').val()) {
                                $('.error').html('Please enter same passwords')
                            } else {
                                $("#register-form").submit();
                            }
                        } else {
                            $('.error').html('Email already exist')
                        }
                    },
                });
            }
        });
    </script>
</body>
</html>