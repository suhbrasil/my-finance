<?php

namespace App\Filament\Widgets;

use App\Models\Release;
use Filament\Support\RawJs;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FinancialSummary extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'revenueChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Resumo financeiro';

    /**
     * Sort
     */
    protected static ?int $sort = 1;

    /**
     * Widget content height
     */
    protected static ?int $contentHeight = 275;

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        $startDate = Carbon::parse($this->filterFormData['date_start']);
        $endDate = Carbon::parse($this->filterFormData['date_end']);

        $releases = Release::select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(CASE WHEN deposit = 1 THEN value ELSE 0 END) as entrance'),
            DB::raw('SUM(CASE WHEN deposit = 0 THEN -value ELSE 0 END) as exit_value') // Note the negative sign here
        )
            ->where('user_id', auth()->user()->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $categories = [];
        $entranceData = [];
        $exitData = [];

        foreach ($releases as $release) {
            $date = Carbon::createFromDate($release->year, $release->month, 1)->locale('pt_BR');
            $categories[] = ucfirst($date->isoFormat('MMM Y'));
            $entranceData[] = round($release->entrance, 2);
            $exitData[] = round($release->exit_value, 2); // This will now be a negative number
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 260,
                'parentHeightOffset' => 2,
                'stacked' => true,
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'series' => [
                [
                    'name' => 'Entrada',
                    'data' => $entranceData,
                ],
                [
                    'name' => 'Saída',
                    'data' => $exitData,
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '50%',
                ],
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'legend' => [
                'show' => true,
                'horizontalAlign' => 'right',
                'position' => 'top',
                'fontFamily' => 'inherit',
                'markers' => [
                    'height' => 12,
                    'width' => 12,
                    'radius' => 12,
                    'offsetX' => -3,
                    'offsetY' => 2,
                ],
                'itemMargin' => [
                    'horizontal' => 5,
                ],
            ],
            'grid' => [
                'show' => false,
            ],
            'xaxis' => [
                'categories' => $categories,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                    'rotate' => 0, // Keep the labels horizontal
                ],
                'axisTicks' => [
                    'show' => false,
                ],
                'axisBorder' => [
                    'show' => false,
                ],
            ],
            'yaxis' => [
                'offsetX' => -16,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
                'tickAmount' => 5,
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shade' => 'dark',
                    'type' => 'vertical',
                    'shadeIntensity' => 0.5,
                    'gradientToColors' => ['#e879f9', '#a21caf'],
                    'opacityFrom' => 1,
                    'opacityTo' => 1,
                    'stops' => [0, 100],
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 0,
                'lineCap' => 'round',
            ],
            'colors' => ['#f0abfc', '#c026d3'],
        ];
    }

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

    protected function extraJsOptions(): ?RawJs
    {
        return RawJs::make(<<<'JS'
        {
            xaxis: {
                labels: {
                    formatter: function (val, timestamp, opts) {
                        var parts = val.split(' ');
                    return parts[0];
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
