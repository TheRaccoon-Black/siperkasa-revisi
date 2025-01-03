<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIPERKASA</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('/img/logo.jpg') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">SIPERKASA <img src="{{ asset('/img/airport.png') }}" alt=""></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#portfolio">Gallery</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- Auth Buttons -->
            @if (Route::has('login'))
                <div class="auth-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="btn-getstarted font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="btn-getstarted font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            Log in
                        </a>
                    @endauth
                </div>
            @endif

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <img src="assets/img/hero-bg-abstract.jpg" alt="" data-aos="fade-in" class="">

            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-out">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1>Sistem Informasi Pengecekan Rutin Kendaraan Operasional ARFF</h1>
                        <p>Aplikasi inovatif untuk mendukung pengecekan kendaraan operasional ARFF secara efektif dan
                            efisien.</p>
                    </div>
                </div>
                <div class="text-center" data-aos="zoom-out" data-aos-delay="100">
                    <a href="#about" class="btn-get-started">Pelajari Lebih Lanjut</a>
                </div>

                <div class="row gy-4 mt-5">
                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-easel"></i></div>
                            <h4 class="title"><a href="">Manajemen Data</a></h4>
                            <p class="description">Sistem yang memastikan data kendaraan selalu terorganisir dengan
                                baik.</p>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-gem"></i></div>
                            <h4 class="title"><a href="">Keandalan</a></h4>
                            <p class="description">Aplikasi yang dirancang untuk beroperasi tanpa gangguan dalam
                                berbagai kondisi.</p>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-pencil"></i></div>
                            <h4 class="title"><a href="">Tanda Tangan Langsung</a></h4>
                            <p class="description">Memungkinkan tanda tangan langsung pada hasil pemeriksaan kendaraan
                                operasional.</p>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-clock"></i></div>
                            <h4 class="title"><a href="">Pelaporan Real-Time</a></h4>
                            <p class="description">Mengirimkan laporan hasil pemeriksaan secara real-time untuk
                                kemudahan monitoring.</p>
                        </div>
                    </div><!--End Icon Box -->

                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang SIPERKASA<br></h2>
                <p>Aplikasi yang didesain untuk memastikan operasional kendaraan ARFF tetap optimal melalui pengecekan
                    rutin.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p>
                            SIPERKASA memberikan solusi bagi pengelolaan kendaraan operasional ARFF dengan fitur-fitur
                            unggulan:
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i> <span>Dashboard manajemen pengecekan kendaraan yang
                                    interaktif.</span></li>
                            <li><i class="bi bi-pencil"></i> <span>Link untuk langsung melakukan tanda tangan pada
                                    hasil pemeriksaan kendaraan operasional.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Pelaporan hasil pengecekan secara
                                    real-time.</span></li>

                        </ul>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <p>Sistem ini membantu meningkatkan efisiensi waktu dan akurasi data, sehingga operasional
                            kendaraan ARFF menjadi lebih terkontrol dan terjamin.</p>
                        <a href="#" class="read-more"><span>Selengkapnya</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $kendaraan }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Kendaraan Terdaftar</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlahPemeriksaan }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Pengecekan Selesai</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $loginLog }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Log Masuk Tercatat</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlahPetugas }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Petugas Terdaftar</p>
                        </div>
                    </div><!-- End Stats Item -->


                </div>

            </div>

        </section><!-- /Stats Section -->




        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>Menyediakan solusi terbaik untuk pengecekan rutin kendaraan operasional ARFF.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <!-- Service Item 1 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <div class="icon">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>
                            <h3>Pengecekan Rutin</h3>
                            <p>Memastikan kondisi kendaraan operasional ARFF selalu dalam performa optimal melalui
                                pemeriksaan terjadwal.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 2 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <div class="icon">
                                <i class="bi bi-card-list"></i>
                            </div>
                            <h3>Manajemen Laporan</h3>
                            <p>Menyimpan data pemeriksaan secara terstruktur dan mudah diakses untuk evaluasi.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 3 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <div class="icon">
                                <i class="bi bi-pencil"></i>
                            </div>
                            <h3>Tanda Tangan Langsung</h3>
                            <p>Link untuk langsung melakukan tanda tangan pada hasil pemeriksaan kendaraan operasional.
                            </p>
                        </div>
                    </div><!-- End Service Item -->


                </div>

            </div>

        </section><!-- /Services Section -->

        <section id="call-to-action" class="call-to-action section accent-background">

            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <h3>Ayo Mulai dengan SIPERKASA</h3>
                            <p>Tingkatkan efisiensi dan akurasi pengecekan kendaraan operasional ARFF Anda dengan
                                SIPERKASA. Buat pengelolaan lebih praktis dan terpercaya!</p>
                            <a class="cta-btn" href="#">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Call To Action Section -->
        <!-- Portfolio Section -->
        <!-- QR Code Section -->
        <section id="qr-code-section" class="section">
            <div class="container">
                <div class="row justify-content-center text-center" data-aos="fade-up">
                    <div class="col-lg-6">
                        <h3>QR Code Login</h3>
                        <p>Scan QR Code berikut untuk masuk ke sistem SIPERKASA.</p>
                        <div class="qr-code mt-4">
                            {!! QrCode::size(200)->generate(url()->route('login')) !!}
                        </div>
                        <a href="{{ route('qrLogin') }}" class="btn btn-primary mt-4">Cetak QR Code</a>
                    </div>
                </div>
            </div>
        </section><!-- /QR Code Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Galeri</h2>
                <p>Beberapa momen pada kendaraan operasional ARFF</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">

                    {{-- <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Card</li>
                        <li data-filter=".filter-branding">Web</li>
                    </ul><!-- End Portfolio Filters --> --}}

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('/img/logo.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Logo injourney</h4>
                                <p>Logo resmi injourney</p>
                                <a href="{{ asset('/img/logo.jpg') }}" title="Logo injourney"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <img src="{{ asset('/img/airport.png') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>AFR logo</h4>
                                <p>logo AFR Fatmawati Soekarno Airport</p>
                                <a href="{{ asset('/img/airport.png') }}" title="AFR logo"
                                    data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <img src="{{ asset('/img/photo1.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Pengecekan</h4>
                                <p>Pengecekan kendaraan operasional</p>
                                <a href="{{ asset('/img/photo1.jpg') }}" title="Pengecekan"
                                    data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <img src="{{ asset('/img/photo2.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Pengecekan 2</h4>
                                <p>Proses pengecekan kendaraan operasional</p>
                                <a href="{{ asset('/img/photo2.jpg') }}" title="Pengecekan 2"
                                    data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('/img/photo2.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Dokumentasi 1</h4>
                                <p>Dokumentasi pengecekan</p>
                                <a href="{{ asset('/img/photo2.jpg') }}" title="Dokumentasi 1"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <img src="{{ asset('/img/photo3.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Proses Checklist</h4>
                                <p>Proses checklist pengecekan kendaraan</p>
                                <a href="{{ asset('/img/photo3.jpg') }}" title="Proses Checklist"
                                    data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <img src="{{ asset('/img/photo4.jpg') }}" class="img-fluid" alt="">
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('/img/photo5.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Pengecekan 3</h4>
                                <p>Pengecekan bersama</p>
                                <a href="{{ asset('/img/photo5.jpg') }}" title="Pengecekan 3"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->


                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->
        <style>
            .team-member .member-img {
                width: 100%;
                height: 400px;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .team-member .member-img img {
                width: auto;
                height: 100%;
                object-fit: cover;
            }
        </style>

        <!-- Team Section -->
        <section id="team" class="team section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tim Kami</h2>
                <p>Tim profesional yang berdedikasi dalam mengembangkan solusi inovatif untuk pengecekan rutin kendaraan
                    operasional ARFF</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    @foreach ($pejabat as $pejabat)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset($pejabat->photo) }}" class="img-fluid" alt="Foto {{ $pejabat->nama }}">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $pejabat->nama }}</h4>
                                    <span>{{ $pejabat->jabatan }}</span>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                    @endforeach
                </div>
            </div>

        </section><!-- /Team Section -->

    </main>

    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">SIPERKASA</span>
                    </a>
                    <p>Sistem Informasi Pengecekan Rutin Kendaraan Operasional ARFF yang mempermudah pengelolaan dan
                        pengawasan dalam operasional harian.</p>
                    <div class="social-links d-flex mt-4">
                        <a href="https://twitter.com"><i class="bi bi-twitter"></i></a>
                        <a href="https://facebook.com"><i class="bi bi-facebook"></i></a>
                        <a href="https://instagram.com"><i class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Tautan Berguna</h4>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Layanan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="#">Sistem Informasi</a></li>
                        <li><a href="#">Manajemen Data</a></li>
                        <li><a href="#">Pelaporan Terintegrasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Hubungi Kami</h4>
                    <p>Jl. Raya Padang Kemiling No. 45</p>
                    <p>Banda Fatmawati, Bengkulu, Indonesia</p>
                    <p><strong>Telepon:</strong> +62 822 6889 6830</p>
                    <p><strong>Email:</strong> siperkasa@example.com</p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Hak Cipta</span> <strong class="px-1 sitename">SIPERKASA</strong> <span>Semua Hak
                    Dilindungi</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
