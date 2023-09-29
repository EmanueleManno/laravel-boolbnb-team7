@extends('layouts.app')

@section('title', 'trash')

@section('main')

    <div class="container my-5">

        <!--Header-->
        <header class="d-flex align-items-center justify-content-between pb-4">

            {{-- Page Title --}}
            <h2>Cestino</h2>

            {{-- Page Actions --}}
            <div>

                {{-- Back --}}
                <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">Torna alla Lista</a>

                {{-- Drop All --}}
                <form class="delete-form ms-2 delete-all d-inline-block" method="POST"
                    action="{{ route('admin.apartments.dropAll') }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Svuota cestino</button>
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