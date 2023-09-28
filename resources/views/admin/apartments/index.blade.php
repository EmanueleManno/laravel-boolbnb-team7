@extends('layouts.app')

@section('title', 'Aparments')

@section('main')

    <!--Contenitore-->
    <div class="container my-5">

        <!--Header-->
        <header class="d-flex align-items-center justify-content-between pb-4">

            <!--Titolo-->
            <h2>Lista Appartamenti</h2>

            <!--Pulsante di aggiunta di un nuovo appartamento-->
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-success">
                <span class="d-none d-md-flex">
                    @if (count($apartments))
                        Aggiungi nuovo appartamento
                    @else
                        Clicca qui per aggiungere il tuo primo appartamento!
                    @endif
                </span>
                <i class="d-flex d-md-none fa-solid fa-plus"></i>
            </a>

        </header>

        {{-- Alerts --}}
        <div class="container my-2">
            @include('includes.alerts')
        </div>

        <!--Tabella nella quale visualizzo la lista degli appartamenti-->
        <table class="table table-white table-hover align-middle mt-5">

            <!--Intestazione della tabella-->
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="d-none d-lg-table-cell">Anteprima</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Stato</th>
                    <th scope="col" class="d-none d-lg-table-cell">Categoria</th>
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
                        <td class="d-none d-lg-table-cell">
                            <img src="{{ $apartment->image ?? 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                                alt="{{ $apartment->title }}" class="image-preview">
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

                                <!--Icona per modificare l'appartamento-->
                                <a href="{{ route('admin.apartments.edit', $apartment) }}"
                                    class="btn btn-sm btn-warning ms-2">
                                    <i class="fas fa-pencil"></i><span class="d-none d-md-flex">Modifica</span>
                                </a>

                                <!--Icona per eliminare il progetto-->
                                <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                                    class="delete-form ms-2" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i><span class="d-none d-md-flex">Elimina</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!--Se non ci sono appartamenti-->
                @empty
                    <tr>
                        <td class="text-center" colspan="8">
                            <h3>Non ci sono appartamenti</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        {{-- Pagination --}}
        @if ($apartments->hasPages())
            {{ $apartments->links() }}
        @endif

    </div>

    {{-- Delete Modal --}}
    @include('includes.delete-modal')

@endsection

@section('scripts')

    @vite('resources/js/confirm-delete.js')

@endsection
