<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class DynamicCategoryForm extends Component
{
    public $categories = [];
    public $categoriesList = []; 
    
    protected $rules = [
        'categories.*.name' => 'required|string|max:255',
    ];
    
    public function render()
    {
        return view('livewire.dynamic-category-form');
    }

    public function mount()
    {
        $this->categoriesList = Kategori::all();
    }
    
    public function addCategory()
    {
        $this->categories[] = ['name' => ''];
    }
    
    public function removeCategory($index)
    {
        unset($this->categories[$index]);
        $this->categories = array_values($this->categories); // Reindex array
    }

    public function hapus($get_id)
    {
        try {
            Kategori::find($get_id)->delete();
        } catch (\Exception $e) {
            $this->dispatch('sweet-alert', title:'Data Gagal Diubah', icon:'error');
        }
    }
    
    public function saveCategories()
    {
        // Filter untuk mengambil hanya kategori yang tidak kosong
        $this->categories = array_filter($this->categories, function ($category) {
            return !empty($category['name']);
        });

        // Validasi
        $this->validate();
    
        // Simpan setiap kategori yang sudah difilter
        foreach ($this->categories as $category) {
            Kategori::create(['name' => $category['name']]);
        }
    
        // Set pesan sukses dan reset form
        session()->flash('message', 'Kategori berhasil disimpan!');
        $this->categories = [];
        $this->categoriesList = Kategori::all(); 
    }
}
