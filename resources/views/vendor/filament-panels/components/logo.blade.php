@if (Route::current()->getName() === 'filament.admin.auth.login' ||
        Route::current()->getName() === 'filament.admin.auth.register' ||
        Route::current()->getName() === 'filament.admin.auth.email-verification.prompt' ||
        Route::current()->getName() === 'filament.admin.auth.login')
<img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}"
title="{{ config('app.name') }}" width="185" style="padding-bottom: 15px">
@else
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}"
        title="{{ config('app.name') }}" width="155">
@endif
