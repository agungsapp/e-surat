<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('wanomor', function ($phoneNumber) {
            if (!is_string($phoneNumber)) {
                throw new Exception('Input must be a string');
            }

            // Hapus karakter selain angka
            $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

            // Jika nomor dimulai dengan '08', ganti dengan '628'
            if (Str::startsWith($phoneNumber, '08')) {
                $phoneNumber = '628' . substr($phoneNumber, 2);
            }

            // Jika nomor sudah dimulai dengan '628', biarkan apa adanya
            return $phoneNumber;
        });
    }
}
