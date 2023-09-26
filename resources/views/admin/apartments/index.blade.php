@extends('layouts.app')

@section('title', 'Aparments')

@section('content')

<!--Contenitore-->
<div class="container my-2">

<!--Header-->
<header class="d-flex align-items-center justify-content-between">

    <!--Titolo-->
    <h1>Lista Appartamenti</h1>

    <!--Pulsante di aggiunta di un nuovo appartamento-->
    <a href="{{ route('apartments.create')}}" class="btn btn-success">Aggiungi nuovo appartamento</a>

</header>

<hr>

<!--Tabella nella quale visualizzo la lista degli appartamenti-->
<table class="table table-light table-hover">

    <!--Intestazione della tabella-->
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Titolo</th>
        <th scope="col">Data Creazione</th>
        <th scope="col">Ultima Modifica</th>
        <th scope="col"></th>
      </tr>
    </thead>

    <!--Corpo della tabella-->
    <tbody>
        @forelse ($apartments as $apartment)
      <tr>
        <th scope="row">{{$apartment->id}}</th>
        <td>{{ $apartment->title }}</td>
        <td>{{ $apartment->created_at }}</td>
        <td>{{ $apartment->updated_at }}</td>

        <!--Dettaglio, modifica e eliminazione-->
        <td>
            <div class="d-flex justify-content-center">

                <!--Per vedere il dettaglio-->
                <a href="{{ route('apartments.show', $apartment)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i>Dettaglio
                </a>

                <!--Icona per modificare l'appartamento-->
                <a href="{{ route('apartments.edit', $apartment)}}" class="btn btn-sm btn-warning ms-2">
                    <i class="fas fa-pencil"></i>Modifica
                </a>

                <!--Icona per eliminare il progetto-->
                <form action="{{ route('apartments.destroy', $apartment) }}" method="POST"
                  class="delete-form ms-2" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                  data-bs-target="#deleteModal">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i>Elimina
                   </button>
                </form>
            </div>
        </td>
      </tr>

        <!--Se non ci sono appartamenti-->
        @empty
            <tr>
                <td class="text-center" colspan="6">
                    <h3>Non ci sono appartamenti</h3>
                </td>
            </tr>
        @endforelse
    </tbody>
  </table>
</div>

  {{-- Delete Modal--}}
  @include('includes.delete-modal')
@endsection

@section('scripts')

@vite('resources/js/confirm-delete.js')

@endsection