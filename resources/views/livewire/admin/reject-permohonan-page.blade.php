<div>
		<div class="card">
				<div class="card-header">
						<h3>Alasan Penolakan Permohonan #{{ $permohonan->id }}</h3>
				</div>
				<div class="card-body">
						@if (session()->has('message'))
								<div class="alert alert-success">{{ session('message') }}</div>
						@endif
						@if (session()->has('error'))
								<div class="alert alert-danger">{{ session('error') }}</div>
						@endif
						<form wire:submit.prevent="submit">
								<div class="mb-3">
										<label for="type" class="form-label">Pilih Tindakan</label>
										<select wire:model="type" class="form-control" id="type" required>
												<option value="">Pilih Tindakan</option>
												<option value="permanen">Reject Permanen</option>
												<option value="revisi">Revisi</option>
										</select>
										@error('type') <span class="text-danger">{{ $message }}</span> @endif
								</div>
								<div class="mb-3">
										<label for="alasan" class="form-label">Alasan Penolakan</label>
										<textarea wire:model="alasan" class="form-control" id="alasan" rows="3" required></textarea>
										@error('alasan') <span class="text-danger">{{ $message }}</span> @endif
								</div>
								<button type="submit" class="btn btn-primary">Kirim</button>
								<a href="{{ route('admin.permohonan') }}" class="btn btn-secondary">Batal</a>
						</form>
				</div>
		</div>
</div>
