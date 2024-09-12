<?php

use App\Livewire\DynamicCategoryForm;
use App\Livewire\PostIndex;
use Illuminate\Support\Facades\Route;

//posts index
// Route::get('/', App\Livewire\Posts\Index::class)->name('posts.index');
Route::get('/', PostIndex::class)->name('posts.index');

//posts create
Route::get('/create', App\Livewire\Posts\Create::class)->name('posts.create');

//posts edit
Route::get('/edit/{id}', App\Livewire\Posts\Edit::class)->name('posts.edit');

Route::get('/kategori', DynamicCategoryForm::class)->name('kategori.tambah');