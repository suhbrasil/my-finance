<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestmentsResource\Pages;
use App\Filament\Resources\InvestmentsResource\RelationManagers;
use App\Filament\Resources\InvestmentsResource\Widgets\InvestmentsOverview;
use App\Models\Release;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestmentsResource extends Resource
{
    protected static ?string $model = Release::class;

    protected static ?string $modelLabel = 'Investimento';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvestments::route('/'),
            'create' => Pages\CreateInvestments::route('/create'),
            'edit' => Pages\EditInvestments::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            InvestmentsOverview::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
    }
}
