@extends('layouts.app')

@section('main')
    <div class="container">
        @include('includes.form')
    </div>
@endsection


{{-- Scripts --}}
@section('scripts')
    @vite(['resources/js/handleAddressGeocode.js'])
@endsection
