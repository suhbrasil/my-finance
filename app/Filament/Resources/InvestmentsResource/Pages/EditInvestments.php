<?php

namespace App\Filament\Resources\InvestmentsResource\Pages;

use App\Filament\Resources\InvestmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvestments extends EditRecord
{
    protected static string $resource = InvestmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
