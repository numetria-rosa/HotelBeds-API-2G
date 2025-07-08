<header data-add-bg="" class="header -dashboard bg-white js-header header-bo" data-x="header" data-x-toggle="is-menu-opened">
    <div class="container">
        <div data-anim="fade" class="header__container px-30 sm:px-20">
            <div class="-left-side">
                <a href="/" class="header-logo" data-x="header-logo" data-x-toggle="is-logo-dark">
                    <img src="img/logo.png" alt="logo icon">
                    <img src="img/logo.png" alt="logo icon">
                </a>
            </div>
            <div class="row justify-between items-center pl-60 lg:pl-20">
                <div class="col-auto">
                    <div class="d-flex items-center">



                    </div>
                </div>

                <div class="col-auto">
                    <div class="d-flex items-center">

                        <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
                            <div class="mobile-overlay"></div>

                            <div class="header-menu__content">
                                <div class="mobile-bg js-mobile-bg"></div>
                                <div class="menu js-navList">
                                    <ul class="menu__nav menu__nav-bo text-dark-1 fw-500 -is-active">

                                        <li>
                                            <a href="Dashboard-booking.php" class="d-flex items-center text-15 lh-1 fw-500">
                                                <div class="sidarbarnav">
                                                    <img src="img/dashboard/sidebar/booking.svg" alt="image" class="mr-15">
                                                    <div>
                                                        <p>Réservations</p>
                                                        <p class="sub-title">Gérez et visualisez vos réservations</p>
                                                    </div>
                                                    <div class="arrow-right">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="Dashboard-transactions.php" class="d-flex items-center text-15 lh-1 fw-500">
                                                <div class="sidarbarnav">
                                                    <img src="img/dashboard/sidebar/transactions.svg" alt="image" class="mr-15">
                                                    <div>
                                                        <p>Liste des Transactions</p>
                                                        <p class="sub-title">Gérez et visualisez vos Deposits</p>
                                                    </div>
                                                    <div class="arrow-right">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="Dashboard-Settings.php" class="d-flex items-center text-15 lh-1 fw-500">
                                                <div class="sidarbarnav">
                                                    <img src="img/dashboard/sidebar/gear.svg" alt="image" class="mr-15">
                                                    <div>
                                                        <p>Paramètre</p>
                                                        <p class="sub-title">Modifier les paramètres de votre compte
                                                        </p>
                                                    </div>
                                                    <div class="arrow-right">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="logout.php" class="d-flex items-center text-15 lh-1 fw-500">
                                            <div class="sidarbarnav">
                                                <img src="img/dashboard/sidebar/log-out.svg" alt="image" class="mr-15">
                                              <p>  Déconnexion</p>
                                            </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>



                                <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                                </div>
                            </div>
                        </div>


                        <div class="row items-center x-gap-5 y-gap-20 pl-20 lg:d-none">
                            <div class="col-auto">
                                <p style="color:white">Welcome <?php echo $_SESSION['USER']['firstname'] . ' ' . $_SESSION['USER']['lastname'] ?></p>
                            </div>

                        </div>

                        <div class="pl-15">
                            <img src="img/avatars/user.png" alt="image" class="size-50 rounded-22 object-cover">
                        </div>

                        <div class="d-none xl:d-flex x-gap-20 items-center pl-20" data-x="header-mobile-icons" data-x-toggle="text-white">
                            <div><button class="d-flex items-center icon-menu text-20" data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>