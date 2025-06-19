<div class="max-w-4xl mx-auto p-4 space-y-6">

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="bg-white p-4 rounded shadow space-y-4">
        <h2 class="text-lg font-semibold">{{ $userId ? 'Edit User' : 'Tambah User' }}</h2>

        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" wire:model.defer="name" class="w-full border rounded p-2" />
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" wire:model.defer="email" class="w-full border rounded p-2" />
            @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Password {{ $userId ? '(Kosongkan jika tidak ingin diubah)' : '' }}</label>
            <input type="password" wire:model.defer="password" class="w-full border rounded p-2" />
            @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                {{ $userId ? 'Update' : 'Simpan' }}
            </button>
            @if($userId)
                <button type="button" wire:click="resetForm" class="text-sm text-gray-600 underline">Batal</button>
            @endif
        </div>
    </form>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">Daftar User</h2>

        <table class="w-full text-left border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $i => $user)
                    <tr>
                        <td class="p-2 border">{{ $i + 1 }}</td>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border space-x-2">
                            <button wire:click="edit({{ $user->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $user->id }})" class="text-red-600 hover:underline" onclick="confirm('Yakin hapus user ini?') || event.stopImmediatePropagation()">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">Belum ada user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
