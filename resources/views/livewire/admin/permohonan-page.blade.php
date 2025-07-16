<div>
		<div class="row">
				<div class="col-12">
						<h2>Data Permohonan</h2>
				</div>
				<div class="col-12">
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
						<!-- Filter Section -->
						<div class="card mb-4">
								<div class="card-body">
										<div class="row g-3">
												<div class="col-md-4">
														<label class="form-label">Filter Status</label>
														<select wire:model.live="statusFilter" class="form-control">
																<option value="">Semua Status</option>
																<option value="pending">Pending</option>
																<option value="revision">Revision</option>
																<option value="approved">Approved</option>
																<option value="rejected">Rejected</option>
														</select>
												</div>
												<div class="col-md-4">
														<label class="form-label">Filter Tanggal</label>
														<input type="date" wire:model.live="dateFilter" class="form-control">
												</div>
										</div>
								</div>
						</div>
						<div class="card">
								<div class="card-body">
										<table id="data" class="table">
												<thead>
														<tr>
																<th scope="col">#</th>
																<th scope="col">Nomor</th>
																<th scope="col">Whatsapp</th>
																<th scope="col">Surat</th>
																<th scope="col">Data</th>
																<th scope="col">Status</th>
																<th scope="col">Dibuat</th>
																<th scope="col">Aksi</th>
														</tr>
												</thead>
												<tbody>
														@forelse ($permohonans as $index => $permohonan)
																<tr>
																		<th scope="row">{{ $index + 1 }}</th>
																		<td>{{ $permohonan->nomor_surat }}</td>
																		<td>{{ $permohonan->whatsapp_number }}</td>
																		<td>{{ $permohonan->surat->nama }}</td>
																		<td>
																				<table class="table-sm table">
																						{{-- @if ($permohonan->surat->kode === 'SKTM')
																								<!-- Untuk SKTM, tampilkan data nested -->
																								<tr>
																										<th colspan="2"><strong>Data Orang Tua</strong></th>
																								</tr>
																								@foreach ($permohonan->data['OrangTua'] as $key => $value)
																										<tr>
																												<td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
																												<td>{{ $value }}</td>
																										</tr>
																								@endforeach
																								<tr>
																										<th colspan="2"><strong>Data Anak</strong></th>
																								</tr>
																								@foreach ($permohonan->data['Anak'] as $key => $value)
																										<tr>
																												<td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
																												<td>{{ $key === 'AlamatKTP' ? $value : $value }}</td>
																										</tr>
																								@endforeach
																								<tr>
																										<td>Penghasilan</td>
																										<td>
																												@php
																														$penghasilan = $permohonan->data['Penghasilan'] ?? 'Tidak ada data';
																														$isNumeric = is_numeric(str_replace(['Rp', '.', ','], '', $penghasilan));
																														if ($isNumeric) {
																														    $penghasilan = (float) str_replace(['Rp', '.', ','], '', $penghasilan);
																														    echo 'Rp ' . number_format($penghasilan, 0, ',', '.');
																														} else {
																														    echo $penghasilan;
																														}
																												@endphp
																										</td>
																								</tr>
																								<tr>
																										<td>Tanggal Penerbitan</td>
																										<td>{{ $permohonan->data['TanggalPenerbitan'] ?? 'Tidak ada data' }}</td>
																								</tr>
																						@else
																							
																						@endif --}}
																						@foreach ($permohonan->data as $key => $value)
																								<tr>
																										<td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
																										<td>{{ $value }}</td>
																								</tr>
																						@endforeach
																				</table>
																		</td>
																		<td>{{ ucfirst($permohonan->status) }}</td>
																		<td>{{ $permohonan->created_at->translatedFormat('d F Y') }}</td>
																		<td>
																				@if (in_array($permohonan->status, ['pending', 'revision']))
																						<div class="d-flex justify-between gap-1">
																								<button wire:click="approve({{ $permohonan->id }})"
																										class="btn btn-success btn-sm">Setujui</button>
																								<a href="{{ route('admin.reject-permohonan', $permohonan->id) }}"
																										class="btn btn-danger btn-sm">Tolak</a>
																						</div>
																				@elseif ($permohonan->status === 'approved')
																						<div class="d-flex justify-between gap-1">
																								<span class="badge bg-success">{{ ucfirst($permohonan->status) }}</span>
																								<a href="#" wire:click.prevent="download({{ $permohonan->id }})"
																										class="btn btn-info btn-sm">Unduh</a>
																						</div>
																				@else
																						<span class="badge bg-danger">{{ ucfirst($permohonan->status) }}</span>
																				@endif
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="8" class="text-center">Belum ada permohonan.</td>
																</tr>
														@endforelse
												</tbody>
										</table>
								</div>
						</div>
				</div>
		</div>
		@push('css')
				<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
		@endpush
		@push('js')
				<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
				<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
				<script>
						new DataTable('#data', {
								language: {
										lengthMenu: "Tampilkan _MENU_ data per halaman",
										zeroRecords: "Tidak ditemukan data yang cocok",
										info: "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
										infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
										infoFiltered: "(disaring dari total _MAX_ data)",
										search: "Cari:",
										paginate: {
												first: "Pertama",
												last: "Terakhir",
												next: "Berikutnya",
												previous: "Sebelumnya"
										}
								},
								// Pastikan DataTables tidak mengganggu filter Livewire
								searching: true,
								ordering: true,
								paging: true,
						});
				</script>
		@endpush
</div>
