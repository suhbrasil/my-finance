<?php

namespace App\Filament\Resources\InvestmentsResource\Widgets;

use App\Models\Category;
use App\Models\Release;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class InvestmentsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $categoryName = [];
        $data = [];
        $stats = [];
        $chatGrowth = [];
        $releases = Release::get()->where('lung_id', 1)->where('user_id', auth()->user()->id);

        foreach ($releases as $key => $release) {
            $categoryName[$release->category_id] = Category::findOrFail($release->category_id)->name;

            if ($release->deposit)
                $chatGrowth[$release->category_id][] = $release->value;
            else
                $chatGrowth[$release->category_id][] = -$release->value;

            if (isset($data[$release->category_id])) {
                if ($release->deposit)
                    $data[$release->category_id] += $release->value;
                else
                    $data[$release->category_id] -= $release->value;
            }
            else {
                if ($release->deposit)
                    $data[$release->category_id] = $release->value;
                else
                    $data[$release->category_id] = -$release->value;
            }
        }

        foreach ($categoryName as $key => $name) {
            $stats[] = Stat::make($name, 'R$ ' . number_format(($data[$key]), 2, ',', '.'))
                ->description('Seu crescimento')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($chatGrowth[$key]);
        }
        return $stats;
    }
}
