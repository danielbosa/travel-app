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
                                Ordine: {{ $day->order }}

                                <h6>Tappe:</h6>
                                @if($day->stops->isEmpty())
                                    <p>Non ci sono tappe associate a questa giornata.</p>
                                @else
                                    <ul class="list-unstyled">
                                        @foreach($day->stops as $stop)
                                            <li class="d-flex align-items-center mb-2">
                                                <div class="row w-100">
                                                    <div class="col-md-8">
                                                        <a href="#" class="stop-name" data-bs-toggle="modal" data-bs-target="#stopModal" data-stop="{{ $stop }}" data-stop-name="{{ $stop->name }}">
                                                            <strong>{{ $stop->name }}</strong>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 text-end">
                                                        <input type="checkbox" class="stop-checkbox" data-id="{{ $stop->id }}" {{ $stop->visited ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                <!-- carousel -->
                                    <h6>Immagini delle tappe:</h6>
                                    @php
                                        // get all images
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
                        <h5 class="modal-title" id="stopModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- stop details -->
                        <div id="stopDetails">
                            <p><strong>Voto:</strong> <span id="stopRating"></span></p>
                            <p><strong>Descrizione:</strong> <span id="stopDescription"></span></p>
                            <p><strong>Note:</strong> <span id="stopNotes"></span></p>

                            <!-- carousel -->
                            <div id="stopImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" id="carouselInnerImages">
                                    <!-- images will be loaded here -->
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
@endsection

{{-- SCRIPT --}}
{{-- js script to show stop details dinamically: based on which stop is clicked --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stopModal = document.getElementById('stopModal');
            stopModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Pulsante che ha attivato la modale
                const stopData = JSON.parse(button.getAttribute('data-stop'));
                const stopName = button.getAttribute('data-stop-name'); // Recupera il nome della tappa

                // Imposta il titolo della modale con il nome della tappa
                document.getElementById('stopModalLabel').textContent = stopName;

                // Popola i campi della modale con i dati della tappa
                document.getElementById('stopRating').textContent = stopData.rating || 'N/A';
                document.getElementById('stopDescription').textContent = stopData.description || 'N/A';
                document.getElementById('stopNotes').textContent = stopData.notes || 'N/A';

                // Carica le immagini per il carosello
                const carouselInner = document.getElementById('carouselInnerImages');
                carouselInner.innerHTML = ''; // Pulisce le immagini precedenti

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
            });
        });
    </script>


