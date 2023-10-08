@extends('layouts.app')

@section('title', 'Aparments')

@section('main')

    <section id="admin-index" class="container">
        <!--Header-->
        <header class="d-flex align-items-center justify-content-between pb-4">
            {{-- Page Title --}}
            <h2>I tuoi boolbnb</h2>

            {{-- Page Actions --}}
            <div class="d-flex gap-2">
                <a href="{{ route('admin.apartments.create') }}" class="button-primary">
                    <div class="d-none d-md-flex">
                        @if (count($apartments))
                            Aggiungi nuovo boolbnb
                        @else
                            Aggiungi il tuo primo boolbnb!
                        @endif
                    </div>
                    <i class="fa-solid fa-house-medical"></i>
                </a>

                <!--Pulsante cestino-->
                <a href="{{ route('admin.apartments.trash') }}" class="circle-button" title="Cestino">
                    <i class="d-inline-block fa-solid fa-trash-can"></i>
                </a>
            </div>
        </header>

        {{-- Alerts --}}
        <div>
            @include('includes.alerts')
        </div>

        {{-- Apartment List --}}
        @include('includes.apartments.apartment-list')

    </section>

    {{-- Delete Modal --}}
    @include('includes.delete-modal')

@endsection

@section('scripts')

    @vite('resources/js/confirm-delete.js')

@endsection
