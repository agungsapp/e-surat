<?php

namespace App\Livewire\Admin;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BannerPage extends Component
{
    use WithFileUploads;

    public $banners;
    public $keterangan;
    public $path;
    public $selectedBanner = null;
    public $editKeterangan;
    public $editPath;
    public $newImage;

    public function mount()
    {
        $this->banners = Banner::all();
    }

    public function create()
    {
        $this->validate([
            'keterangan' => 'required|string|max:255',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imageName = time() . '.' . $this->path->getClientOriginalExtension();
        $this->path->storeAs('banner', $imageName, 'public');

        Banner::create([
            'keterangan' => $this->keterangan,
            'path' => 'banner/' . $imageName,
        ]);

        $this->reset(['keterangan', 'path']);
        $this->banners = Banner::all();
        session()->flash('message', 'Banner berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $this->selectedBanner = $id;
        $this->editKeterangan = $banner->keterangan;
        $this->editPath = $banner->path;
    }

    public function update()
    {
        $this->validate([
            'editKeterangan' => 'required|string|max:255',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $banner = Banner::findOrFail($this->selectedBanner);

        $data = ['keterangan' => $this->editKeterangan];

        if ($this->newImage) {
            // Hapus gambar lama
            if ($banner->path) {
                Storage::disk('public')->delete($banner->path);
            }
            $imageName = time() . '.' . $this->newImage->getClientOriginalExtension();
            $this->newImage->storeAs('banner', $imageName, 'public');
            $data['path'] = 'banner/' . $imageName;
        }

        $banner->update($data);

        $this->reset(['selectedBanner', 'editKeterangan', 'editPath', 'newImage']);
        $this->banners = Banner::all();
        session()->flash('message', 'Banner berhasil diperbarui.');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->path) {
            Storage::disk('public')->delete($banner->path);
        }
        $banner->delete();

        $this->banners = Banner::all();
        session()->flash('message', 'Banner berhasil dihapus.');
    }

    public function cancel()
    {
        $this->reset(['selectedBanner', 'editKeterangan', 'editPath', 'newImage']);
    }

    public function render()
    {
        return view('livewire.admin.banner-page');
    }
}
