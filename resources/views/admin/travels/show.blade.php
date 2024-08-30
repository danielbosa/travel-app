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
                                @if($day->done)
                                    <span class="text-success">Completato</span>
                                @else
                                    <span class="text-danger">Non completato</span>
                                @endif
                                <br>
                                Ordine: {{ $day->order }}
                                
                                <h6>Tappe:</h6>
                                @if($day->stops->isEmpty())
                                    <p>Non ci sono tappe associate a questa giornata.</p>
                                @else
                                    <div class="container">
                                        @foreach($day->stops as $stop)
                                            <div class="row mb-2 align-items-center">
                                                <!-- Nome dello stop -->
                                                <div class="col-9">
                                                    <strong>{{ $stop->name }}</strong>
                                                </div>
                                                <!-- Checkbox -->
                                                <div class="col-3 d-flex justify-content-end">
                                                    <input type="checkbox" class="stop-checkbox" data-id="{{ $stop->id }}" {{ $stop->visited ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
