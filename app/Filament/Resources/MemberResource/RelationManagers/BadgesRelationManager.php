<?php

namespace App\Filament\Resources\MemberResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BadgesRelationManager extends RelationManager
{
    protected static string $relationship = 'badges';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->url(fn ($record) => route('filament.admin.resources.badges.edit', ['record' => $record->id]), shouldOpenInNewTab: true)
                    ->color('blue'),
                Tables\Columns\TextColumn::make('date')->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('reason')->limit(50)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(
                        fn ($action) => [
                            $action->getRecordSelect(),
                            // Forms\Components\Select::make('badge_id')
                            //     ->relationship('badges', 'name')
                            //     ->preload()
                            //     ->required(),
                            Forms\Components\DatePicker::make('date')
                                ->required(),
                            Forms\Components\Textarea::make('reason')
                                ->required(),
                        ]
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                ]),
            ]);
    }
}
