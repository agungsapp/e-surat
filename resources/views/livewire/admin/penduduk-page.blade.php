<div>
		<div class="row">
				<div class="col-12">
						<h2>Data Penduduk</h2>
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



						<!-- Form Edit Penduduk -->
						@if ($selectedPenduduk)
								<div class="card mb-4">
										<div class="card-body">
												<h4>Edit Penduduk</h4>
												<form wire:submit.prevent="update">
														<div class="row g-3">
																<div class="col-md-6">
																		<label class="form-label">NIK</label>
																		<input type="text" wire:model="editNik" class="form-control" required>
																		@error('editNik')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Nama Lengkap</label>
																		<input type="text" wire:model="editNamaLengkap" class="form-control" required>
																		@error('editNamaLengkap')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Tempat Lahir</label>
																		<input type="text" wire:model="editTempatLahir" class="form-control" required>
																		@error('editTempatLahir')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Tanggal Lahir</label>
																		<input type="date" wire:model="editTanggalLahir" class="form-control" required>
																		@error('editTanggalLahir')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Jenis Kelamin</label>
																		<select wire:model="editJenisKelamin" class="form-control" required>
																				<option value="">Pilih Jenis Kelamin</option>
																				<option value="L">Laki-laki</option>
																				<option value="P">Perempuan</option>
																		</select>
																		@error('editJenisKelamin')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Alamat</label>
																		<input type="text" wire:model="editAlamat" class="form-control" required>
																		@error('editAlamat')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">RT</label>
																		<input type="text" wire:model="editRt" class="form-control" required>
																		@error('editRt')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">RW</label>
																		<input type="text" wire:model="editRw" class="form-control" required>
																		@error('editRw')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Dusun</label>
																		<input type="text" wire:model="editDusun" class="form-control" required>
																		@error('editDusun')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Agama</label>
																		<select wire:model="editAgama" class="form-control">
																				<option value="">Pilih Agama</option>
																				<option value="Islam">Islam</option>
																				<option value="Kristen">Kristen</option>
																				<option value="Katolik">Katolik</option>
																				<option value="Hindu">Hindu</option>
																				<option value="Buddha">Buddha</option>
																				<option value="Konghucu">Konghucu</option>
																		</select>
																		@error('editAgama')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Status Perkawinan</label>
																		<select wire:model="editStatusPerkawinan" class="form-control">
																				<option value="">Pilih Status</option>
																				<option value="Belum Kawin">Belum Kawin</option>
																				<option value="Kawin">Kawin</option>
																				<option value="Cerai Hidup">Cerai Hidup</option>
																				<option value="Cerai Mati">Cerai Mati</option>
																		</select>
																		@error('editStatusPerkawinan')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Pekerjaan</label>
																		<input type="text" wire:model="editPekerjaan" class="form-control">
																		@error('editPekerjaan')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">No. KK</label>
																		<input type="text" wire:model="editNoKk" class="form-control">
																		@error('editNoKk')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Email</label>
																		<input type="email" wire:model="editEmail" class="form-control" required>
																		@error('editEmail')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Password (opsional)</label>
																		<input type="password" wire:model="editPassword" class="form-control"
																				placeholder="Kosongkan jika tidak diubah">
																		@error('editPassword')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Status</label>
																		<select wire:model="editStatus" class="form-control" required>
																				<option value="">Pilih Status</option>
																				<option value="aktif">Aktif</option>
																				<option value="pindah">Pindah</option>
																				<option value="meninggal">Meninggal</option>
																		</select>
																		@error('editStatus')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
														</div>
														<div class="mt-3">
																<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
																<button type="button" wire:click="cancel" class="btn btn-secondary btn-sm">Batal</button>
														</div>
												</form>
										</div>
								</div>
						@else
								<!-- Form Tambah Penduduk -->
								<div class="card mb-4">
										<div class="card-body">
												<h4>Tambah Penduduk</h4>
												<form wire:submit.prevent="create">
														<div class="row g-3">
																<div class="col-md-6">
																		<label class="form-label">NIK</label>
																		<input type="text" wire:model="nik" class="form-control" required>
																		@error('nik')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Nama Lengkap</label>
																		<input type="text" wire:model="nama_lengkap" class="form-control" required>
																		@error('nama_lengkap')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Tempat Lahir</label>
																		<input type="text" wire:model="tempat_lahir" class="form-control" required>
																		@error('tempat_lahir')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Tanggal Lahir</label>
																		<input type="date" wire:model="tanggal_lahir" class="form-control" required>
																		@error('tanggal_lahir')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Jenis Kelamin</label>
																		<select wire:model="jenis_kelamin" class="form-control" required>
																				<option value="">Pilih Jenis Kelamin</option>
																				<option value="L">Laki-laki</option>
																				<option value="P">Perempuan</option>
																		</select>
																		@error('jenis_kelamin')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Alamat</label>
																		<input type="text" wire:model="alamat" class="form-control" required>
																		@error('alamat')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">RT</label>
																		<input type="text" wire:model="rt" class="form-control" required>
																		@error('rt')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">RW</label>
																		<input type="text" wire:model="rw" class="form-control" required>
																		@error('rw')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Dusun</label>
																		<input type="text" wire:model="dusun" class="form-control" required>
																		@error('dusun')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Agama</label>
																		<select wire:model="agama" class="form-control">
																				<option value="">Pilih Agama</option>
																				<option value="Islam">Islam</option>
																				<option value="Kristen">Kristen</option>
																				<option value="Katolik">Katolik</option>
																				<option value="Hindu">Hindu</option>
																				<option value="Buddha">Buddha</option>
																				<option value="Konghucu">Konghucu</option>
																		</select>
																		@error('agama')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Status Perkawinan</label>
																		<select wire:model="status_perkawinan" class="form-control">
																				<option value="">Pilih Status</option>
																				<option value="Belum Kawin">Belum Kawin</option>
																				<option value="Kawin">Kawin</option>
																				<option value="Cerai Hidup">Cerai Hidup</option>
																				<option value="Cerai Mati">Cerai Mati</option>
																		</select>
																		@error('status_perkawinan')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Pekerjaan</label>
																		<input type="text" wire:model="pekerjaan" class="form-control">
																		@error('pekerjaan')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">No. KK</label>
																		<input type="text" wire:model="no_kk" class="form-control">
																		@error('no_kk')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Email</label>
																		<input type="email" wire:model="email" class="form-control" required>
																		@error('email')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Password</label>
																		<input type="password" wire:model="password" class="form-control" required>
																		@error('password')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
																<div class="col-md-6">
																		<label class="form-label">Status</label>
																		<select wire:model="status" class="form-control" required>
																				<option value="">Pilih Status</option>
																				<option value="aktif">Aktif</option>
																				<option value="pindah">Pindah</option>
																				<option value="meninggal">Meninggal</option>
																		</select>
																		@error('status')
																				<span class="text-danger">{{ $message }}</span>
																		@enderror
																</div>
														</div>
														<div class="mt-3">
																<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
														</div>
												</form>
										</div>
								</div>
						@endif

						<!-- Tabel Penduduk -->
						<div class="card">
								<div class="card-body">
										<table class="table">
												<thead>
														<tr>
																<th scope="col">#</th>
																<th scope="col">NIK</th>
																<th scope="col">Nama Lengkap</th>
																<th scope="col">Jenis Kelamin</th>
																<th scope="col">Alamat</th>
																<th scope="col">RT/RW</th>
																<th scope="col">Email</th>
																<th scope="col">Status</th>
																<th scope="col">Action</th>
														</tr>
												</thead>
												<tbody>
														@forelse ($penduduks as $index => $penduduk)
																<tr>
																		<th scope="row">{{ $index + 1 }}</th>
																		<td>{{ $penduduk->nik }}</td>
																		<td>{{ $penduduk->nama_lengkap }}</td>
																		<td>{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
																		<td>{{ $penduduk->alamat }}</td>
																		<td>{{ $penduduk->rt }}/{{ $penduduk->rw }}</td>
																		<td>{{ $penduduk->email }}</td>
																		<td>{{ ucfirst($penduduk->status) }}</td>
																		<td>
																				<div class="d-flex gap-1">
																						<button wire:click="edit({{ $penduduk->id }})" class="btn btn-sm btn-warning">Edit</button>
																						<button wire:click="delete({{ $penduduk->id }})" class="btn btn-sm btn-danger"
																								onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">Hapus</button>
																				</div>
																		</td>
																</tr>
														@empty
																<tr>
																		<td colspan="9" class="text-center">Belum ada data penduduk.</td>
																</tr>
														@endforelse
												</tbody>
										</table>
								</div>
						</div>
				</div>
		</div>
</div>
