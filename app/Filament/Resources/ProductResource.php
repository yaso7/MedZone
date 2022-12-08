<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->numeric()
                    ->maxLength(4),
                Forms\Components\Textarea::make('english_desc')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('arabic_desc')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('product_line')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('brand_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('manufacturer')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_of_origin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'in_stock' => 'in stock',
                        'out_of_stock' => 'out of stock',
                    ])
                    ->default('in_stock'),
                Forms\Components\Select::make('type')
                    ->options([
                        'lab' => 'lab',
                        'pharmacy' => 'pharmacy',
                        'dentist' => 'dentist',
                    ])
                    ->default('lab'),
                Forms\Components\Select::make('top_category_id')
                    ->relationship('top_category', 'name')
                    ->required(),
                Forms\Components\Select::make('vendor_id')
                    ->relationship('vendor', 'name')
                    ->required(),
                Forms\Components\Select::make('contract_id')
                    ->relationship('contract', 'name')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->directory('ProductResource/image'),
                Forms\Components\FileUpload::make('manufacturer_logo')
                    ->directory('ProductResource/logos'),
                Forms\Components\FileUpload::make('pdf')
                    ->directory('ProductResource/pdf'),
                Forms\Components\TextInput::make('url')
                    ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('arabic_desc'),
                Tables\Columns\TextColumn::make('english_desc'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('product_line')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('manufacturer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('manufacturer_logo')
                    ->square(),
                Tables\Columns\ImageColumn::make('image')
                    ->square(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_of_origin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('TopCategory.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('vendor.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
