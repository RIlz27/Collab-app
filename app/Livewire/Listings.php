<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class Listings extends Component
{
    use WithPagination;

    public $title, $description, $price, $listing_id, $category_id, $location_id;
    public $isEditing = false;

    protected $rules = [
        'title' => 'required|string|min:3',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'location_id' => 'required|exists:locations,id',
    ];

    public function render()
    {
        return view('livewire.listing-crud', [
            'listings' => Listing::latest()->paginate(5),
        ]);
    }

    public function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category_id = null;
        $this->location_id = null;
        $this->listing_id = null;
        $this->isEditing = false;
    }


    public function store()
    {
        $this->validate();

        Listing::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
        ]);

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
        $this->isEditing = true;
    }


    public function update()
    {
        $this->validate();

        $listing = Listing::findOrFail($this->listing_id);
        $listing->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
        ]);

        $this->resetInput();
        session()->flash('message', 'Produk berhasil diperbarui!');
    }


    public function destroy($id)
    {
        Listing::destroy($id);
        session()->flash('message', 'Produk berhasil dihapus!');
    }
}
