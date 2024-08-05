<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $modelLabel = 'Categoria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nome da categoria')->required(),
                Select::make('lung_id')->label('Pulmão')->required()
                    ->relationship('lung', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Categoria'),
                TextColumn::make('lung.name')->label('Pulmão')

            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->label(false)
                    ->tooltip('Editar')
                    ->modalHeading('Editar Categoria')
                    ->modalWidth('lg')
                    ->iconButton()
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(fn (Model $record): array => [
                        'lung_id' => $record->lung_id,
                        'name' => $record->name,
                    ])
                    ->form([
                        TextInput::make('name')->label('Nome da categoria')->required(),
                        Select::make('lung_id')->label('Pulmão')->required()
                            ->relationship('lung', 'name'),
                    ])
                    ->action(function (Model $record, array $data): Model {
                        $record->update($data);
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()->iconButton()->modalHeading('Excluir Categoria'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
