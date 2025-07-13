<div>
		<div class="row">
				<div class="col-12">
						<h2>Data Surat Tersedia</h2>
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
						@if ($selectedSurat)
								<div class="card mb-4">
										<div class="card-body">
												<h4>Edit Surat</h4>
												<form wire:submit.prevent="save">
														<div class="row g-3">
																<div class="col-md-4">
																		<label class="form-label">Nama</label>
																		<input type="text" wire:model="editNama" class="form-control" required>
																		@error('editNama') <span class="text-danger">{{ $message }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">Kode</label>
								<input type="text" wire:model="editKode" class="form-control" required>
								@error('editKode') <span class="text-danger">{{ $message }}</span> @endif
						</div>
						<div class="col-md-4">
								<label class="form-label">Deskripsi</label>
								<input type="text" wire:model="editDeskripsi" class="form-control" required>
								@error('editDeskripsi') <span class="text-danger">{{ $message }}</span> @endif
						</div>
						<div class="col-md-4">
								<label class="form-label">Active</label>
								<select wire:model="editActive" class="form-control" required>
										<option value="1">Ya</option>
										<option value="0">Tidak</option>
								</select>
								@error('editActive') <span class="text-danger">{{ $message }}</span> @endif
						</div>
				</div>
				<div class="mt-3">
						<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
						<button type="button" wire:click="cancel" class="btn btn-secondary btn-sm">Batal</button>
				</div>
				</form>
		</div>
		</div>
		@endif
		<div class="card">
				<div class="card-body">
						<table class="table">
								<thead>
										<tr>
												<th scope="col">#</th>
												<th scope="col">Nama</th>
												<th scope="col">Kode</th>
												<th scope="col">Deskripsi</th>
												<th scope="col">Active</th>
												<th scope="col">Action</th>
										</tr>
								</thead>
								<tbody>
										@forelse ($surats as $index => $surat)
												<tr>
														<th scope="row">{{ $index + 1 }}</th>
														<td>{{ $surat->nama }}</td>
														<td>{{ $surat->kode }}</td>
														<td>{{ $surat->deskripsi }}</td>
														<td>{{ $surat->active ? 'Ya' : 'Tidak' }}</td>
														<td>
																<div class="d-flex gap-1">
																		<a href="{{ route('admin.surat-info', $surat->id) }}" class="btn btn-sm btn-success">Detail</a>
																		<button wire:click="edit({{ $surat->id }})" class="btn btn-sm btn-warning">Edit</button>
																</div>
														</td>
												</tr>
										@empty
												<tr>
														<td colspan="6" class="text-center">Belum ada surat.</td>
												</tr>
										@endforelse
								</tbody>
						</table>
				</div>
		</div>
		</div>
		</div>
		</div>
