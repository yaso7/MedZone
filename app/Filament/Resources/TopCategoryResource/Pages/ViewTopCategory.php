<?php

namespace App\Filament\Resources\TopCategoryResource\Pages;

use App\Filament\Resources\TopCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTopCategory extends ViewRecord
{
    protected static string $resource = TopCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
