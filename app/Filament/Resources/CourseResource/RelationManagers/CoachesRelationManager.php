<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoachesRelationManager extends RelationManager
{
    protected static string $relationship = 'coaches';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hours')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name'),
                Tables\Columns\TextColumn::make('hours'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    // ->preloadRecordSelect()
                    ->recordSelect(fn ($select) => $select
                        ->searchable()
                        ->options(Member::pluck('full_name', 'id')->toArray()))
                    ->form(
                        fn ($action) => [
                            $action->getRecordSelect(),
                            Forms\Components\TextInput::make('hours')
                                ->required()
                                ->numeric(),
                        ]
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
