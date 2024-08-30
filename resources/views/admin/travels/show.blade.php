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
                                                        <strong>{{ $stop->name }}</strong>
                                                    </div>
                                                    <div class="col-md-4 text-end">
                                                        <input type="checkbox" class="stop-checkbox" data-id="{{ $stop->id }}" {{ $stop->visited ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Slider per le immagini delle tappe -->
                                    <h6>Immagini delle tappe:</h6>
                                    @php
                                        // Recupera tutte le immagini delle tappe di questa giornata
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
</section>
@endsection
