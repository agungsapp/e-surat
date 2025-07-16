<div>
		<!-- Page Title -->
		<div class="page-title" data-aos="fade">
				<div class="heading">
						<div class="container">
								<div class="row d-flex justify-content-center text-center">
										<div class="col-lg-8">
												<h1>Pengajuan Surat - {{ $surat->nama }}</h1>
												<p class="mb-0">Isi formulir di bawah ini untuk mengajukan surat {{ $surat->nama }}. Pastikan NIK sesuai
														dengan data di database penduduk.</p>
										</div>
								</div>
						</div>
				</div>
				<nav class="breadcrumbs">
						<div class="container">
								<ol>
										<li><a href="{{ route('pelayanan-surat') }}">Home</a></li>
										<li class="current">Pengajuan Surat</li>
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

						<!-- Formulir Dinamis -->
						<div class="row gy-4">
								<div class="col-12 my-5">
										<form wire:submit.prevent="submit" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
												<div class="row gy-4">
														@if ($surat->kode === 'SKTM')
																<h4>Data Pemohon</h4>
																<div class="col-md-6">
																		<label class="form-label">NIK Pemohon</label>
																		<input type="text" class="form-control"
																				value="{{ Auth::guard('penduduk')->check() ? Auth::guard('penduduk')->user()->nik : '' }}" readonly
																				required>
																		@error('formData.NIKPemohon')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<h4>Data Anak</h4>
																<div class="col-md-6">
																		<label class="form-label">NIK Anak</label>
																		<input type="text" wire:model="formData.NIKAnak" class="form-control"
																				placeholder="Masukkan NIK anak" required>
																		@error('formData.NIKAnak')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Penghasilan</label>
																		<input type="number" wire:model="formData.Penghasilan" class="form-control"
																				placeholder="Masukkan penghasilan (angka)" required step="0.01" min="0">
																		@error('formData.Penghasilan')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
														@elseif ($surat->kode === 'SKL')
																<h4>Data Pemohon</h4>
																<div class="col-md-6">
																		<label class="form-label">NIK Pemohon</label>
																		<input type="text" class="form-control"
																				value="{{ Auth::guard('penduduk')->check() ? Auth::guard('penduduk')->user()->nik : '' }}" readonly
																				required>
																		@error('formData.NIKPemohon')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<h4>Data Anak</h4>
																<div class="col-md-6">
																		<label class="form-label">NIK Anak</label>
																		<input type="text" wire:model="formData.NIKAnak" class="form-control"
																				placeholder="Masukkan NIK anak" required>
																		@error('formData.NIKAnak')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<h4>Data Orang Tua</h4>
																<div class="col-md-6">
																		<label class="form-label">NIK Ayah</label>
																		<input type="text" wire:model="formData.NIKAyah" class="form-control"
																				placeholder="Masukkan NIK ayah" required>
																		@error('formData.NIKAyah')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">NIK Ibu</label>
																		<input type="text" wire:model="formData.NIKIbu" class="form-control" placeholder="Masukkan NIK ibu"
																				required>
																		@error('formData.NIKIbu')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
														@else
																@foreach ($fields as $key => $value)
																		@if (is_array($value))
																				<h4>{{ ucwords(str_replace('_', ' ', $key)) }}</h4>
																				@foreach ($value as $subKey => $subValue)
																						<div class="col-md-6">
																								<label
																										class="form-label">{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $subKey)) }}</label>
																								<input
																										type="{{ stripos($subKey, 'Penghasilan') !== false ? 'number' : (stripos(strtolower($subKey), 'tanggal') !== false ? 'date' : 'text') }}"
																										wire:model="formData.{{ $key }}.{{ $subKey }}" class="form-control"
																										placeholder="{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $subKey)) }}"
																										@if (stripos($subKey, 'Penghasilan') !== false) required step="0.01" min="0" @endif>
																								@error("formData.{$key}.{$subKey}")
																										<span class="text-danger">{{ $message }}</span>
																								@enderror
																						</div>
																				@endforeach
																		@elseif (is_string($value))
																				<div class="col-md-6">
																						<label
																								class="form-label">{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $value)) }}</label>
																						<input
																								type="{{ stripos($value, 'Penghasilan') !== false ? 'number' : (stripos(strtolower($value), 'tanggal') !== false ? 'date' : 'text') }}"
																								wire:model="formData.{{ $value }}" class="form-control"
																								placeholder="{{ ucwords(preg_replace_callback('/([A-Z])/', fn($matches) => ' ' . strtolower($matches[1]), $value)) }}"
																								@if (stripos($value, 'Penghasilan') !== false) required step="0.01" min="0" @endif>
																						@error("formData.{$value}")
																								<span class="text-danger">{{ $message }}</span>
																						@enderror
																				</div>
																		@endif
																@endforeach
														@endif

														<div class="col-md-6">
																<label class="form-label">Nomor WhatsApp</label>
																<input type="text" wire:model="whatsapp_number" class="form-control"
																		placeholder="Masukkan nomor WhatsApp (opsional)">
																@error('whatsapp_number')
																		<span class="text-danger">{{ $message }}</span>
																@enderror
														</div>

														<div class="col-md-12 text-center">
																<button type="submit" class="btn btn-primary">Ajukan Surat</button>
														</div>
												</div>
										</form>
								</div>
						</div>
				</div>
		</section><!-- /Contact Section -->
</div>
