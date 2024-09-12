<div x-data>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateModalLabel">Edit a post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="postUpdate" enctype="multipart/form-data">
    
                <!-- Input File untuk Gambar -->
                <div class="form-group mb-4">
                    <label class="fw-bold">GAMBAR</label>
                    <input wire:model="image" type="file" class="form-control @error('image') is-invalid @enderror">
                    
                    <!-- Jika ada Gambar Sebelumnya, Tampilkan -->
                    @if ($image)
                        <div class="mt-3">
                            <img src="{{ Storage::url('posts/' . $image) }}" alt="Updated Image" width="100" class="d-block mb-2">
                            
                            <!-- Nama file gambar sebelumnya -->
                            <small class="text-muted">{{ $image }}</small>
                        </div>
                    @endif

                    <!-- Pesan Error untuk Gambar -->
                    @error('image')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                    <!-- Input untuk Judul -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">JUDUL</label>
                        <input wire:model="title" type="text" id="titleInput" class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan Judul Post">
                        <!-- Pesan Error untuk Judul -->
                        @error('title')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Dropdown untuk Kategori -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">KATEGORI</label>
                        <select wire:model="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @isset($data_kategori)
                            @foreach ($data_kategori as $kt)
                                <option value="{{ $kt->id }}">{{ $kt->name }}</option>
                            @endforeach
                            @endisset
                            
                        </select>
                        <!-- Pesan Error untuk Kategori -->
                        @error('kategori_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Konten ( CKEDITOR ) --}}
                    <div wire:ignore x-data="{ content: $wire.entangle('content') }" wire:key="editor_edit"
                        @set-content.window="
                           post_content_edit.setData(event.detail.content)
                        "
                        >
                            <label for="content" class="form-label fw-bold">KONTEN</label>
                            <textarea wire:model="content" x-model="content"  id="content_edit" class="form-control @error('content') is-invalid @enderror"></textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" wire:click.prevent="postUpdate">Update</button>
            </div>
        </div>
        </div>
    </div>
    @push('script')
    <script>
        // gunakan variable global untuk parsing dari alpinejs
        let post_content_edit;
        ClassicEditor
            .create(document.querySelector('#content_edit'))
            .then(editor_edit  => {
                post_content_edit = editor_edit
                editor_edit.model.document.on('change:data', () => {
                    @this.set('content', editor_edit.getData());
                })
            });
    </script>
    @endpush
</div>
