<div x-data>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
        Tambah Post
    </button>
    <br> <br>
    
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="postModalLabel">Create a post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="store" enctype="multipart/form-data">

                    <label class="fw-bold">GAMBAR</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image">
                    <div class="form-group mb-4">
                        <!-- error message untuk title -->
                        @error('image')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold">JUDUL</label>
                        <input type="text" id="titleInput" class="form-control @error('title') is-invalid @enderror" wire:model="title" placeholder="Masukkan Judul Post">
                        
                        <!-- error message untuk title -->
                        @error('title')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    {{-- Konten Create CKEditor --}}
                    <div wire:ignore x-data="{ content: $wire.entangle('content') }" x-init="$nextTick(() => {
                            ClassicEditor
                                .create(document.querySelector('#content'))
                                .then(editor  => {
                                    window.editorInstance = editor;
                                    editor.model.document.on('change:data', () => {
                                        @this.set('content', editor.getData());
                                    })
                                })
                        })">
                            <label for="content" class="form-label fw-bold">KONTEN</label>
                            <textarea x-model="content" class="form-control @error('content') is-invalid @enderror" id="content"
                                wire:model="content"></textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>

                    {{-- Preview Untuk CKEditor
                    <div class="form-group mb-4">
                        <br>
                        <label class="fw-bold">Preview</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" wire:model="content" rows="5" placeholder="Masukkan Konten Post" disabled></textarea>
                        
                        <!-- error message untuk content -->
                        @error('content')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> 
                    --}}

                    {{-- Kategori --}}
                    <div class="form-group">
                        <br>
                        <label class="fw-bold" for="category">Pilih Kategori</label>
                        <select wire:model="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categoriesList as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary" wire:click.prevent="store">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <script>
        const myModal = document.getElementById('postModal')
        const myInput = document.getElementById('titleInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })

        window.addEventListener('reset-ckeditor', event => {
            if (editorInstance) {
                editorInstance.setData(''); // Kosongkan CKEditor
            }
        });

    //     document.addEventListener('DOMContentLoaded', function() {
    //     window.addEventListener('show-post-modal', event => {
    //         $('#postModal').modal('show');
    //     });

    //     window.addEventListener('hide-modal', event => {
    //         $('#postModal').modal('hide');

    //         if (editor) {
    //             editor.setData('');
    //         }
    //     });
    // });
    </script>
</div>
