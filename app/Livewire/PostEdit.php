<?php

namespace App\Livewire;

use App\Models\Kategori;
use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostEdit extends Component
{
    use WithFileUploads;

    public Post $post;

    // #[Validate('image', message: 'File Harus Gambar')]
    // #[Validate('max:1024', message: 'Ukuran File Maksimal 1MB')]
    public $image;

    #[Validate('required', message: 'Masukkan Judul Post')]
    public $title;

    #[Validate('required', message: 'Masukkan Isi Post')]
    #[Validate('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $content = '<p></p>';

    #[Validate('nullable', message: 'Pilih Kategori')]
    public $kategori_id;

    public $image_db;

    #[On('postEdit')]
    public function load_data(Post $post)
    {
        $this->post = $post;
        $this->image = $post->image;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->kategori_id = $post->kategori_id;

        $this->image_db = $post->image;

        $this->dispatch('set-content', content: $this->content);
    }

    public function postUpdate()
    {
        $validate = $this->validate();

        if ($this->image != $this->image_db) {
            $this->image->storeAs('public/posts', $this->image->hashName());
            $this->post->image = $this->image->hashName();
            Storage::delete('public/posts/' . $this->image_db);
        }

        try {
            $data = [
                'title' => $this->title,
                'content' => $this->content,
                'kategori_id' => $this->kategori_id, // Assign selected category to the post
            ];

            if (isset($this->image)) {
                $data['image'] = $this->post->image;
            }

            $this->post->update($data);

            $this->dispatch('xxx');
            $this->dispatch('sweet-alert', title: 'Data Berhasil Disimpan', icon: 'success');
        } catch (\Throwable $th) {
            $this->dispatch('sweet-alert', title: 'Data Gagal Disimpan', icon: 'error');
        }
    }

    public function render()
    {
        return view('livewire.post-edit', [
            'data_kategori' => Kategori::all(),
        ]);
    }
}
