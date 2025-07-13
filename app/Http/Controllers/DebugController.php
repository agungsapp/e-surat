<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Services\SuratService;
use App\Services\WhatsAppService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class DebugController extends Controller
{
    public function showPdf($id = null)
    {
        $wa = new WhatsAppService();
        $wa->sendMessage('6281373939116', "lagi debug bro");

        if ($id === 'static') {
            // Mode debugging dengan data statis
            $permohonan = new Permohonan();
            $permohonan->id = 999; // ID dummy
            $permohonan->id_surat = 1; // Asumsikan template SKU
            $suratService = new SuratService();

            // Data statis untuk debugging
            $permohonan->nomor_surat = 'DEBUG-001/2025';
            $verificationUrl = url('/cek-surat/DEBUG-001/2025');

            // Buat QR code menggunakan simplesoftwareio/simple-qrcode
            $qrBase64 = 'data:image/png;base64,' . base64_encode(QrCode::size(100)
                ->errorCorrection('H')
                ->format('png')
                ->generate($verificationUrl));

            // Debug isi QR code
            Log::info('QR Base64 Length: ' . strlen(base64_encode(QrCode::size(100)
                ->errorCorrection('H')
                ->format('png')
                ->generate($verificationUrl))));
            Log::info('QR Base64 Sample: ' . substr($qrBase64, 0, 100));
        } else {
            // Mode normal dengan data dari database
            $permohonan = Permohonan::findOrFail($id);
            $suratService = new SuratService();

            $permohonan->generateNomorSurat();
            $verificationUrl = url('/cek-surat/' . $permohonan->nomor_surat);

            $qrBase64 = 'data:image/png;base64,' . base64_encode(QrCode::size(100)
                ->errorCorrection('H')
                ->format('png')
                ->generate($verificationUrl));
        }

        $template = $id === 'static' ? 'surat.sku' : $suratService->getTemplateView($permohonan->id_surat);
        // dd($template);
        $data = $suratService->mapStaticData($permohonan);

        // Load view untuk ditampilkan langsung
        return view($template, [
            'permohonan' => $permohonan,
            'qrBase64' => $qrBase64,
            'data' => $data,
        ]);

        // Komentari stream untuk sementara
        // $pdf = Pdf::loadView($template, [
        //     'permohonan' => $permohonan,
        //     'qrBase64' => $qrBase64,
        //     'data' => $data,
        // ])->setPaper('a4', 'portrait');
        //
        // return $pdf->stream('debug-surat-' . ($id === 'static' ? 'static' : $permohonan->id) . '.pdf');
    }
}
