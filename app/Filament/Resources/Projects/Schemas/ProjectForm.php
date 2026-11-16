<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Grid::make(1)
                    ->columnSpan(2)
                    ->schema([
                        Section::make('Présentation')
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nom')
                                    ->required()
                                    ->maxLength(80)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (?string $state, Set $set, string $operation): void {
                                        if ($operation === 'create') {
                                            $set('slug', Str::slug((string) $state));
                                        }
                                    }),

                                TextInput::make('slug')
                                    ->label('Identifiant')
                                    ->helperText('Utilisé pour l’ancre #projet-… sur le site.')
                                    ->required()
                                    ->alphaDash()
                                    ->maxLength(80)
                                    ->unique(ignoreRecord: true),

                                TextInput::make('tagline')
                                    ->label('Accroche')
                                    ->placeholder('Prise de rendez-vous en ligne pour les professionnels')
                                    ->required()
                                    ->maxLength(120)
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->helperText('À quoi sert le projet et pour qui. 2 à 4 phrases.')
                                    ->required()
                                    ->rows(5)
                                    ->maxLength(1500)
                                    ->columnSpanFull(),

                                TextInput::make('role')
                                    ->label('Mon rôle')
                                    ->placeholder('Projet personnel : conception, développement, mise en production.')
                                    ->maxLength(200)
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Détails techniques')
                            ->schema([
                                Repeater::make('highlights')
                                    ->label('Points forts')
                                    ->simple(TextInput::make('text')->required()->maxLength(200))
                                    ->reorderableWithButtons()
                                    ->addActionLabel('Ajouter un point fort')
                                    ->defaultItems(0),

                                TagsInput::make('stack')
                                    ->label('Technologies')
                                    ->placeholder('Ajouter une technologie puis Entrée')
                                    ->reorderable(),
                            ]),
                    ]),

                Grid::make(1)
                    ->columnSpan(1)
                    ->schema([
                        Section::make('Publication')
                            ->schema([
                                Toggle::make('is_published')
                                    ->label('Visible sur le site')
                                    ->default(true),

                                Select::make('status')
                                    ->label('Statut')
                                    ->options(ProjectStatus::class)
                                    ->default(ProjectStatus::Online)
                                    ->required(),

                                TextInput::make('year')
                                    ->label('Année')
                                    ->numeric()
                                    ->minValue(2000)
                                    ->maxValue(2100)
                                    ->default(now()->year),
                            ]),

                        Section::make('Liens')
                            ->schema([
                                TextInput::make('url')
                                    ->label('Site')
                                    ->url()
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->maxLength(255),

                                TextInput::make('repository_url')
                                    ->label('Code source')
                                    ->helperText('Seulement si le dépôt est public.')
                                    ->url()
                                    ->maxLength(255),
                            ]),

                        Section::make('Visuel')
                            ->schema([
                                FileUpload::make('image')
                                    ->hiddenLabel()
                                    ->helperText('Capture d’écran 16:10 (1440 × 900 conseillé), WebP ou PNG, 1 Mo maximum.')
                                    ->disk(Project::DISK)
                                    ->directory('projects')
                                    ->visibility('public')
                                    ->image()
                                    ->acceptedFileTypes(['image/webp', 'image/png', 'image/jpeg'])
                                    ->maxSize(1024)
                                    ->imageEditor(),
                            ]),
                    ]),
            ]);
    }
}
