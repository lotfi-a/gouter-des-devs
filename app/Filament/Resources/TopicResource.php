<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopicResource\Pages;
use App\Filament\Resources\TopicResource\RelationManagers;
use App\Models\Topic;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;
    public ?string $filter = 'created_at';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns([
                        'md' => 12,
                    ])
                ->schema([
                    Forms\Components\Group::make()
                        ->columnSpan([
                            'sm' => 2,
                        ])
                        ->columns([
                            'sm' => 12,
                        ])
                        ->schema([
                            TextInput::make('title')
                                ->columnSpan([
                                'sm' => 4,
                                    ])
                                ->required(),
                            DateTimePicker::make('created_at')->columnSpan([
                                'sm' => 2,
                            ])
                                ->maxDate(now())->required(),
                        ]),
                ])
                ,
                Forms\Components\Grid::make()
                ->columns(["md" => 1])
                ->schema([
                    Forms\Components\Group::make()
                        ->columnSpan([
                            'md' => 1,
                        ])
                    ->schema([
                        RichEditor::make('description')->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'undo',
                            'redo'
                        ])->required(),
                    ])
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('likes')->getStateUsing(fn (Topic $record) => count($record->likes))->sortable(),
                Tables\Columns\TextColumn::make('created_at'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }
}
