<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers\BadgesRelationManager;
use App\Filament\Resources\MemberResource\RelationManagers\CourseCoachRelationManager;
use App\Filament\Resources\MemberResource\RelationManagers\CourseStudentRelationManager;
use App\Filament\Resources\MemberResource\RelationManagers\SkillsRelationManager;
use App\Filament\Resources\MemberResource\RelationManagers\WorksOnProjectsRelationManager;
use App\Filament\Resources\MemberResource\Widgets\MemberGeneralInfoCards;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('join_date')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('father_name')
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\Select::make('sex')
                    ->required()
                    ->options(['M' => 'Male', 'F' => 'Female']),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required(),
                Forms\Components\Select::make('university_id')
                    ->relationship('university', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('major_id')
                    ->relationship('major', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\TextInput::make('uni_year')
                    ->required()
                    ->minValue(1)
                    ->maxValue(5)
                    ->numeric(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('emergency_name'),
                Forms\Components\TextInput::make('emergency_kinship'),
                Forms\Components\TextInput::make('emergency_phone')
                    ->tel(),
                Forms\Components\Select::make('governorate_id')
                    ->relationship('governorate', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\TextInput::make('region_name'),
                Forms\Components\TextInput::make('street_name'),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('level_id')
                    ->relationship('level', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('technical_specialization_id')
                    ->relationship('technicalSpecialization', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Toggle::make('frozen')
                    ->required(),
                Forms\Components\Toggle::make('work_from_home')
                    ->required(),
                Forms\Components\Select::make('tournament_id')
                    ->preload()
                    ->visibleOn('edit')
                    ->relationship('tournaments', 'name')
                    ->multiple()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hash_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('join_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->color(fn ($state) => $state == 'M' ? 'blue' : 'pink')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state == 'M' ? 'Male' : 'Female')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->searchable(),
                Tables\Columns\TextColumn::make('university.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('major.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('uni_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_kinship')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('governorate.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('technicalSpecialization.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('frozen'),
                Tables\Columns\ToggleColumn::make('work_from_home'),
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
                Tables\Filters\SelectFilter::make('badge')
                    ->relationship('badges', 'name')
                    ->preload()
                    ->modifyQueryUsing(function (Builder $query, $data) {
                        return $query->when(
                            $data['value'],
                            fn ($query) => $query->whereHas(
                                'badges',
                                fn ($q) => $q->where('badges.id', $data['value'])
                            )
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
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
            BadgesRelationManager::class,
            CourseStudentRelationManager::class,
            CourseCoachRelationManager::class,
            WorksOnProjectsRelationManager::class,
            SkillsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            MemberGeneralInfoCards::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
