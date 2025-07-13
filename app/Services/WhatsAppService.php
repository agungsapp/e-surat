<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
  protected $apiKey;
  protected $baseUrl = 'https://api.fonnte.com/send';

  public function __construct()
  {
    $this->apiKey = env('FONNTE_API_KEY'); // Ambil API Key dari .env
    if (!$this->apiKey) {
      throw new \Exception('FONNTE_API_KEY tidak ditemukan di .env');
    }
  }

  public function sendMessage($phoneNumber, $message)
  {

    $response = Http::withHeaders([
      'Authorization' => $this->apiKey,
    ])->post($this->baseUrl, [
      'target' => $phoneNumber,
      'message' => $message,
    ]);

    if ($response->successful()) {
      Log::info("WhatsApp message sent successfully to {$phoneNumber}: {$message}");
      return true;
    } else {
      Log::error("Failed to send WhatsApp message to {$phoneNumber}: " . $response->body());
      return false;
    }
  }
}
