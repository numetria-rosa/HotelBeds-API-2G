<?php
$metaDescription = "With Dmcbooking.pro Discover unforgettable Summer holiday. Experience our breathtaking destinations. Book now for the ultimate getaway!";
$metaKeywords = "DMC Booking, Dmcbooking , Dmcbooking.pro, Summer holiday,Hotel reservations,Holiday deals,Vacation packages,Travel discounts,Beach vacations,Romantic escapes,Family-friendly hotels,Adventure travel,Luxury accommodations,Destination getaways,Travel specials,Last-minute deals";
$metaCanonical = "https://dmcbooking.pro/season-vacations.php";
$metaTitle = "DMC Booking :Discover Hotels during Summer holiday";
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
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Book Summer Holiday</h1>
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
                            <div class="text-dark-1">Summer holiday</div>
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
                        <h2 class="sectionTitle__title">Book Summer holiday in Tunisia</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Experience a blend of history and relaxation this summer in Tunisia. From the ancient ruins of Carthage to the stunning beaches of Hammamet, find your perfect getaway .</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="HMM" name="Hammamet">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Tunisia/Hammamet.jpg" alt="Hammamet" title="Hammamet" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Entertainment, Old Town
                                        </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Hammamet</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="TOE" name="Tunis">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Tunisia/Tunis.jpg" alt="Tunis" title="Tunis" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Medina, Bardo Museum, Carthage
                                        </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Tunis</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="DJE" name="Djerba">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Tunisia/Djerba.avif" alt="Djerba" title="Djerba" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Synagogue, Souks</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Djerba</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="TN1" name="Sousse">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Tunisia/Sousse.jpg" alt="Sousse" title="Sousse" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Ribat, Ressorts , Nightlife</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Sousse</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="TO1" name="Tozeur">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Tunisia/Tozeur.avif" alt="Tozeur" title="Tozeur" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Sahara Desert, Oasis, Chott el Jerid</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Tozeur</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 6/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="MH1" name="Mahdia">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Tunisia/Mahdia.jpeg" alt="Mahdia" title="Mahdia" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Fatimid Architecture, Fishing Port</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Mahdia</h3>
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
        <div class=" container countryPage" style="overflow: hidden;">
            <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end is-in-view">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Book Summer holiday in Egypt</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Embark on a magical journey to Egypt this summer. Explore the wonders of the pyramids in Giza, cruise the serene Nile River, and bask in the warm sun of Sharm El Sheikh for an unforgettable vacation .</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="CAI" name="Cairo">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Egypt/Cairo.jpeg" alt="Cairo" title="Cairo" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Pyramids, Nile River, History </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Cairo</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="SSH" name="Sharm El Sheikh">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Egypt/SharmElSheikh.avif" alt="Sharm El Sheikh" title="Sharm El Sheikh" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Red Sea, Diving, Resorts
                                        </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Sharm El Sheikh</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="ASW" name="Aswan">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Egypt/Aswan.jpg" alt="Aswan" title="Aswan" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Nile Cruises, Temples, Nubian Culture</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Aswan</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="ANK" name="Alexandria">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Egypt/Alexandria.jpeg" alt="Alexandria" title="Alexandria" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Mediterranean Coast, Citadel, Bibliotheca Alexandrina</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Alexandria</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="LXR" name="Luxor">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Egypt/Luxor.jpeg" alt="Luxor" title="Luxor" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Valley of the Kings, Temples, Hot Air Ballooning</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Luxor</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 6/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="HRG" name="Hurghada">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Egypt/Hurghada.jpg" alt="Hurghada" title="Hurghada" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beach Resorts, Snorkeling, Water Sports</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Hurghada</h3>
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
        <div class=" container countryPage" style="overflow: hidden;">
            <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end is-in-view">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Book Summer holiday in Morocco</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Escape to the vibrant colors and bustling souks of Morocco this summer. Lose yourself in the maze-like streets of Marrakech, trek the majestic Atlas Mountains, and indulge in the flavors of authentic Moroccan cuisine for an enchanting holiday experience.</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="RAK" name="Marrakech">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Morocco/Marrakech.jpg" alt="Marrakech" title="Marrakech" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Souks, Medina, Gardens </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Marrakech</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="CHH" name="Chefchaouen">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Morocco/Chefchaouen.jpeg" alt="Chefchaouen" title="Chefchaouen" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Blue City, Medina, Rif Mountains
                                        </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Chefchaouen</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="CAA" name="Casablanca">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Morocco/Casablanca.jpg" alt="Casablanca" title="Casablanca" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Hassan II Mosque, Corniche, Art Deco Buildings</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Casablanca</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="RBA" name="Rabat">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Morocco/Rabat.jpeg" alt="Rabat" title="Rabat" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Kasbah, Mausoleum of Mohammed V, Chellah</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Rabat</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="FEZ" name="Fez">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Morocco/Fez.jpg" alt="Fez" title="Fez" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Medina, Tanneries, Al-Qarawiyyin Mosque </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Fez</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 6/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="BJV" name="Tangier">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Morocco/Tangier.jpeg" alt="Tangier" title="Tangier" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Strait of Gibraltar, Kasbah, Caves of Hercules</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Tangier</h3>
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
    <section class="layout-pt-md-a layout-pb-md">
        <div class=" container countryPage" style="overflow: hidden;">
            <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end is-in-view">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Book Summer holiday in Saudi Arabia</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Discover the charm of Saudi Arabia this summer with its rich cultural heritage and modern luxuries. From exploring the historical sites of Jeddah to experiencing the bustling city life of Riyadh, create lasting memories in the heart of the Middle East.</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="RUH" name="Riyadh">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/SaudiArabia/Riyadh.jpeg" alt="Riyadh" title="Riyadh" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Kingdom Centre, Al Masmak Fortress, Diriyah </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Riyadh</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="JED" name="Jeddah">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/SaudiArabia/Jeddah.jpeg" alt="Jeddah" title="Jeddah" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Corniche, Al-Balad, King Fahd Fountain
                                        </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Jeddah</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="QCA" name="Makkah">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/SaudiArabia/Makkah.jpg" alt="Makkah" title="Makkah" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Masjid al-Haram, Kaaba, Pilgrimage</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Makkah</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="MED" name="Madinah">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/SaudiArabia/Madinah.jpeg" alt="Madinah" title="Madinah" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Prophet's Mosque, Dates, Islamic History</br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Madinah</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" attr="YNB" name="Yanbu">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/SaudiArabia/Yanbu.jpg" alt="Yanbu" title="Yanbu" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Red Sea Coast, Coral Reefs, Diving Spots </br>
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Yanbu</h3>
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