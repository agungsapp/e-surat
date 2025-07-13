<div>
		<section id="hero" class="hero section dark-background">

				<img src="{{ asset('user') }}/img/desa-hero.png" alt="" data-aos="fade-in">

				<div class="container">
						<h2 data-aos="fade-up" data-aos-delay="100">Selamat Datang, <br>Di Desa Juku Batu</h2>
						<p data-aos="fade-up" data-aos-delay="200">Pelayanan Surat Online
						</p>
						<div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
								<a href="{{ route('pelayanan-surat') }}" class="btn-get-started">Mulai</a>
						</div>
				</div>

		</section>

		<!-- About Section -->
		<section id="about" class="about section">
				<div class="container">
						<div class="row gy-4">
								<div class="col-lg-6 order-lg-2 order-1" data-aos="fade-up" data-aos-delay="100">
										<img src="{{ asset('surat') }}/image/balai.webp" class="img-fluid" alt="Layanan Surat Desa Juku Batu">
								</div>
								<div class="col-lg-6 order-lg-1 content order-2" data-aos="fade-up" data-aos-delay="200">
										<h3>Tentang Layanan Surat Online</h3>
										<p class="fst-italic">
												Layanan surat online Desa Juku Batu hadir untuk mempermudah warga dalam mengurus dokumen resmi dengan proses
												yang cepat dan aman.
										</p>
										<ul>
												<li><i class="bi bi-check-circle"></i> <span>Pengajuan surat kapan saja, 24/7.</span></li>
												<li><i class="bi bi-check-circle"></i> <span>Status permohonan terpantau secara real-time.</span></li>
												<li><i class="bi bi-check-circle"></i> <span>Dukungan langsung dari tim desa.</span></li>
										</ul>
										<a href="{{ route('panduan') }}" class="read-more"><span>Pelajari Cara Penggunaan</span><i
														class="bi bi-arrow-right"></i></a>
								</div>
						</div>
				</div>
		</section><!-- /About Section -->



		<!-- Counts Section -->
		<section id="counts" class="section counts light-background">

				<div class="container" data-aos="fade-up" data-aos-delay="100">

						<div class="row gy-4">

								<div class="col-lg-4 col-md-6">
										<div class="stats-item w-100 h-100 text-center">
												<span data-purecounter-start="0" data-purecounter-end="{{ $count['pending'] }}"
														data-purecounter-duration="1" class="purecounter"></span>
												<p>Pending</p>
										</div>
								</div><!-- End Stats Item -->

								<div class="col-lg-4 col-md-6">
										<div class="stats-item w-100 h-100 text-center">
												<span data-purecounter-start="0" data-purecounter-end="{{ $count['rejected'] }}"
														data-purecounter-duration="1" class="purecounter"></span>
												<p>Rejected</p>
										</div>
								</div><!-- End Stats Item -->

								<div class="col-lg-4 col-md-6">
										<div class="stats-item w-100 h-100 text-center">
												<span data-purecounter-start="0" data-purecounter-end="{{ $count['approved'] }}"
														data-purecounter-duration="1" class="purecounter"></span>
												<p>Aproved</p>
										</div>
								</div><!-- End Stats Item -->



						</div>

				</div>

		</section><!-- /Counts Section -->


		@if (!empty($banners))
				<section class="section why-us">
						<div class="container">
								<div class="row gy-4">
										<div class="col-12">
												<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
														<div class="carousel-inner">


																@foreach ($banners as $key => $banner)
																		<div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
																				<img src="{{ Storage::url($banner->path) }}" class="d-block w-100" alt="{{ $banner->path }}">
																		</div>
																@endforeach

														</div>
														<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
																data-bs-slide="prev">
																<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																<span class="visually-hidden">Previous</span>
														</button>
														<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
																data-bs-slide="next">
																<span class="carousel-control-next-icon" aria-hidden="true"></span>
																<span class="visually-hidden">Next</span>
														</button>
												</div>
										</div>
								</div>
						</div>
				</section>
		@endif



		<!-- Why Us Section -->
		<section id="why-us" class="section why-us">
				<div class="container">
						<div class="row gy-4">
								<div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
										<div class="why-box">
												<h3>Manfaat Layanan Surat untuk Warga</h3>
												<p>
														Layanan surat online Desa Juku Batu dirancang untuk mendukung warga dengan proses yang mudah, cepat, dan
														terjangkau.
												</p>
												<div class="text-center">
														<a href="{{ route('panduan') }}" class="more-btn"><span>Panduan Penggunaan</span> <i
																		class="bi bi-chevron-right"></i></a>
												</div>
										</div>
								</div><!-- End Why Box -->
								<div class="col-lg-8 d-flex align-items-stretch">
										<div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
												<div class="col-xl-4">
														<div class="icon-box d-flex flex-column justify-content-center align-items-center">
																<i class="bi bi-people" style="color: #28a745;"></i>
																<h4>Dukungan Warga</h4>
																<p>Layanan ini dibuat untuk memenuhi kebutuhan komunitas desa.</p>
														</div>
												</div><!-- End Icon Box -->
												<div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
														<div class="icon-box d-flex flex-column justify-content-center align-items-center">
																<i class="bi bi-clock" style="color: #28a745;"></i>
																<h4>Akses Mudah</h4>
																<p>Tersedia 24/7 untuk kenyamanan warga.</p>
														</div>
												</div><!-- End Icon Box -->
												<div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
														<div class="icon-box d-flex flex-column justify-content-center align-items-center">
																<i class="bi bi-shield" style="color: #28a745;"></i>
																<h4>Keamanan Data</h4>
																<p>Informasi warga dijaga dengan sistem yang aman.</p>
														</div>
												</div><!-- End Icon Box -->
										</div>
								</div>
						</div>
				</div>
		</section><!-- /Why Us Section -->




		<!-- Features Section -->
		<section id="features" class="features section">
				<div class="container">
						<h2 class="mb-4 text-center" data-aos="fade-up" data-aos-delay="100">Lokasi Kantor Kelurahan</h2>
						<div class="row" data-aos="fade-up" data-aos-delay="200">
								<div class="col-12">
										<div class="map-container">
												<iframe
														src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31804.261891629947!2d104.42693880634981!3d-4.8499776380354405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3883178b456217%3A0xec37e25da2ddd43f!2sJuku%20Batu%2C%20Kec.%20Banjit%2C%20Kabupaten%20Way%20Kanan%2C%20Lampung!5e0!3m2!1sid!2sid!4v1750169119068!5m2!1sid!2sid"
														width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
														referrerpolicy="no-referrer-when-downgrade"></iframe>
										</div>
								</div>
						</div>
						<div class="row mt-4" data-aos="fade-up" data-aos-delay="300">
								<div class="col-12 text-center">
										<h4>Jam Kerja Kantor Kelurahan</h4>
										<p>
												Kantor kelurahan Desa Juku Batu melayani warga pada:<br>
												- Senin-Kamis: 07:30 - 16:00 WIB<br>
												- Jumat: 07:30 - 11:30 WIB & 13:00 - 16:00 WIB<br>
												- Sabtu, Minggu, dan Hari Libur: Tutup<br><br>
												Pengajuan surat akan diproses pada hari kerja dalam jam operasional tersebut, tergantung antrean dan
												kelengkapan dokumen. Ajukan lebih awal untuk proses yang lebih cepat!
										</p>
								</div>
						</div>
				</div>
		</section><!-- /Features Section -->


</div>
