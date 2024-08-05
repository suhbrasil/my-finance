<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use App\Models\Account;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $modelLabel = 'Conta';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Conta de Entrada/Saída')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Conta'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->label(false)
                    ->tooltip('Editar')
                    ->modalHeading('Editar Conta')
                    ->modalWidth('lg')
                    ->iconButton()
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(fn (Model $record): array => [
                        'name' => $record->name,
                    ])
                    ->form([
                        TextInput::make('name')->label('Conta de Entrada/Saída')->required(),
                    ])
                    ->action(function (Model $record, array $data): Model {
                        $record->update($data);
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()->iconButton()->modalHeading('Excluir Conta'),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
