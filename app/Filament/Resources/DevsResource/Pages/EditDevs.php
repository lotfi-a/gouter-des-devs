<?php

namespace App\Filament\Resources\DevsResource\Pages;

use App\Filament\Resources\DevsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDevs extends EditRecord
{
    protected static string $resource = DevsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
