<?php

namespace App\Filament\Resources\DevsResource\Pages;

use App\Filament\Resources\DevsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevs extends ListRecords
{
    protected static string $resource = DevsResource::class;
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
