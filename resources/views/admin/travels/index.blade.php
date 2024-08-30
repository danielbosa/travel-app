@extends('layouts.app')

@section('content')
<section class="container pt-2" id="travels">
    @if($travels->isEmpty())
        <p>Non hai viaggi registrati.</p>
    @else
    <h1>I tuoi viaggi</h1>
        @foreach($travels as $travel)
        <div class="container my-4">
            <a href="{{ route('travels.show', $travel->id) }}" class="text-decoration-none">
                <div class="row border">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center border">
                        <img src="{{ asset('images/' . $travel->image) }}" alt="{{ $travel->name }}" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-8 p-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div>
                                <h5 class="mb-1">{{ $travel->name }}</h5>
                                <p class="mb-1">{{ $travel->description }}</p>
                            </div>
                            <div class="text-md-end">
                                Periodo:
                                <span>{{ $travel->date_start }}<br>{{ $travel->date_end }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>              
        @endforeach
    @endif
</section>
@endsection
