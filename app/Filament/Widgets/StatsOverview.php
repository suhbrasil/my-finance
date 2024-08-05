<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Categorias', Category::count())
                ->url(CategoryResource::getUrl('create'))
                ->description('Crie mais categorias')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
        ];
    }
}
