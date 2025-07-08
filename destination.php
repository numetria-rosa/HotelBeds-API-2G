<?php
$currentQueryString = $_SERVER['QUERY_STRING'];
parse_str($currentQueryString, $urlData);
$dest = $urlData['destination'];
$code = $urlData['code'];
$metaDescription = "With Dmcbooking.pro Discover the best hotels and accommodations in " . $dest . ". Plan your perfect trip with our curated selection of hotels, resorts, and guesthouses. Book now and enjoy a memorable stay!";
$metaKeywords = "Dmcbooking.pro, " . $dest . ' , ' . $dest . " hotels, hotels, accommodations, resorts, guesthouses, travel, booking, reservations";
$metaCanonical = "https://dmcbooking.pro/destination.php?" . $currentQueryString;
$metaTitle = "DMC Booking :   Explore Hotels in " . $dest . "Hotel Details";
include('files/top-head.php')
?>
<?php
session_start();
include_once("./files/DB_FUNCTION_INC.php");
$site = new Site();
$hotels = $site->SelectHotelsList($code);
?>
<body>
    <?php include('./files/header.php') ?>
    <section data-anim-wrap="" class="masthead -type-1 z-5 ">
        <div data-anim-child="fade" class="masthead__bg">
            <?php $imgSrc = (file_exists('img/backgrounds/destinations/' . $dest . '.webp')) ? ('img/backgrounds/destinations/' . $dest . '.webp') : ($WORKPATH . 'img/backgrounds/2.webp') ?>
            <img src="#" alt="Find Hotels" title="Find Hotels" data-src="<?php echo $imgSrc ?>" class="js-lazy">
        </div>
        <div class="container">
            <div class="row justify-center">
                <div class="col-auto">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Find Hotels in <?php echo $dest; ?></h1>
                        <p data-anim-child="slide-up delay-5" class="text-white mt-6 md:mt-10">Discover amazing places at exclusive deals</p>
                    </div>
                    <div data-anim-child="slide-up delay-6" class="tabs -underline mt-60 js-tabs">
                        <div class="tabs__content mt-30 md:mt-20 js-tabs-content">
                            <div class="tabs__pane -tab-item-1 is-tab-el-active">
                                <div class="mainSearch -w-900 bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-100">
                                    <div class="button-grid items-center">
                                        <input hidden type="text" name="lang" id="lang" value="ENG" />
                                        <div class="searchMenu-loc px-30 lg:py-20 lg:px-0 js-form-dd js-liverSearch">
                                            <div data-x-dd-click="searchMenu-loc">
                                                <p class="text-15 fw-500 ls-2 lh-16">Location</p>
                                                <div class="text-15 text-light-1 ls-2 lh-16">
                                                    <input autocomplete="off" type="search" placeholder="Where are you going?" class="js-search js-dd-focus" id="search">
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                            <div class="searchMenu-loc__field shadow-2 js-popup-window" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                                                <div class="bg-white px-30 py-30 sm:py-15 rounded-4 results-list">
                                                    <div class="ring">
                                                        <div class="lds-dual-ring"></div>
                                                    </div>
                                                    <div class="y-gap-5 js-results">
                                                    </div>
                                                    <div class="y-gap-5 js-results-hotels">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="searchMenu-date px-30 lg:py-20 lg:px-0 js-form-dd js-calendar">
                                            <div data-x-dd-click="searchMenu-date">
                                                <p class="text-15 fw-500 ls-2 lh-16">Check in - Check out</p>
                                                <div class="text-15 text-light-1 ls-2 lh-16">
                                                    <input type="text" name="daterange" value="" id="daterange" />
                                                </div>
                                            </div>
                                            <div class="searchMenu-date__field shadow-2" data-x-dd="searchMenu-date" data-x-dd-toggle="-is-active">
                                            </div>
                                        </div>
                                        <div class="searchMenu-guests px-30 lg:py-20 lg:px-0 js-form-dd js-form-counters">
                                            <div data-x-dd-click="searchMenu-guests">
                                                <p class="text-15 fw-500 ls-2 lh-16">Guest</p>
                                                <div class="text-15 text-light-1 ls-2 lh-16">
                                                    <span class="js-count-room" id="pax">1 Room 1 Adult 0 Children</span>
                                                </div>
                                            </div>
                                            <div class="searchMenu-guests__field shadow-2" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active" id="selector">
                                                <div class="bg-white px-30 py-30 rounded-4">
                                                    <div class="d-flex y-gap-10 justify-start items-center">
                                                        <div class="mr-5">
                                                            <div class="text-15 fw-500">Rooms</div>
                                                            <div>
                                                                <select class="rounded-4 border-light px-5 h-50 text-14" id="RoomsSelect">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mr-5">
                                                            <div class="text-15 fw-500">Adults</div>
                                                            <select class="adultsselect0 rounded-4 border-light px-5 h-50 text-14">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                            </select>
                                                        </div>
                                                        <div class="mr-5">
                                                            <div class="text-15  fw-500">Children</div>
                                                            <select class="childselect0 rounded-4 border-light px-5 h-50 text-14">
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="pax-wrapper"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-item">
                                            <button class="mainSearch__submit button -dark-1 h-60 px-35 col-12 rounded-100 bg-blue-1 text-white">
                                                <i class="icon-search text-20 mr-10"></i>
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 d-flex items-center ">
        <div class="container countryPage">
            <div class="row y-gap-10 items-center justify-between">
                <div class="col-auto">
                    <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
                        <div class="col-auto">
                            <a href="index.php">Home</a>
                        </div>
                        <div class="col-auto">
                            <div class="">></div>
                        </div>
                        <div class="col-auto">
                            <div class="text-dark-1">Destinations</div>
                        </div>
                        <div class="col-auto">
                            <div class="">></div>
                        </div>
                        <div class="col-auto">
                            <div class="text-dark-1"><?php echo $dest ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" layout-pb-md ">
        <div data-anim-wrap="" class="container countryPage">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Best Hotels in <?php echo $dest ?></h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Book your accommodation in the best hotels in <?php echo $dest ?></p>
                    </div>
                </div>
            </div>
            <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist ">
                <?php
                foreach ($hotels  as $k => $hotel) {
                    if ($k == 16) {
                        break;
                    }
                ?>
                    <div data-anim-child="slide-up delay-3" class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
                        <a target="_blank" href="<?php echo $WORKPATH . 'hotel.php?hotel=' . $hotel['slug']; ?>">
                            <div class="SearchByhotel hotelsCard -type-1 " id="<?php echo $hotel['id'] ?>">
                                <div class="hotelsCard__image">
                                    <div class="cardImage ratio ratio-1:1">
                                        <div class="cardImage__content">
                                            <?php
                                            $images = json_decode($hotel['images'], true);
                                            $src = 'https://photos.hotelbeds.com/giata/' . $images['image'][0]['@attributes']['path'];
                                            ?>
                                            <img class="rounded-4 col-12" src="<?php echo $src ?>" alt="<?php echo $hotel['name'] ?>" title="<?php echo $hotel['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelsCard__content mt-10">
                                    <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                        <span><?php echo $hotel['name'] ?></span>
                                        <div class="d-inline-block ml-10">
                                            <?php
                                            $stars = substr($hotel['categoryCode'], 0, 1);
                                            for ($i = 1; $i <= (int) $stars; $i++) {
                                                echo '<i class="icon-star text-10 text-yellow-2"></i>';
                                            } ?>
                                        </div>
                                    </h3>
                                    <p class="text-light-1 lh-14 text-14 mt-5"> <?php echo $hotel['address'] . ", " . $hotel['city']; ?> </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="d-flex x-gap-15 items-center justify-center sm:justify-start pt-40 sm:pt-20">
                <button class="button -md -dark-1 bg-blue-1 text-white mt-5 justify-center" id="loadMoreBtn" style="display:block">
                    Load All Hotels in <?php echo $dest ?>
                </button>
            </div>
            <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist " id="loadMore" style="display:none">
                <?php
                foreach ($hotels  as $k => $hotel) {
                    if ($k < 16) {
                        continue;
                    }
                ?>
                    <div data-anim-child="slide-up delay-3" class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
                        <a target="_blank" href="<?php echo $WORKPATH . 'hotel.php?hotel=' . $hotel['slug']; ?>">
                            <div class="SearchByhotel hotelsCard -type-1 " id="<?php echo $hotel['id'] ?>">
                                <div class="hotelsCard__image">
                                    <div class="cardImage ratio ratio-1:1">
                                        <div class="cardImage__content">
                                            <?php
                                            $images = json_decode($hotel['images'], true);
                                            $src = 'https://photos.hotelbeds.com/giata/' . $images['image'][0]['@attributes']['path'];
                                            ?>
                                            <img class="rounded-4 col-12" src="<?php echo $src ?>" alt="<?php echo $hotel['name'] ?>" title="<?php echo $hotel['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelsCard__content mt-10">
                                    <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                        <span><?php echo $hotel['name'] ?></span>
                                        <div class="d-inline-block ml-10">
                                            <?php
                                            $stars = substr($hotel['categoryCode'], 0, 1);
                                            for ($i = 1; $i <= (int) $stars; $i++) {
                                                echo '<i class="icon-star text-10 text-yellow-2"></i>';
                                            } ?>
                                        </div>
                                    </h3>
                                    <p class="text-light-1 lh-14 text-14 mt-5"> <?php echo $hotel['address'] . ", " . $hotel['city']; ?> </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <section class=" layout-pb-md ">
        <div data-anim-wrap="" class="container countryPage">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">5 Stars Hotels in <?php echo $dest ?></h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Book your accommodation in the best hotels in <?php echo $dest ?></p>
                    </div>
                </div>
            </div>
            <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist ">
                <?php
                $count = 0;
                foreach ($hotels  as $hotel) {
                    if ($count == 4) {
                        break;
                    }
                    if (substr($hotel['categoryCode'], 0, 1) != 5) {
                        continue;
                    }
                    $count += 1;
                ?>
                    <div data-anim-child="slide-up delay-3" class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
                        <a target="_blank" href="<?php echo $WORKPATH . 'hotel.php?hotel=' . $hotel['slug']; ?>">
                            <div class="SearchByhotel hotelsCard -type-1 " id="<?php echo $hotel['id'] ?>">
                                <div class="hotelsCard__image">
                                    <div class="cardImage ratio ratio-1:1">
                                        <div class="cardImage__content">
                                            <?php
                                            $images = json_decode($hotel['images'], true);
                                            $src = 'https://photos.hotelbeds.com/giata/' . $images['image'][0]['@attributes']['path'];
                                            ?>
                                            <img class="rounded-4 col-12" src="<?php echo $src ?>" alt="<?php echo $hotel['name'] ?>" title="<?php echo $hotel['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelsCard__content mt-10">
                                    <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                        <span><?php echo $hotel['name'] ?></span>
                                        <div class="d-inline-block ml-10">
                                            <?php
                                            $stars = substr($hotel['categoryCode'], 0, 1);
                                            for ($i = 1; $i <= (int) $stars; $i++) {
                                                echo '<i class="icon-star text-10 text-yellow-2"></i>';
                                            } ?>
                                        </div>
                                    </h3>
                                    <p class="text-light-1 lh-14 text-14 mt-5"> <?php echo $hotel['address'] . ", " . $hotel['city']; ?> </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <section class=" layout-pb-md ">
        <div data-anim-wrap="" class="container countryPage">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">4 Stars Hotels in <?php echo $dest ?></h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Book your accommodation in the best hotels in <?php echo $dest ?></p>
                    </div>
                </div>
            </div>
            <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist ">
                <?php
                $count = 0;
                foreach ($hotels  as $hotel) {
                    if ($count == 4) {
                        break;
                    }
                    if (substr($hotel['categoryCode'], 0, 1) != 4) {
                        continue;
                    }
                    $count += 1;
                ?>
                    <div data-anim-child="slide-up delay-3" class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
                        <a target="_blank" href="<?php echo $WORKPATH . 'hotel.php?hotel=' . $hotel['slug']; ?>">
                            <div class="SearchByhotel hotelsCard -type-1 " id="<?php echo $hotel['id'] ?>">
                                <div class="hotelsCard__image">
                                    <div class="cardImage ratio ratio-1:1">
                                        <div class="cardImage__content">
                                            <?php
                                            $images = json_decode($hotel['images'], true);
                                            $src = 'https://photos.hotelbeds.com/giata/' . $images['image'][0]['@attributes']['path'];
                                            ?>
                                            <img class="rounded-4 col-12" src="<?php echo $src ?>" alt="<?php echo $hotel['name'] ?>" title="<?php echo $hotel['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelsCard__content mt-10">
                                    <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                        <span><?php echo $hotel['name'] ?></span>
                                        <div class="d-inline-block ml-10">
                                            <?php
                                            $stars = substr($hotel['categoryCode'], 0, 1);
                                            for ($i = 1; $i <= (int) $stars; $i++) {
                                                echo '<i class="icon-star text-10 text-yellow-2"></i>';
                                            } ?>
                                        </div>
                                    </h3>
                                    <p class="text-light-1 lh-14 text-14 mt-5"> <?php echo $hotel['address'] . ", " . $hotel['city']; ?> </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <section class=" layout-pb-md ">
        <div data-anim-wrap="" class="container countryPage">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">3 Stars Hotels in <?php echo $dest ?></h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Book your accommodation in the best hotels in <?php echo $dest ?></p>
                    </div>
                </div>
            </div>
            <div class="row y-gap-30 pt-40 sm:pt-20 row-hotelslist ">
                <?php
                $count = 0;
                foreach ($hotels  as $hotel) {
                    if ($count == 4) {
                        break;
                    }
                    if (substr($hotel['categoryCode'], 0, 1) != 3) {
                        continue;
                    }
                    $count += 1;
                ?>
                    <div data-anim-child="slide-up delay-3" class="col-xl-3 col-lg-3 col-sm-6 js-section-slide">
                        <a target="_blank" href="<?php echo $WORKPATH . 'hotel.php?hotel=' . $hotel['slug']; ?>">
                            <div class="SearchByhotel hotelsCard -type-1 " id="<?php echo $hotel['id'] ?>">
                                <div class="hotelsCard__image">
                                    <div class="cardImage ratio ratio-1:1">
                                        <div class="cardImage__content">
                                            <?php
                                            $images = json_decode($hotel['images'], true);
                                            $src = 'https://photos.hotelbeds.com/giata/' . $images['image'][0]['@attributes']['path'];
                                            ?>
                                            <img class="rounded-4 col-12" src="<?php echo $src ?>" alt="<?php echo $hotel['name'] ?>" title="<?php echo $hotel['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelsCard__content mt-10">
                                    <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                        <span><?php echo $hotel['name'] ?></span>
                                        <div class="d-inline-block ml-10">
                                            <?php
                                            $stars = substr($hotel['categoryCode'], 0, 1);
                                            for ($i = 1; $i <= (int) $stars; $i++) {
                                                echo '<i class="icon-star text-10 text-yellow-2"></i>';
                                            } ?>
                                        </div>
                                    </h3>
                                    <p class="text-light-1 lh-14 text-14 mt-5"> <?php echo $hotel['address'] . ", " . $hotel['city']; ?> </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    if (array_key_exists($dest, $descriptions)) {
        echo "<section class='layout-pb-md '>
                <div class='container countryPage desc'>
                  <h2>Explore and find Hotels in " . $dest . " </h2></br>" . $descriptions[$dest] . "
                </div>
            </section>";
    }
    ?>
    <?php
    if (array_key_exists($dest, $faqs)) {
        echo "</hr><section class='layout-pb-md'>
   <div class='container countryPage '>
     <div class='row y-gap-20'>
        <div class='col-lg-4'>
            <h2 class='text-30 fw-500'>
                 FAQs about  " . $dest . "
             </h2>
         </div>
         <div class='col-lg-8'>
             <div class='accordion -simple row y-gap-20 js-accordion'>";
        foreach ($faqs[$dest] as $key => $value) {
            echo "
                 <div class='col-12'>
                     <div class='accordion__item px-20 py-20 border-light rounded-4'>
                         <div class='accordion__button d-flex items-center'>
                             <div class='accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20'>
                                 <i class='icon-plus'></i>
                                 <i class='icon-minus'></i>
                             </div>
                             <div class='button text-dark-1'>" . $key . "</div>
                         </div>
                         <div class='accordion__content'>
                             <div class='pt-20 pl-60'>
                                 <p class='text-15'>" . $value . "</p>
                             </div>
                         </div>
                     </div>
                 </div>";
        };
        echo " </div>
         </div>
     </div>
 </div>
</section>";
    }
    ?>
    <?php include('files/bottom.php') ?>
    <script>
        var startdate = new Date();
        startdate.setDate(startdate.getDate() + 1);
        var enddate = new Date();
        enddate.setDate(enddate.getDate() + 2);
        window.start = moment(startdate).format("YYYY-MM-DD");
        window.end = moment(enddate).format("YYYY-MM-DD");
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                    opens: "center",
                    startDate: startdate,
                    endDate: enddate,
                    minDate: startdate,
                    locale: {
                        format: "DD/MM/YYYY",
                    },
                },
                function(start, end, label) {
                    window.start = start.format("YYYY-MM-DD");
                    window.end = end.format("YYYY-MM-DD");
                }
            );
        });
        document.getElementById('loadMoreBtn').addEventListener('click', function() {
            document.getElementById('loadMoreBtn').style.display = 'none';
            document.getElementById('loadMore').style.display = 'flex';
        });
    </script>
</body>
</html>