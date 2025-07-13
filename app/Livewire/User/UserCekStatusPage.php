<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Permohonan;

#[Layout('livewire.user.layouts.app')]
class UserCekStatusPage extends Component
{
    public $nomorSurat = '';
    public $status = null;
    public $message = '';

    public function cekStatus()
    {
        $this->reset(['status', 'message']); // Reset nilai sebelum cek

        if (!$this->nomorSurat) {
            $this->message = 'Mohon masukkan nomor surat yang valid.';
            return;
        }

        $permohonan = Permohonan::where('nomor_surat', $this->nomorSurat)->first();

        if ($permohonan) {
            $this->status = $permohonan->status;
            switch ($permohonan->status) {
                case 'approved':
                    $this->message = 'Dokumen dengan nomor surat ' . $this->nomorSurat . ' telah disetujui secara resmi.';
                    break;
                case 'pending':
                    $this->message = 'Dokumen dengan nomor surat ' . $this->nomorSurat . ' masih dalam proses peninjauan.';
                    break;
                case 'rejected':
                    $this->message = 'Dokumen dengan nomor surat ' . $this->nomorSurat . ' telah ditolak. Silakan hubungi pihak berwenang untuk informasi lebih lanjut.';
                    break;
                default:
                    $this->message = 'Dokumen dengan nomor surat ' . $this->nomorSurat . ' memiliki status ' . ucfirst($permohonan->status) . '.';
            }
        } else {
            $this->message = 'Nomor surat ' . $this->nomorSurat . ' tidak ditemukan dalam sistem.';
        }
    }

    public function render()
    {
        return view('livewire.user.user-cek-status-page');
    }
}
