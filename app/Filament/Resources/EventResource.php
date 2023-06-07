<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                DatePicker::make('date_of_event')->formatStateUsing(fn (?Event $record) => $record?->date_of_event->toDateTime()->format('F, j  Y '))->required(),
                RichEditor::make('description')->disableToolbarButtons([
                    'attachFiles',
                    'codeBlock',
                    'undo',
                    'redo'
                ])->required(),
                Select::make('status')
                    ->searchable()
                    ->options([
                        'IN_PROGRESS' => 'In progress',
                        'FINISHED' => 'Finished',
                        'INCOMING' => 'Incoming',
                    ]),
                TagsInput::make('tags')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(30),
                BadgeColumn::make('status')
                    ->enum([
                        'IN_PROGRESS' => 'In progress',
                        'FINISHED' => 'Finished',
                        'INCOMING' => 'Incoming',
                    ])
                    ->colors([
                        'primary' => static fn ($state): bool => $state === 'INCOMING',
                        'success' => static fn ($state): bool => $state === 'IN_PROGRESS',
                        'danger' => static fn ($state): bool => $state === 'FINISHED',
                    ])
                ->sortable(),
                    TextColumn::make('date_of_event')->getStateUsing(fn (Event $record) => $record->date_of_event->toDateTime())->date('F, j  Y ')->sortable(),

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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
