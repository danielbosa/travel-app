<!-- resources/views/admin/stops/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Aggiungi Nuova Tappa</h1>
    <form method="POST" action="{{ route('stops.store') }}">
        @csrf
        <!-- Campi per la tappa -->
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
    
        <!-- Campi per la località -->
        <div class="mb-3">
            <label for="autocomplete" class="form-label">Località</label>
            <input type="text" class="form-control" id="autocomplete" name="name_location" required>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
        </div>
    
        <!-- Campi nascosti per travel_id e day_id -->
        <input type="hidden" name="travel_id" value="{{ $travel_id }}">
        <input type="hidden" name="day_id" value="{{ $day_id }}"> <!-- Passa il day_id al form -->

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>

<!-- Include Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places"></script>

<script>
    function initAutocomplete() {
        const input = document.getElementById('autocomplete');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        const autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                latitudeInput.value = place.geometry.location.lat();
                longitudeInput.value = place.geometry.location.lng();
                input.value = place.name; // Set the name of the place
            }
        });
    }

    window.onload = initAutocomplete;
</script>
@endsection
