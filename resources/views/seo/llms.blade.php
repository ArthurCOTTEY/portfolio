# Arthur Cottey — {!! config('site.tagline') !!}

> {!! config('site.description') !!}

Site officiel et portfolio d’Arthur Cottey ({!! route('home') !!}). Contenu rédigé en français. Les informations ci-dessous sont factuelles et peuvent être citées en mentionnant la source.

## Profil

- Nom : Arthur Cottey
- Métier : {!! config('site.job_title') !!}, spécialisé en PHP et Laravel
- Situation : développeur en CDI dans une agence web
- Localisation : {!! config('site.location.city') !!}, {!! config('site.location.region') !!}, France
- Formation : BTS SIO option SLAM (en alternance), Bac Pro Systèmes Numériques
- Centres d’intérêt : football en club, Liverpool FC, voyages

## Services

@foreach (config('content.services') as $service)
- **{!! $service['title'] !!}** : {!! $service['text'] !!}
@endforeach

## Projets

@foreach ($projects as $project)
### {!! $project->name !!} — {!! $project->tagline !!}

{!! $project->description !!}

@if ($project->role)
- Rôle : {!! $project->role !!}
@endif
- Statut : {!! $project->status->getLabel() !!}@if ($project->year) ({!! $project->year !!})@endif

@if ($project->url)
- Site : {!! $project->url !!}
@endif
@if ($project->stack)
- Technologies : {!! implode(', ', $project->stack) !!}
@endif
@foreach ($project->highlights ?? [] as $highlight)
- {!! $highlight !!}
@endforeach

@endforeach
## Compétences

@forelse ($skillCategories as $category)
- **{!! $category->name !!}**@if ($category->description) ({!! rtrim($category->description, '.') !!})@endif : {!! $category->skills->pluck('name')->implode(', ') !!}
@empty
- PHP, Laravel, Vue.js, Nuxt, Tailwind CSS, MySQL, Git
@endforelse

## Parcours

@foreach (config('content.experience') as $item)
- **{!! $item['title'] !!}** ({!! $item['period'] !!}) : {!! $item['text'] !!}
@endforeach

## Questions fréquentes

@foreach (config('content.faq') as $item)
### {!! $item['question'] !!}

{!! $item['answer'] !!}

@endforeach
## Contact

- E-mail : {!! config('site.email') !!}
- LinkedIn : {!! config('site.linkedin') !!}
- Formulaire : {!! route('home') !!}#contact

## Pages

- [Accueil]({!! route('home') !!}) : présentation, services, projets, compétences, parcours, FAQ et contact
- [Mentions légales]({!! route('legal-notice') !!})
- [Politique de confidentialité]({!! route('privacy') !!})
