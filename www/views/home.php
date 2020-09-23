<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Greg Zorb <websitegdp@gmail.com>">
    <title>Book Cafe</title>

    <link rel="stylesheet" href="landing/css/linearicons.css">
    <link rel="stylesheet" href="landing/css/owl.carousel.css">
    <link rel="stylesheet" href="landing/css/font-awesome.min.css">
    <link rel="stylesheet" href="landing/css/nice-select.css">
    <link rel="stylesheet" href="landing/css/magnific-popup.css">
    <link rel="stylesheet" href="landing/css/bootstrap.css">
    <link rel="stylesheet" href="landing/css/main.css">
</head>

<body>

    <header id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="/"><img src="landing/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="/">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#fact">Fact</a></li>
                        <li><a href="#price">Price</a></li>

                        <?php if (!$isRegistered) : ?>
                            <li><a href="/login">Sign In</a></li>
                        <?php endif; ?>

                        <?php if ($isRegistered) : ?>
                            <li class="menu-has-children"><a href=""><?= $user['login'] ?? '' ?></a>
                                <ul>
                                    <li><a href="/library">Library</a></li>
                                    <li><a href="/logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->


    <!-- start banner Area -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-start">
                <div class="banner-content col-lg-7">
                    <h5 class="text-white text-uppercase">Store your own library</h5>
                    <h1 class="text-uppercase">
                        Book Cafe
                    </h1>
                    <p class="text-white pt-20 pb-20">

                    </p>
                    <a href="/login" class="primary-btn text-uppercase">For FREE</a>
                </div>
                <div class="col-lg-5 banner-right">
                    <img class="img-fluid" src="landing/img/header-img.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start about Area -->
    <section class="section-gap info-area" id="about">
        <div class="container">
            <div class="single-info row mt-40 align-items-center">
                <div class="col-lg-6 col-md-12 text-center no-padding info-left">
                    <div class="info-thumb">
                        <img src="landing/img/about-img.jpg" class="img-fluid info-img" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 no-padding info-rigth">
                    <div class="info-content">
                        <h2 class="pb-30">Book Cafe</h2>
                        <p>
                            Best online Book Cafe ever
                        </p>
                        <br>
                        <img src="landing/img/signature.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End about Area -->

    <!-- Start fact Area -->
    <section class="fact-area relative section-gap" id="fact">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-40 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Some Features that Made us Unique</h1>
                        <p>Who are in extremely love with our Book Cafe.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End fact Area -->

    <!-- Start counter Area -->
    <section class="counter-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">2536</h1>
                        <p>Happy Users</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">6784</h1>
                        <p>Hours Reading</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">1059</h1>
                        <p>Total Libraries</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <h1 class="counter">12239</h1>
                        <p>Total Books</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end counter Area -->

    <!-- Start price Area -->
    <section class="price-area section-gap" id="price">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">FREE for ever</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="single-price no-padding">
                        <div class="price-top">
                            <h4>On-Line</h4>
                        </div>
                        <p>
                            Uplaod book and read it
                        </p>
                        <div class="price-bottom">
                            <h1>FREE</h1>
                            <a href="/login" class="primary-btn header-btn">Try Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End price Area -->


    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            &nbsp;We are the best
                        </p>
                        <p class="footer-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h6>Follow Me</h6>
                        <div class="footer-social d-flex align-items-center">
                            <a href="https://www.facebook.com/perevyshko" target="_blank"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->


    <script src="landing/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="landing/js/vendor/bootstrap.min.js"></script>
    <script src="landing/js/easing.min.js"></script>
    <script src="landing/js/hoverIntent.js"></script>
    <script src="landing/js/superfish.min.js"></script>
    <script src="landing/js/jquery.ajaxchimp.min.js"></script>
    <script src="landing/js/jquery.magnific-popup.min.js"></script>
    <script src="landing/js/owl.carousel.min.js"></script>
    <script src="landing/js/jquery.sticky.js"></script>
    <script src="landing/js/jquery.nice-select.min.js"></script>
    <script src="landing/js/parallax.min.js"></script>
    <script src="landing/js/waypoints.min.js"></script>
    <script src="landing/js/jquery.counterup.min.js"></script>
    <script src="landing/js/mail-script.js"></script>
    <script src="landing/js/main.js"></script>

</body>