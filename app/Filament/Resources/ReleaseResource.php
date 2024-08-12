<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReleaseResource\Pages;
use App\Models\Category;
use App\Models\Account;
use App\Models\Release;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Leandrocfe\FilamentPtbrFormFields\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReleaseResource extends Resource
{
    protected static ?string $model = Release::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $modelLabel = 'Lançamento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')
                        ->label('Data')
                        ->required()
                        ->native(false),

                TextInput::make('description')
                        ->label('Descrição'),

                Select::make('category_id')->label('Categoria')
                    ->required()
                    ->reactive()
                    ->options(function () {
                        return Category::where('user_id', Auth::id())->pluck('name', 'id');
                    }),

                Select::make('lung_id')
                    ->label('Pulmão')
                    ->required()
                    ->options(function (callable $get) {
                        $categoryId = $get('category_id');
                        if ($categoryId) {
                            $category = DB::table('categories')->where('id', $categoryId)->first();
                            if ($category) {
                                return DB::table('lungs')
                                    ->where('id', $category->lung_id)
                                    ->where('user_id', Auth::id()) // Filter by current user
                                    ->pluck('name', 'id');
                            }
                        }
                        return [];
                    }),

                Select::make('account_id')
                    ->label('Conta de Entrada/Saída')
                    ->required()
                    ->options(function () {
                        return Account::where('user_id', Auth::id())->pluck('name', 'id');
                    }),

                Money::make('value')
                    ->label('Valor')
                    ->required(),

                Radio::make('deposit')
                    ->label('Tipo de lançamento')
                    ->boolean()
                    ->options([
                        1 => 'Entrada',
                        0 => 'Saída',
                    ])
                    ->inline()
                    ->inlineLabel(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->label('Data')->dateTime('d/m/Y'),
                TextColumn::make('category.name')->label('Categoria'),
                TextColumn::make('description')->label('Descrição'),
                TextColumn::make('lung.name')->label('Pulmão'),
                TextColumn::make('account.name')->label('Conta'),
                TextColumn::make('value')->label('Valor')
                    ->formatStateUsing(function (string $state, $record) {
                        if ($record->deposit)
                            return 'R$ ' . number_format(($state), 2, ',', '.');
                        return '- R$ ' . number_format(($state), 2, ',', '.');
                    }),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (Auth::user()->role === 'user') {
                    return $query->where('user_id', Auth::id());
                }
            })
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->label(false)
                    ->tooltip('Editar')
                    ->modalHeading('Editar Lançamento')
                    ->modalWidth('2xl')
                    ->iconButton()
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(fn (Model $record): array => [
                        'date' => $record->date,
                        'category_id' => $record->category_id,
                        'description' => $record->description,
                        'lung_id' => $record->lung_id,
                        'account_id' => $record->account_id,
                        'value' => $record->value,
                        'deposit' => $record->deposit,
                    ])
                    ->form([
                        DatePicker::make('date')->label('Data')->required()->native(false),
                        Select::make('category_id')->label('Categoria')->required()
                            ->relationship('category', 'name'),
                        TextInput::make('description')->label('Descrição'),
                        Select::make('lung_id')->label('Pulmão')->required()
                            ->relationship('lung', 'name'),
                        Select::make('account_id')->label('Conta de Entrada/Saída')->required()
                            ->relationship('account', 'name'),
                        Money::make('value')->label('Valor')->required(),
                        Radio::make('deposit')
                            ->label('Tipo de lançamento')
                            ->boolean()
                            ->options([
                                1 => 'Entrada',
                                0 => 'Saída',
                            ])
                            ->inline()
                            ->inlineLabel(false)
                            ->required(),
                    ])
                    ->action(function (Model $record, array $data): Model {
                        $record->update($data);
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()->iconButton()->modalHeading('Excluir Lançamento')->label(false)->tooltip('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReleases::route('/'),
            'create' => Pages\CreateRelease::route('/create'),
            'edit' => Pages\EditRelease::route('/{record}/edit'),
        ];
    }
}
