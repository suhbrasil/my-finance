<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;

Route::get('/', LandingPage::class)->name('landing-page');
