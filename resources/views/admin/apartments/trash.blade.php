@extends('layouts.app')

@section('title', 'trash')

@section('main')

    <!--Contenitore-->
    <div class="container my-2">

        <!--Header-->
        <header class="d-flex align-items-center justify-content-between">

            <!--Titolo-->
            <h1>Cestino</h1>

            <!--Pulsante nel quale vengo reindirizzato alla home e svuota cestino-->
            <div class="d-flex align-items-center justify-content-end">

                <!--Torna alla lista-->
                <a href="{{ route('admin.apartments.index') }}" class="btn btn-sm btn-secondary">Torna alla Lista</a>

                <!--Svuota cestino-->
                <form class="delete-form ms-2 delete-all" method="POST" action="{{ route('admin.apartments.dropAll') }}"
                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Svuota cestino</button>
                </form>

            </div>
        </header>

        {{-- Alerts --}}
        <div class="container my-2">
            @include('includes.alerts')
        </div>

        {{-- Apartment List --}}
        @include('includes.apartments.apartment-list')

    </div>

    {{-- Delete Modal --}}
    @include('includes.delete-modal')

@endsection

@section('scripts')

    @vite('resources/js/confirm-delete.js')

@endsection
