@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="ms-2 mb-2">{{$apartment->title}}</h2>

    {{-- Image --}}
    <div class="row">
        <div class="col-8">
            <img src="{{$apartment->image}}" alt="{{$apartment->title}}">
        </div>
    </div>

    {{-- Rooms --}}
    <div class="row">
        <div class="col-8">
            <div>{{$apartment->rooms}} - {{$apartment->beds}} - {{$apartment->bathrooms}} - {{$apartment->square_meters}}</div>
        </div>

        <div class="col-4">
            <div class="card">
                <h4>{{$apartment->price}} € </h4>
                <h4>Prenota</h4>
            </div>
        </div>
    </div>

</div>

@endsection
