<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\Member;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StudentsRelationManager extends RelationManager
{
    use \App\Traits\Filament\RelationManagerHasBadge;

    protected static string $relationship = 'students';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->recordSelect(fn ($select) => $select
                        ->searchable()
                        ->options(Member::pluck('full_name', 'id')->toArray()))
                    ->form(
                        fn ($action) => [
                            $action->getRecordSelect(),
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
