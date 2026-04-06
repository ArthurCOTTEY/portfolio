<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->rows(4)
                    ->maxLength(500)
                    ->columnSpanFull(),

                Repeater::make('skills')
                    ->relationship() // 🔥 important !
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Skill'),

                        FileUpload::make('image')
                            ->label('Icône SVG')
                            ->image() // permet preview
                            ->disk('public')
                            ->directory('skills-icons') // stockage
                            ->visibility('public') // important pour affichage
                            ->preserveFilenames(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel('Ajouter une skill')
                    ->collapsible()
                    ->defaultItems(0),
            ]);
    }
}
