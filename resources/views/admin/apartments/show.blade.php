@extends('layouts.app')

@section('main')

<div class="container">

    <h2 class="my-5">{{$apartment->title}}</h2>

    {{-- Image --}}
    <div class="row">
        <div class="col-8">
            <img class="img-fluid" src="{{$apartment->image}}" alt="{{$apartment->title}}">
        </div>
    </div>

    <div class="row">
        {{----------------------- Left Content ------------------------}}
        <div class="col-8">
            <div class="mt-2 mb-5">
                Stanze: {{$apartment->rooms}} - Letti: {{$apartment->beds}} - Bagni: {{$apartment->bathrooms}} - Metri quadri: {{$apartment->square_meters}}
            </div>
            <div>
                {{$apartment->description}}
            </div>
        </div>

        {{------------- Right Content -----------------}}
        <div class="col-4">
            <div class="card p-3">
                <h5 class="my-3">{{$apartment->price}}€ a notte</h5>

                {{-- Check --}}
                <div class="row text-center">
                    <div class="col-6">
                        <div>Check-in</div>
                        <div>data</div>
                    </div>
                    <div class="col-6">
                        <div>Check-out</div>
                        <div>data</div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12 text-center">
                        Ospiti
                    </div>
                </div>


                <button class="btn btn-primary text-center mt-3">Prenota</button>
                <div class="text-center my-2">Non riceverai alcun addebito in questa fase</div>

                {{-- Prices --}}
                <div class="row mt-4 text-center">
                    <div class="col-6">
                        <div class="mb-2">Costo x notte</div>
                        <div>Servizi</div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">tot notti</div>
                        <div>tot servizi</div>
                    </div>
                </div>

                <div class="row text-center mt-5">
                    <div class="col-6 h4">
                        Totale
                    </div>
                    <div class="col-6 h4">
                        tot
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
