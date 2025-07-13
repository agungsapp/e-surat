<div>
		<!-- Page Title -->
		<div class="page-title" data-aos="fade">
				<div class="heading">
						<div class="container">
								<div class="row d-flex justify-content-center text-center">
										<div class="col-lg-8">
												<h1>Edit Permohonan - {{ $permohonan->surat->nama }} (No. {{ $permohonan->nomor_surat }})</h1>
												<p class="mb-0">Ubah data di bawah ini untuk memperbarui permohonan surat {{ $permohonan->surat->nama }}.
												</p>
										</div>
								</div>
						</div>
				</div>
				<nav class="breadcrumbs">
						<div class="container">
								<ol>
										<li><a href="{{ route('pelayanan-surat') }}">Home</a></li>
										<li class="current">Edit Permohonan</li>
								</ol>
						</div>
				</nav>
		</div><!-- End Page Title -->

		<!-- Contact Section -->
		<section id="contact" class="contact section">
				<div class="container" data-aos="fade-up" data-aos-delay="100">
						<!-- Notifikasi -->
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

						<!-- Formulir Dinamis -->
						<div class="row gy-4">
								<div class="col-12 my-5">
										<form wire:submit.prevent="save" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
												<div class="row gy-4">
														@if ($permohonan->surat->kode === 'SKTM')
																<h4>Data Orang Tua</h4>
																@foreach ($formData['OrangTua'] as $key => $value)
																		<div class="col-md-6">
																				<label
																						class="form-label">{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $key)) }}</label>
																				<input type="{{ str_contains(strtolower($key), 'tanggal') ? 'date' : 'text' }}"
																						wire:model="formData.OrangTua.{{ $key }}" class="form-control"
																						placeholder="{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $key)) }}"
																						required>
																				@error("formData.OrangTua.{$key}")
																						<span class="text-danger">{{ $message }}</span>
																		@endif
														</div>
														@endforeach

														<h4>Data Anak</h4>
														@foreach ($formData['Anak'] as $key => $value)
																<div class="col-md-6">
																		<label
																				class="form-label">{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $key)) }}</label>
																		<input type="{{ str_contains(strtolower($key), 'tanggal') ? 'date' : 'text' }}"
																				wire:model="formData.Anak.{{ $key }}" class="form-control"
																				placeholder="{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $key)) }}"
																				required>
																		@error("formData.Anak.{$key}")
																				<span class="text-danger">{{ $message }}</span>
																@endif
												</div>
												@endforeach

												<div class="col-md-6">
														<label class="form-label">Penghasilan</label>
														<input type="text" wire:model="formData.Penghasilan" class="form-control" placeholder="Penghasilan"
																required>
														@error('formData.Penghasilan')
																<span class="text-danger">{{ $message }}</span>
																@endif
														</div>

														<div class="col-md-6">
																<label class="form-label">Tanggal Penerbitan</label>
																<input type="date" wire:model="formData.TanggalPenerbitan" class="form-control" required>
																@error('formData.TanggalPenerbitan')
																		<span class="text-danger">{{ $message }}</span>
																		@endif
																@else
																		@foreach ($formData as $key => $value)
																				<div class="col-md-6">
																						<label
																								class="form-label">{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $key)) }}</label>
																						<input type="{{ str_contains(strtolower($key), 'tanggal') ? 'date' : 'text' }}"
																								wire:model="formData.{{ $key }}" class="form-control"
																								placeholder="{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $key)) }}"
																								required>
																						@error("formData.{$key}")
																								<span class="text-danger">{{ $message }}</span>
																				@endif
																		</div>
																		@endforeach
																		@endif

																		<div class="col-md-12 text-center">
																				<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
																				<a href="{{ route('pelayanan-surat') }}" class="btn btn-secondary">Batal</a>
																		</div>
																</div>
																</form>
														</div>
										</div>
										</div>
										</section><!-- /Contact Section -->
										</div>
