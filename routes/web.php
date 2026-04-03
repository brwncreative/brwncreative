<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Security;
use Illuminate\Support\Facades\DB;

Route::livewire('/', 'pages::welcome')->name('home');
Route::livewire('/login', 'pages::login')->name('login');
Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard')->middleware(Security::class);
Route::get('/mail/{type?}', function ($type) {
    if ($type == 'review') {
        return view('mail.review', ['client' => DB::table('clients')->first()]);
    }
})->name('mail');
