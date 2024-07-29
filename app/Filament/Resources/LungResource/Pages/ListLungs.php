<?php

namespace App\Filament\Resources\LungResource\Pages;

use App\Filament\Resources\LungResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLungs extends ListRecords
{
    protected static string $resource = LungResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
