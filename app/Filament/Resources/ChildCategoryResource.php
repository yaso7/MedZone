<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildCategoryResource\Pages;
use App\Filament\Resources\ChildCategoryResource\RelationManagers;
use App\Models\ChildCategory;
use App\Models\TopCategory;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Str;

class ChildCategoryResource extends Resource
{

    Use InteractsWithForms;

    protected static ?string $model = ChildCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Categories';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('top_category_id')
                    ->options(TopCategory::all()->pluck('name','id')->toArray())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('sub_category_id', null)),

                Forms\Components\Select::make('sub_category_id')
                    ->options(function(callable $get) {
                        $top_category = TopCategory::find($get('top_category_id'));

                        if(! $top_category) {
                            return SubCategory::all()->pluck('name','id');
                        }

                        return $top_category->sub_category->pluck('name', 'id');
                    })
                    ->required(),

                Forms\Components\FileUpload::make('icon')
                    ->directory('ChildCategoryResource/icons'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('SubCategory.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('icon')
                    ->square(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListChildCategories::route('/'),
            'create' => Pages\CreateChildCategory::route('/create'),
            'view' => Pages\ViewChildCategory::route('/{record}'),
            'edit' => Pages\EditChildCategory::route('/{record}/edit'),
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
