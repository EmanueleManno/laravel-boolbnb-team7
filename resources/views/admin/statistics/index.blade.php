@extends('layouts.app')

@section('title', 'Statistics')

@section('main')

    <div class="container my-5">

        {{-- Alerts --}}
        <div class="my-2">
            @include('includes.alerts')
        </div>

        <!--Header-->
        <header class="d-flex align-items-center justify-content-between pb-4">

            {{-- Page Title --}}
            <h2>Lista Statistiche</h2>

        </header>

        <table class="table table-white table-hover align-middle mt-5">

            {{-- Table Headers --}}
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Indirizzo IP</th>
                    <th scope="col">Data</th>
                    <th scope="col">ID Appartamento</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            {{-- Table Body --}}
            <tbody>
                @forelse ($statistics as $statistic)
                    <tr>
                        {{-- ID --}}
                        <th scope="row">{{ $statistic->id }}</th>

                        {{-- IP Address --}}
                        <td>{{ $statistic->ip_address }}</td>

                        {{-- Date --}}
                        <td>{{ $statistic->getDate('date') }}</td>

                        {{-- Apartment_id --}}
                        <td>{{ $statistic->apartment_id }}</td>

                    </tr>

                    {{-- Empty message --}}
                @empty
                    <tr>
                        <td class="text-center" colspan="8">
                            <h3>Non ci sono statistiche</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection
