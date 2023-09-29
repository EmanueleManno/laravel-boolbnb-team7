@extends('layouts.app')

@section('title', 'Aparments')

@section('main')

    <div class="container my-5">

        <!--Header-->
        <header class="d-flex align-items-center justify-content-between pb-4">

            {{-- Page Title --}}
            <h2>Lista Appartamenti</h2>

            {{-- Page Actions --}}
            <div>
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-success">
                    <span class="d-none d-md-flex">
                        @if (count($apartments))
                            Aggiungi nuovo appartamento
                        @else
                            Clicca qui per aggiungere il tuo primo appartamento!
                        @endif
                    </span>
                    <i class="d-inline-block d-md-none fa-solid fa-plus"></i>
                </a>

                <!--Pulsante cestino-->
                <a href="{{ route('admin.apartments.trash') }}" class="btn btn-secondary ms-2">Cestino</a>
            </div>

        </header>

        {{-- Alerts --}}
        <div class="my-2">
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
