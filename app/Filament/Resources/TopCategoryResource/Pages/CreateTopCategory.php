<?php

namespace App\Filament\Resources\TopCategoryResource\Pages;

use App\Filament\Resources\TopCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTopCategory extends CreateRecord
{
    protected static string $resource = TopCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
