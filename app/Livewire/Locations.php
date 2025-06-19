<?php
namespace App\Livewire;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class Locations extends Component
{
    use WithPagination;

    public $name, $parent_id, $location_id;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|min:2',
        'parent_id' => 'nullable|exists:location,id',
    ];

    public function render()
    {
        return view('livewire.Location-crud', [
            'location' => Location::latest()->paginate(5),
            'parents' => Location::whereNull('parent_id')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();
        Location::create(['name' => $this->name, 'parent_id' => $this->parent_id]);
        $this->resetInput();
        session()->flash('message', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $this->location_id = $location->id;
        $this->name = $location->name;
        $this->parent_id = $location->parent_id;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();
        Location::findOrFail($this->location_id)->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);
        $this->resetInput();
        session()->flash('message', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Location::destroy($id);
        session()->flash('message', 'Lokasi berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->parent_id = null;
        $this->location_id = null;
        $this->isEditing = false;
    }
}
