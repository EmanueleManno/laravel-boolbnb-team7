<table class="table table-white table-hover align-middle">

    {{-- Table Headers --}}
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col" class="d-none d-lg-table-cell">Anteprima</th>
            <th scope="col">Titolo</th>
            @if (Route::is('admin.apartments.index'))
                <th scope="col">Stato</th>
                <th scope="col" class="d-none d-md-table-cell">Categoria</th>
                <th scope="col">Fine promozione</th>
                <th scope="col" class="d-none d-lg-table-cell">Data Creazione</th>
                <th scope="col" class="d-none d-lg-table-cell">Ultima Modifica</th>
            @else
                <th scope="col" class="d-none d-lg-table-cell">Data Creazione</th>
                <th scope="col">Data Eliminazione</th>
            @endif

            <th scope="col"></th>
        </tr>
    </thead>

    {{-- Table Body --}}
    <tbody>
        @forelse ($apartments as $apartment)
            <tr>
                {{-- ID --}}
                <th scope="row">
                    {{ $apartment->id }}</th>

                {{-- Preview --}}
                <td class="d-none d-lg-table-cell">
                    <img src="{{ $apartment->image ? $apartment->get_image() : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $apartment->title }}" class="image-preview">
                </td>

                @if (Route::is('admin.apartments.index'))
                    {{-- Title --}}
                    <td class="apartment-title">
                        <div>
                            <a href="{{ route('admin.apartments.show', $apartment) }}">{{ $apartment->title }}</a>
                        </div>
                    </td>

                    {{-- Status (is_visible) --}}
                    <td>{{ $apartment->is_visible ? 'Pubblicato' : 'Bozza' }}</td>

                    {{-- Category --}}
                    <td class="d-none d-md-table-cell">
                        @if ($apartment->category)
                            {{ $apartment->category->name }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- Promotion End Date --}}
                    <td class="promotion">
                        @if ($apartment->promotions_max_apartment_promotionend_date)
                            {{ $apartment->getDate('promotions_max_apartment_promotionend_date') }}
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Promo attive
                                </button>
                                <ol class="dropdown-menu">
                                    <h6>A partire dal giorno
                                        <br><b
                                            class="fw-bold">{{ $apartment->formatDate($apartment->promotions[0]->created_at) }}</b>
                                    </h6>
                                    <hr>
                                    @foreach ($apartment->promotions as $key => $promotion)
                                        <li>
                                            <div>
                                                {{ $key + 1 }}
                                            </div>
                                            <div class="{{ $promotion->name }}">
                                                {{ $promotion->name }}
                                            </div>
                                            <div>
                                                Per {{ $promotion->duration }} ore
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @else
                            -
                        @endif
                    </td>

                    {{-- Dates --}}
                    <td class="d-none d-lg-table-cell">{{ $apartment->getDate('created_at') }}</td>
                    <td class="d-none d-lg-table-cell">{{ $apartment->getDate('updated_at') }}</td>
                @else
                    {{-- Title (trash version) --}}
                    <td>
                        {{ $apartment->title }}
                    </td>

                    {{-- Dates --}}
                    <td class="d-none d-lg-table-cell">{{ $apartment->getDate('created_at') }}</td>
                    <td>{{ $apartment->getDate('deleted_at') }}</td>
                @endif

                {{-- Actions --}}
                <td>
                    <div class="d-flex justify-content-center">

                        @if (Route::is('admin.apartments.index'))
                            <div class="dropdown apartments-action-list">
                                <button class="circle-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        {{-- Show --}}
                                        <a href="{{ route('admin.apartments.show', $apartment) }}"
                                            class="admin-action info">
                                            <i class="fas fa-eye"></i>Dettaglio
                                        </a>
                                    </li>
                                    <li>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.apartments.edit', $apartment) }}"
                                            class="admin-action warning">
                                            <i class="fas fa-pencil"></i>Modifica
                                        </a>
                                    </li>
                                    <hr>
                                    <li>
                                        {{-- Soft Delete --}}
                                        <form action="{{ route('admin.apartments.destroy', $apartment) }}"
                                            method="POST" class="delete-form" data-title="{{ $apartment->title }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-action danger">
                                                <i class="fas fa-trash"></i>
                                                Elimina
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            {{-- Promote --}}
                            <a href="{{ route('admin.apartments.promote', $apartment) }}" class="circle-button promote"
                                title="Effettua l'Upgrade">
                                <i class="fa-solid fa-arrow-up"></i>
                            </a>

                            {{-- Trash Actions --}}
                        @else
                            {{-- Restore --}}
                            <form action="{{ route('admin.apartments.restore', $apartment) }}" method="POST"
                                class="ms-2">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">
                                    <i class="d-inline-block d-md-none fa-solid fa-recycle"></i>
                                    <span class="d-none d-md-flex"> Ripristina elemento</span>
                                </button>
                            </form>

                            <!--Commentato l'elimina definitivamente-->
                            {{-- Drop --}}
                            <!--<form action="{{-- {{ route('admin.apartments.drop', $apartment) }}" --}} method="POST"
                                class="delete-form ms-2" data-title="{{-- {{ $apartment->title }}" --}} data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                {{-- @csrf
                                @method('DELETE') --}}
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="d-inline-block d-md-none fa-solid fa-trash-can"></i>
                                    <span class="d-none d-md-flex"> Elimina definitivamente</span>
                                </button>
                            </form>-->
                        @endif


                    </div>
                </td>
            </tr>

            {{-- Empty message --}}
        @empty
            <tr>
                @if (Route::is('admin.apartments.index'))
                    <td class="text-center" colspan="9">
                        <h5>Qui potrai gestire i tuoi boolbnb</h5>
                    </td>
                @else
                    <td class="text-center" colspan="6">
                        <h5>Cestino vuoto</h5>
                    </td>
                @endif
            </tr>
        @endforelse
    </tbody>
</table>


{{-- Pagination --}}
@if ($apartments->hasPages())
    {{ $apartments->links() }}
@endif
