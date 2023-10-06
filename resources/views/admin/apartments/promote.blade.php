@extends('layouts.app')

@section('title', 'Promote')

@section('cdn')
    <script src=" https://js.braintreegateway.com/web/dropin/1.40.2/js/dropin.min.js "></script>
@endsection

@section('main')
    <div class="contrainer p-5">

        <h1 class="mb-5 text-center">Payment</h1>
        
        
        {{-- Radios --}}
        <div class="row text-center">
            
            {{-- Prom 1--}}
            <div class="col-4">
                <div class="card">
                    <h2>Prom 1</h2>
                    <div class="form-check-input d-flex">
                        <input class="form-check-input" type="radio" name="promotion" id="promotion1" value="option1" checked>
                        <label class="form-check-label" for="promotion1">1</label>
                    </div>
                    <p>
                        Blablabla
                    </p>
                </div>
            </div>
            
            {{-- Prom 2--}}
            <div class="col-4">
                <div class="card">
                    <h2>Prom 2</h2>
                    <div class="form-check-input d-flex">
                        <input class="form-check-input" type="radio" name="promotion" id="promotion2" value="option2">
                        <label class="form-check-label" for="promotion2">2</label>
                    </div>
                    <p>
                        Blablabla
                    </p>
                </div>
            </div>
            
            {{-- Prom 3--}}
            <div class="col-4">
                <div class="card">
                    <h2>Prom 3</h2>
                    <div class="form-check-input d-flex">
                        <input class="form-check-input" type="radio" name="promotion" id="promotion3" value="option3">
                        <label class="form-check-label" for="promotion3">3</label>
                    </div>
                    <p>
                        Blablabla
                    </p>
                </div>
            </div>
        </div>
    
    
    
        {{-- Payments Form--}}
        <form id="payment-form" action="{{route('admin.apartments.payment', $apartment)}}" method="post" data-token="{{$clientToken}}">
            @csrf
            
            <div id="dropin-container"></div>
            <input type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>
        
        
        
    </div>
@endsection

@section('scripts')

    @vite('resources/js/handle-braintree.js')
    @vite('resources/js/confirm-delete.js')

@endsection