<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class PostIndex extends Component
{
    #[Title('Data Posts - Belajar Livewire 3 di SantriKoding.com')]
    public function render()
    {
        return view('livewire.post-index');
    }
}