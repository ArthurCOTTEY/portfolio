<?php

namespace App\Filament\Resources\SkillCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SkillCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                TextColumn::make('name')
                    ->label('Catégorie')
                    ->weight('bold')
                    ->description(fn ($record): ?string => str($record->description)->limit(70)->toString() ?: null)
                    ->searchable(),

                ImageColumn::make('skills.image')
                    ->label('Icônes')
                    ->disk('public')
                    ->stacked()
                    ->limit(6)
                    ->limitedRemainingText(),

                TextColumn::make('skills_count')
                    ->label('Technologies')
                    ->counts('skills')
                    ->badge(),

                TextColumn::make('updated_at')
                    ->label('Modifiée le')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->emptyStateHeading('Aucune catégorie')
            ->emptyStateDescription('Créez une première catégorie (Back-end, Front-end…) puis ajoutez-y vos technologies.');
    }
}
