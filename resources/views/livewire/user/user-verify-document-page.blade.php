<div>
		<div class="container py-5">
				<div class="row">
						<div class="col-12">
								<h2 class="text-success fw-bold mb-4 text-center">Verifikasi Dokumen Resmi</h2>
								<div class="card mt-4 border-0 shadow-lg" style="background-color: #f8f9fa;">
										<div class="card-body p-4">
												<h4 class="text-dark mb-3 text-center" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
														Pengesahan Resmi Dokumen
												</h4>
												<p class="text-muted lead text-center" style="font-style: italic;">
														Dengan nama Tuhan Yang Maha Esa, dokumen dengan barcode ini telah melalui proses verifikasi
														dan dinyatakan sah. Surat ini resmi dikeluarkan dan ditandatangani oleh Bapak Kepala Desa
														Juku Batu, Kabupaten Way Kanan, sebagai bukti keabsahan dokumen sesuai dengan data yang
														terdaftar. Harap menyimpan dokumen ini dengan penuh kehormatan dan kehati-hatian.
												</p>
												<hr class="my-4" style="border-top: 2px solid #5FCF80;">
												<div class="text-center">
														<p class="mb-1"><strong class="text-dark">Nomor Surat:</strong> <span
																		class="text-success">{{ $permohonan->nomor_surat }}</span></p>
														<p class="mb-1"><strong class="text-dark">Status:</strong> <span
																		class="badge bg-success text-white">{{ ucfirst($permohonan->status) }}</span></p>
														<p class="mb-4"><strong class="text-dark">Tanggal Dibuat:</strong> <span
																		class="text-success">{{ $permohonan->created_at->translatedFormat('d F Y') }}</span></p>
												</div>
												<div class="mt-4 text-center">
														<a href="#" wire:click.prevent="download({{ $permohonan->id }})"
																class="btn btn-sm btn-success btn-lg">
																<i class="fas fa-download"></i> Unduh Dokumen Resmi
														</a>
												</div>
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
								background-color: #5FCF80;
								border-color: #5FCF80;
								transition: all 0.3s ease;
						}

						.btn-success:hover {
								background-color: #5FCF80;
								border-color: #5FCF80;
								transform: translateY(-2px);
						}

						.badge {
								font-size: 1rem;
								padding: 0.5rem 1rem;
						}
				</style>
		@endpush
</div>
