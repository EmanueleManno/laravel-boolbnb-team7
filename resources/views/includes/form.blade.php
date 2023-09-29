@if ($apartment->exists)
    <form id="validation-form" method="POST" action="{{ route('admin.apartments.update', $apartment) }}" class="mt-5"
        novalidate>
        @method('PUT')
    @else
        <form id="validation-form" method="POST" action="{{ route('admin.apartments.store') }}" class="mt-5" novalidate>
@endif
@csrf

<div class="row" id="get-validation" data-validate="form">

    {{-- # Title --}}
    <div class="col-6 mb-4">
        <label for="title" class="form-label @error('title') is-invalid @enderror">
            Titolo
            <span class="form-text text-danger fs-5">*</span>
        </label>

        <input value="{{ old('title', $apartment->title) }}" type="text"
            class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
        @error('title')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
        <span id="title-error" class="text-danger"></span>
    </div>


    {{-- # Description --}}
    <div class="col-12 mb-4">
        <label for="description" class="form-label">Descrizione</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
            rows="10">{{ old('description', $apartment->description) }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
        <span id="description-error" class="text-danger"></span>
    </div>


    {{-- # Image Field --}}
    <div class="col-12 mb-4">
        <div class="row align-items-center">

            {{-- # Url --}}
            <div class="col-8 col-sm-9">
                <label for="image" class="form-label">Url dell'immagine</label>
                <input type="url"class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image', $apartment->image) }}" placeholder="Insersisci un url valido">
                @error('image')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
                <span id="image-error" class="text-danger"></span>
            </div>

            {{-- # Preview --}}
            <div class="col-4 col-sm-3">
                <img src="{{ old('image', $apartment->image ?? 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=') }}"
                    alt="preview" class="img-fluid" id="image-preview">
            </div>
        </div>
    </div>


    {{-- Categories --}}
    <div class="col-12 mb-4">
        <label for="categories" class="form-label">Categorie</label>
        <select id="categories" class="form-select form-select-lg @error('category_id') is-invalid @enderror"
            aria-label="Large select example" name="category_id">
            <option value="">Nessuna categoria</option>
            @foreach ($categories as $category)
                <option @if (old('category_id', $apartment->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                    {{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>


    {{-- Services --}}
    <div class="col-12 mb-4">

        <label class="form-label">
            Servizi
            <span class="form-text text-danger fs-5">*</span>
        </label>

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
            <span class="text-danger" role="alert">{{ $message }}</span>
        @enderror
        <span id="price-error" id="service-error" class="text-danger"></span>

    </div>


    {{-- # Price --}}
    <div class="col-6 mb-4">
        <label for="price" class="form-label">
            Prezzo
            <span class="form-text text-danger fs-5">*</span>
        </label>
        <input value="{{ old('price', $apartment->price) }}" type="number" min="0" step="0.01"
            class="form-control @error('price') is-invalid @enderror" id="price" name="price" required>
        @error('price')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
        <span id="price-error" class="text-danger"></span>
    </div>


    {{-- # Other Info --}}
    <div class="col-12">
        <div class="row">

            {{-- # Rooms --}}
            <div class="col-12 col-sm-4 mb-4">
                <label for="rooms" class="form-label">Numero di stanze</label>
                <input value="{{ old('rooms', $apartment->rooms) }}" type="number"
                    class="form-control @error('rooms') is-invalid @enderror" id="rooms" name="rooms"
                    min="0">
                @error('rooms')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>


            {{-- # Beds --}}
            <div class="mb-4 col-12 col-sm-4 mb-4">
                <label for="beds" class="form-label">Numero di letti</label>
                <input value="{{ old('beds', $apartment->beds) }}" type="number"
                    class="form-control @error('beds') is-invalid @enderror" id="beds" name="beds"
                    min="0">
                @error('beds')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>


            {{-- # Bathrooms --}}
            <div class="col-12 col-sm-4 mb-4">
                <label for="bathrooms" class="form-label">Numero di bagni</label>
                <input value="{{ old('bathrooms', $apartment->bathrooms) }}" type="number"
                    class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" name="bathrooms"
                    min="0">
                @error('bathrooms')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>


    {{-- # Square meters --}}
    <div class="col-4 mb-4">
        <label for="square_meters" class="form-label">Metri quadri</label>
        <input value="{{ old('square_meters', $apartment->square_meters) }}" type="number"
            class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
            name="square_meters" min="0">
        @error('square_meters')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>


    {{-- # Address --}}
    <div class="col-12 mb-4">
        <label for="address-search" class="form-label">Indirizzo</label>

        <div class="position-relative">

            {{-- Search Input --}}
            <input id="address-search" autocomplete="off" value="{{ old('address', $apartment->address) }}"
                type="text" class="form-control @error('address') is-invalid @enderror">

            {{-- Errors --}}
            @error('address')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror

            {{-- API Suggestion List --}}
            <ul id="api-suggestions" class="suggestions-list"></ul>
        </div>

        {{-- Chosen Place Input --}}
        <input type="text" readonly name="address" id="address" class="form-control-plaintext p-2 fw-bold"
            value="{{ old('address', $apartment->address) }}">

        {{-- Hidden Latitude and Longitude Fields --}}
        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $apartment->latitude) }}">
        <input type="hidden" name="longitude" id="longitude"
            value="{{ old('longitude', $apartment->longitude) }}">
    </div>


    {{-- # Is Visible --}}
    <div class="col-12 mb-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible"
                value="1" @if (old('is_visible', $apartment->is_visible)) checked @endif>
            <label class="ms-2 form-check-label" for="is_visible">Pubblica</label>
        </div>
    </div>


    {{-- # Submit --}}
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-success">Conferma</button>
    </div>

</div>
</form>
