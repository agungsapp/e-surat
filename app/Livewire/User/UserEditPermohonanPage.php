<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Permohonan;
use App\Services\WhatsAppService;
use Livewire\Attributes\Layout;

class UserEditPermohonanPage extends Component
{
    public $permohonan;
    public $formData = [];

    public function mount($id)
    {
        $this->permohonan = Permohonan::findOrFail($id);
        if (!in_array($this->permohonan->status, ['rejected', 'revision'])) {
            session()->flash('error', 'Permohonan tidak dapat diedit. Status saat ini: ' . $this->permohonan->status);
            return redirect()->route('pelayanan-surat'); // Atau rute lain yang sesuai
        }
        $this->formData = $this->permohonan->data; // Muat data awal
    }

    public function save()
    {
        $this->validate([
            'formData.*' => 'required', // Validasi semua field wajib
        ]);

        $this->permohonan->data = $this->formData;
        $this->permohonan->status = 'revision'; // Ubah status ke revision setelah revisi
        $this->permohonan->save();

        $wa = new WhatsAppService();
        $wa->sendMessage($this->permohonan->whatsapp_number, "Terimakasih telah melakukan revisi dokumen yang anda ajukan silahkan menunggu info selanjutnya.");

        session()->flash('message', 'Data berhasil diperbarui. Menunggu persetujuan kembali.');
        return redirect()->route('pelayanan-surat'); // Atau rute lain yang sesuai
    }

    #[Layout('livewire.user.layouts.app')]
    public function render()
    {
        return view('livewire.user.user-edit-permohonan-page');
    }
}
