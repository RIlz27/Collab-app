<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Listings extends Component
{
    use WithPagination, WithFileUploads;

    public $title, $images = [], $description, $price, $listing_id, $category_id, $location_id, $name, $sms, $phone, $whatsapp;
    public $isEditing = false;
    public $produkPerLokasi = 0;
    public $produkPerKategori = 0;


    protected $rules = [
        'title' => 'required|string|min:3',
        'images' => 'required|array|min:1|max:3',
        'images.*' => 'image|max:1024',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'location_id' => 'required|exists:locations,id',
        'name' => 'required|string|min:3',
        'sms' => 'nullable|string',
        'phone' => 'nullable|string',
        'whatsapp' => 'nullable|string',
    ];

    public function resetInput()
    {
        $this->reset([
            'title',
            'description',
            'price',
            'category_id',
            'location_id',
            'listing_id',
            'name',
            'sms',
            'phone',
            'whatsapp',
            'images',
            'isEditing'
        ]);
        $this->resetValidation();
    }

    public function kontakValid()
    {
        return $this->sms || $this->phone || $this->whatsapp;
    }

    public function store()
    {
        $this->validate();

        if (!$this->kontakValid()) {
            $this->addError('kontak', 'Minimal salah satu kontak (SMS, Telepon, atau WhatsApp) harus diisi.');
            return;
        }

        $listing = Listing::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'name' => $this->name,
            'sms' => $this->sms,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
        ]);

        foreach ($this->images as $img) {
            $path = $img->store('listings', 'public');
            $listing->images()->create(['path' => $path]);
        }

        $this->resetInput();
        session()->flash('message', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $listing = Listing::findOrFail($id);

        $this->listing_id = $listing->id;
        $this->title = $listing->title;
        $this->description = $listing->description;
        $this->price = $listing->price;
        $this->category_id = $listing->category_id;
        $this->location_id = $listing->location_id;
        $this->name = $listing->name;
        $this->sms = $listing->sms;
        $this->phone = $listing->phone;
        $this->whatsapp = $listing->whatsapp;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        if (!$this->kontakValid()) {
            $this->addError('kontak', 'Minimal salah satu kontak (SMS, Telepon, atau WhatsApp) harus diisi.');
            return;
        }

        $listing = Listing::findOrFail($this->listing_id);
        $listing->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'name' => $this->name,
            'sms' => $this->sms,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
        ]);

        // (Optional) tambahkan logika upload gambar baru di update jika perlu

        $this->resetInput();
        session()->flash('message', 'Produk berhasil diperbarui!');
    }

    public function updatedLocationId($value)
    {
        $this->produkPerLokasi = Listing::where('location_id', $value)->count();
    }

    public function updatedCategoryId($value)
    {
        $this->produkPerKategori = Listing::where('category_id', $value)->count();
    }


    public function destroy($id)
    {
        Listing::destroy($id);
        session()->flash('message', 'Produk berhasil dihapus!');
    }

    
    public function render()
    {
        return view('livewire.listings', [
            'categories' => \App\Models\Category::all(),
            'locations' => \App\Models\Location::all(),
            'listings' => Listing::latest()->with(['category', 'location'])->paginate(10),
        ])->layout('layouts.app');
    }
}