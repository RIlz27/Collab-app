<div class="max-w-3xl mx-auto space-y-6">
    <!-- Form Tambah/Edit -->
    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="space-y-4 bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold mb-2">{{ $isEditing ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>

        <div>
            <label class="block text-sm font-medium">Nama Kategori</label>
            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2" placeholder="Contoh: Elektronik">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Induk Kategori (opsional)</label>
            <select wire:model="parent_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Tidak Ada --</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
            @error('parent_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEditing ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>

    <!-- Tabel Data -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold mb-2">Daftar Kategori</h2>

        <table class="w-full text-sm text-left border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 border">Nama</th>
                    <th class="px-3 py-2 border">Induk</th>
                    <th class="px-3 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $cat)
                    <tr>
                        <td class="px-3 py-2 border">{{ $cat->name }}</td>
                        <td class="px-3 py-2 border">{{ $cat->parent?->name ?? '-' }}</td>
                        <td class="px-3 py-2 border text-center">
                            <button wire:click="edit({{ $cat->id }})"
                                class="text-blue-600 hover:underline mr-2">Edit</button>
                            <button wire:click="destroy({{ $cat->id }})"
                                class="text-red-600 hover:underline"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-3 py-2 text-center text-gray-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
