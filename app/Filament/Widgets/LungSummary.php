<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Illuminate\Contracts\View\View;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LungSummary extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'orderStatusChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Pulmões';

    /**
     * Sort
     */
    protected static ?int $sort = 2;

    /**
     * Widget content height
     */
    protected static ?int $contentHeight = 275;

    /**
     * Widget Footer
     */
    // protected function getFooter(): string | View
    // {
    //     $data = [
    //         'new' => 230,
    //         'delivered' => 890,
    //         'cancelled' => 54,
    //     ];

    //     return view('charts.order-status.footer', ['data' => $data]);
    // }

    /**
     * Fetch and sum values for each month of the year for all lung_ids.
     *
     * @return array
     */
    protected function getMonthlySums(): array
    {
        $startDate = Carbon::parse($this->filterFormData['date_start']);
        $endDate = Carbon::parse($this->filterFormData['date_end']);

        // Get all lung_ids
        $lungIds = DB::table('releases')
            ->distinct()
            ->pluck('lung_id');

        $monthlySums = [];

        foreach ($lungIds as $lungId) {
            $lungName = DB::table('lungs')->where('id', $lungId)->first()->name;

            $monthlyData = DB::table('releases')
                ->select(DB::raw('MONTH(date) as month'), DB::raw('YEAR(date) as year'), DB::raw('SUM(CASE WHEN deposit THEN value ELSE -value END) as total'))
                ->where('lung_id', $lungId)
                ->whereBetween('date', [$startDate, $endDate])
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->pluck('total', 'month')
                ->toArray();

            $data = array_fill(1, 12, 0); // Fill array with zeros for all months
            foreach ($monthlyData as $month => $total) {
                $data[$month] = $total;
            }

            $monthlySums[$lungName] = array_values($data);
        }

        return $monthlySums;
    }

    /**
     * Filter Form
     */
    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->label('Data de início')
                ->default(now()->subYear()->startOfMonth()),
            DatePicker::make('date_end')
                ->label('Data de fim')
                ->default(now()->endOfMonth()),
        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {


        $series = [];

        foreach ($this->getMonthlySums() as $key => $value) {
            $series[] = [
                'name' => $key,
                'data' => [$value[0], $value[1], $value[2], $value[3], $value[4], $value[5], $value[6], $value[7], $value[8], $value[9], $value[10], $value[11]],
            ];

            $colors[] = $this->generateColorFromString($key);
        }
        // dump($colors);

        $chart = [
            'chart' => [
                'type' => 'bar',
                'height' => 250,
                'stacked' => true,
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'series' => $series,
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 2,
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                'labels' => [
                    'style' => [
                        'fontWeight' => 400,
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontWeight' => 400,
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'fill' => [
                'type' => 'solid',
            ],

            'dataLabels' => [
                'enabled' => false,
            ],
            'grid' => [
                'show' => true,
            ],
            'markers' => [
                'size' => 3,
            ],
            'tooltip' => [
                'enabled' => true,
            ],
            'stroke' => [
                'width' => 0,
            ],
            'colors' => $colors,
            // 'annotations' => [
            //     'yaxis' => [
            //         [
            //             'y' => 7500,
            //             'borderColor' => '#ef4444',
            //             'borderWidth' => 1,
            //             'label' => [
            //                 'borderColor' => '#ef4444',
            //                 'style' => [
            //                     'color' => '#fffbeb',
            //                     'background' => '#ef4444',
            //                 ],
            //                 'text' => 'Annotation: ' . 7500,
            //             ],
            //         ],
            //     ],
            // ],
        ];
        return $chart;
    }

    protected function generateColorFromString($string): string
    {
        // Gera um hash MD5 da string e usa os primeiros 6 caracteres como cor hexadecimal
        return '#' . substr(md5($string), 0, 6);
    }
}
