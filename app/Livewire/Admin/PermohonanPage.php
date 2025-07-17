<?php

namespace App\Livewire\Admin;

use App\Models\Permohonan;
use App\Services\SuratService;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PermohonanPage extends Component
{
    public $permohonans;
    public $statusFilter = '';
    public $dateFilter = ''; // Filter tanggal tunggal, bisa diperluas jadi range

    protected $suratService;

    public function __construct()
    {
        $this->suratService = app(SuratService::class);
    }

    public function mount()
    {
        $this->updatePermohonans();
    }

    public function updatedStatusFilter()
    {
        $this->updatePermohonans();
    }

    public function updatedDateFilter()
    {
        $this->updatePermohonans();
    }

    public function updatePermohonans()
    {
        $query = Permohonan::with(['penduduk', 'surat']);

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->dateFilter) {
            $query->whereDate('created_at', $this->dateFilter);
        }

        $this->permohonans = $query->get();
    }

    public function approve($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        Log::info('Status permohonan ID ' . $id . ': ' . $permohonan->status);

        if (!in_array($permohonan->status, ['pending', 'revision'])) {
            session()->flash('error', 'Permohonan tidak dapat disetujui. Status saat ini: ' . $permohonan->status);
            return;
        }

        try {
            if ($this->suratService === null) {
                throw new \Exception('Service SuratService tidak diinisialisasi.');
            }
            $this->suratService->processAfterApproval($permohonan);
            $permohonan->status = 'approved';
            $permohonan->save();
            session()->flash('message', 'Permohonan berhasil disetujui dan ditandatangani dengan QR code.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memproses dokumen: ' . $e->getMessage());
        }

        $this->updatePermohonans();
    }

    public function reject($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        if (!in_array($permohonan->status, ['pending', 'revision'])) {
            session()->flash('error', 'Permohonan tidak dapat ditolak. Status saat ini: ' . $permohonan->status);
            return;
        }

        $permohonan->status = 'rejected';
        $permohonan->save();

        session()->flash('message', 'Permohonan berhasil ditolak.');
        $this->updatePermohonans();
    }

    public function download($id)
    {
        $permohonan = Permohonan::findOrFail($id);

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
        return view('livewire.admin.permohonan-page');
    }
}
