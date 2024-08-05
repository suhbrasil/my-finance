<?php

namespace App\Filament\Resources\ReleaseResource\Pages;

use App\Filament\Resources\ReleaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRelease extends CreateRecord
{
    protected static string $resource = ReleaseResource::class;

    public function getHeading(): string
    {
        return __('Criar Lançamento');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
