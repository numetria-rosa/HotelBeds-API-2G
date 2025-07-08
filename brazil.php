<?php
$metaDescription = "Experience Brazil vibrant beauty with our hotel reservations. Discover top destinations, culture, and landscapes. Book your stay with Dmcbooking.pro";
$metaKeywords = "DMC Booking, Dmcbooking , Dmcbooking.pro,Brazil, hotels in Brazil, Brazilian tourism, travel Brazil, accommodation Brazil, Brazil vacations, Brazil travel guide";
$metaCanonical = "https://dmcbooking.pro/brazil.php";
$metaTitle = "DMC Booking : Explore hotels in Brazil";
include('files/top-head.php')
?>
<?php
session_start();
?>
<body>
    <?php include('./files/header.php') ?>
    <section data-anim-wrap="" class="masthead -type-1 z-5">
        <div data-anim-child="fade" class="masthead__bg">
            <img src="#" alt="Find Hotels in Brazil" title="Find Hotels in Brazil" data-src="img/backgrounds/2.webp" class="js-lazy">
        </div>
        <div class="container">
            <div class="row justify-center">
                <div class="col-auto">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Find Hotels in Brazil</h1>
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
                            <div class="text-dark-1">Brazil</div>
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
                        <h2 class="sectionTitle__title">Top Cities in Brazil</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Find hotels in some of the most popular cities in Brazil</p>
                    </div>
                </div>
            </div>
            <div class="relative pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden is-in-view" data-gap="30" data-scrollbar="" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label=" 1/ 6">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Brazil" attr="SAO" name="São Paulo">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Brazil/zone/SaoPaulo.webp" alt="São Paulo" title="São Paulo" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Food, Shopping, Culture </br>
                                        452 hotels

                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">São Paulo</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 2/ 6">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Brazil" attr="RIO" name="Rio de Janeiro">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Brazil/zone/Rio.webp" alt="Rio de Janeiro" title="Rio de Janeiro" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Sightseeing, Scenery </br>
                                        380 hotels

                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Rio de Janeiro</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 3/ 6">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Brazil" attr="BSB" name="Brasília">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Brazil/zone/Brazilia.webp" alt="Brasília" title="Brasília" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Architecture, Monuments, Fine Dining </br>
                                        190 hotels

                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Brasília</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 4/ 6">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Brazil" attr="SVD" name="Salvador">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Brazil/zone/Salvador.webp" alt="Salvador" title="Salvador" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Old Town, Beaches, Culture </br>
                                        132 hotels

                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Salvador</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 5/ 6">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Brazil" attr="FTZ" name="Fortaleza">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Brazil/zone/Fortaleza.webp" alt="Fortaleza" title="Fortaleza" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Tourist Attractions, Beach Walks </br>
                                        103 hotels

                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Fortaleza</h3>
                                    <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Discover</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 6/ 6">
                        <a href="#" class="citiesCard -type-1 d-block rounded-4 searchBydest" ctry="Brazil" attr="FLO" name="Florianópolis">
                            <div class="citiesCard__image ratio ratio-3:4">
                                <img src="img/country/Brazil/zone/Florianopolis.webp" alt="Florianópolis" title="Florianópolis" class="js-lazy loaded" data-ll-status="loaded">
                            </div>
                            <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                <div class="citiesCard__bg"></div>
                                <div class="citiesCard__top">
                                    <div class="text-14 text-white">
                                        Beaches, Nature, Beach Walks </br>
                                        127 hotels

                                    </div>
                                </div>
                                <div class="citiesCard__bottom">
                                    <h3 class="text-26 md:text-20 lh-13 text-white mb-20">Florianópolis</h3>
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
                        <h2 class="sectionTitle__title">Top Destinations in Brazil</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Discover Brazil by exploring its top destinations</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev1" data-pagination="js-hotels-pag1" data-nav-next="js-hotels-next1">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide  " role="group" aria-label=" 1/ 5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Brazil" attr="AHI" name="Ilha Grande">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/dest/IlhaGrande.webp" alt="Ilha Grande" title="Ilha Grande">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Ilha Grande
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">198 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 2/ 5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Brazil" attr="ECR" name="Ceará">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/dest/Ceara.webp" alt="Ceará" title="Ceará">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Ceará
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">112 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 3/ 5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Brazil" attr="LHL" name="Ilhabela">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/dest/Ilhabela.webp" alt="Ilhabela" title="Ilhabela">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Ilhabela
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">132 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label=" 4/ 5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Brazil" attr="SBJ" name="Espírito Santo">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/dest/EspiritoSanto.webp" alt="Espírito Santo" title="Espírito Santo">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Espírito Santo
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">159 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide  " role="group" aria-label="5 / 5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" ctry="Brazil" attr="RIG" name="Rio Grande do Sul">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/dest/RioGrande.webp" alt="Rio Grande do Sul" title="Rio Grande do Sul">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Rio Grande do Sul
                                    </span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">152 hotels</p>
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
            <h2>Discover the Marvels of Brazil with Dmcbooking.pro</h2></br>
            <h3>Embark on an Unforgettable Journey to Brazil</h3>
            <p>Discover the allure of Brazil, a mesmerizing destination that beckons travelers with its breathtaking landscapes, vibrant culture, and warm hospitality. From the golden shores of Rio de Janeiro to the dense jungles of the Amazon, Brazil offers an unparalleled tapestry of experiences waiting to be explored. At Dmcbooking.pro, we invite you to dive into the heart of this enchanting country and create memories that will last a lifetime.</p></br>

            <h3>Experience the Magnificence of Brazil's Coastline</h3>
            <p>Indulge in the ultimate beachfront escape as you explore Brazil's stunning coastline, adorned with pristine beaches and azure waters. Whether you're drawn to the bustling energy of Copacabana or the serene beauty of Ilha Grande, our curated selection of hotels and resorts promise a luxurious retreat by the sea. From world-class amenities to breathtaking views, immerse yourself in the coastal splendor of Brazil with Dmcbooking.pro.</p></br>

            <h3>Immerse Yourself in Brazil's Rich Cultural Tapestry</h3>
            <p>Delve into the heart of Brazilian culture as you wander through its vibrant cities and charming towns. From the rhythm of samba in Salvador to the colonial charm of Paraty, each destination offers a glimpse into Brazil's diverse heritage. Engage with locals, explore historic landmarks, and partake in colorful festivals that celebrate the country's rich traditions. At Dmcbooking.pro, we invite you to experience the warmth and vibrancy of Brazil's cultural tapestry.</p></br>

            <h3>Discover the Untamed Beauty of the Amazon Rainforest</h3>
            <p>Embark on an adventure like no other as you journey into the depths of the Amazon rainforest, one of the world's most biodiverse ecosystems. Traverse winding rivers, trek through dense foliage, and encounter exotic wildlife in their natural habitat. Our eco-friendly lodges and guided tours offer a responsible and immersive experience, allowing you to connect with nature while preserving its pristine beauty. Let Dmcbooking.pro be your gateway to the untamed wilderness of the Amazon.</p></br>

            <h3>Savor the Flavors of Brazilian Cuisine</h3>
            <p>Indulge your senses in the tantalizing flavors of Brazilian cuisine, a delightful fusion of indigenous, African, and Portuguese influences. From savory feijoada to succulent churrasco, Brazilian gastronomy is a culinary journey like no other. Sip on refreshing caipirinhas, sample exotic fruits, and explore the vibrant street food scene that captivates visitors from around the world. At Dmcbooking.pro, we invite you to embark on a culinary adventure that celebrates the diverse flavors of Brazil.</p></br>
        </div>
    </section>
    <section class="layout-pt-md-a layout-pb-md">
        <div data-anim="slide-up delay-1" class="container countryPage is-in-view">
            <div class="row y-gap-10 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Hotels in Brazil near popular landmarks</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">Pick your point of interest and find a hotel nearby</p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight swiper-watch-progress swiper-backface-hidden" data-gap="30" data-scrollbar="" data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
                <div class="swiper-wrapper" aria-live="polite">
                    <div class="swiper-slide " role="group" aria-label=" 1/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Cristo Redentor" ctry="Brazil" attr="RIO" name="Rio de Janeiro">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/landmark/CristoRedentor.jpg" alt="Cristo Redentor" title="Cristo Redentor">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Cristo Redentor, Rio de Janeiro</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">242 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label=" 2/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Copacabana" ctry="Brazil" attr="RIO" name="Rio de Janeiro">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/landmark/Copacabana.jpg" alt="Copacabana" title="Copacabana">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Copacabana, Rio de Janeiro</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">192 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label=" 3/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Ouro Preto" ctry="Brazil" attr="OUP" name="Ouro Preto">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/landmark/OuroPreto.jpg" alt="Ouro Preto" title="Ouro Preto">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Ouro Preto's Baroque Architecture, Ouro Preto</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">83 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label=" 4/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Latin America Memorial" ctry="Brazil" attr="SAO" name="São Paulo">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/landmark/LatinAmericaMemorial.webp" alt="Latin America Memorial" title="Latin America Memorial">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Latin America Memorial, São Paulo</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">273 hotels</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide " role="group" aria-label=" 5/5">
                        <a href="#" class="hotelsCard -type-1 searchBydest" landmark="Art Museum of Sao Paulo" ctry="Brazil" attr="SAO" name="São Paulo">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12" src="img/country/Brazil/landmark/ArtMuseum.webp" alt="Art Museum of Sao Paulo" title="Art Museum of Sao Paulo">
                                    </div>
                                </div>
                            </div>
                            <div class="hotelsCard__content mt-10">
                                <h3 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>Art Museum, São Paulo</span>
                                </h3>
                                <p class="text-light-1 lh-14 text-14 mt-5">248 hotels</p>
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