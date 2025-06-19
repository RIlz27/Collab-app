<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Users extends Component
{
    public $users;
    public $name = '';
    public $email = '';
    public $password = '';
    public $userId = null;

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::latest()->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(
            ['id' => $this->userId],
            $data
        );

        session()->flash('message', $this->userId ? 'User berhasil diperbarui.' : 'User berhasil ditambahkan.');

        $this->resetForm();
        $this->loadUsers();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        session()->flash('message', 'User berhasil dihapus.');

        $this->resetForm();
        $this->loadUsers();
    }

    public function resetForm()
    {
        $this->reset(['userId', 'name', 'email', 'password']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.user')->layout('layouts.app');
    }
}
