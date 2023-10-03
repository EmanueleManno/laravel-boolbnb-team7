@extends('layouts.app')

@section('main')
    <div class="container my-5">

        {{-- Form Header --}}
        <header class="d-flex justify-content-between align-items-center pb-4">

            <h2 class="text-center">Crea Appartamento</h2>
            <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">
                <i class="fas fa-arrow-left"></i>
                Indietro
            </a>
        </header>

        @include('includes.form')
    </div>
@endsection


{{-- Scripts --}}
@section('scripts')
    @vite(['resources/js/handle-address-geocode.js'])
    @vite(['resources/js/image-form'])
    @vite(['resources/js/frontend-validation.js'])
@endsection
