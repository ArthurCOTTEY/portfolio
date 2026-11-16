<?php

namespace App\Filament\Resources\SkillCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Catégorie')
                    ->description('Le titre et le texte affichés en tête du bloc sur la page d’accueil.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Titre')
                            ->placeholder('Back-end')
                            ->required()
                            ->maxLength(60),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Applications, API et logique métier robustes.')
                            ->rows(3)
                            ->maxLength(300),
                    ]),

                Section::make('Technologies')
                    ->description('Le nom est affiché sous l’icône et utilisé par les moteurs de recherche.')
                    ->schema([
                        Repeater::make('skills')
                            ->hiddenLabel()
                            ->relationship()
                            ->orderColumn('position')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel('Ajouter une technologie')
                            ->defaultItems(0)
                            ->grid(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nom')
                                    ->placeholder('Laravel')
                                    ->required()
                                    ->maxLength(50),

                                FileUpload::make('image')
                                    ->label('Icône')
                                    ->helperText('SVG de préférence (PNG ou WebP acceptés), carré, 512 Ko maximum.')
                                    ->disk('public')
                                    ->directory('skills-icons')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/webp'])
                                    ->maxSize(512)
                                    ->imagePreviewHeight('64'),
                            ]),
                    ]),
            ]);
    }
}
