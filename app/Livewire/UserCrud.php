<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserCrud extends Component
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'password' => $this->userId ? 'nullable|string|min:6' : 'required|string|min:6',
            ]);

            $data = [
                'name' => $this->name,
                'email' => $this->email,
            ];

            if($this->password) {
                $data['password'] = $this->password;
            }

            User::updatedOrCreate(
                ['id' => $this->userId],
                $data
            );

            $this->resetform();
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
        User::destroy($id);
        $this->loadUsers();
    }

    public function resetform()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.user-crud');
    }
}
