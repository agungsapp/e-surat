<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surat = [
            [
                'nama' => 'SURAT KETERANGAN USAHA',
                'kode' => 'SKU',
                'deskripsi' => 'Surat Keterangan Usaha menyatakan seseorang memiliki dan menjalankan usaha di desa. Dibutuhkan untuk pengajuan kredit, pinjaman bank, bantuan UMKM, atau administrasi lain yang memerlukan bukti legal usaha.',
                'active' => true,
                'data' => json_encode([
                    'JenisUsaha',
                ]),
            ],
            [
                'nama' => 'SURAT KETERANGAN BELUM MENIKAH',
                'kode' => 'SKBM',
                'deskripsi' => 'Surat Keterangan Belum Menikah menyatakan seseorang belum menikah secara hukum atau adat. Digunakan untuk pernikahan, pendaftaran kerja, pendidikan, atau keperluan administrasi lainnya.',
                'active' => true,
                'data' => json_encode([
                    // 'Nama',
                    // 'JenisKelamin',
                    // 'TempatLahir',
                    // 'TanggalLahir',
                    // 'Agama',
                    // 'Pekerjaan',
                    // 'StatusPerkawinan',
                    // 'NomorKK',
                    // 'NIK',
                    // 'Alamat',
                    // 'TanggalPenerbitan'
                ]),
            ],
            [
                'nama' => 'SURAT KETERANGAN TIDAK MAMPU',
                'kode' => 'SKTM',
                'deskripsi' => 'Surat Keterangan Tidak Mampu menyatakan seseorang atau keluarga tidak mampu secara ekonomi. Digunakan untuk bantuan sosial, keringanan biaya sekolah, layanan kesehatan gratis, atau keperluan serupa.',
                'active' => true,
                'data' => json_encode([
                    'OrangTua' => [
                        'Nama' => '',
                        'NIK' => '',
                        'TempatLahir' => '',
                        'TanggalLahir' => '',
                        'Agama' => '',
                        'JenisKelamin' => '',
                        'Pekerjaan' => '',
                        'Alamat' => '',
                    ],
                    'Anak' => [
                        'Nama' => '',
                        'NIK' => '',
                        'TempatLahir' => '',
                        'TanggalLahir' => '',
                        'Agama' => '',
                        'JenisKelamin' => '',
                        'Pekerjaan' => '',
                        'AlamatKTP' => '',
                    ],
                    'Penghasilan' => '',
                    'TanggalPenerbitan' => '',
                ]),
            ],
            [
                'nama' => 'SURAT KETERANGAN KEHILANGAN',
                'kode' => 'SKH',
                'deskripsi' => 'Surat Keterangan Kehilangan menyatakan seseorang kehilangan barang (dokumen, dompet, kendaraan) berdasarkan laporan. Digunakan untuk pengurusan ulang dokumen atau laporan resmi kepada pihak berwenang.',
                'active' => true,
                'data' => json_encode([
                    // 'Nama',
                    // 'NIK',
                    // 'TempatLahir',
                    // 'TanggalLahir',
                    // 'JenisKelamin',
                    'Umur',
                    // 'Pekerjaan',
                    // 'Alamat',
                    'Kehilangan',
                    'LokasiKehilangan',
                    'TanggalKehilangan',
                    // 'TanggalPenerbitan',
                ]),
            ],
            [
                'nama' => 'SURAT KETERANGAN DOMISILI',
                'kode' => 'SKD',
                'deskripsi' => 'Surat Keterangan Domisili menyatakan seseorang bertempat tinggal di wilayah desa. Dibutuhkan untuk keperluan administrasi, pendaftaran penduduk, atau persyaratan lainnya yang memerlukan bukti domisili.',
                'active' => true,
                'data' => json_encode([
                    // 'Nama',
                    // 'JenisKelamin',
                    // 'TempatLahir',
                    // 'TanggalLahir',
                    // 'Agama',
                    // 'Pekerjaan',
                    // 'StatusPerkawinan',
                    // 'NomorKK',
                    // 'NIK',
                    // 'Alamat',
                    // 'TanggalPenerbitan'
                ]),
            ],
            [
                'nama' => 'SURAT KETERANGAN KEMATIAN',
                'kode' => 'SKK',
                'deskripsi' => 'Surat Keterangan Kematian menyatakan seseorang telah meninggal dunia berdasarkan laporan. Digunakan untuk keperluan administrasi seperti akta kematian, warisan, atau dokumen resmi lainnya.',
                'active' => true,
                'data' => json_encode([
                    // 'Nama',
                    // 'JenisKelamin',
                    // 'TempatLahir',
                    // 'TanggalLahir',
                    // 'Agama',
                    // 'Pekerjaan',
                    // 'StatusPerkawinan',
                    // 'NomorKK',
                    // 'NIK',
                    // 'Alamat',
                    // 'TanggalPenerbitan',
                    'TanggalKematian',
                    'WaktuKematian',
                    'TempatKematian',
                    'TempatPemakaman',
                ]),
            ],
            // [
            //     'nama' => 'SPTJM KEBENARAN DATA KELAHIRAN',
            //     'kode' => 'SPTJM',
            //     'deskripsi' => 'Surat Pernyataan Tanggung Jawab Mutlak (SPTJM) Kebenaran Data Kelahiran merupakan surat pernyataan orang tua/wali yang menyatakan kebenaran data kelahiran anak. Dokumen ini dibutuhkan apabila akta kelahiran belum diterbitkan atau tidak tersedia dokumen pendukung resmi kelahiran dari rumah sakit/bidan.',
            //     'active' => false,
            //     'data' => json_encode([
            //         'NamaAnak',
            //         'TanggalLahir',
            //         'NamaOrangTua',
            //         'TanggalPenerbitan'
            //     ]),
            // ],
            [
                'nama' => 'SURAT KETERANGAN KELAHIRAN',
                'kode' => 'SKL',
                'deskripsi' => 'Surat Keterangan Kelahiran menyatakan kelahiran seseorang yang sah, mencakup data anak dan orang tua. Digunakan untuk keperluan administrasi seperti akta kelahiran, pendidikan, atau dokumen resmi lainnya.',
                'active' => true,
                'data' => json_encode([
                    'NamaAnak',
                    'JenisKelaminAnak',
                    'TempatLahirAnak',
                    'TanggalLahirAnak',
                    'AgamaAnak',
                    'AlamatAnak',

                    'NamaAyah',
                    'NamaIbu',

                    'TanggalPenerbitan',

                ]),
            ],
            [
                'nama' => 'SURAT KETERANGAN PENGHASILAN ORANG TUA',
                'kode' => 'SKPO',
                'deskripsi' => 'Surat Keterangan Kelahiran menyatakan kelahiran seseorang yang sah, mencakup data anak dan orang tua. Digunakan untuk keperluan administrasi seperti akta kelahiran, pendidikan, atau dokumen resmi lainnya.',
                'active' => true,
                'data' => json_encode([
                    // 'Nama',
                    // 'TempatLahir',
                    // 'TanggalLahir',
                    // 'NIK',
                    // 'Alamat',
                    // 'Pekerjaan',
                    'MinimalPenghasilan',
                    'MaksimalPenghasilan',

                    'NamaAnak',
                    'JenisKelaminAnak',
                    'TempatLahirAnak',
                    'TanggalLahirAnak',
                    'NIKAnak',
                    'AlamatAnak',

                    // 'TanggalPenerbitan',
                ]),
            ],
        ];


        DB::table('surat')->insert($surat);
    }
}
