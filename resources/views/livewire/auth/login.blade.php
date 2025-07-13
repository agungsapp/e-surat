<div>
		<h4 class="mb-2">Selamat Datang Kembali! 👋</h4>

		{{-- debug role --}}
		@if (Auth::guard('web')->check())
				<p>admin login</p>
		@elseif(Auth::guard('penduduk')->check())
				<p>penduduk login</p>
		@else
				<p>tidak ada lgon</p>
		@endif

		<p class="mb-4">Silahkan login untuk masuk ke sistem pelayanan surat online</p>

		<!-- Session Status -->
		<x-auth-session-status class="mb-3 text-center" :status="session('status')" />

		<form wire:submit.prevent="login" class="mb-3">
				<!-- Email or Username -->
				<div class="mb-3">
						<label for="email" class="form-label">Email / NIK</label>
						<input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
								wire:model.defer="email" placeholder="Masukan email anda" autofocus />
						@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
						@enderror
				</div>

				<!-- Password -->
				<div class="form-password-toggle mb-3">
						<div class="d-flex justify-content-between">
								<label class="form-label" for="password">Password</label>

						</div>
						<div class="input-group input-group-merge">
								<input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
										wire:model.defer="password" placeholder="••••••••••" aria-describedby="password" />
								<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
						</div>
						@error('password')
								<div class="invalid-feedback d-block">{{ $message }}</div>
						@enderror
				</div>

				<!-- Remember Me -->
				<div class="mb-3">
						<div class="form-check">
								<input class="form-check-input" type="checkbox" id="remember-me" wire:model="remember" />
								<label class="form-check-label" for="remember-me"> ingat saya </label>
						</div>
				</div>

				<!-- Submit -->
				<div class="mb-3">
						<button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
				</div>
		</form>

</div>
