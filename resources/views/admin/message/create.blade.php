@extends('layouts.app')

@section('main')

<!--Contenitore-->
<div class="container my-5">
    
    {{-- Form Header --}}
    <header class="d-flex justify-content-between align-items-center pb-4">

        <h2 class="text-center">Manda un messaggio</h2>
        <a class="btn btn-secondary" href="{{ route('admin.message.index') }}">
            <i class="fas fa-arrow-left"></i>
            Indietro
        </a>
    </header>

    <!--Form-->
    <form id="validation-form" method="POST" action="{{ route('admin.message.store') }}" class="mt-5" novalidate>
    @csrf

    <!--Validazione-->
    <div class="row" id="get-validation" data-validate="form">

    {{-- # Title --}}
    <div class="col-6 mb-4">
        <label for="name" class="form-label @error('name') is-invalid @enderror">
            Titolo
            <span class="form-text text-danger fs-5">*</span>
        </label>

        <input value="" type="text"
            class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
        @error('name')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
        <span id="name-error" class="text-danger"></span>
    </div>


    {{-- # Contenuto --}}
    <div class="col-12 mb-4">
        <label for="content" class="form-label">Contenuto
            <span class="form-text text-danger fs-5">*</span>
        </label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"
            rows="10"></textarea>
        @error('content')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
        <span id="content-error" class="text-danger"></span>
    </div>

    <!--Email-->
    <div class="mb-4 row">
        <label for="email" class="form-label">
            {{ __('Email') }}
            <span class="form-text text-danger fs-5">*</span>
        </label>

        <div class="col-md-6">
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email"
                value="" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
            <span id="email-error" class="text-danger"></span>
        </div>
    </div>


    {{-- # Submit --}}
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-success">Invia messaggio</button>
    </div>

    </div>
    </form>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
    @vite(['resources/js/frontend-validation.js'])
@endsection