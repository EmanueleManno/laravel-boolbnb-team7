@extends('layouts.app')

@section('title', 'I tuoi Boolbnb')

@section('main')
    <section id="admin-show" class="container">
        {{-- Alerts --}}
        @include('includes.alerts')

        {{-- header --}}
        <header>
            {{-- Title --}}
            <h2>{{ $apartment->title }}</h2>

            <div class="d-flex justify-content-between align-items-center gap-2">
                {{-- Back Button --}}
                <div class="circle-button">
                    <a href="{{ route('admin.apartments.index') }}">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </div>

                {{-- Actions --}}
                @if (Auth::id() === $apartment->user_id)
                    <div class="dropdown">
                        <button class="circle-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                {{-- Toggle Button --}}
                                <form method="POST" action="{{ route('admin.apartments.toggle', $apartment) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="admin-action {{ $apartment->is_visible ? 'secondary' : 'success' }}">
                                        <i class="fas fa-{{ $apartment->is_visible ? 'eye-slash' : 'eye' }}"></i>
                                        {{ $apartment->is_visible ? 'Cambia in Bozza' : 'Pubblica' }}
                                    </button>
                                </form>
                            </li>
                            <li>
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.apartments.edit', $apartment) }}" class="admin-action warning">
                                    <i class="fas fa-pencil"></i> Modifica
                                </a>
                            </li>
                            <hr>
                            <li>
                                {{-- Delete Button --}}
                                <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                                    class="delete-form" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action danger">
                                        <i class="fas fa-trash"></i>Elimina
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </header>

        {{-- image --}}
        <div class="slider">
            <div></div>
            @if ($apartment->image)
                {{-- With image --}}
                <div class="image-container">
                    <img src="{{ $apartment->image ? asset('storage/' . $apartment->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
                        alt="{{ $apartment->title }}">
                </div>
            @else
                {{-- Without image --}}
                <div class="no-image">
                    <div class="icon">
                        <img src="{{ asset('img/camera.png') }}" alt="camera">
                    </div>
                    <h3>Non hai acnora inserito nessuna immagine</h3>
                </div>
            @endif
            <div></div>
        </div>

        {{-- Information --}}
        <section id="apartments-details" class="mt-4">
            <h3>Informazioni sul tuo Boolbnb</h3>
            <div>
                <h4>Categoria e prezzo</h4>
                {{-- Category --}}
                @if ($apartment->category)
                    <span>
                        {{ $apartment->category->name }} |
                    </span>
                @else
                    <span>
                        Nessuna Categoria |
                    </span>
                @endif
                <span>{{ $apartment->price }}€ a notte</span>
            </div>
            <hr>
            <div>
                <h4>Stanze e misure</h4>
                <ul>
                    <li>{{ $apartment->rooms . ' ' . ($apartment->rooms == 1 ? 'camera' : 'camere') }}</li>
                    <li>{{ $apartment->beds . ' ' . ($apartment->beds == 1 ? 'letto' : 'letti') }}</li>
                    <li>{{ $apartment->bathrooms . ' ' . ($apartment->bathrooms == 1 ? 'bagno' : 'bagni') }}</li>
                    <li>{{ $apartment->square_meters }} Metri quadrati</li>
                </ul>
            </div>
            <hr>
            {{-- Description --}}
            <div>
                <h4>Descrizione</h4>
                <p>{{ $apartment->description }}</p>
            </div>
            <hr>
            {{-- Services --}}
            <div>
                <h4>Servizi offerti</h4>
                <div class="d-flex flex-wrap">
                    @forelse ($apartment->services as $service)
                        <span class="badge text-bg-success p-2 m-1 d-flex align-items-center">
                            <div class="service-image"><img src="{{ asset('img/service/' . $service['image']) }}"
                                    alt="{{ $service->name }}" width="20px"></div>
                            <span>{{ $service->name }}</span>
                        </span>
                    @empty
                        -
                    @endforelse
                </div>
            </div>
            <hr>
            {{-- Map --}}
            @if ($apartment->address)
                <h4>Mappa</h4>
                <div id="map" data-latitude="{{ $apartment->latitude }}"
                    data-longitude="{{ $apartment->longitude }}" style="height:400px"></div>
                <hr>
            @endif

            <div>
                <h4>Messaggi ricevuti</h4>
                <div class="message-list accordion accordion-flush" id="accordionFlushExample">
                    @forelse ($apartment->messages as $message)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $message->id }}" aria-expanded="false"
                                    aria-controls="flush-collapse{{ $message->id }}">
                                    Messaggio ricevuto da {{ $message->name }}
                                    <div class="text-gradient" style="font-size: 12px">
                                        {{ $message->created_at->format('d/m/y') }}
                                        alle
                                        {{ $message->created_at->format('H:i') }}
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-collapse{{ $message->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p>{{ $message->content }}</p>
                                    <hr>
                                    <div><i class="fa-solid fa-envelope"></i> <i> {{ $message->email }} </i></div>

                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Empty message --}}
                        <div class="text-center" colspan="8">
                            Non hai ricevuto nessun messaggio
                        </div>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                    @endforelse
                </div>
            </div>
            </div>
            </div>

        </section>

    </section>

    {{-- Delete Modal --}}
    @include('includes.delete-modal')
@endsection



@section('scripts')
    @vite(['resources/js/confirm-delete.js', 'resources/js/map-viewer.js'])
@endsection
