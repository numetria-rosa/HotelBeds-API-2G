<?php
$metaDescription = "Explore Italy allure with Dmcbooking.pro. From Rome ruins to Venice canals, immerse in culture, art, and cuisine. Plan your escape with us.";
$metaKeywords = "Italy destinations, Italian travel, Rome, Venice, Italian culture, art, cuisine, travel guide, historical sites, romantic escapes";
$metaCanonical = "https://dmcbooking.pro/country-italy.php";
$metaTitle = "DMC Booking : Explore hotels in Italy";
include('files/top-head.php')
?>
<?php
session_start();
?>
<body>
    <?php include('./files/header.php') ?>
    <section data-anim-wrap="" class="masthead -type-1 z-5">
        <div data-anim-child="fade" class="masthead__bg">
            <img src="#" alt="Find Hotels in Italy" title="Find Hotels in Italy" data-src="img/backgrounds/2.webp" class="js-lazy">
        </div>
        <div class="container">
            <div class="row justify-center">
                <div class="col-auto">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Find Hotels in Italy</h1>
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
                            <div class="text-dark-1">Italy</div>
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
                        <h2 class="sectionTitle__title">Top Cities in Italy</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Find hotels in some of the most popular cities in Italy</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label=" 1/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Italy" attr="ROE" name="Rome">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Italy/zone/Rome.webp" alt="Rome" title="Rome" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        History, Ancient Landmarks, Monuments</br>
                                        848 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Rome</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 2/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Italy" attr="MIL" name="Milan">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Italy/zone/Milan.webp" alt="Milan" title="Milan" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Shopping, City Walks, Cathedrals</br>
                                        312 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Milan</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 3/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Italy" attr="VCE" name="Venice">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Italy/zone/Venice.webp" alt="Venice" title="Venice" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Architecture, Romance, History</br>
                                        247 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Venice</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 4/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Italy" attr="FLR" name="Florence">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Italy/zone/Florence.webp" alt="Florence" title="Florence" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Museums, Art, Culture</br>
                                        178 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Florence</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/5">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Italy" attr="NAP" name="Naples">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Italy/zone/Naples.webp" alt="Naples" title="Naples" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Old Town, Pizza, City Walks</br>
                                        129 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Naples</h3>
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
                        <h2 class="sectionTitle__title">Top Destinations in Italy</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Discover Italy by exploring its top destinations</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev1" data-pagination="js-hotels-pag1" data-nav-next="js-hotels-next1">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Italy" attr="RNP" name="Amalfi Coast">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/dest/AmalfiCoast.webp" alt="Amalfi Coast" title="Amalfi Coast">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Amalfi Coast
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 422 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Italy" attr="SIC" name="Sicily">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/dest/Sicily.webp" alt="Sicily" title="Sicily">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Sicily
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 651 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Italy" attr="OMD" name="Dolomiti">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/dest/Dolomites.webp" alt="Dolomites" title="Dolomites">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Dolomites
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 313 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Italy" attr="NSR" name="North Sardinia">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/dest/NorthSardinia.webp" alt="North Sardinia" title="North Sardinia">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>North Sardinia
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 179 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="5/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Italy" attr="SSR" name="South Sardinia">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/dest/SouthSardinia.webp" alt="South Sardinia" title="South Sardinia">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>South Sardinia
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 189 hotels</p>
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
            <h2>Explore and find Hotels in Italy</h2></br>
            <h3>Discover Hotels in Italy</h3>
            <p>Experience the beauty and charm of Italy and explore its diverse selection of hotels nestled in picturesque cities, historic towns, and breathtaking landscapes. From luxurious accommodations offering elegance and sophistication to cozy bed and breakfasts with rustic charm, Italy provides accommodations to suit every traveler's preferences.</p></br>
            <h3>Explore Diverse Accommodation Options</h3>
            <p>Discover a variety of lodging options throughout Italy, including hotels with stunning views of the Mediterranean Sea, agriturismi nestled in the rolling hills of Tuscany, and budget-friendly stays for travelers seeking affordability. Whether you seek art, culture, cuisine, or nature, Italy promises an unforgettable stay.</p></br>
            <h3>Plan Your Stay with Ease</h3>
            <p>Plan your Italian getaway effortlessly with our user-friendly booking platform. Browse through a curated selection of hotels, filter by location and amenities, and find the perfect accommodation tailored to your needs and preferences. From exploring historic landmarks to indulging in authentic Italian cuisine, Italy offers experiences for every type of traveler.</p></br>
            <h3>Immerse Yourself in Italian Culture</h3>
            <p>Immerse yourself in the rich culture of Italy as you explore its ancient ruins, marvel at its Renaissance art, and savor its regional delicacies. From the iconic Colosseum in Rome to the charming canals of Venice, Italy invites you to experience its unique blend of history, art, and la dolce vita.</p></br>
            <h3>Book Your Italian Adventure Today</h3>
            <p>Begin your Italian adventure by booking your hotel with us. Whether you're planning a romantic escape, a cultural exploration, or a culinary journey, let us help you find the perfect place to stay in Italy. Start your journey today and create cherished memories in this captivating land of beauty and passion.</p></br>
        </div>
    </section>
    <section class="layout-pt-md-a layout-pb-md">
        <div data-anim="slide-up delay-1" class="container countryPage is-in-view">
            <div class="row y-gap-10 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Hotels in Italy near popular landmarks</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Pick your point of interest and find a hotel nearby</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide " role="group" aria-label="1/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="The Vatican" ctry="Italy" attr="ROE" name="Rome">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/landmark/Vatican.webp" alt="The Vatican" title="The Vatican">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>The Vatican ,Rome</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 512 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="2/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Trevi Fountain" ctry="Italy" attr="ROE" name="Rome">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/landmark/TreviFountain.webp" alt="Trevi Fountain" title="Trevi Fountain">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Trevi Fountain, Rome</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 548 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="3/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Galleria Vittorio Emanuele" ctry="Italy" attr="MIL" name="Milan">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/landmark/GalleriaVittorio.webp" alt="Galleria Vittorio Emanuele" title="Galleria Vittorio Emanuele">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Galleria Vittorio Emanuele, Milan</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 313 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="4/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="The Colosseum" ctry="Italy" attr="ROE" name="Rome">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/landmark/Colosseum.webp" alt="The Colosseum" title="The Colosseum">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>The Colosseum, Rome</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 612 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="5/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Pisa Tower" ctry="Italy" attr="PSA" name="Pisa">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Italy/landmark/PisaTower.webp" alt="Pisa Tower" title="Pisa Tower">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Pisa Tower, Pisa</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5"> 212 hotels</p>
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