<?php

namespace App\Filament\Resources\InvestmentsResource\Pages;

use App\Filament\Resources\InvestmentsResource;
use App\Filament\Resources\InvestmentsResource\Widgets\InvestmentsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvestments extends ListRecords
{
    protected static string $resource = InvestmentsResource::class;


    protected function getHeaderWidgets(): array {
        return [
            InvestmentsOverview::class,
        ];
    }
}
