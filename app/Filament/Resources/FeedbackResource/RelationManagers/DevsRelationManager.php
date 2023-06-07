<?php

namespace App\Filament\Resources\FeedbackResource\RelationManagers;


use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class DevsRelationManager extends RelationManager
{
    protected static string $relationship = 'devs';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('picture'),
            ]);
    }
    public function getRelationship(): Builder
    {
        return parent::getRelationship()->orderBy('_id');
    }

}
