@extends('layouts.app')

@section('main')
    <div class="container my-5">

        {{-- Form Header --}}
        <div class="d-flex justify-content-between align-items-center">

            <h2 class="text-center">Crea Appartamento</h2>
            <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">
                <i class="fas fa-arrow-left"></i>
                Indietro
            </a>
        </div>

        @include('includes.form')
    </div>
@endsection


{{-- Scripts --}}
@section('scripts')
    @vite(['resources/js/handle-address-geocode.js'])
    @vite(['resources/js/image-preview'])
    @vite(['resources/js/validation-create-form.js'])
@endsection
