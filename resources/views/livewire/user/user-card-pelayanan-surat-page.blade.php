{{-- <div>


		<!-- Page Title -->
		<div class="page-title" data-aos="fade">
				<div class="heading">
						<div class="container">
								<div class="row d-flex justify-content-center text-center">
										<div class="col-lg-8">
												<h1>Pelayanan Surat Online</h1>
												<p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas
														consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit
														quaerat ipsum dolorem.</p>
										</div>
								</div>
						</div>
				</div>
				<nav class="breadcrumbs">
						<div class="container">
								<ol>
										<li><a href="index.html">Home</a></li>
										<li class="current">Pelayanan Surat</li>
								</ol>
						</div>
				</nav>
		</div> --}}


{{-- Nothing in the world is as soft and yielding as water. --}}


<!-- Courses Section -->
<section id="courses" class="courses section">

		<!-- Section Title -->
		<div class="section-title container" data-aos="fade-up">
				<h2>Pelayanan Surat Online</h2>
				<p>Daftar Surat Tersedia</p>
		</div><!-- End Section Title -->

		<div class="container">

				<div class="row">

						@if (session()->has('message'))
								<div class="alert alert-success">
										{{ session('message') }}
								</div>
						@endif
						@if (session()->has('error'))
								<div class="alert alert-danger">
										{{ session('error') }}
								</div>
						@endif

						@if (Auth::guard('penduduk')->check())
								@forelse ($surats as  $surat)
										<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-5" data-aos="zoom-in" data-aos-delay="100">
												<div class="course-item">
														<img src="{{ asset('surat') }}/image/cover/{{ $surat->id }}.png" class="img-fluid" alt="...">
														<div class="course-content">
																<div class="d-flex justify-content-between align-items-center mb-3">
																		<p class="category">{{ $surat->kode }}</p>
																</div>

																<h3><a href="course-details.html">{{ $surat->nama }}</a></h3>
																<p class="description">{{ $surat->deskripsi }}</p>
																<div class="trainer d-flex justify-content-between align-items-center">
																		<a href="{{ route('pengajuan-surat', $surat->id) }}"
																				class="btn btn-success text-capitalize mx-auto">pengajuan surat</a>
																</div>
														</div>
												</div>
										</div> <!-- End Course Item-->
								@empty
								@endforelse
						@else
								<div class="col-6 mx-auto">

										<div class="alert alert-danger" role="alert">
												<h4 class="alert-heading text-center">Anda Belum Login !</h4>
												<p class="text-center">Silahkan login terlebih dahulu untuk dapat melakukan pengajuan surat.</p>
												<hr>
												<p class="d-flex justify-content-center mb-0">
														<a href="/login" class="btn btn-success btn-sm px-5">Login</a>
												</p>
										</div>

								</div>
						@endif



				</div>

		</div>

</section><!-- /Courses Section -->
{{-- </div> --}}
