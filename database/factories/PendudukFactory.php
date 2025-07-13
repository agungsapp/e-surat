<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PendudukFactory extends Factory
{
    protected $model = \App\Models\Penduduk::class;

    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'), // 16-digit random NIK
            'nama_lengkap' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date('Y-m-d', '2005-01-01'), // Random date before 2005
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->streetAddress,
            'rt' => str_pad($this->faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT), // e.g., 001, 002
            'rw' => str_pad($this->faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT), // e.g., 001, 002
            'dusun' => 'V',
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'status_perkawinan' => $this->faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'pekerjaan' => $this->faker->jobTitle,
            'no_kk' => $this->faker->unique()->numerify('################'), // 16-digit random KK
            'email' => $this->faker->unique()->userName . '@gmail.com', // Random username with @gmail.com
            'password' => Hash::make('admin'), // Default password: admin (hashed)
            'status' => $this->faker->randomElement(['aktif', 'pindah', 'meninggal']),
        ];
    }
}
