<?php
$metaDescription = "Discover enchanting French destinations with Dmcbooking.pro. Immerse yourself in art, history, and gastronomy. Plan your getaway today.";
$metaKeywords = "France destinations, French travel, Paris, French Riviera, art, history, gastronomy, travel guide, romantic getaways, French culture";
$metaCanonical = "https://dmcbooking.pro/country-france.php";
$metaTitle = "DMC Booking : Explore hotels in France";
include('files/top-head.php')
?>
<?php
session_start();
?>
<body>
    <?php include('./files/header.php') ?>
    <section data-anim-wrap="" class="masthead -type-1 z-5">
        <div data-anim-child="fade" class="masthead__bg">
            <img src="#" alt="Find Hotels in France" title="Find Hotels in France" data-src="img/backgrounds/2.webp" class="js-lazy">
        </div>
        <div class="container">
            <div class="row justify-center">
                <div class="col-auto">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Find Hotels in France</h1>
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
                            <div class="text-dark-1">France</div>
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
                        <h2 class="sectionTitle__title">Top Cities in France</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Find hotels in some of the most popular cities in France</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="France" code="1" attr="NCE" name="Nice">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/France/zone/Nice.webp" alt="Nice" title="Nice" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Promenades, Vieille ville, Bord de mer </br>
                                        142 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Nice</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="France" code="1" attr="LYS" name="Lyon">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/France/zone/Lyon.webp" alt="Lyon" title="Lyon" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Vieille ville, Balades en ville, Gastronomie
                                        </br>92 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Lyon</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="France" code="1" attr="MRS" name="Marseille">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/France/zone/Marseille.webp" alt="Marseille" title="Marseille" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Ports, Climat ensoleillé, Balades en ville</br>
                                        112 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Marseille</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="France" code="1" attr="SXB" name="Strasbourg">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/France/zone/Strasbourg.webp" alt="Strasbourg" title="Strasbourg" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Strasbourg
                                        Vieille ville, Cathédrales, Balades en ville</br>
                                        185 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Strasbourg</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 9">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="France" code="1" attr="CAN" name="Cannes">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/France/zone/Cannes.webp" alt="Cannes" title="Cannes" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Plage, Bord de mer, Restaurants </br>
                                        93 hotels
                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Cannes</h3>
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
                        <h2 class="sectionTitle__title">Top Destinations in France</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Discover France by exploring its top destinations</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev1" data-pagination="js-hotels-pag1" data-nav-next="js-hotels-next1">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label="1 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="France" attr="PAR" name="Paris">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/dest/Paris.webp" alt="Paris" title="Paris">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Paris
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">972 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="2 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="France" attr="NCY" name="Annecy">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/dest/Annecy.webp" alt="Annecy" title="Annecy">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Lake Annecy
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">85 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="3 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="France" attr="TLS" name="Toulouse">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/dest/Toulouse.webp" alt="Toulouse" title="Toulouse">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Toulouse
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">220 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="4 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="France" attr="AJA" name="Corsica">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/dest/Corsica.webp" alt="Corsica" title="Corsica">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Corsica
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">72 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="5 / 8">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="France" attr="LR1" name="Loire">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/dest/Loire.webp" alt="Loire" title="Loire">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Loire Valley
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">192 hotels</p>
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
            <h2>Explore and find Hotels in France</h2></br>
            <h3>Discover Hotels in France</h3>
            <p>Explore the diverse landscapes and rich cultural heritage of France with our curated selection of hotels. From the romantic streets of Paris to the sun-kissed beaches of the French Riviera, France offers an array of experiences for every traveler.</p></br>
            <h3>Explore Diverse Accommodation Options</h3>
            <p>Discover a variety of lodging options in France, including luxurious hotels with panoramic views, charming boutique accommodations nestled in historic villages, and budget-friendly stays for travelers seeking affordability. Whether you seek romance, adventure, or relaxation, France promises an unforgettable stay.</p></br>
            <h3>Plan Your Stay with Ease</h3>
            <p>Plan your French getaway effortlessly with our user-friendly booking platform. Browse through a curated selection of hotels, filter by location and amenities, and find the perfect accommodation tailored to your needs and preferences. From exploring world-renowned landmarks to savoring delectable cuisine, France offers experiences for every type of traveler.</p></br>
            <h3>Immerse Yourself in France's Cultural Splendor</h3>
            <p>Immerse yourself in France's cultural splendor as you wander through its charming villages, explore its majestic castles, and indulge in its world-class art and cuisine. From the iconic Eiffel Tower to the breathtaking landscapes of Provence, France invites you to experience its timeless beauty and joie de vivre.</p></br>
            <h3>Book Your French Adventure Today</h3>
            <p>Begin your French adventure by booking your hotel with us. Whether you're planning a romantic escape, a family vacation, or a solo journey, let us help you find the perfect place to stay in France. Start your journey today and create cherished memories in this enchanting destination.</p>
        </div>
    </section>
    <section class="layout-pt-md-a layout-pb-md">
        <div data-anim="slide-up delay-1" class="container countryPage is-in-view">
            <div class="row y-gap-10 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Hotels in France near popular landmarks</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Pick your point of interest and find a hotel nearby</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide " role="group" aria-label="1 /4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Notre Dame de Lourdes Sanctuary" ctry="France" attr="LDE" name="Lourdes">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/landmark/NotreDame.webp" alt="Notre Dame" title="Notre Dame">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Notre Dame de Lourdes Sanctuary, Lourdes</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">112 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="2 /4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Louvre Museum" ctry="France" attr="PAR" name="Paris">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/landmark/Louvre.webp" alt="Louvre Museum" title="Louvre Museum">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Louvre Museum, Paris</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">272 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="3 /4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Strasbourg Christmas Market" ctry="France" attr="SXB" name="Strasbourg">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/landmark/Strasbourg.webp" alt="Christmas Market" title="Christmas Market">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Strasbourg Christmas Market, Strasbourg</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">185 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label="4 /4">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Galeries Lafayette" ctry="France" attr="PAR" name="Paris">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/France/landmark/Lafayette.webp" alt="Galeries Lafayette" title="Galeries Lafayette">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Galeries Lafayette, Paris</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">275 hotels</p>
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