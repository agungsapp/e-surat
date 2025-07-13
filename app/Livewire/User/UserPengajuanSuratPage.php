<?php

namespace App\Livewire\User;

use App\Models\Surat;
use App\Models\Permohonan;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserPengajuanSuratPage extends Component
{
    public $surat;
    public $formData = [];
    public $fields = [];
    public $whatsapp_number;

    public function mount($id)
    {
        $this->surat = Surat::findOrFail($id);
        $this->fields = is_string($this->surat->data) ? json_decode($this->surat->data, true) : $this->surat->data;

        if ($this->surat->kode === 'SKTM') {
            // Logika eksplisit untuk SKTM
            $this->fields = [
                'OrangTua' => ['Nama', 'NIK', 'TempatLahir', 'TanggalLahir', 'Agama', 'JenisKelamin', 'Pekerjaan', 'Alamat'],
                'Anak' => ['Nama', 'NIK', 'TempatLahir', 'TanggalLahir', 'Agama', 'JenisKelamin', 'Pekerjaan', 'AlamatKTP'],
                'Penghasilan' => '',
                'TanggalPenerbitan' => '',
            ];
            $this->formData = [
                'OrangTua' => [],
                'Anak' => [],
                'Penghasilan' => '',
                'TanggalPenerbitan' => '',
            ];
            foreach ($this->fields['OrangTua'] as $field) {
                $this->formData['OrangTua'][$field] = '';
            }
            foreach ($this->fields['Anak'] as $field) {
                $this->formData['Anak'][$field] = '';
            }
        } else {
            $this->formData = [];
            foreach ($this->fields as $key => $value) {
                if (is_array($value)) {
                    $this->formData[$key] = [];
                    foreach ($value as $subKey => $subValue) {
                        $this->formData[$key][$subKey] = '';
                    }
                } else {
                    $this->formData[$value] = '';
                }
            }
        }
    }

    public function submit()
    {
        // Validasi spesifik untuk struktur formData
        $validationRules = [
            'whatsapp_number' => 'nullable|string',
        ];

        if ($this->surat->kode === 'SKTM') {
            foreach ($this->fields['OrangTua'] as $field) {
                $validationRules["formData.OrangTua.{$field}"] = 'required';
            }
            foreach ($this->fields['Anak'] as $field) {
                $validationRules["formData.Anak.{$field}"] = 'required';
            }
            $validationRules['formData.Penghasilan'] = 'required|numeric';
            $validationRules['formData.TanggalPenerbitan'] = 'required|date';
        } else {
            // Validasi dinamis untuk surat lain
            foreach ($this->fields as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        if (stripos($subKey, 'Penghasilan') !== false) {
                            $validationRules["formData.{$key}.{$subKey}"] = 'required|numeric';
                        } else {
                            $validationRules["formData.{$key}.{$subKey}"] = 'required';
                        }
                    }
                } elseif (is_string($value) && stripos($value, 'Penghasilan') !== false) {
                    $validationRules["formData.{$value}"] = 'required|numeric';
                } elseif (is_string($value)) {
                    $validationRules["formData.{$value}"] = 'required';
                }
            }
            // Validasi khusus untuk TanggalPenerbitan jika ada
            if (isset($this->fields['TanggalPenerbitan'])) {
                $validationRules['formData.TanggalPenerbitan'] = 'required|date';
            }
        }

        $this->validate($validationRules);

        try {
            $permohonan = Permohonan::create([
                'id_penduduk' => Auth::guard('penduduk')->user()->id ?? null,
                'id_surat' => $this->surat->id,
                'data' => $this->formData,
                'status' => 'pending',
                'signature' => null,
                'whatsapp_number' => Str::wanomor($this->whatsapp_number),
            ]);

            $nomorSurat = Permohonan::generateNewNomorSurat($this->surat->id, $permohonan->id);
            $permohonan->nomor_surat = $nomorSurat;
            $permohonan->save();

            if ($this->whatsapp_number) {
                $whatsappService = new WhatsAppService();
                $whatsappService->sendMessage($permohonan->whatsapp_number, "Halo, pengajuan suratmu untuk {$this->surat->nama} sedang diproses. Nomor suratmu: {$permohonan->kode_surat}. Tunggu info selanjutnya.");
            }

            session()->flash('message', 'Permohonan berhasil diajukan!');
            $this->reset(['formData', 'whatsapp_number']);
            return redirect()->route('pelayanan-surat');
        } catch (\Exception $e) {
            Log::error('Error submitting permohonan: ' . $e->getMessage());
            session()->flash('message', 'Terjadi kesalahan saat mengajukan permohonan. Silakan coba lagi.');
        }
    }

    #[Layout('livewire.user.layouts.app')]
    public function render()
    {
        return view('livewire.user.user-pengajuan-surat-page', [
            'surat' => $this->surat,
            'fields' => $this->fields,
        ]);
    }
}
