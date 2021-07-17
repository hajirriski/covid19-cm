<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Covid-19 Checker Management System</title>

    <?= link_tag('vendor/bootstrap/css/bootstrap.min.css'); ?>
    <?= link_tag('assets/css/fontawesome.css'); ?>
    <?= link_tag('assets/css/templatemo-grad-school.css'); ?>
    <?= link_tag('assets/css/owl.css'); ?>
    <?= link_tag('assets/css/lightbox.css'); ?>

</head>

<body>
    <header class="main-header clearfix" role="header">
        <div class="logo">
            <a href="#"><em>Covid 19</em> CMS</a>
        </div>
        <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <li><a href="#section1">HOME</a></li>
                <li><a href="#section2">Covid-19</a></li>
                <li ><a href="<?= base_url(); ?>user/index" class="external">Checker</a></li>
                <!-- <li><a href="#section5">Video</a></li> -->
                <li><a href="<?= base_url(); ?>user/livetest" class="external">Live Updates</a></li>
                <li><a href="<?= base_url(); ?>admin/index" class="external">Admin</a></li>
            </ul>
        </nav>
    </header>

    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Checking Management System</h6>
                <h2><em>Covid 19</em> CMS</h2>
                <div class="main-button">
                    <div class="scroll-to-section"><a href="#section2">TENTANG</a></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section why-us" data-section="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>COVID-19</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id='tabs'>
                        <ul>
                            <li><a href='#tabs-1'>Covid-19</a></li>
                            <li><a href='#tabs-2'>Gejala Covid-19</a></li>
                            <li><a href='#tabs-3'>Pencegahan</a></li>
                        </ul>
                        <section class='tabs-content'>
                            <article id='tabs-1'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/gb1.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Covid-19</h4>
                                        <p>Penyakit coronavirus (COVID-19) adalah penyakit menular yang disebabkan oleh coronavirus yang baru ditemukan. Kebanyakan orang yang terinfeksi COVID-19, virus akan mengalami penyakit ringan hingga sedang, penyakit pernapasan & sembuh tanpa memerlukan perawatan khusus. Orang tua dan mereka yang memiliki masalah medis mendasar seperti penyakit kardiovaskular.</p>
                                    </div>
                                </div>
                            </article>
                            <article id='tabs-2'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/gb2.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Gejala Covid-19</h4>
                                        <p><strong>Demam Tinggi 2-14 hari !</strong></p>
                                        <p>Penyakit yang dilaporkan berkisar dari gejala ringan hingga penyakit parah dan kematian</p>
                                        <p><strong>Batuk Kering 2-14 hari !</strong></p>
                                        <p>Penyakit yang dilaporkan berkisar dari gejala ringan hingga penyakit parah dan kematian</p>
                                        <p><strong>Sesak napas !</strong></p>
                                        <p>Penyakit yang dilaporkan berkisar dari gejala ringan hingga penyakit parah dan kematian</p>
                                    </div>
                                </div>
                            </article>
                            <article id='tabs-3'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/gb3.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Pencegahan</h4>
                                        <p><a>- Sering cuci tangan</a></p>
                                        <p><a>- Pakailah Masker</a></p>
                                        <p><a>- Hindari kontak dengan orang sakit</a></p>
                                        <p><a>- Selalu tutupi batuk atau bersin Anda</a></p>
                                    </div>
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Copyright 2021 by Hajir Rizky Nugroho</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }

        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function(e) {
            if ($(e.target).hasClass('external')) {
                return;
            }
            e.preventDefault();
            $('#menu').removeClass('active');
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>

</body>

</html>