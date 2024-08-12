<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'ToDo' => 'To Do',
                        'In Progress' => 'In Progress',
                        'Done' => 'Done',
                    ]),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->nullable()
                    ->label('Assigned User'),
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->sortable(),
                TextColumn::make('status')
                    ->sortable(),
                TextColumn::make('project.name')
                    ->label('Project')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Assigned User')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('start_date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('start_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Start Date from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Start Date until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),

                    Tables\Filters\SelectFilter::make('status')
                        ->options([
                            'ToDo' => 'To Do',
                            'In Progress' => 'In Progress',
                            'Done' => 'Done',
                        ])
                        ->placeholder('All Statuses')
                        ->attribute('status'),

                    Tables\Filters\SelectFilter::make('Assigned Name')
                        ->relationship('user', 'name')
                    // Tables\Filters\SelectFilter::make('user_id')
                    //     ->relationship('user', 'name')
                    //     ->label('Assigned User')
                    //     ->placeholder('All Users')
                    //     ->query(fn (Builder $query, $userId = null): Builder => $query->where('user_id', $userId)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('start_date', 'asc');
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
