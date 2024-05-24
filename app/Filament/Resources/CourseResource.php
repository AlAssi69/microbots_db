<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Filament\Resources\CourseResource\Widgets;
use App\Models\Course;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

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
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\TextInput::make('sessions')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('hours')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('certificate')
                    ->required(),
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
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sessions')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('certificate')
                    ->boolean(),
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
                Tables\Filters\TernaryFilter::make('certificate'),
                Tables\Filters\Filter::make('start_date')
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['from'] && ! $data['to']) {
                            return null;
                        }

                        $return = '';

                        if ($data['from']) {
                            $return .= 'From: '.Carbon::parse($data['from'])->toDateString();
                        }

                        if ($data['to']) {
                            $return .= ' To: '.Carbon::parse($data['to'])->toDateString();
                        }

                        return $return;
                    })
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('to'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query) => $query->whereDate('start_date', '>=', $data['from']))
                            ->when($data['to'], fn ($query) => $query->whereDate('start_date', '<=', $data['to']));
                    }),
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
            RelationManagers\CoachesRelationManager::class,
            RelationManagers\StudentsRelationManager::class,
            RelationManagers\PrerequisitesRelationManager::class,
            RelationManagers\CoursesRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            Widgets\CourseCardsWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
