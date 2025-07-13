<?php

namespace App\Livewire\Admin;

use App\Models\Permohonan;
use App\Models\RejectionLog;
use App\Services\WhatsAppService;
use Livewire\Component;

class RejectPermohonanPage extends Component
{
    public $permohonan;
    public $alasan;
    public $type; // 'permanen' atau 'revisi'

    public function mount($id)
    {
        $this->permohonan = Permohonan::findOrFail($id);
        if ($this->permohonan->status !== 'pending') {
            session()->flash('error', 'Permohonan sudah diproses.');
            return redirect()->route('admin.permohonan'); // Kembali ke daftar permohonan
        }
    }

    public function submit()
    {
        $this->validate([
            'alasan' => 'required',
            'type' => 'required|in:permanen,revisi',
        ]);

        // Buat entri di rejection_log
        RejectionLog::create([
            'id_permohonan' => $this->permohonan->id,
            'alasan' => $this->alasan,
            'type' => $this->type,
        ]);

        // Update status permohonan
        if ($this->type === 'revisi') {
            $this->permohonan->status = 'rejected'; // Awalnya rejected, akan berubah ke revision setelah revisi
            $revisionLink = route('edit-permohonan', $this->permohonan->id);
        } else {
            $this->permohonan->status = 'rejected'; // Permanen
            $revisionLink = null;
        }
        $this->permohonan->save();

        // Kirim notifikasi WhatsApp
        if ($this->permohonan->whatsapp_number) {
            $whatsappService = new WhatsAppService();
            $message = "Permohonan surat {$this->permohonan->surat->nama} dengan nomor {$this->permohonan->nomor_surat} telah " . ($this->type === 'revisi' ? 'diminta revisi' : 'ditolak') . ". ";
            $message .= "Alasan: {$this->alasan}. ";
            $message .= $revisionLink ? "Silakan revisi di: {$revisionLink}" : '';
            $whatsappService->sendMessage($this->permohonan->whatsapp_number, $message);
        }

        session()->flash('message', 'Permohonan ' . ($this->type === 'revisi' ? 'diminta revisi' : 'ditolak') . ' dengan alasan: ' . $this->alasan);
        return redirect()->route('admin.permohonan');
    }

    public function render()
    {
        return view('livewire.admin.reject-permohonan-page');
    }
}
