<table class="table table-white table-hover align-middle mt-5">

    {{-- Table Headers --}}
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col" class="d-none d-lg-table-cell">Anteprima</th>
            <th scope="col">Titolo</th>
            <th scope="col">Stato</th>
            <th scope="col" class="d-none d-md-table-cell">Categoria</th>
            <th scope="col" class="d-none d-lg-table-cell">Data Creazione</th>
            <th scope="col" class="d-none d-lg-table-cell">Ultima Modifica</th>
            <th scope="col"></th>
        </tr>
    </thead>

    {{-- Table Body --}}
    <tbody>
        @forelse ($apartments as $apartment)
            <tr>
                {{-- ID --}}
                <th scope="row">{{ $apartment->id }}</th>

                {{-- Preview --}}
                <td class="d-none d-lg-table-cell">
                    <img src="{{ $apartment->image ? $apartment->get_image() : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $apartment->title }}" class="image-preview">
                </td>

                {{-- Title --}}
                <td>{{ $apartment->title }}</td>

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

                {{-- Dates --}}
                <td class="d-none d-lg-table-cell">{{ $apartment->created_at }}</td>
                <td class="d-none d-lg-table-cell">{{ $apartment->updated_at }}</td>

                {{-- Actions --}}
                <td>
                    <div class="d-flex justify-content-center">

                        @if (!$apartment->deleted_at)
                            {{-- Show --}}
                            <a href="{{ route('admin.apartments.show', $apartment) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i><span class="d-none d-md-flex">Dettaglio</span>
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.apartments.edit', $apartment) }}"
                                class="btn btn-sm btn-warning ms-2">
                                <i class="fas fa-pencil"></i><span class="d-none d-md-flex">Modifica</span>
                            </a>

                            {{-- Soft Delete --}}
                            <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                                class="delete-form ms-2" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                    <span class="d-none d-md-flex">Elimina</span>
                                </button>
                            </form>

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

                            {{-- Drop --}}
                            <form action="{{ route('admin.apartments.drop', $apartment) }}" method="POST"
                                class="delete-form ms-2" data-title="{{ $apartment->title }}" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="d-inline-block d-md-none fa-solid fa-trash-can"></i>
                                    <span class="d-none d-md-flex"> Elimina definitivamente</span>
                                </button>
                            </form>
                        @endif


                    </div>
                </td>
            </tr>

            {{-- Empty message --}}
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
