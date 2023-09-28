@if ($apartment->exists)
    <h1 class="text-center mt-5">Modifica un appartamento: {{ $apartment->title }}</h1>
    <form id="validation-form" method="POST" action="{{ route('admin.apartments.update', $apartment) }}" class="p-5 mt-5"
        novalidate>
        @method('PUT')
    @else
        <h1 class="text-center mt-5">Crea un appartamento: {{ $apartment->title }}</h1>
        <form id="validation-form" method="POST" action="{{ route('admin.apartments.store') }}" class="p-5 mt-2"
            novalidate>
@endif
@csrf

<div class="row">

    {{-- # Title --}}
    <div class="mb-3 col-6">
        <label for="title" class="form-label @error('title') is-invalid @enderror">Titolo</label>
        <span class="form-text">*</span>
        <input value="{{ old('title', $apartment->title) }}" type="text"
            class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp"
            name="title" required>
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
        @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span id="title-error" class="text-danger"></span>
    </div>

    {{-- # Description --}}
    <div class="mb-3 col-12">
        <label for="description" class="form-label">Descrizione</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
            rows="10">{{ old('description', $apartment->description) }}</textarea>
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span id="description-error" class="text-danger"></span>
    </div>

    <div class="row align-items-center">
        {{-- # Image --}}
        <div class="col-10 mb-3">
            <label for="image" class="form-label">Url dell'immagine</label>
            <input type="url"class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{ old('image', $apartment->image) }}" placeholder="Insersisci un url valido">
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span id="image-error" class="text-danger"></span>
        </div>

        {{-- # Image preview --}}
        <div class="col-2">
            <img src="{{ old('image', 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=') }}"
                alt="preview" class="img-fluid my-2" id="image-preview">
        </div>
    </div>

    <div class="row mb-3">
        {{-- Categories --}}
        <div class="col-12">
            <label for="categories" class="form-label">Categorie</label>
            <select id="categories" class="form-select form-select-lg mb-3" aria-label="Large select example"
                name="category_id">
                <option value="">Nessuna categoria</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $apartment->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-5">
        {{-- Services --}}

        <div class="col-12">

            <label class="form-label">Servizi</label>
            <span class="form-text">*</span>

            <div class="border rounded p-2">
                @foreach ($services as $service)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" @if (in_array($service->id, old('services', $apartment_service_id ?? []))) checked @endif
                            id="service-{{ $service->id }}" value="{{ $service->id }}" name="services[]">
                        <label class="form-check-label me-3"
                            for="service-{{ $service->id }}">{{ $service->name }}</label>
                    </div>
                @endforeach
            </div>

            @error('services')
                <div class="col-12 text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

        </div>

    </div>

    <div class="row mb-3">
        {{-- # Price --}}
        <div class="col-6">
            <label for="price" class="form-label">Prezzo</label>
            <span class="form-text">*</span>
            <input value="{{ old('price', $apartment->price) }}" type="number" min="0" step="0.01"
                class="form-control @error('price') is-invalid @enderror" id="price" name="price" required>
            <div class="invalid-feedback">
                {{ $errors->first('price') }}
            </div>

            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span id="price-error" class="text-danger"></span>
        </div>
    </div>

    <div class="row mb-3">
        {{-- # Rooms --}}
        <div class="col-12 col-sm-4">
            <label for="rooms" class="form-label">Numero di stanze</label>
            <span class="form-text"></span>
            <input value="{{ old('rooms', $apartment->rooms) }}" type="number"
                class="form-control @error('rooms') is-invalid @enderror" id="rooms" name="rooms"
                min="0">
            <div class="invalid-feedback">
                {{ $errors->first('rooms') }}
            </div>
        </div>

        {{-- # Beds --}}
        <div class="mb-3 col-12 col-sm-4">
            <label for="beds" class="form-label">Numero di letti</label>
            <span class="form-text"></span>
            <input value="{{ old('beds', $apartment->beds) }}" type="number"
                class="form-control @error('beds') is-invalid @enderror" id="beds" name="beds"
                min="0">
            <div class="invalid-feedback">
                {{ $errors->first('beds') }}
            </div>
        </div>

        {{-- # Bathrooms --}}
        <div class="col-12 col-sm-4">
            <label for="bathrooms" class="form-label">Numero di bagni</label>
            <span class="form-text"></span>
            <input value="{{ old('bathrooms', $apartment->bathrooms) }}" type="number"
                class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" name="bathrooms"
                min="0">
            <div class="invalid-feedback">
                {{ $errors->first('bathrooms') }}
            </div>
        </div>
    </div>

    <div class="row mb-3">
        {{-- # Square meters --}}
        <div class="col-4">
            <label for="square_meters" class="form-label">Metri quadri</label>
            <span class="form-text"></span>
            <input value="{{ old('square_meters', $apartment->square_meters) }}" type="number"
                class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                name="square_meters" min="0">
            <div class="invalid-feedback">
                {{ $errors->first('square_meters') }}
            </div>
        </div>
    </div>

    <div class="row mb-3">
        {{-- # Address --}}
        <div class="col-12">
            <label for="address-search" class="form-label">Indirizzo</label>

            <div class="position-relative">

                {{-- Search Input --}}
                <input id="address-search" autocomplete="off" value="{{ old('address', $apartment->address) }}"
                    type="text" class="form-control" list="api-suggestions">

                {{-- Errors --}}
                <div class="invalid-feedback">
                    {{ $errors->first('address') }}
                </div>

                {{-- API Suggestion List --}}
                <ul id="api-suggestions" class="suggestions-list"></ul>
            </div>

            {{-- Chosen Place Input --}}
            <input type="text" readonly name="address" id="address"
                class="form-control-plaintext fw-bold p-2 mt-2" value="{{ old('address', $apartment->address) }}">

            {{-- Hidden Latitude and Longitude Fields --}}
            <input type="hidden" name="latitude" id="latitude"
                value="{{ old('latitude', $apartment->latitude) }}">
            <input type="hidden" name="longitude" id="longitude"
                value="{{ old('longitude', $apartment->longitude) }}">
        </div>
    </div>

    {{-- # Is Visible --}}
    <div class="mb-3 col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible"
                value="1" @if (old('is_visible', $apartment->is_visible)) checked @endif>
            <label class="ms-2 form-check-label" for="is_visible">Pubblica</label>
        </div>
    </div>


    <div class="d-flex align-items-center justify-content-between ">
        <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">Torna indietro</a>

        {{-- # Submit --}}
        <button type="submit" class="btn btn-success">Conferma</button>
    </div>
</div>
</form>
