<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Log;

#[Layout('livewire.user.layouts.app')]
class UserVerifyDocumentPage extends Component
{
    public $permohonan;
    public $permohonanId;

    public function mount($id)
    {
        $this->permohonanId = $id;
        $this->permohonan = Permohonan::with('surat')->findOrFail($id);

        if ($this->permohonan->status !== 'approved') {
            abort(404, 'Dokumen tidak ditemukan atau belum disetujui.');
        }
    }

    public function download()
    {
        $permohonan = Permohonan::findOrFail($this->permohonanId);

        if ($permohonan->status !== 'approved') {
            session()->flash('error', 'Hanya permohonan yang disetujui yang dapat diunduh.');
            return;
        }

        $filePath = public_path('storage/' . $permohonan->pdf_path); // Gunakan path publik
        Log::info('Mencoba unduh file dari path publik: ' . $filePath);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            Log::error('File tidak ditemukan di: ' . $filePath);
            session()->flash('error', 'File tidak ditemukan di server. Periksa path: ' . $permohonan->pdf_path);
        }
    }


    public function render()
    {
        return view('livewire.user.user-verify-document-page');
    }
}
