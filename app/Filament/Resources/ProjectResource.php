<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Color;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Start Date' => $record->start_date,
            'Description' => str($record->description)->limit()->value(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\Select::make('color_id')
                    ->getOptionLabelFromRecordUsing(fn (Color $record) =>
                    '<div class="fi-ta-color-item h-6 w-6 rounded-md" style="background-color: ' . $record->name . ';">dosaijmsdaoi</div>')
                    ->allowHtml()
                    ->relationship('color', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('supervisior_id')
                    ->relationship('supervisior', 'full_name')
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('level_id')
                    ->relationship('level', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\TextInput::make('budget')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('deadline')
                    ->seconds(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hash_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\ColorColumn::make('color.name'),
                Tables\Columns\TextColumn::make('supervisior.full_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('color')
                    ->form([
                        // Forms\Components\Select::make('color')
                        //     // ->getOptionLabelFromRecordUsing(fn (Color $record) =>
                        //     // )
                        //     ->allowHtml()
                        //     ->options(Color::pluck('name', 'id')
                        //         ->map(fn ($name) => new HtmlString('<span style="color: ' . $name . ';">' . $name . '</span>'))
                        //         ->toArray()),
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),

                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MembersRelationManager::class,
            RelationManagers\SkillsRelationManager::class,
            RelationManagers\PartsRelationManager::class,
            RelationManagers\BorrowWarehousesRelationManager::class,
            RelationManagers\ReturnWarehousesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
