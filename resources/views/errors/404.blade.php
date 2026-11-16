@extends('layouts.app')

@section('title', 'Page introuvable — Arthur Cottey')
@section('robots', 'noindex, follow')

@section('content')
    <section class="border-b-2 border-black bg-yellow-400 p-8 md:p-16">
        <p class="font-display text-8xl font-bold md:text-[12rem] leading-none">404</p>
        <h1 class="mt-6 font-display text-3xl font-bold tracking-tight md:text-5xl">Cette page n’existe pas (ou plus).</h1>
        <p class="mt-4 max-w-xl text-base md:text-lg">Le lien est peut-être erroné ou la page a été déplacée.</p>
        <a href="{{ route('home') }}" class="btn btn-black mt-8">Retour à l’accueil</a>
    </section>
@endsection
