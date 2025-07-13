<?php

namespace App\Livewire\Admin;

use App\Models\Penduduk;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class PendudukPage extends Component
{
    public $penduduks;
    public $nik;
    public $nama_lengkap;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $alamat;
    public $rt;
    public $rw;
    public $dusun;
    public $agama;
    public $status_perkawinan;
    public $pekerjaan;
    public $no_kk;
    public $email;
    public $password;
    public $status;
    public $selectedPenduduk = null;
    public $editNik;
    public $editNamaLengkap;
    public $editTempatLahir;
    public $editTanggalLahir;
    public $editJenisKelamin;
    public $editAlamat;
    public $editRt;
    public $editRw;
    public $editDusun;
    public $editAgama;
    public $editStatusPerkawinan;
    public $editPekerjaan;
    public $editNoKk;
    public $editEmail;
    public $editPassword;
    public $editStatus;

    public function mount()
    {
        $this->penduduks = Penduduk::all();
    }

    public function create()
    {
        $this->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'dusun' => 'required|string|size:3',
            'agama' => 'nullable|string|max:20',
            'status_perkawinan' => 'nullable|string|max:20',
            'pekerjaan' => 'nullable|string|max:50',
            'no_kk' => 'nullable|string|size:16|unique:penduduk,no_kk',
            'email' => 'required|email|max:100|unique:penduduk,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:aktif,pindah,meninggal',
        ]);

        Penduduk::create([
            'nik' => $this->nik,
            'nama_lengkap' => $this->nama_lengkap,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'dusun' => $this->dusun,
            'agama' => $this->agama,
            'status_perkawinan' => $this->status_perkawinan,
            'pekerjaan' => $this->pekerjaan,
            'no_kk' => $this->no_kk,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => $this->status,
        ]);

        $this->reset([
            'nik',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'agama',
            'status_perkawinan',
            'pekerjaan',
            'no_kk',
            'email',
            'password',
            'status'
        ]);
        $this->penduduks = Penduduk::all();
        session()->flash('message', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $this->selectedPenduduk = $id;
        $this->editNik = $penduduk->nik;
        $this->editNamaLengkap = $penduduk->nama_lengkap;
        $this->editTempatLahir = $penduduk->tempat_lahir;
        $this->editTanggalLahir = $penduduk->tanggal_lahir;
        $this->editJenisKelamin = $penduduk->jenis_kelamin;
        $this->editAlamat = $penduduk->alamat;
        $this->editRt = $penduduk->rt;
        $this->editRw = $penduduk->rw;
        $this->editDusun = $penduduk->dusun;
        $this->editAgama = $penduduk->agama;
        $this->editStatusPerkawinan = $penduduk->status_perkawinan;
        $this->editPekerjaan = $penduduk->pekerjaan;
        $this->editNoKk = $penduduk->no_kk;
        $this->editEmail = $penduduk->email;
        $this->editStatus = $penduduk->status;
        // Password is not loaded to avoid exposing it
    }

    public function update()
    {
        $this->validate([
            'editNik' => 'required|string|size:16|unique:penduduk,nik,' . $this->selectedPenduduk,
            'editNamaLengkap' => 'required|string|max:100',
            'editTempatLahir' => 'required|string|max:50',
            'editTanggalLahir' => 'required|date',
            'editJenisKelamin' => 'required|in:L,P',
            'editAlamat' => 'required|string|max:255',
            'editRt' => 'required|string|size:3',
            'editRw' => 'required|string|size:3',
            'editDusun' => 'required|string|size:3',
            'editNamaLengkap' => 'required|string|max:100',
            'editAgama' => 'nullable|string|max:20',
            'editStatusPerkawinan' => 'nullable|string|max:20',
            'editPekerjaan' => 'nullable|string|max:50',
            'editNoKk' => 'nullable|string|size:16|unique:penduduk,no_kk,' . $this->selectedPenduduk,
            'editEmail' => 'required|email|max:100|unique:penduduk,email,' . $this->selectedPenduduk,
            'editPassword' => 'nullable|string|min:6',
            'editStatus' => 'required|in:aktif,pindah,meninggal',
        ]);

        $penduduk = Penduduk::findOrFail($this->selectedPenduduk);

        $data = [
            'nik' => $this->editNik,
            'nama_lengkap' => $this->editNamaLengkap,
            'tempat_lahir' => $this->editTempatLahir,
            'tanggal_lahir' => $this->editTanggalLahir,
            'jenis_kelamin' => $this->editJenisKelamin,
            'alamat' => $this->editAlamat,
            'rt' => $this->editRt,
            'rw' => $this->editRw,
            'dusun' => $this->editDusun,
            'agama' => $this->editAgama,
            'status_perkawinan' => $this->editStatusPerkawinan,
            'pekerjaan' => $this->editPekerjaan,
            'no_kk' => $this->editNoKk,
            'email' => $this->editEmail,
            'status' => $this->editStatus,
        ];

        if ($this->editPassword) {
            $data['password'] = Hash::make($this->editPassword);
        }

        $penduduk->update($data);

        $this->reset([
            'selectedPenduduk',
            'editNik',
            'editNamaLengkap',
            'editTempatLahir',
            'editTanggalLahir',
            'editJenisKelamin',
            'editAlamat',
            'editRt',
            'editRw',
            'editDusun',
            'editAgama',
            'editStatusPerkawinan',
            'editPekerjaan',
            'editNoKk',
            'editEmail',
            'editPassword',
            'editStatus'
        ]);
        $this->penduduks = Penduduk::all();
        session()->flash('message', 'Data penduduk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();

        $this->penduduks = Penduduk::all();
        session()->flash('message', 'Data penduduk berhasil dihapus.');
    }

    public function cancel()
    {
        $this->reset([
            'selectedPenduduk',
            'editNik',
            'editNamaLengkap',
            'editTempatLahir',
            'editTanggalLahir',
            'editJenisKelamin',
            'editAlamat',
            'editRt',
            'editRw',
            'editDusun',
            'editAgama',
            'editStatusPerkawinan',
            'editPekerjaan',
            'editNoKk',
            'editEmail',
            'editPassword',
            'editStatus'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.penduduk-page');
    }
}
