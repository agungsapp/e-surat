<?php

namespace App\Livewire\User;

use App\Models\Surat;
use App\Models\Permohonan;
use App\Models\Penduduk;
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

        // Inisialisasi formData berdasarkan jenis surat
        $this->formData = [];
        if ($this->surat->kode === 'SKTM') {
            $this->formData = [
                'NIKAnak' => '',
                'Penghasilan' => '',
            ];
        } elseif ($this->surat->kode === 'SKL') {
            $this->formData = [
                'NIKAnak' => '',
                'NIKAyah' => '',
                'NIKIbu' => '',
            ];
        } else {
            foreach ($this->fields as $key => $value) {
                if (is_array($value)) {
                    $this->formData[$key] = [];
                    foreach ($value as $subKey => $subValue) {
                        $this->formData[$key][$subKey] = '';
                    }
                } else {
                    $this->formData[$key] = '';
                }
            }
        }
    }

    public function submit()
    {
        // Aturan validasi
        $validationRules = [
            'whatsapp_number' => 'nullable|string',
        ];

        if ($this->surat->kode === 'SKTM') {
            $validationRules['formData.NIKAnak'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Penduduk::where('nik', $value)->exists()) {
                        $fail('NIK anak tidak ditemukan di database penduduk.');
                    }
                    if (Auth::guard('penduduk')->check() && $value === Auth::guard('penduduk')->user()->nik) {
                        $fail('NIK anak tidak boleh sama dengan NIK pemohon.');
                    }
                },
            ];
            $validationRules['formData.Penghasilan'] = 'required|numeric|min:0';
        } elseif ($this->surat->kode === 'SKL') {
            $validationRules['formData.NIKAnak'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Penduduk::where('nik', $value)->exists()) {
                        $fail('NIK anak tidak ditemukan di database penduduk.');
                    }
                },
            ];
            $validationRules['formData.NIKAyah'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Penduduk::where('nik', $value)->exists()) {
                        $fail('NIK ayah tidak ditemukan di database penduduk.');
                    }
                    if ($value === $this->formData['NIKAnak']) {
                        $fail('NIK ayah tidak boleh sama dengan NIK anak.');
                    }
                    if (Auth::guard('penduduk')->check() && $value === Auth::guard('penduduk')->user()->nik) {
                        $fail('NIK ayah tidak boleh sama dengan NIK pemohon.');
                    }
                },
            ];
            $validationRules['formData.NIKIbu'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Penduduk::where('nik', $value)->exists()) {
                        $fail('NIK ibu tidak ditemukan di database penduduk.');
                    }
                    if ($value === $this->formData['NIKAnak']) {
                        $fail('NIK ibu tidak boleh sama dengan NIK anak.');
                    }
                    if ($value === $this->formData['NIKAyah']) {
                        $fail('NIK ibu tidak boleh sama dengan NIK ayah.');
                    }
                },
            ];
        } else {
            foreach ($this->fields as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        if (stripos($subKey, 'Penghasilan') !== false) {
                            $validationRules["formData.{$key}.{$subKey}"] = 'required|numeric|min:0';
                        } else {
                            $validationRules["formData.{$key}.{$subKey}"] = 'required';
                        }
                    }
                } elseif (is_string($value) && stripos($value, 'Penghasilan') !== false) {
                    $validationRules["formData.{$value}"] = 'required|numeric|min:0';
                } elseif (is_string($value)) {
                    $validationRules["formData.{$value}"] = 'required';
                }
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
