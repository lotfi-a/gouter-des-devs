<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DevsResource\Pages;
use App\Filament\Resources\DevsResource\RelationManagers;
use App\Models\Devs;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Jenssegers\Mongodb\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DevsResource extends Resource
{
    protected static ?string $model = Devs::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Developers';
    protected static ?string $label = "Developers";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('picture')->circular(),
                TextColumn::make('first_name')->searchable(['first_name', 'last_name']),
                TextColumn::make('last_name'),
                TextColumn::make('email'),
                TextColumn::make('feedbacks')->getStateUsing(fn (?Devs $record) => count($record?->feedbacks))->sortable(),
                TextColumn::make('topics')->getStateUsing(fn (?Devs $record) => count($record?->topics))->sortable(),
                TextColumn::make('events')->getStateUsing(fn (?Devs $record) => count($record->events))->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDevs::route('/'),
            'create' => Pages\CreateDevs::route('/create'),
            'edit' => Pages\EditDevs::route('/{record}/edit'),
        ];
    }
}
