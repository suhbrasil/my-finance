<?php

namespace App\Filament\Resources\InvestmentsResource\Widgets;

use App\Models\Category;
use App\Models\Release;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InvestmentsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $categoryName = [];
        $stats = [];
        $chatGrowth = [];

        foreach (Release::get()->where('lung_id', 5) as $key => $release) {
            $categoryName[$release->category_id] = Category::findOrFail($release->category_id)->name;

            $chatGrowth[$release->category_id][] = $release->value;

            if (isset($value[$release->category_id]) && $release->deposit)
                    $value[$release->category_id] += $release->value;
            elseif($release->deposit)
                $value[$release->category_id] = $release->value;
        }

        foreach ($categoryName as $key => $name) {
            $stats[] = Stat::make($name, 'R$ ' . number_format(($value[$key]), 2, ',', '.'))
                ->description('Seu crescimento')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($chatGrowth[$key]);
        }
        return $stats;
    }
}
