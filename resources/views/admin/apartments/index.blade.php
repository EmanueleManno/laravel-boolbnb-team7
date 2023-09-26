@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach ($apartments as $apartment)
        <li>{{$apartment->title}}</li>
        @endforeach
    </ul>
</div>
@endsection
