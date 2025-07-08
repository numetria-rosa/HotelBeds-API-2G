<?php
$metaDescription = "Discover dynamic UAE destinations with Dmcbooking.pro. From Dubai skyline to Abu Dhabi heritage, explore Emirates wonders. Plan your adventure today.";
$metaKeywords = "UAE destinations, Dubai, Abu Dhabi, Emirati travel, UAE culture, travel guide, futuristic cities, cultural heritage, Middle East travel";
$metaCanonical = "https://dmcbooking.pro/united-arab-emirates.php";
$metaTitle = "DMC Booking : Explore hotels in the United Arab Emirates";
include('files/top-head.php')
?>
<?php
session_start();
?>
<body>
    <?php include('./files/header.php') ?>
    <section data-anim-wrap="" class="masthead -type-1 z-5">
        <div data-anim-child="fade" class="masthead__bg">
            <img src="#" alt="Find Hotels in the United Arab Emirates" title="Find Hotels in the United Arab Emirates" data-src="img/backgrounds/2.webp" class="js-lazy">
        </div>
        <div class="container">
            <div class="row justify-center">
                <div class="col-auto">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Find Hotels in United Arab Emirates</h1>
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
                            <div class="text-dark-1">United Arab Emirates</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="layout-pt-md-a">
        <div class=" container countryPage" style="overflow: hidden;">
            <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end is-in-view">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Top Cities in the United Arab Emirates</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Find hotels in some of the most popular cities in the United Arab Emirates</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label=" 1/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="United Arab Emirates" code="1" attr="DXB" name="Dubai">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/UAE/zone/Dubai.webp" alt="Dubai" title="Dubai" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Vibrant, Luxurious, Modern</br>
                                        447 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Dubai city</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 2/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="United Arab Emirates" code="2" attr="DXB" name="Jumeirah">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/UAE/zone/Jumeirah.jpg" alt="Jumeirah" title="Jumeirah" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Opulent, Coastal, Exclusive</br>
                                        185 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Jumeirah</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 3/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="United Arab Emirates" code="8" attr="DXB" name="Al Barsha">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/UAE/zone/AlBarsha.jpg" alt="Al Barsha" title="Al Barsha" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Dynamic, Cosmopolitan, Bustling</br>
                                        224 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Al Barsha</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 4/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="United Arab Emirates" code="2" attr="FJR" name="Dibba">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/UAE/zone/Dibba.webp" alt="Dibba" title="Dibba" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Serene, Scenic, Tranquil</br>
                                        78 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Dibba</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="United Arab Emirates" code="37" attr="DXB" name="Dubai Investment Park">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/UAE/zone/DubaiInvestmentsPark1.jpg" alt="Dubai Investment Park" title="Dubai Investment Park" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Business-Focused, Industrial, Strategic</br>
                                        112 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Dubai Investment Park</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev swiper-button-disabled" disabled="" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-479a6cf6a4ce7e63" aria-disabled="true">
                    <i class="icon icon-chevron-left text-12"></i>
                </button>
                <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-479a6cf6a4ce7e63" aria-disabled="false">
                    <i class="icon icon-chevron-right text-12"></i>
                </button>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </section>
    <section class="layout-pt-md-a">
        <div data-anim="slide-up delay-1" class="container countryPage is-in-view">
            <div class="row y-gap-10 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Top Destinations in United Arab Emirates</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Discover United Arab Emirates by exploring its top destinations</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev1" data-pagination="js-hotels-pag1" data-nav-next="js-hotels-next1">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="AUH" name="Abu Dhabi">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/AbuDhabi.webp" alt="Abu Dhabi" title="Abu Dhabi">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Abu Dhabi
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 112 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="DXB" name="Dubai">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/Dubai.webp" alt="Dubai" title="Dubai">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Dubai
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 447 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="SHJ" name="Sharjah">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/Sharjah.webp" alt="Sharjah" title="Sharjah">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Sharjah
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">154 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="RKT" name="Ras Al Khaimah">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/RasAlKhaimah.webp" alt="Ras Al Khaimah" title="Ras Al Khaimah">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Ras Al Khaimah
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">78 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="FJR" name="Fujairah">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/Fujairah.webp" alt="Fujairah" title="Fujairah">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Fujairah
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 92 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="AE1" name="Ajman">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/Ajman.webp" alt="Ajman" title="Ajman">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Ajman
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 73 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="/7">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="United Arab Emirates" attr="AAN" name="Al Ain">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/dest/AlAin.webp" alt="Al Ain" title="Al Ain">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Al Ain
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">42 hotels</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="d-flex x-gap-15 items-center justify-center sm:justify-start pt-20 sm:pt-20">
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-left-hover js-hotels-prev1 swiper-button-disabled" disabled="" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-61723fdb8eeee264" aria-disabled="true">
                            <i class="icon icon-arrow-left"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <div class="pagination -dots text-border js-hotels-pag1 swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                            <div class="pagination__item is-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 2"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 3"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 4"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 5"></div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-right-hover js-hotels-next1" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-61723fdb8eeee264" aria-disabled="false">
                            <i class="icon icon-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </section>
    <section class="layout-pt-md-a ">
        <div class="container countryPage desc">
            <h2>Explore and find Hotels in United Arab Emirates</h2></br>
            <h4>Discover Hotels in the United Arab Emirates</h4>
            <p>Experience the luxury and opulence of the United Arab Emirates (UAE) and explore its modern cities, stunning deserts, and pristine beaches with a delightful selection of hotels nestled amidst breathtaking landscapes and iconic landmarks. From luxurious accommodations offering comfort and extravagance to boutique hotels with authentic Arabian charm, the UAE provides accommodations to suit every traveler's preferences.</p></br>
            <h4>Explore Diverse Accommodation Options</h4>
            <p>Discover a variety of lodging options in the UAE, including luxurious beachfront resorts overlooking the Arabian Gulf, opulent hotels in dynamic urban centers like Dubai and Abu Dhabi, and serene desert retreats offering traditional Emirati hospitality. Whether you seek relaxation, adventure, shopping, or cultural immersion, the UAE promises an unforgettable stay.</p></br>
            <h4>Plan Your Stay with Ease</h4>
            <p>Plan your UAE getaway effortlessly with our user-friendly booking platform. Browse through a curated selection of hotels, filter by location and amenities, and find the perfect accommodation tailored to your needs and preferences. From exploring the futuristic architecture of Dubai to indulging in world-class shopping and dining, the UAE offers experiences for every type of traveler.</p></br>
            <h4>Immerse Yourself in UAE's Culture and Luxury</h4>
            <p>Immerse yourself in the rich culture and luxury of the UAE as you explore its vibrant souks, marvel at its towering skyscrapers, and experience its world-famous attractions like the Burj Khalifa and Sheikh Zayed Grand Mosque. Whether you're seeking adrenaline-pumping adventures in the desert or serene moments on pristine beaches, the UAE invites you to discover its unique blend of tradition and modernity.</p></br>
            <h4>Book Your UAE Adventure Today</h4>
            <p>Begin your UAE adventure by booking your hotel with us. Whether you're planning a romantic escape, a family vacation, or a business trip, let us help you find the perfect place to stay in the United Arab Emirates. Start your journey today and experience the luxury and hospitality of this captivating destination.</p>
        </div>
    </section>
    <section class="layout-pt-md-a layout-pb-md">
        <div data-anim="slide-up delay-1" class="container countryPage is-in-view">
            <div class="row y-gap-10 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Hotels in United Arab Emirates near popular landmarks</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Pick your point of interest and find a hotel nearby</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide " role="group" aria-label="1/4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Burj Khalifa" ctry="United Arab Emirates" attr="DXB" name="Dubai">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/landmark/BurjKhalifa.webp" alt="Burj Khalifa" title="Burj Khalifa">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Burj Khalifa</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 272 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="2/4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Sheikh Zayed Grand Mosque" ctry="United Arab Emirates" attr="AUH" name="Abu Dhabi">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/landmark/SheikhZayedGrandMosque.webp" alt="Sheikh Zayed Grand Mosque" title="Sheikh Zayed Grand Mosque">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Sheikh Zayed Grand Mosque</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 112 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="3/4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Dubai Mall" ctry="United Arab Emirates" attr="DXB" name="Dubai">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/landmark/DubaiMall.webp" alt="Dubai Mall" title="Dubai Mall">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Dubai Mall</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 312 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="4/4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Dubai Museum" ctry="United Arab Emirates" attr="DXB" name="Dubai">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/UAE/landmark/DubaiMuseum.webp" alt="Dubai Museum" title="Dubai Museum">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Dubai Museum</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 312 hotels</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="d-flex x-gap-15 items-center justify-center sm:justify-start pt-20 sm:pt-20">
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-left-hover js-hotels-prev swiper-button-disabled" disabled="" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-61723fdb8eeee261" aria-disabled="true">
                            <i class="icon icon-arrow-left"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <div class="pagination -dots text-border js-hotels-pag swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                            <div class="pagination__item is-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 2"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 3"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 4"></div>
                            <div class="pagination__item" tabindex="0" role="button" aria-label="Go to slide 5"></div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="d-flex items-center text-24 arrow-right-hover js-hotels-next" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-61723fdb8eeee261" aria-disabled="false">
                            <i class="icon icon-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </section>
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
    </script>
</body>
</html>