@extends('layouts.app')

@section('main')
    <div class="container">
        @include('includes.form')
    </div>
@endsection

{{-- Scripts --}}
@section('scripts')
    @vite(['resources/js/handle-address-geocode.js'])
    @vite(['resources/js/image-preview'])
@endsection