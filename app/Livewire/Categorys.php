<?php
namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categorys extends Component
{
    use WithPagination;

    public $name, $parent_id, $category_id;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|min:2',
        'parent_id' => 'nullable|exists:Category,id',
    ];

    public function render()
    {
        return view('livewire.category', [
            'category' => Category::latest()->paginate(5),
            'parents' => Category::whereNull('parent_id')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();
        Category::create(['name' => $this->name, 'parent_id' => $this->parent_id]);
        $this->resetInput();
        session()->flash('message', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();
        Category::findOrFail($this->Category_id)->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);
        $this->resetInput();
        session()->flash('message', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->parent_id = null;
        $this->category_id = null;
        $this->isEditing = false;
    }
}
