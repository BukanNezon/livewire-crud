<div class="container my-5">
    <!-- Tabel Kategori -->
    <div class="d-flex justify-content-center mb-4">
        <div class="card shadow" style="width: 100%; max-width: 800px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Daftar Kategori</h4>

                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Category</th>
                            <th scope="col" style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categoriesList as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{!! $category->name !!}</td>
                            <td class="text-center">
                                <!-- Button Delete -->
                                <button @click="$dispatch('category-delete', {get_id: '{{ $category->id }}' })" class="btn btn-sm btn-danger">DELETE</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <div class="alert alert-danger mb-0">
                                    Category Not Found
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <x-category-delete />
    </div>

    <!-- Form Tambah Kategori -->
    <div class="d-flex justify-content-center">
        <div class="card shadow" style="width: 100%; max-width: 600px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Tambah Kategori</h4>

                @foreach($categories as $index => $category)
                <div class="form-group d-flex align-items-center mb-2">
                    <input type="text" class="form-control" placeholder="Nama Kategori"
                        wire:model.defer="categories.{{ $index }}.name">
                    <button type="button" class="btn btn-danger ml-2" wire:click="removeCategory({{ $index }})">-</button>
                </div>
                @endforeach

                <!-- Add Category Button -->
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-primary" wire:click="addCategory">Tambah Kategori +</button>
                </div>

                <!-- Save Categories Button, Only Show If Categories Are Added -->
                @if(count($categories) > 0)
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-success" wire:click="saveCategories">Simpan Semua Kategori</button>
                </div>
                @endif

                <!-- Success Message -->
                @if (session()->has('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
