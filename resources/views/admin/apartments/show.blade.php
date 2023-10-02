@extends('layouts.app')

@section('main')
    <div class="container my-4">

        {{-- Alerts --}}
        <div class="container my-2">
            @include('includes.alerts')
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            {{-- Back Button --}}
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>
                Indietro</a>

            @if (Auth::id() === $apartment->user_id)
                <div class="d-flex justify-content-end align-items-center">

                    {{-- Toggle Button --}}
                    <form method="POST" action="{{ route('admin.apartments.toggle', $apartment) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-outline-{{ $apartment->is_visible ? 'secondary' : 'success' }} ms-2">
                            <i class="fas fa-{{ $apartment->is_visible ? 'eye-slash' : 'eye' }}"></i>
                            {{ $apartment->is_visible ? 'Cambia in Bozza' : 'Pubblica' }}
                        </button>
                    </form>


                    {{-- Edit Button --}}
                    <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-sm btn-warning ms-2">
                        <i class="fas fa-pencil"></i> Modifica
                    </a>

                    {{-- Delete Button --}}
                    <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                        class="delete-form ms-2" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash me-2"></i>Elimina
                        </button>
                    </form>
                </div>
            @endif

        </div>

        {{-- Title --}}
        <h2 class="mt-4 mb-2">{{ $apartment->title }}</h2>

        {{-- Category --}}
        @if ($apartment->category)
            <div class="h6 mb-4">
                <span class="badge text-bg-danger">
                    {{ $apartment->category->name }}
                </span>

            </div>
        @else
            <div class="mb-4">
                Nessuna Categoria
            </div>
        @endif

        {{-- Image --}}
        <div class="row">
            <div class="col-8 mb-3">

                <img class="img-fluid"
                    src="{{ $apartment->image ? $apartment->image($apartment->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
                    alt="{{ $apartment->title }}">
            </div>
        </div>

        <div class="row">
            {{-- --------------------- Left Content ---------------------- --}}
            <div class="col-12 col-md-7">

                {{-- Details --}}
                <div class="mb-3">

                    {{-- Misc --}}
                    <div>
                        Stanze: {{ $apartment->rooms }} - Letti: {{ $apartment->beds }} - Bagni:
                        {{ $apartment->bathrooms }}
                        -
                        Metri quadri: {{ $apartment->square_meters }}
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-5">
                    {{ $apartment->description }}
                </div>

                {{-- Services --}}
                <div class="mb-5">

                    <h5 class="mb-2">Servizi offerti</h5>

                    <div class="h5">
                        @forelse ($apartment->services as $service)
                            <span class="badge text-bg-success p-2 m-1">
                                <i class="fas fa-{{ $service->icon }}"></i>
                                {{ $service->name }}
                            </span>
                        @empty
                            -
                        @endforelse
                    </div>
                </div>

                {{-- Map --}}
                @if ($apartment->address)
                    <h5 class="mb-2">Mappa</h5>
                    <div id="map" data-latitude="{{ $apartment->latitude }}"
                        data-longitude="{{ $apartment->longitude }}" style="height:200px"></div>
                @endif

            </div>

            {{-- ----------- Right Content --------------- --}}
            <!--<div class="col-12 col-md-5">

                                        <div class="card p-4">

                                            {{-- Price x Night --}}
                                            <h5 class="mb-3"> {{-- $apartment->price --}} € <span class="fw-normal fs-6">notte</span></h5>

                                            {{-- Booking Options --}}
                                            <div class="row rounded border mb-3">

                                                <div class="col-6 py-2">
                                                    <label for="check-in" class="form-label fw-bold mb-0">CHECK-IN</label>
                                                    <input type="date" class="form-control border-0" id="check-in" value="2023-09-30">
                                                </div>

                                                <div class="col-6 py-2">
                                                    <label for="check-out" class="form-label fw-bold mb-0">CHECK-OUT</label>
                                                    <input type="date" class="form-control border-0" id="check-out" value="2023-10-30">
                                                </div>

                                                <div class="col-12 border-top py-2">
                                                    <label for="guests" class="form-label fw-bold mb-0">Ospiti</label>
                                                    <select id="guests" class="form-select border-0">
                                                        <option value="1">1 ospite</option>
                                                        <option value="1">2 ospiti</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Booking Button --}}
                                            <button disabled class="btn btn-primary text-center">Prenota</button>
                                            <div class="text-center my-3">Non riceverai alcun addebito in questa fase</div>

                                            {{-- Booking Recap --}}
                                            <div>

                                                <div class="d-flex justify-content-between">
                                                    <div>Costo x notte</div>
                                                    <div>tot notti</div>
                                                </div>

                                                <div class="d-flex justify-content-between border-bottom pb-3">
                                                    <div>Servizi</div>
                                                    <div>tot servizi</div>
                                                </div>

                                                <div class="d-flex justify-content-between h4 pt-3">
                                                    <div>Totale</div>
                                                    <div>tot</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>-->
        </div>

    </div>

    {{-- Delete Modal --}}
    @include('includes.delete-modal')
@endsection



@section('scripts')
    @vite(['resources/js/confirm-delete.js', 'resources/js/map-viewer.js'])
@endsection
