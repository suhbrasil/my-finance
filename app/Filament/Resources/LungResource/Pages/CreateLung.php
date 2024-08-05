<?php

namespace App\Filament\Resources\LungResource\Pages;

use App\Filament\Resources\LungResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLung extends CreateRecord
{
    protected static string $resource = LungResource::class;

    public function getHeading(): string
    {
        return __('Criar Pulmão');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
