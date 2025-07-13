<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generate()
    {
        // Generate QR code sebagai data URI base64
        $qrCode = 'data:image/png;base64,' . base64_encode(QrCode::size(50)->format('png')->generate('https://sehatea.my.id'));
        return view('qrcode', compact('qrCode'));
    }
}
