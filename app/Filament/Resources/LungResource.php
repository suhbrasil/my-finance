<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LungResource\Pages;
use App\Models\Lung;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Filament\Tables;


class LungResource extends Resource
{
    protected static ?string $model = Lung::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $modelLabel = 'Pulmão';

    protected static ?string $pluralModelLabel = 'Pulmões';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nome do pulmão')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Pulmão')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->label(false)
                    ->tooltip('Editar')
                    ->modalHeading('Editar Pulmão')
                    ->modalWidth('lg')
                    ->iconButton()
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(fn (Model $record): array => [
                        'name' => $record->name,
                    ])
                    ->form([
                        TextInput::make('name')->label('Pulmão')->required()
                    ])
                    ->action(function (Model $record, array $data): Model {
                        $record->update($data);
                        return $record;
                    })
                    ->hidden(fn ($record) => $record->name == 'Investimentos'),
                Tables\Actions\DeleteAction::make()
                    ->label(false)
                    ->tooltip('Excluir')
                    ->iconButton()
                    ->modalHeading('Excluir Pulmão')
                    ->hidden(fn ($record) => $record->name == 'Investimentos'),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListLungs::route('/'),
            'create' => Pages\CreateLung::route('/create'),
        ];
    }
}
