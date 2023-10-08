@extends('layouts.app')

@section('title', 'Promote')

@section('cdn')
    <script src=" https://js.braintreegateway.com/web/dropin/1.40.2/js/dropin.min.js "></script>
@endsection

@section('main')
    <div class="contrainer p-5">

        <h1 class="mb-5">Promuovi il tuo appartamento</h1>


        <p class="fs-5 mb-4">{{ $apartment->title }}</p>

        {{-- Payments Form --}}
        <form id="payment-form" action="{{ route('admin.apartments.sponsorize', $apartment) }}" method="post"
            data-token="{{ $clientToken }}">
            @csrf
            {{-- Radios --}}
            <div class="row text-center">

                @foreach ($promotions as $promotion)
                    {{-- Prom 1 --}}
                    <div class="col-4">
                        <label class="card p-2">
                            <h2>{{ $promotion->name }}</h2>
                            <div class="d-flex">
                                <input type="radio" class="invisible" name="promotion" id="promotion-{{ $promotion->id }}"
                                    value="{{ $promotion->id }}" @if ($loop->first) checked @endif>
                            </div>
                            <p>
                                {{ $promotion->price }} € per {{ $promotion->duration }} ore di sponsorizzazione

                            </p>
                        </label>
                    </div>
                @endforeach

            </div>


            <div id="dropin-container"></div>
            <input type="submit" class="btn btn-success" value="Procedi" />
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>



    </div>
@endsection

@section('scripts')

    @vite('resources/js/handle-braintree.js')
    @vite('resources/js/confirm-delete.js')

@endsection
