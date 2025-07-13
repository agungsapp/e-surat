<div>
		<div class="container py-5">
				<div class="row">
						<div class="col-12">
								<h2 class="text-success fw-bold mb-4 text-center">Cek Status Dokumen Resmi</h2>
								<div class="card mt-4 border-0 shadow-lg" style="background-color: #f8f9fa;">
										<div class="card-body p-4">
												<h4 class="text-dark mb-3 text-center" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
														Pengecekan Status Dokumen
												</h4>
												<p class="text-muted lead text-center" style="font-style: italic;">
														Masukkan nomor surat untuk memverifikasi status dokumen Anda. Proses ini dilakukan
														dengan penuh kehati-hatian oleh Pemerintah Desa Juku Batu, Way Kanan, untuk
														memastikan keabsahan data yang terdaftar.
												</p>
												<hr class="my-4" style="border-top: 2px solid #28a745;">
												<div class="mb-4 text-center">
														<div class="input-group w-50 mx-auto">
																<input type="text" wire:model.live="nomorSurat" class="form-control form-control-lg text-center"
																		placeholder="Masukkan Nomor Surat" style="border-color: #28a745;">
																<button wire:click="cekStatus" class="btn btn-success btn-lg">
																		<i class="fas fa-search"></i> Cek Status
																</button>
														</div>
												</div>

												@if ($message)
														<div class="mt-4 text-center">
																<div
																		class="alert {{ $status === 'approved' ? 'alert-success' : ($status === 'rejected' ? 'alert-danger' : 'alert-warning') }} w-75 mx-auto">
																		{{ $message }}
																		@if ($status)
																				<p class="mb-0"><strong>Status:</strong> <span
																								class="badge {{ $status === 'approved' ? 'bg-success' : ($status === 'rejected' ? 'bg-danger' : 'bg-warning') }} text-white">{{ ucfirst($status) }}</span>
																				</p>
																		@endif
																</div>
														</div>
												@endif
										</div>
								</div>
						</div>
				</div>
		</div>

		@push('css')
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
				<style>
						body {
								background-color: #e9ecef;
						}

						.card {
								border-radius: 15px;
								box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
						}

						.card-body {
								background: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"%3E%3Cpath fill="%23f8f9fa" fill-opacity="0.8" d="M0,64L48,80C96,96,192,128,288,128C384,128,480,96,576,85.3C672,75,768,85,864,106.7C960,128,1056,160,1152,165.3C1248,171,1344,149,1392,138.7L1440,128V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"%3E%3C/path%3E%3C/svg%3E');
								background-size: cover;
								background-position: center;
						}

						.btn-success {
								background-color: #28a745;
								border-color: #28a745;
								transition: all 0.3s ease;
						}

						.btn-success:hover {
								background-color: #218838;
								border-color: #218838;
								transform: translateY(-2px);
						}

						.input-group .form-control:focus {
								border-color: #28a745;
								box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
						}

						.alert {
								border-radius: 10px;
						}
				</style>
		@endpush
</div>
