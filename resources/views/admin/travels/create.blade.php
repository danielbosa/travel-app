@extends('layouts.app')

@section('content')
<section class="container pt-4">
    <h1>Crea un nuovo viaggio</h1>
    <form action="{{ route('travels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome del viaggio</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date_start" class="form-label">Data di inizio</label>
            <input type="date" class="form-control" id="date_start" name="date_start" value="{{ old('date_start') }}" required>
        </div>
        <div class="mb-3">
            <label for="date_end" class="form-label">Data di fine</label>
            <input type="date" class="form-control" id="date_end" name="date_end" value="{{ old('date_end') }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</section>
@endsection
