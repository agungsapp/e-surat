<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        // Coba login ke users (guard: web, provider: users) - AKTIFKAN KEMBALI
        if (Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::clear($this->throttleKey());
            Session::regenerate();
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
            return;
        }

        // Coba login ke penduduk (guard: penduduk)
        // Cek apakah input adalah email atau nik
        $pendudukField = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        // Debug: Log attempt untuk debugging
        Log::info('Attempting penduduk login', [
            'field' => $pendudukField,
            'value' => $this->email,
            'has_password' => !empty($this->password)
        ]);

        if (Auth::guard('penduduk')->attempt([$pendudukField => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::clear($this->throttleKey());
            Session::regenerate();
            // $this->redirectIntended(default: '/home', navigate: true);
            $this->redirect('/home', navigate: false);
            return;
        }

        RateLimiter::hit($this->throttleKey());

        // Pesan error yang lebih spesifik
        throw ValidationException::withMessages([
            'email' => 'Email/NIK atau password tidak valid.',
        ]);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
