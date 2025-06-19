<div class="max-w-5xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">{{ $isEditing ? 'Edit' : 'Tambah' }} Listing</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Judul -->
            <div>
                <label class="block">Judul</label>
                <input type="text" wire:model.defer="title" class="w-full border rounded px-3 py-2">
                @error('title')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label class="block">Harga</label>
                <input type="number" wire:model.defer="price" class="w-full border rounded px-3 py-2">
                @error('price')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block">Kategori</label>
                <select wire:model.defer="category_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block">Lokasi</label>
                <select wire:model.defer="location_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach ($locations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="col-span-2">
                <label class="block">Deskripsi</label>
                <textarea wire:model.defer="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                @error('description')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div class="col-span-2">
                <label class="block">Upload Gambar (maks. 3 gambar)</label>
                <input type="file" wire:model="images" multiple class="w-full border rounded px-3 py-2"
                    accept="image/*">
                @error('images')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
                @error('images.*')
                    <span class="text-red-600 block">{{ $message }}</span>
                @enderror

                <div class="flex flex-wrap gap-4 mt-2">
                    @if ($images)
                        @foreach ($images as $img)
                            @if ($img instanceof \Livewire\TemporaryUploadedFile)
                                <img src="{{ $img->temporaryUrl() }}" class="w-24 h-24 object-cover border rounded">
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block">Nama Pemilik</label>
                    <input type="text" wire:model.defer="name" class="w-full border rounded px-3 py-2">
                    @error('name')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block">SMS</label>
                    <input type="text" wire:model.defer="sms" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block">Telepon</label>
                    <input type="text" wire:model.defer="phone" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block">WhatsApp</label>
                    <input type="text" wire:model.defer="whatsapp" class="w-full border rounded px-3 py-2">
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ $isEditing ? 'Update' : 'Simpan' }}
            </button>
            @if ($isEditing)
                <button type="button" wire:click="resetInput" class="ml-2 text-gray-600 hover:underline">Batal</button>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <h3 class="text-xl font-bold mb-2">Daftar Listings</h3>

    <table class="min-w-full border divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2">Judul</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Lokasi</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listings as $list)
                <tr class="bg-white">
                    <td class="px-4 py-2">{{ $list->title }}</td>
                    <td class="px-4 py-2">{{ $list->category->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $list->location->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ number_format($list->price, 0, ',', '.') }} {{ $list->currency }}</td>
                    <td class="px-4 py-2">
                        <button wire:click="edit({{ $list->id }})"
                            class="text-blue-600 hover:underline">Edit</button>
                        <button wire:click="destroy({{ $list->id }})"
                            class="text-red-600 hover:underline ml-2">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $listings->links() }}</div>
</div>
