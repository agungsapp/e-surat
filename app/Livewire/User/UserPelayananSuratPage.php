<?php

namespace App\Livewire\User;

use App\Models\Surat;
use App\Models\Permohonan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserPelayananSuratPage extends Component
{
    public $surats;
    public $selectedSuratId;
    public $formData = [];
    public $fields = [];

    public function mount()
    {
        $this->surats = Surat::all();
    }

    // Perbarui field formulir saat surat dipilih
    public function updatedSelectedSuratId($value)
    {
        $this->formData = [];
        $this->fields = [];
        $surat = Surat::find((int) $value);
        if ($surat) {
            // dd($surat->data); // Pastikan ini adalah array, bukan string
            $this->fields = $surat->data;
            foreach ($this->fields as $field) {
                $this->formData[$field] = '';
            }
        }
    }

    // Logika submit
    public function submit()
    {
        // Validasi
        $this->validate([
            'selectedSuratId' => 'required|exists:surat,id',
            'formData.*' => 'required',
        ]);

        // Simpan ke tabel permohonan
        Permohonan::create([
            'id_surat' => $this->selectedSuratId,
            'data' => $this->formData,
            'status' => 'pending',
            'signature' => null, // Untuk saat ini, biarkan null (QR code akan ditangani nanti)
        ]);

        // Reset form dan beri notifikasi
        $this->reset(['selectedSuratId', 'formData', 'fields']);
        session()->flash('message', 'Permohonan berhasil diajukan!');
    }

    #[Layout('livewire.user.layouts.app')]
    public function render()
    {
        return view('livewire.user.user-pelayanan-surat-page');
    }
}
