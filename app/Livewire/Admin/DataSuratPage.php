<?php

namespace App\Livewire\Admin;

use App\Models\Surat;
use Livewire\Component;

class DataSuratPage extends Component
{
    public $surats;
    public $selectedSurat = null;
    public $editNama = '';
    public $editKode = '';
    public $editDeskripsi = '';
    public $editActive = false; // Tambahan untuk active

    public function mount()
    {
        $this->surats = Surat::all();
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $this->selectedSurat = $id;
        $this->editNama = $surat->nama;
        $this->editKode = $surat->kode;
        $this->editDeskripsi = $surat->deskripsi;
        $this->editActive = $surat->active; // Muat nilai active
    }

    public function save()
    {
        $this->validate([
            'editNama' => 'required|string|max:255',
            'editKode' => 'required|string|max:10|unique:surat,kode,' . $this->selectedSurat,
            'editDeskripsi' => 'required|string',
            'editActive' => 'required|boolean', // Validasi untuk active
        ]);

        $surat = Surat::findOrFail($this->selectedSurat);
        $surat->update([
            'nama' => $this->editNama,
            'kode' => $this->editKode,
            'deskripsi' => $this->editDeskripsi,
            'active' => $this->editActive, // Simpan nilai active
        ]);

        $this->selectedSurat = null;
        $this->surats = Surat::all();
        session()->flash('message', 'Data surat berhasil diperbarui.');
    }

    public function cancel()
    {
        $this->selectedSurat = null;
    }

    public function render()
    {
        return view('livewire.admin.data-surat-page');
    }
}
