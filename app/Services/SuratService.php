<?php

namespace App\Services;

use App\Models\Penduduk;
use App\Models\Permohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratService
{
  public function processAfterApproval(Permohonan $permohonan)
  {

    // $surat = $permohonan->surat;
    // dd($data['NIKAnak']);
    // Generate nomor surat
    $permohonan->generateNomorSurat();

    // Generate PDF dengan QR code
    $pdfPath = $this->generatePdfWithQR($permohonan);

    // Simpan path PDF
    $permohonan->pdf_path = $pdfPath;
    $permohonan->status = 'signed'; // Langsung signed karena QR code sebagai tanda tangan
    $permohonan->save();

    return ['message' => 'Dokumen berhasil diproses dengan QR code.'];
  }

  protected function generatePdfWithQR(Permohonan $permohonan)
  {

    // dd($permohonan);


    // dd($data);
    // Generate URL untuk verifikasi dokumen
    $verificationUrl = url('/verify-document/' . $permohonan->id);

    // Generate QR code sebagai data URI base64
    $qrBase64 = 'data:image/png;base64,' . base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)
      ->errorCorrection('H')
      ->format('png')
      ->generate($verificationUrl));

    // Tentukan template berdasarkan surat_id
    $template = $this->getTemplateView($permohonan->id_surat);

    // Ambil nama pemohon dari relasi penduduk
    $namaPemohon = str_replace(' ', '_', $permohonan->penduduk->nama_lengkap ?? 'unknown');

    $tanggalCreatedAt = $permohonan->created_at->format('d_m_Y');
    $kodeSurat = $permohonan->surat->kode ?? 'unknown'; // Ambil kode dari relasi surat

    // Generate nama file dengan format baru
    $fileName = "{$kodeSurat}_{$permohonan->id}_{$namaPemohon}_{$tanggalCreatedAt}.pdf";
    $pdfPath = 'documents/' . $fileName;

    // Ambil tanggal dari updated_at jika ada, jika tidak gunakan created_at
    $tanggal = $permohonan->updated_at ?? $permohonan->created_at;
    $tanggalPenerbitan = Carbon::parse($tanggal)->translatedFormat('d F Y');

    $penduduk = Penduduk::find($permohonan->id_penduduk);

    $kirim = [
      'penduduk' => $penduduk,
      'tanggalPenerbitan' => $tanggalPenerbitan,
      'permohonan' => $permohonan,
      'qrBase64' => $qrBase64,
      'data' => $this->mapStaticData($permohonan),
    ];

    if ($permohonan->surat->kode == 'SKTM') {
      $data = is_string($permohonan->data) ? json_decode($permohonan->data, true) : $permohonan->data;
      $anak = Penduduk::where('nik', $data['NIKAnak'])->first();
      $kirim['anak'] = $anak;
    } elseif ($permohonan->surat->kode == 'SKL') {
      $data = is_string($permohonan->data) ? json_decode($permohonan->data, true) : $permohonan->data;
      $kirim['anak'] = Penduduk::where('nik', $data['NIKAnak'])->first();
      $kirim['ayah'] = Penduduk::where('nik', $data['NIKAyah'])->first();
      $kirim['ibu'] = Penduduk::where('nik', $data['NIKIbu'])->first();
      // $kirim[]
    } else {
    }

    // dd($kirim);

    // dd($kirim);

    // Generate PDF dengan QR code dan data dinamis
    $pdf = Pdf::loadView($template, $kirim);

    if ($permohonan->whatsapp_number) {
      $whatsappService = new WhatsAppService();
      $namaSurat = strtoupper($permohonan->surat->nama ?? 'Surat');
      $nomorSurat = $permohonan->kode_surat ?? 'Belum ada kode';
      $downloadUrl = asset('storage/' . $pdfPath);

      $message = "📄 Permohonan surat *{$namaSurat}* dengan nomor *{$nomorSurat}* telah disetujui dan ditandatangani Kepala Desa. 
            Silakan unduh dokumenmu di sini: 
            👉 {$downloadUrl}";

      $whatsappService->sendMessage($permohonan->whatsapp_number, $message);
    }

    // Simpan ke disk public
    Storage::disk('public')->put($pdfPath, $pdf->output());

    return $pdfPath;
  }

  public function getTemplateView($suratId)
  {
    $templates = [
      1 => 'surat.sku',
      2 => 'surat.skbm',
      3 => 'surat.sktm',
      4 => 'surat.skh',
      5 => 'surat.skd',
      6 => 'surat.skk',
      7 => 'surat.skl',
      8 => 'surat.skpo',
    ];

    return $templates[$suratId] ?? 'surat.sku';
  }

  public function mapStaticData(Permohonan $permohonan)
  {
    $data = is_string($permohonan->data) ? json_decode($permohonan->data, true) : $permohonan->data;
    $surat = $permohonan->surat;

    if ($surat->kode === 'SKTM') {
      $anak = Penduduk::where('nik', $data['NIKAnak'] ?? '')->first();
      // dd($anak);
      return [
        'KepalaDesaNama' => 'M. A. Khoirin, S.Pd',
        'KepalaDesaJabatan' => 'Kepala Kampung Juku Batu',
        'KepalaDesaAlamat' => 'Dusun II Kampung Juku Batu',
        'Anak' => $anak ? [
          'Nama' => $anak->nama_lengkap ?? '',
          'NIK' => $anak->nik ?? '',
          'TempatLahir' => $anak->tempat_lahir ?? '',
          'TanggalLahir' => $anak->tanggal_lahir ?? '',
          'Agama' => $anak->agama ?? '',
          'JenisKelamin' => $anak->jenis_kelamin ?? '',
          'Pekerjaan' => $anak->pekerjaan ?? '',
          'AlamatKTP' => $anak->alamat ?? '',
        ] : [],
        'Penghasilan' => $data['Penghasilan'] ?? '',
      ];
    } elseif ($surat->kode === 'SKL') {
      $anak = Penduduk::where('nik', $data['NIKAnak'] ?? '')->first();
      $ayah = Penduduk::where('nik', $data['NIKAyah'] ?? '')->first();
      $ibu = Penduduk::where('nik', $data['NIKIbu'] ?? '')->first();
      return [
        'KepalaDesaNama' => 'M. A. Khoirin, S.Pd',
        'KepalaDesaJabatan' => 'Kepala Kampung Juku Batu',
        'KepalaDesaAlamat' => 'Dusun II Kampung Juku Batu',
        'Anak' => $anak ? [
          'Nama' => $anak->nama_lengkap ?? '',
          'JenisKelamin' => $anak->jenis_kelamin ?? '',
          'TempatLahir' => $anak->tempat_lahir ?? '',
          'TanggalLahir' => $anak->tanggal_lahir ?? '',
          'Agama' => $anak->agama ?? '',
          'Alamat' => $anak->alamat ?? '',
        ] : [],
        'Ayah' => $ayah ? ['NamaAyah' => $ayah->nama_lengkap ?? ''] : ['NamaAyah' => ''],
        'Ibu' => $ibu ? ['NamaIbu' => $ibu->nama_lengkap ?? ''] : ['NamaIbu' => ''],
      ];
    } else {
      $mappedData = [];
      foreach ($data as $field => $value) {
        $mappedData[$field] = $value ?? '';
      }
      return array_merge([
        'KepalaDesaNama' => 'M. A. Khoirin, S.Pd',
        'KepalaDesaJabatan' => 'Kepala Kampung Juku Batu',
        'KepalaDesaAlamat' => 'Dusun II Kampung Juku Batu',
      ], $mappedData);
    }
  }
}
