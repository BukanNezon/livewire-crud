<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PostTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    protected $paginationTheme = 'bootstrap';

    public $post_id;
    public $paginate = 5;
    public $image;
    public $title;
    public $content;
    public $kategori;
    public $search;
    public $existingImage;
    
    #[On('xxx')] 
    public function render()
    {   
        if(!$this->search) {
            $posts = Post::latest()->paginate($this->paginate);
        } else {
            $posts = Post::where('title', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        }
    
        return view('livewire.post-table', [
            'posts' => $posts,
        ]);
    }

    // Stock Aja 
    // protected $rules = [
    //     'image' => 'nullable|image|max:1024',
    //     'title' => 'required|string|max:255',
    //     'content' => 'required|string',
    //     'kategori' => 'required|string',
    // ];

    public function hapus($get_id)
    {
        try {
            $post = Post::find($get_id);
            
            if ($post) {
                // Hapus file dari local storage
                $filePath = 'public/posts/' . $post->image;

                if(Storage::exists($filePath)) {
                    Storage::delete($filePath);
                } 
            }

            $post->delete();

        } catch (\Exception $e) {
            $this->dispatch('sweet-alert', title:'Data Gagal Diubah', icon:'error');
        }
    }
}
