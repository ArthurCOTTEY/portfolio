<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 🌍 MULTILINGUE (FR / EN tabs)
                TranslatableTabs::make()
                    ->localeTabSchema(fn (TranslatableTab $tab) => [

                        TextInput::make($tab->makeName('name'))
                            ->required()
                            ->maxLength(255),

                        Textarea::make($tab->makeName('description'))
                            ->rows(4)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                // 🧠 RELATION NON TRADUITE (skills)
                Repeater::make('skills')
                    ->relationship()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Skill'),

                        FileUpload::make('image')
                            ->label('Icône SVG')
                            ->image()
                            ->disk('public')
                            ->directory('skills-icons')
                            ->visibility('public')
                            ->preserveFilenames(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel('Ajouter une skill')
                    ->collapsible()
                    ->defaultItems(0),
            ]);
    }
}
