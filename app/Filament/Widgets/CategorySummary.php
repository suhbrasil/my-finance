<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\Select;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CategorySummary extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'categorySummary';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Gastos por Categoria';

    /**
     * Sort
     */
    protected static ?int $sort = 3;

    /**
     * Widget content height
     */
    protected static ?int $contentHeight = 275;

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $lung = $this->filterFormData['lung'];

        $categories = $this->getCategories();
        $labels = [];
        $series = [];

        foreach ($categories as $key => $value) {
            if ($value[1] == $lung || !isset($lung)) {
                $labels[] = $key;
                $series[] = $value[0];
            }
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $series,
            'labels' => $labels,
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }

    public function getCategories()
    {
        $categoriesData = DB::table('releases')
            ->where('user_id', auth()->user()->id)
            ->select('category_id', DB::raw("
            SUM(value) as total_value
        "))
            ->whereBetween('date', [now()->startOfYear(), now()])
            ->where('deposit', false)
            ->groupBy('category_id')
            ->get();

        $categories = [];
        foreach ($categoriesData as $category) {
            $getCategory = DB::table('categories')->where('id', $category->category_id)->first();

            $categories[$getCategory->name] = [$category->total_value, $getCategory->lung_id];
        }
        return $categories;
    }

    /**
     * Filter Form
     */
    protected function getFormSchema(): array
    {
        $categories = $this->getCategories();
        $lungsOptions = [];

        foreach ($categories as $key => $value) {
            $lungId = $value[1];
            $lungName = DB::table('lungs')->where('id', $lungId)->first()->name;

            if (!isset($lungsOptions[$lungId])) {
                $lungsOptions[$lungId] = $lungName;
            }
        }

        return [
            Select::make('lung')
                ->label('Pulmão')
                ->options($lungsOptions)
                ->native(false),
        ];
    }


    protected function extraJsOptions(): ?RawJs
    {
        return RawJs::make(<<<'JS'
        {
            xaxis: {
                labels: {
                    formatter: function (val, timestamp, opts) {
                        return val
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (val, index) {
                        return 'R$' + val
                    }
                }
            },
            tooltip: {
                x: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }
    JS);
    }
}
