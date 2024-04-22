<?php

use App\Livewire\SitePages\MainPage;
use App\Livewire\SitePages\PublicAssistant;
use Illuminate\Support\Facades\Route;

Route::get('/', MainPage::class);
Route::get('/asistente', PublicAssistant::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
