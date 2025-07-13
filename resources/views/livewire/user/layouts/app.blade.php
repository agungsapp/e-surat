<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title>Desa Juku Batu</title>
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Favicons -->
		<link href="{{ asset('user') }}/img/favicon.png" rel="icon">
		<link href="{{ asset('user') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com" rel="preconnect">
		<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
		<link
				href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
				rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="{{ asset('user') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ asset('user') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="{{ asset('user') }}/vendor/aos/aos.css" rel="stylesheet">
		<link href="{{ asset('user') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="{{ asset('user') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

		<!-- Main CSS File -->
		<link href="{{ asset('user') }}/css/main.css" rel="stylesheet">

		<!-- =======================================================
		* Template Name: Mentor
		* Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
		* Updated: Aug 07 2024 with Bootstrap v5.3.3
		* Author: BootstrapMade.com
		* License: https://bootstrapmade.com/license/
		======================================================== -->
</head>

<body class="index-page">

		<header id="header" class="header d-flex align-items-center sticky-top">
				<div class="container-fluid container-xl position-relative d-flex align-items-center">

						<a href="index.html" class="logo d-flex align-items-center me-auto">
								<!-- Uncomment the line below if you also wish to use an image logo -->
								<!-- <img src="{{ asset('user') }}/img/logo.png" alt=""> -->
								<h1 class="sitename">SILANDES</h1>
						</a>

						<nav id="navmenu" class="navmenu">
								<ul>
										<li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Beranda<br></a></li>
										<li><a href="{{ route('tentang') }}" class="{{ Route::is('tentang') ? 'active' : '' }}">Tentang</a></li>
										<li><a href="{{ route('pelayanan-surat') }}"
														class="{{ Route::is('pelayanan-surat') ? 'active' : '' }}">Pelayanan
														Surat</a></li>
										<li><a href="{{ route('cek-status') }}"
														class="{{ Route::is(['cek-status', 'verify-document']) ? 'active' : '' }}">Cek Status</a>
										</li>
										<li><a href="{{ route('panduan') }}" class="{{ Route::is('panduan') ? 'active' : '' }}">Panduan</a></li>
										<li><a href="{{ route('kontak') }}" class="{{ Route::is('kontak') ? 'active' : '' }}">Kontak</a></li>



								</ul>
								<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
						</nav>

						@if (Auth::guard('penduduk')->check())
								<form action="{{ route('logout') }}" method="POST" style="display:inline;">
										@csrf
										<button type="submit" class="btn-getstarted">Logout</button>
								</form>
						@else
								<a class="btn-getstarted" href="/login">Login</a>
						@endif

						{{-- <a class="btn-getstarted" href="courses.html">Get Started</a>k --}}

				</div>
		</header>

		<main class="main">

				{{ $slot }}



		</main>



		<footer id="footer" class="footer position-relative light-background">
				<div class="footer-top container">
						<div class="row gy-4">
								<div class="col-lg-4 col-md-6 footer-about">
										<a href="{{ route('home') }}" class="logo d-flex align-items-center">
												<span class="sitename">Desa Juku Batu</span>
										</a>
										<div class="footer-contact pt-3">
												<p>Juku Batu, Kec. Banjit</p>
												<p>Kabupaten Way Kanan, Lampung</p>
												<p class="mt-3"><strong>Phone:</strong> <span>0822-7862-7083</span></p>
												<p><strong>Email:</strong> <span>jukubatukampung@gmail.com</span></p>
										</div>

								</div>

								<div class="col-lg-3 col-md-3 footer-links">
										<h4>Informasi Penting</h4>
										<ul>
												<li><a href="{{ route('home') }}">Beranda</a></li>
												<li><a href="{{ route('tentang') }}">Tentang</a></li>
												<li><a href="{{ route('panduan') }}">Panduan</a></li>
												<li><a href="{{ route('kontak') }}">Kontak</a></li>
										</ul>
								</div>

								<div class="col-lg-3 col-md-3 footer-links">
										<h4>Layanan Desa</h4>
										<ul>
												<li><a href="{{ route('pelayanan-surat') }}">Pelayanan Surat</a></li>
												<li><a href="{{ route('cek-status') }}">Cek Status</a></li>
										</ul>
								</div>

								<div class="col-lg-2 col-md-12"></div> <!-- Placeholder untuk menjaga layout -->

						</div>
				</div>

				<div class="copyright container mt-4 text-center">
						<p>© <span>Copyright</span> <strong class="sitename px-1">Desa Juku Batu</strong> <span>, Banjit, Way Kanan
								</span></p>
						<div class="credits d-none">
								Dirancang oleh <a href="https://bootstrapmade.com/">BootstrapMade</a> | Didistribusikan oleh <a
										href="https://themewagon.com">ThemeWagon</a>
						</div>
				</div>
		</footer>

		<!-- Scroll Top -->
		<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
						class="bi bi-arrow-up-short"></i></a>

		<!-- Preloader -->
		<div id="preloader"></div>

		<!-- Vendor JS Files -->
		<script src="{{ asset('user') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="{{ asset('user') }}/vendor/php-email-form/validate.js"></script>
		<script src="{{ asset('user') }}/vendor/aos/aos.js"></script>
		<script src="{{ asset('user') }}/vendor/glightbox/js/glightbox.min.js"></script>
		<script src="{{ asset('user') }}/vendor/purecounter/purecounter_vanilla.js"></script>
		<script src="{{ asset('user') }}/vendor/swiper/swiper-bundle.min.js"></script>

		<!-- Main JS File -->
		<script src="{{ asset('user') }}/js/main.js"></script>

</body>

</html>
