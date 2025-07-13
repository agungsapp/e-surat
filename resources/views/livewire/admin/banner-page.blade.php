<div>
		<div class="row">
				<div class="col-12">
						<h2>Data Banner</h2>
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

						<!-- Form Tambah Banner -->
						<div class="card mb-4">
								<div class="card-body">
										<h4>Tambah Banner</h4>
										<form wire:submit.prevent="create">
												<div class="row g-3">
														<div class="col-md-6">
																<label class="form-label">Keterangan</label>
																<input type="text" wire:model="keterangan" class="form-control" required>
																@error('keterangan') <span class="text-danger">{{ $message }}</span> @endif
														</div>
														<div class="col-md-6">
																<label class="form-label">Gambar</label>
																<input type="file" wire:model="path" class="form-control" accept="image/*" required>
																@error('path') <span class="text-danger">{{ $message }}</span> @endif
														</div>
												</div>
												<div class="mt-3">
														<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
												</div>
										</form>
								</div>
						</div>

						<!-- Form Edit Banner -->
						@if ($selectedBanner)
								<div class="card mb-4">
										<div class="card-body">
												<h4>Edit Banner</h4>
												<form wire:submit.prevent="update">
														<div class="row g-3">
																<div class="col-md-6">
																		<label class="form-label">Keterangan</label>
																		<input type="text" wire:model="editKeterangan" class="form-control" required>
																		@error('editKeterangan') <span class="text-danger">{{ $message }}</span>
								@endif
						</div>
						<div class="col-md-6">
								<label class="form-label">Gambar Saat Ini</label>
								<img src="{{ Storage::url($editPath) }}" alt="Banner" class="img-fluid mb-2" style="max-height: 100px;">
								<label class="form-label">Gambar Baru (opsional)</label>
								<input type="file" wire:model="newImage" class="form-control" accept="image/*">
								@error('newImage') <span class="text-danger">{{ $message }}</span> @endif
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

		<!-- Tabel Banner -->
		<div class="card">
				<div class="card-body">
						<table class="table">
								<thead>
										<tr>
												<th scope="col">#</th>
												<th scope="col">Keterangan</th>
												<th scope="col">Gambar</th>
												<th scope="col">Action</th>
										</tr>
								</thead>
								<tbody>
										@forelse ($banners as $index => $banner)
												<tr>
														<th scope="row">{{ $index + 1 }}</th>
														<td>{{ $banner->keterangan }}</td>
														<td>
																<img src="{{ Storage::url($banner->path) }}" alt="{{ $banner->keterangan }}" class="img-fluid"
																		style="max-height: 50px;">
														</td>
														<td>
																<div class="d-flex gap-1">
																		<button wire:click="edit({{ $banner->id }})" class="btn btn-sm btn-warning">Edit</button>
																		<button wire:click="delete({{ $banner->id }})" class="btn btn-sm btn-danger"
																				onclick="return confirm('Yakin ingin menghapus banner ini?')">Hapus</button>
																</div>
														</td>
												</tr>
										@empty
												<tr>
														<td colspan="4" class="text-center">Belum ada banner.</td>
												</tr>
										@endforelse
								</tbody>
						</table>
				</div>
		</div>
		</div>
		</div>
		</div>
