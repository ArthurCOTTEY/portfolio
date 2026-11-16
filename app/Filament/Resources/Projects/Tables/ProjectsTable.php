<?php

namespace App\Filament\Resources\Projects\Tables;

use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                ImageColumn::make('image')
                    ->label('')
                    ->disk(Project::DISK)
                    ->imageHeight(48),

                TextColumn::make('name')
                    ->label('Projet')
                    ->weight('bold')
                    ->description(fn (Project $record): string => $record->tagline)
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Statut')
                    ->badge(),

                TextColumn::make('year')
                    ->label('Année'),

                ToggleColumn::make('is_published')
                    ->label('Visible'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Aucun projet')
            ->emptyStateDescription('Ajoutez vos réalisations : elles apparaîtront dans la section « Projets » du site.');
    }
}
