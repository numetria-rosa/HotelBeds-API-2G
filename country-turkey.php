<?php
$metaDescription = "With Dmcbooking.pro, explore Turkey beauty and culture. From stunning Cappadocian landscapes to historic Istanbul sites, plan your adventure.";
$metaKeywords = "Turkey destinations, Turkish travel, Cappadocia, Istanbul, Turkish culture, travel guide, historical sites, local cuisine, landmarks, Turkish tourism";
$metaCanonical = "https://dmcbooking.pro/country-turkey.php";
$metaTitle = "DMC Booking : Explore hotels in Turkey";
include('files/top-head.php')
?>
<?php
session_start();
?>
<body>
    <?php include('./files/header.php') ?>
    <section data-anim-wrap="" class="masthead -type-1 z-5">
        <div data-anim-child="fade" class="masthead__bg">
            <img src="#" alt="Find Hotels in Turkey" title="Find Hotels in Turkey" data-src="img/backgrounds/2.webp" class="js-lazy">
        </div>
        <div class="container">
            <div class="row justify-center">
                <div class="col-auto">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Find Hotels in Turkey</h1>
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
                            <div class="text-dark-1">Turkey</div>
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
                        <h2 class="sectionTitle__title">Top Cities in Turkey</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Find hotels in some of the most popular cities in Turkey</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="1" attr="BTZ" name="Bursa">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/bursa.webp" alt="Bursa" title="Bursa" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Nature, Mountains, Old Town </br>
                                        73 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Bursa City</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="1" attr="FET" name="Fethiye">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Fethiye.webp" alt="Fethiye" title="Fethiye" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Paragliding, Relaxation
                                        </br>82 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Fethiye</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="2" attr="FET" name="Oludeniz">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Oludeniz.webp" alt="Oludeniz" title="Oludeniz" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Paragliding, Beaches, Nature</br>
                                        92 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Oludeniz</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="1" attr="ANK" name="Ankara">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Ankara.webp" alt="Ankara" title="Ankara" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Business, Shopping, Museums</br>
                                        85 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Ankara</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="10" attr="BJV" name="Bodrum">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/BodrumCity.webp" alt="Bodrum" title="Bodrum" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Nightlife, Beaches, Entertainment </br>
                                        73 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Bodrum City</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 6/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="2" attr="BJV" name="Gumbet">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Gumbet.webp" alt="Gumbet" title="Gumbet" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Nightlife, Beaches, Entertainment</br>
                                        42 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Gümbet</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="7/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="1" attr="TR3" name="Pamukkale">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Pamukkale.webp" alt="Pamukkale" title="Pamukkale" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Hot Springs, Scenery, Nature</br>
                                        27 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Pamukkale</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="8 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="2" attr="AYT" name="Lara">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Lara.webp" alt="Lara" title="Lara" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Relaxation, Beaches, Family friendly trips </br>
                                        15 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Lara</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 9/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Turkey" code="15" attr="AYT" name="Side">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/turkey/zone/Side.webp" alt="Side" title="Side" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Sandy beaches, Ancient landmarks </br>
                                        63 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Side</h3>
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
                        <h2 class="sectionTitle__title">Top Destinations in Turkey</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Discover Turkey by exploring its top destinations</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev1" data-pagination="js-hotels-pag1" data-nav-next="js-hotels-next1">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Turkey" attr="BTZ" name="Bursa">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/dest/Bursa.webp" alt="Bursa" title="Bursa">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Bursa
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">73 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Turkey" attr="CAP" name="Cappadocia">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/dest/Cappadocia.webp" alt="Cappadocia" title="Cappadocia">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Cappadocia
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">89 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Turkey" attr="YAV" name="Yalova">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/dest/Yalova.webp" alt="Yalova" title="Yalova">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Yalova Thermal
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">27 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Turkey" attr="BJV" name="Bodrum">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/dest/Bodrum.webp" alt="Bodrum" title="Bodrum">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Bodrum
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">97 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Turkey" attr="AYT" name="Antalya">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/dest/Antalya.webp" alt="Antalya" title="Antalya">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Antalya Coast
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">92 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Turkey" attr="SSX" name="Samsun">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/dest/Samsun.webp" alt="Samsun" title="Samsun">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Samsun Province
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
            <h2>Explore and find Hotels in Turkey</h2></br>
            <h3>Discover Hotels in Turkey</h3>
            <p>Explore the vibrant offerings of hotels in Turkey, where culture, history, and hospitality converge to create unforgettable experiences. From the bustling streets of Istanbul to the serene shores of the Aegean coast, Turkey boasts a wide range of accommodations to suit every traveler's preferences.</p></br>
            <h3>Explore Diverse Accommodation Options</h3>
            <p>Discover a variety of lodging options, including luxurious resorts overlooking breathtaking landscapes, charming boutique hotels nestled in historic neighborhoods, and cozy guesthouses in picturesque villages. Whether you're seeking a relaxing beach retreat, an urban adventure, or a cultural immersion, Turkey has the perfect accommodation for you.</p></br>
            <h3>Plan Your Turkish Getaway</h3>
            <p>Plan your Turkish getaway with ease using our intuitive search tools and comprehensive listings. Filter hotels by location, amenities, and budget to find the ideal stay that meets your needs. Whether you're traveling solo, with family, or for business, we make it simple to explore and book your dream accommodations in Turkey.</p></br>
            <h3>Immerse Yourself in Turkish Culture</h3>
            <p>Immerse yourself in Turkey's rich heritage and vibrant culture as you explore iconic landmarks, sample delicious cuisine, and interact with friendly locals. From the ancient ruins of Ephesus to the fairy chimneys of Cappadocia, Turkey offers a wealth of experiences waiting to be discovered.</p></br>
            <h3>Book Your Turkish Adventure Today</h3>
            <p>Start your Turkish adventure today by booking your hotel with us. Whether you're embarking on a once-in-a-lifetime journey or a quick weekend getaway, let us help you find the perfect place to stay in Turkey, where every moment promises to be an unforgettable adventure.</p>
        </div>
    </section>
    <section class="layout-pt-md-a layout-pb-md">
        <div data-anim="slide-up delay-1" class="container countryPage is-in-view">
            <div class="row y-gap-10 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Hotels in Turkey near popular landmarks</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Pick your point of interest and find a hotel nearby</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide " role="group" aria-label="1 /9">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Taksim Square" ctry="Turkey" attr="IST" name="Istanbul">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/landmark/Taksim.webp" alt="Taksim Square" title="Taksim Square">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Taksim Square, Istanbul</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">62 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="2 /9">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Hagia Sophia" ctry="Turkey" attr="IST" name="Istanbul">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/landmark/HagiaSophia.webp" alt="Hagia Sophia" title="Hagia Sophia">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Hagia Sophia, Istanbul</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">54 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="4 /9">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Mevlana Museum" ctry="Turkey" attr="KYA" name="Konya">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/landmark/MevlanaMuseum.webp" alt="Mevlana Museum" title="Mevlana Museum">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Mevlana Museum, Konya</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">39 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="8 /9">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Calis Beach" ctry="Turkey" attr="FET" name="Fethiye">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/landmark/Calis.webp" alt="Calis Beach" title="Calis Beach">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Calis Beach, Fethiye</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">59 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="6 /9">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Istiklal Street" ctry="Turkey" attr="IST" name="Istanbul">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/landmark/Istiklal.webp" alt="Istiklal Street" title="Istiklal Street">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Istiklal Street, Istanbul</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 74 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="7 /9">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Grand Bazaar" ctry="Turkey" attr="IST" name="Istanbul">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/turkey/landmark/GrandBazaar.webp" alt="Grand Bazaar" title="Grand Bazaar">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Grand Bazaar, Istanbul</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">76 hotels</p>
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