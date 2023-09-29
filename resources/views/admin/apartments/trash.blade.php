@extends('layouts.app')

@section('title', 'trash')

@section('main')

    <!--Contenitore-->
    <div class="container my-2">

        <!--Header-->
        <header class="d-flex align-items-center justify-content-between">

            <!--Titolo-->
            <h1>Cestino</h1>

            <!--Pulsante nel quale vengo reindirizzato alla home-->
            <div class="d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">Torna alla Lista</a>
            </div>
        </header>

        {{-- Alerts --}}
        <div class="container my-2">
            @include('includes.alerts')
        </div>

        <!--Tabella nella quale visualizzo la lista degli appartamenti-->
        <table class="table table-light table-hover">

            <!--Intestazione della tabella-->
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="d-none d-lg-table-cell">Anteprima</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Stato</th>
                    <th scope="col" class="d-none d-lg-table-cell">Categoria</th>
                    <th scope="col" class="d-none d-lg-table-cell">Servizi</th>
                    <th scope="col" class="d-none d-lg-table-cell">Data Creazione</th>
                    <th scope="col" class="d-none d-lg-table-cell">Ultima Modifica</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <!--Corpo della tabella-->
            <tbody>
                @forelse ($apartments as $apartment)
                    <tr>
                        <!--Id dell'appartamento-->
                        <th scope="row">{{ $apartment->id }}</th>

                        <!-- Preview Immagine-->
                        <td class="d-none d-lg-table-cell"><img src="{{ $apartment->image ?? ('https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=') }}"
                            alt="preview" class="my-2" height="75px" width="75px" id="image-preview">
                        </td>
        
                        <!--Titolo dell'appartamento-->
                        <td>{{ $apartment->title }}</td>

                        <!--Stato dell'appartamento-->
                        <td>{{ $apartment->is_visible ? 'Pubblicato' : 'Bozza' }}</td>

                        <!--Categoria dell'appartamento-->
                        <td class="d-none d-lg-table-cell">
                            @if ($apartment->category)
                                {{ $apartment->category->name }}
                            @else
                                -
                            @endif
                        </td>

                        <!--Servizi dell'appartamento-->
                        <td class="d-none d-lg-table-cell">

                            @forelse ($apartment->services as $service)
                                {{ $service->name }} @if (!$loop->last)
                                    ,
                                @endif
                            @empty
                                -
                            @endforelse
                        </td>

                        <!--Data di creazione e ultima modifica-->
                        <td class="d-none d-lg-table-cell">{{ $apartment->created_at }}</td>
                        <td class="d-none d-lg-table-cell">{{ $apartment->updated_at }}</td>

                        <!--Dettaglio, modifica e eliminazione-->
                        <td>
                            <div class="d-flex justify-content-center">

                                <!--Per vedere il dettaglio-->
                                <a href="{{ route('admin.apartments.show', $apartment) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i><span class="d-none d-md-flex">Dettaglio</span>
                                </a>

                                <!--Icona per ripristinare l'appartamento-->
                                <form action="{{ route('admin.apartments.restore', $apartment)}}" method="POST" class="ms-2">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success">
                                    <i class="fas fa-refresh"></i><span class="d-none d-md-flex">Ripristina</span></button>
                                </form>

                                <!--Icona per eliminare DEFINITIVAMENTE il progetto-->
                                <form action="{{ route('admin.apartments.drop', $apartment) }}" method="POST"
                                    class="delete-form ms-2" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i><span class="d-none d-md-flex">Elimina definitivamente</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                <!--Se non ci sono appartamenti-->
                @empty
                    <tr>
                        <td class="text-center" colspan="9">
                            <h3>Non ci sono appartamenti nel cestino</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Delete Modal --}}
    @include('includes.delete-modal')

@endsection

@section('scripts')

    @vite('resources/js/confirm-delete.js')

@endsection