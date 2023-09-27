@extends('layouts.app')

@section('main')
    <?php
    $name = Auth::user()->name ? strtoupper(Auth::user()->name) : null;
    $firstLetter = substr($name, 0, 1);
    ?>

    <section id="admin-home">
        <div class="container py-5">
            {{-- Card with name --}}
            @if (Auth::user()->name)
                <div class="card">
                    <div class="profile-img">{{ $firstLetter }}</div>
                    <h1>{{ $name }}</h1>
                </div>
            @endif


            <div class="card my-3">
                <div class="row">
                    {{-- Personal info --}}
                    <div class="col-12 col-md-6">
                        @if (Auth::user()->name)
                            <h3>Informazioni di {{ Auth::user()->name }}</h3>
                        @else
                            <h3>Informazioni personali</h3>
                        @endif
                        <ul>
                            <li><span>Nome</span> {{ Auth::user()->name ?? 'Non fornito' }}</li>
                            <li><span>Cognome</span> {{ Auth::user()->surname ?? 'Non fornito' }}</li>
                            <li><span>Data di nascita</span> {{ Auth::user()->date_of_birth ?? 'Non fornito' }}</li>
                            <li><span>Indirizzo email</span> {{ Auth::user()->email }}</li>
                        </ul>
                    </div>

                    {{-- Personal Boolbnb --}}
                    <div class="col-12 col-md-6">
                        <h3>I tuoi Boolbnb</h3>
                        {{-- VEDE TUTTI GLI APPARTAMENTI DA SISTEMARE --}}
                        <a class="button-primary" href="{{ route('apartments.index') }}">
                            Vai ai tuoi boolbnb
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
