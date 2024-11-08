<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?> </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('img/konfigurasi/icon/' . $konfigurasi['icon']) ?>" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/assets/front/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/assets/front/assets/css/style.css" rel="stylesheet">
    <!-- =======================================================
  * Template Name: Mentor - v2.2.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto"><a href="<?= base_url() ?>"><?= $konfigurasi['nama_web'] ?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="<?= base_url() ?>/assets/front/assets/img/logo.png" alt="" class="img-fluid"></a> -->
            <?= $this->renderSection('navbar') ?>

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
            <h1><?= $konfigurasi['nama_web'] ?></h1>
            <h2><?= $konfigurasi['deskripsi'] ?> </h2>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <?= $this->renderSection('isi') ?>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3><?= $konfigurasi['nama_web'] ?></h3>
                        <p>
                            <?= $konfigurasi['alamat'] ?><br>
                            <strong>Phone:</strong> <?= $konfigurasi['whatsapp'] ?><br>
                            <strong>Email:</strong> <?= $konfigurasi['email'] ?><br>
                        </p>
                    </div>


                    <div class="col-lg-3 col-md-6 footer-links">
                       
                    </div>

                    <div class="col-lg-6 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Sistem informasi Manajemen TPQ Jami Darussa'adah memudahkan anda dalam mencari informasi seputar Kegiatan TPQ Jami Darussa'adah</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="mr-md-auto text-center text-md-left">
                <div class="copyright">
                    &copy;<strong><span><?= $konfigurasi['nama_web'] ?></span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="https://mycoding.net/">Diyah_ayu</a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/assets/front/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/counterup/counterup.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/js/chart.js"></script>
    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/assets/front/assets/js/main.js"></script>
    <script>
        function numberOnly(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
    </script>

</body>

</html>