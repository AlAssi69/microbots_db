<?php

namespace App\Filament\Resources\WarehouseResource\RelationManagers;

use App\Models\Member;
use App\Models\Project;
use App\Models\Warehouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BorrowMembersRelationManager extends RelationManager
{
    protected static string $relationship = 'borrow_members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->label('Project')
                    ->options(Project::pluck('name', 'id')->toArray())->searchable(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->required(),
                Forms\Components\TextInput::make('count')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name'),
                Tables\Columns\TextColumn::make('pivot.project.name'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('reason'),
                Tables\Columns\TextColumn::make('count'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->recordSelect(fn ($select) => $select->options(Member::pluck('full_name', 'id')->toArray())->searchable())
                    ->form(fn (Tables\Actions\AttachAction $action) => [
                        $action->getRecordSelect()
                            ->label('Member')
                            ->required(),
                        Forms\Components\Select::make('project_id')
                            ->label('Project')
                            ->required()
                            ->options(Project::pluck('name', 'id')->toArray())->searchable(),
                        Forms\Components\DatePicker::make('date')
                            ->required(),
                        Forms\Components\Textarea::make('reason')
                            ->required(),
                        Forms\Components\TextInput::make('count')
                            ->maxValue(fn () => $this->getOwnerRecord()->remaining_count)
                            ->numeric()
                            ->required(),
                    ]),
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
