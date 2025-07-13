<div>
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
		</div><!-- End Page Title -->

		<!-- Contact Section -->
		<section id="contact" class="contact section">
				<h2 class="mb-5 text-center">Form Pengisian Surat</h2>

				<div class="container" data-aos="fade-up" data-aos-delay="100">
						<!-- Notifikasi -->
						@if (session()->has('message'))
								<div class="alert alert-success">
										{{ session('message') }}
								</div>
						@endif

						<!-- Dropdown Jenis Surat -->
						<div class="row d-flex justify-content-end mb-5">
								<div class="col-3">
										<label for="jenisSurat" class="form-label">Jenis Surat</label>
										<select wire:model.live="selectedSuratId" class="form-select" id="jenisSurat">
												<option value="">-- Pilih Jenis Surat --</option>
												@forelse ($surats as $surat)
														<option value="{{ $surat->id }}">{{ $surat->nama }}</option>
												@empty
														<option value="">-- Belum Ada Data Surat --</option>
												@endforelse
										</select>
										@error('selectedSuratId')
												<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
						</div>

						<!-- Formulir Dinamis -->
						@if ($selectedSuratId)
								<div class="row gy-4">
										<div class="col-12">
												<form wire:submit.prevent="submit" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
														<div class="row gy-4">
																@foreach ($fields as $field)
																		<div class="col-md-6">
																				<label class="form-label">{{ $field }}</label>
																				<input type="text" wire:model="formData.{{ $field }}" class="form-control"
																						placeholder="{{ $field }}" required>
																				@error("formData.{$field}")
																						<span class="text-danger">{{ $message }}</span>
																				@enderror
																		</div>
																@endforeach

																<div class="col-md-12 text-center">
																		<button type="submit" class="btn btn-primary">Ajukan Surat</button>
																</div>
														</div>
												</form>
										</div>
								</div>
						@endif
				</div>
		</section><!-- /Contact Section -->
</div>
