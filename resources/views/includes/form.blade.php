@if ($apartment->exists)
    <h1 class="text-center mt-5">Modifica appartamento: {{ $apartment->title }}</h1>
    <form method="POST" action=""
        class="p-5 mt-5" novalidate>
        @method('PUT')
    @else
        <form method="POST" action="" class="p-5 mt-5"
            novalidate>
@endif
@csrf

<div class="row">

    {{-- # Title --}}
    <div class="mb-3 col-6">
        <label for="title" class="form-label">Titolo</label>
        <span class="form-text">*</span>
        <input value="{{ old('title', $apartment->title) }}" type="text"
            class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp"
            name="title" required>
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    </div>

    {{-- # Description --}}
    <div class="mb-3 col-12">
        <label for="description" class="form-label">Descrizione</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
            rows="10">{{ old('description', $apartment->description) }}</textarea>
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    </div>

    {{-- # Image --}}
    <div class="col-11 mb-3">
        <label for="image" class="form-label">Url dell'immagine</label>
        <input type="url"class="form-control @error('image') is-invalid @enderror" id="image" name="image"
            value="{{ old('image', $apartment->image) }}" placeholder="Insersisci un url valido">
        <div class="invalid-feedback">
            {{ $errors->first('image') }}
        </div>
    </div>

    {{-- # Image preview --}}
    <div class="col-1">
        <img src="{{ old('image', 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=') }}"
            alt="preview" class="img-fluid my-2" id="image-preview">
    </div>

    {{-- # Price --}}
    <div class="mb-3 col-6">
        <label for="price" class="form-label">Prezzo</label>
        <span class="form-text">*</span>
        <input value="{{ old('price', $apartment->price) }}" type="number"
            class="form-control @error('price') is-invalid @enderror" id="price"
            name="price" required>
        <div class="invalid-feedback">
            {{ $errors->first('price') }}
        </div>
    </div>

    {{-- # Rooms --}}
    <div class="mb-3 col-2">
        <label for="rooms" class="form-label">Numero di stanze</label>
        <span class="form-text"></span>
        <input value="{{ old('rooms', $apartment->rooms) }}" type="number"
            class="form-control @error('rooms') is-invalid @enderror" id="rooms"
            name="rooms">
        <div class="invalid-feedback">
            {{ $errors->first('rooms') }}
        </div>
    </div>

    {{-- # Beds --}}
    <div class="mb-3 col-2">
        <label for="beds" class="form-label">Numero di letti</label>
        <span class="form-text"></span>
        <input value="{{ old('beds', $apartment->beds) }}" type="number"
            class="form-control @error('beds') is-invalid @enderror" id="beds"
            name="beds">
        <div class="invalid-feedback">
            {{ $errors->first('beds') }}
        </div>
    </div>

    {{-- # Bathrooms --}}
    <div class="mb-3 col-2">
        <label for="bathrooms" class="form-label">Numero di bagni</label>
        <span class="form-text"></span>
        <input value="{{ old('bathrooms', $apartment->bathrooms) }}" type="number"
            class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
            name="bathrooms">
        <div class="invalid-feedback">
            {{ $errors->first('bathrooms') }}
        </div>
    </div>

    {{-- # Square meters --}}
    <div class="mb-3 col-4">
        <label for="square_meters" class="form-label">Metri quadri</label>
        <span class="form-text"></span>
        <input value="{{ old('square_meters', $apartment->square_meters) }}" type="number"
            class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
            name="square_meters">
        <div class="invalid-feedback">
            {{ $errors->first('square_meters') }}
        </div>
    </div>

    {{-- # Address --}}
    <div class="mb-3 col-8">
        <label for="square_meters" class="form-label">Indirizzo</label>
        <span class="form-text"></span>
        <input value="{{ old('', ) }}" type="text" class="form-control">
    </div>

    <div class="mb-3 col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_visible">
            <label class="ms-2 form-check-label" for="is_visible">Pubblica</label>
        </div>
    </div>


    <div class="d-flex align-items-center justify-content-between ">
        <a class="btn btn-secondary" href="{{ route('apartments.index') }}">Torna indietro</a>

        {{-- # Submit --}}
        <button type="submit" class="btn btn-success">Conferma</button>
    </div>
</div>
</form>