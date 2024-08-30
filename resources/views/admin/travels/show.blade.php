@extends('layouts.app')

@section('content')
<section class="container pt-2">
    <h1>{{ $travel->name }}</h1>
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/' . $travel->image) }}" alt="{{ $travel->name }}" class="img-fluid">
            </div>
            <div class="col-12 col-md-8 p-3">
                <p>{{ $travel->description }}</p>
            </div>
        </div>
        <h6>Giornate:</h6>
        @if($travel->days->isEmpty())
            <p>Non ci sono giornate associate a questo viaggio.</p>
        @else
            <div class="accordion" id="accordionDays">
                @foreach($travel->days as $index => $day)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                                {{ $day->name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionDays">
                            <div class="accordion-body">
                                @php
                                    $completionPercentage = $day->completionPercentage ?? 0;
                                @endphp
                                <span>Completamento: {{ number_format($completionPercentage, 0) }}%</span>
                                <br>
                                {{-- Ordine: {{ $day->order }} --}}

                                <h6>Tappe:</h6>
                                @if($day->stops->isEmpty())
                                    <p>Non ci sono tappe associate a questa giornata.</p>
                                @else
                                    <ul class="list-unstyled">
                                        @foreach($day->stops as $stop)
                                            <li class="d-flex align-items-center mb-2">
                                                <div class="row w-100">
                                                    <div class="col-8">
                                                        <a href="#" class="stop-name" data-bs-toggle="modal" data-bs-target="#stopModal" data-stop="{{ $stop->toJson() }}">
                                                            <strong>{{ $stop->name }}</strong>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <input type="checkbox" class="stop-checkbox" data-id="{{ $stop->id }}" {{ $stop->visited ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Pulsante per aggiungere una nuova tappa -->
                                    <div class="text-end mt-3">
                                        <a href="{{ route('stops.create', ['travel_id' => $travel->id, 'day_id' => $day->id]) }}" class="btn btn-primary">Aggiungi Nuova Tappa</a>
                                    </div>

                                    <!-- carousel -->
                                    <h6>Immagini delle tappe:</h6>
                                    @php
                                        $images = $day->stops->map(function ($stop) {
                                            return $stop->stop_images;
                                        })->flatten();
                                    @endphp
                                    @if($images->isEmpty())
                                        <p>Non ci sono immagini per le tappe di questa giornata.</p>
                                    @else
                                        <div id="carouselImages{{ $index }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($images as $imageIndex => $image)
                                                    <div class="carousel-item {{ $imageIndex === 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('images/stop_images/' . $image->image_path) }}" class="d-block w-100" alt="Image for stop {{ $image->stop_id }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages{{ $index }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselImages{{ $index }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                        <!-- Autoplay for carousel -->
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const carouselElement = document.getElementById('carouselImages{{ $index }}');
                                                if (carouselElement) {
                                                    const carousel = new bootstrap.Carousel(carouselElement, {
                                                        interval: 5000, // 5 seconds
                                                        ride: 'carousel'
                                                    });
                                                }
                                            });
                                        </script>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <!-- create btn -->
        <div class="text-center my-4">
            <a href="{{ route('travels.create') }}" class="btn-cta">
                Crea una nuova giornata
            </a>
        </div>
    </div>
    <!-- modal for stop details -->
    <div class="modal fade" id="stopModal" tabindex="-1" aria-labelledby="stopModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stopModalLabel">Dettagli Tappa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dettagli della tappa -->
                    <div id="stopDetails">
                        <p><strong>Voto:</strong> <span id="stopRating"></span></p>
                        <p><strong>Descrizione:</strong> <span id="stopDescription"></span></p>
    
                        <!-- Campo Note Modificabile -->
                        <div id="noteSection">
                            <p><strong>Note:</strong> 
                                <span id="stopNotes">
                                    <span id="stopNotesText">N/A</span>
                                    <i class="fa-solid fa-pen-to-square" id="editNotesIcon" style="cursor: pointer;"></i>
                                </span>
                            </p>
                            <!-- Textarea nascosta inizialmente per modificare le note -->
                            <textarea id="notesTextarea" class="form-control d-none"></textarea>
                            <!-- Bottoni per salvare o annullare le modifiche -->
                            <div id="notesButtons" class="mt-2 d-none">
                                <button id="saveNotesBtn" class="btn btn-primary btn-sm">Salva</button>
                                <button id="cancelNotesBtn" class="btn btn-secondary btn-sm">Annulla</button>
                            </div>
                        </div>
    
                        <!-- Carosello delle immagini -->
                        <div id="stopImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carouselInnerImages">
                                <!-- Immagini verranno caricate qui -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#stopImagesCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#stopImagesCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <!-- Map -->
                        <div id="stopMap" style="width: 100%; height: 400px; margin-top: 20px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

{{-- SCRIPT --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap"></script>
<script>
    let stopData; // Definisci stopData a livello globale

    // Funzione per inizializzare la mappa
    function initMap() {
        if (!stopData || !stopData.location.lat || !stopData.location.lng) {
            console.error('stopData non definito o lat/lng mancante');
            return;
        }

        const mapOptions = {
            center: { lat: stopData.location.lat, lng: stopData.location.lng },
            zoom: 12
        };

        const map = new google.maps.Map(document.getElementById('stopMap'), mapOptions);

        // Aggiungi un marcatore alla mappa
        new google.maps.Marker({
            position: { lat: stopData.location.lat, lng: stopData.location.lng },
            map: map,
            title: stopData.name
        });
    }

    // Gestisci l'apertura della modale
    document.addEventListener('DOMContentLoaded', function() {
        const stopModal = document.getElementById('stopModal');
        stopModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            stopData = JSON.parse(button.getAttribute('data-stop'));

            // Verifica i dati ricevuti
            console.log('stopData:', stopData);

            // Passa i dati alla modale
            document.getElementById('stopModalLabel').textContent = stopData.name;
            document.getElementById('stopRating').textContent = stopData.rating || 'N/A';
            document.getElementById('stopDescription').textContent = stopData.description || 'N/A';

            // Aggiorna il campo note
            const stopNotes = document.getElementById('stopNotes');
            stopNotes.innerHTML = `
                <span id="stopNotesText">${stopData.notes || 'N/A'}</span>
                <i class="fa-solid fa-pen-to-square" id="editNotesIcon" style="cursor: pointer;"></i>
            `;

            // Carica le immagini del carosello
            const carouselInner = document.getElementById('carouselInnerImages');
            carouselInner.innerHTML = '';

            if (stopData.stop_images.length > 0) {
                stopData.stop_images.forEach(function(image, index) {
                    const activeClass = index === 0 ? 'active' : '';
                    carouselInner.innerHTML += `
                        <div class="carousel-item ${activeClass}">
                            <img src="{{ asset('images/stop_images/') }}/${image.image_path}" class="d-block w-100" alt="Immagine Tappa">
                        </div>
                    `;
                });
            } else {
                carouselInner.innerHTML = '<p>Non ci sono immagini per questa tappa.</p>';
            }

            // Inizializza la mappa
            initMap();
        });
    });

    // Gestisci il click sull'icona di modifica
    document.addEventListener('click', function(event) {
        if (event.target.id === 'editNotesIcon') {
            const stopNotes = document.getElementById('stopNotes');
            stopNotes.innerHTML = `
                <textarea id="stopNotesTextarea" class="form-control mb-2">${stopData.notes || ''}</textarea>
                <button id="saveNotesBtn" class="btn btn-success btn-sm me-2">Salva</button>
                <button id="cancelNotesBtn" class="btn btn-secondary btn-sm">Annulla</button>
            `;
        }

        // Gestisci il click sul tasto "Salva"
        if (event.target.id === 'saveNotesBtn') {
            const newNotes = document.getElementById('stopNotesTextarea').value;

            // Effettua la richiesta AJAX per salvare le note
            fetch(`/stops/${stopData.id}/update-notes`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ notes: newNotes })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Aggiorna stopData con le nuove note
                    stopData.notes = newNotes;

                    // Aggiorna il campo note con il nuovo testo e ripristina l'icona di modifica
                    document.getElementById('stopNotes').innerHTML = `
                        <span id="stopNotesText">${newNotes}</span>
                        <i class="fa-solid fa-pen-to-square" id="editNotesIcon" style="cursor: pointer;"></i>
                    `;
                } else {
                    alert('Errore durante il salvataggio delle note.');
                }
            })
            .catch(error => console.error('Errore:', error));
        }

        // Gestisci il click sul tasto "Annulla"
        if (event.target.id === 'cancelNotesBtn') {
            const stopNotes = document.getElementById('stopNotes');
            // Ripristina il contenuto originale delle note con l'icona di modifica
            stopNotes.innerHTML = `
                <span id="stopNotesText">${stopData.notes || 'N/A'}</span>
                <i class="fa-solid fa-pen-to-square" id="editNotesIcon" style="cursor: pointer;"></i>
            `;
        }
    });
</script>

