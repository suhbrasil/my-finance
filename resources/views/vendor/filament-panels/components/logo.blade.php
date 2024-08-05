<div class="flex items-center">
    @if (Route::current()->getName() === 'filament.admin.auth.login' ||
            Route::current()->getName() === 'filament.admin.auth.register' ||
            Route::current()->getName() === 'filament.admin.auth.email-verification.prompt' ||
            Route::current()->getName() === 'filament.admin.auth.login')
        <img src="{{ asset('images/image.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}"
            width="40" style="padding-bottom: 15px">
        <span class="text-xl font-sans font-bold p-2" style="padding-bottom: 15px"> My Finance </span>
    @else
        <img src="{{ asset('images/image.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}"
            width="40">
        <span class="text-xl font-sans font-bold p-2"> My Finance </span>
    @endif
</div>
