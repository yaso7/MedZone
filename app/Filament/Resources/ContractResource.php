<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractResource\Pages;
use App\Filament\Resources\ContractResource\RelationManagers;
use App\Models\Contract;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('السعر')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->label('الحالة')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('offers_and_notes')
                    ->label('العروض و الملاحظات')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('expires_at')
                    ->label('تنتهي في ')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم'),
                Tables\Columns\TextColumn::make('price')
                    ->label('السعر'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة'),
                Tables\Columns\TextColumn::make('products')
                    ->label('المنتجات'),
                Tables\Columns\TextColumn::make('offers_and_notes')
                    ->label('العروض و الملاحظات'),
                Tables\Columns\TextColumn::make('expires_at')
                    ->label('تنتهي في')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تم انشاءها')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تم تعديلها')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListContracts::route('/'),
            'create' => Pages\CreateContract::route('/create'),
            'view' => Pages\ViewContract::route('/{record}'),
            'edit' => Pages\EditContract::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
