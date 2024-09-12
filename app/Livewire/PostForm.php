<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class PostForm extends Component
{
    use WithFileUploads;

    //image
    #[Validate('image', message: 'File Harus Gambar')]
    #[Validate('max:1024', message: 'Ukuran File Maksimal 1MB')]
    public $image;

    //title
    #[Validate('required', message: 'Masukkan Judul Post')]
    public $title;

    //content
    #[Validate('required', message: 'Masukkan Isi Post')]
    #[Validate('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $content = '';

    #[Validate('nullable', message: 'Pilih Kategori')]
    public $kategori_id;

    /**
     * Render function to pass categories to the view
     *
     * @return void
     */
    public function render()
    {
        $categoriesList = Kategori::all(); // Fetching all categories from Kategori model
        return view('livewire.post-form', [
            'categoriesList' => $categoriesList, // Passing categories list to the view
        ]);
    }

    /**
     * Store function to save the post
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        try {
            // Store image in storage/app/public/posts
            $this->image->storeAs('public/posts', $this->image->hashName());
            
            $data = [
                'image' => $this->image->hashName(),
                'title' => $this->title,
                'content' => $this->content,
                'kategori_id' => $this->kategori_id, // Assign selected category to the post
            ];

            Post::create($data);

            // Reset form fields after saving
            $this->image = NULL;
            $this->title = NULL;
            $this->dispatch('reset-ckeditor');
            $this->kategori_id = NULL;

            $this->dispatch('xxx');
            $this->dispatch('sweet-alert', title: 'Data Berhasil Disimpan', icon: 'success');
            $this->dispatch('editPost');
        } catch (\Throwable $th) {
            $this->dispatch('sweet-alert', title: 'Data Gagal Disimpan', icon: 'error');
        }
    }
}
