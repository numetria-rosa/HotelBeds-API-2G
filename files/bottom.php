<?php include_once("files/DB_FUNCTION_INC.php");
$lang= $_SESSION['lang'];
$content = $footer_content[$lang];
?>
<section class="layout-pt-md-a layout-pb-sm bg-dark-2">
    <div class="container">
        <div class="row y-gap-30 justify-between items-center">
            <div class="col-auto">
                <div class="row y-gap-20  flex-wrap items-center">
                    <div class="col-auto">
                        <div class="icon-newsletter text-60 sm:text-40 text-white"></div>
                    </div>
                    <div class="col-auto">
                        <h4 class="text-26 text-white fw-600"><?php echo $content['Your Travel Journey Starts Here'] ?></h4>
                        <div class="text-white"><?php echo $content['Sign up and we\'ll send the best deals to you'] ?></div>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <form id="newsletterform">
                    <div class="single-field -w-410 d-flex x-gap-10 y-gap-20">
                        <div>
                            <input id="newsletteremail" class="bg-white h-60" type="email" placeholder="<?php echo $content['Your Email'] ?>" required>
                        </div>
                        <div>
                            <button class="button -md h-60 bg-blue-1 text-white" id="newsletterbtn"><?php echo $content['Subscribe'] ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="footer -type-1 footerFont">
    <div class="container">
        <div class="pt-10 pb-60">
            <div class="row y-gap-0 justify-between xl:justify-start">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="d-flex y-gap-0 flex-column">
                        <a href="country-all.php"><?php echo $content['Countries'] ?></a>
                        <a href="#"><?php echo $content['Regions'] ?></a>
                        <a href="#"><?php echo $content['Cities'] ?></a>
                        <a href="#"><?php echo $content['Places of interest'] ?></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="d-flex y-gap-0 flex-column">
                        <a href="#"><?php echo $content['Resorts'] ?></a>
                        <a href="#"><?php echo $content['Villas'] ?></a>
                        <a href="#"><?php echo $content['Hostels'] ?></a>
                        <a href="#"><?php echo $content['B&Bs'] ?></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="d-flex y-gap-0 flex-column">
                        <a href="about.php"><?php echo $content['About'] ?> DMCBooking.pro</a>
                        <a href="privacy-policy.php"><?php echo $content['Privacy Policy'] ?></a>
                        <a href="terms.php"><?php echo $content['Terms of Use'] ?></a>
                        <a href="legal-notice.php"><?php echo $content['Legal Notice'] ?></a>
                    </div>
                </div>
            </div>
        </div>
</footer>
</main>
</div>
</div>
<script>
    var stripePublickey = '<?php echo $stripePublickey ?>';
    var WORKPATH = '<?php echo $WORKPATH ?>';
</script>
<script src="<?php echo $WORKPATH ?>js/jquery-3.6.3.min.js"></script>
<script src="<?php echo $WORKPATH ?>js/vendors.js"></script>
<script src="<?php echo $WORKPATH ?>js/main.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5974415929806391" crossorigin="anonymous"></script>
<script>
    $("#newsletterbtn").click(function(e) {
        if (document.getElementById("newsletterform").checkValidity()) {
            e.preventDefault();
            var dataStringNewsletter =
                "email=" + $("#newsletteremail").val() + "&action=newsletter";
            $.ajax({
                type: "POST",
                url: "userAction.php",
                data: dataStringNewsletter,
                cache: false,
                success: function(data) {
                    if (data != 0) {
                        Toastify({
                            text: "You have successfully subscribed",
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #2a63d8, #13357b)",
                            }
                        }).showToast();
                    } else {
                        Toastify({
                            text: "You are already subscribed",
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #2a63d8, #13357b)",
                            }
                        }).showToast();
                    }
                },
            });
        }
    });
</script>