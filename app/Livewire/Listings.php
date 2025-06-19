<?php
namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class ListingCrud extends Component
{
    use WithPagination;

    public $title, $description, $price, $listing_id;
    public $isEditing = false;

    protected $rules = [
        'title' => 'required|string|min:3',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
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
        ]);

        $this->resetInput();
        session()->flash('message', 'Iklan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        $this->listing_id = $listing->id;
        $this->title = $listing->title;
        $this->description = $listing->description;
        $this->price = $listing->price;
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
        ]);

        $this->resetInput();
        session()->flash('message', 'Iklan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Listing::destroy($id);
        session()->flash('message', 'Iklan berhasil dihapus!');
    }
}
