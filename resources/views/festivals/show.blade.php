@extends('layouts.app')

@section('title', $festival->name)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('festivals.index') }}">Festivals</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $festival->name }}</li>
        </ol>
    </nav>

    <!-- Festival Banner -->
    @if($festival->banner_image)
    <div class="festival-banner mb-4">
        <img src="{{ asset('storage/' . $festival->banner_image) }}" 
             class="img-fluid rounded" 
             alt="{{ $festival->name }}">
    </div>
    @endif

    <div class="row">
        <!-- Festival Details -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="h2 mb-0">{{ $festival->name }}</h1>
                        <span class="badge bg-primary">{{ $festival->location }}</span>
                    </div>

                    <div class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar me-2 text-muted"></i>
                                    <div>
                                        <div class="small text-muted">Start</div>
                                        <div>{{ $festival->start_date->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-check me-2 text-muted"></i>
                                    <div>
                                        <div class="small text-muted">Eind</div>
                                        <div>{{ $festival->end_date->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                    <div>
                                        <div class="small text-muted">Locatie</div>
                                        <div>{{ $festival->location }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-ticket-alt me-2 text-muted"></i>
                                    <div>
                                        <div class="small text-muted">Beschikbare Tickets</div>
                                        <div>{{ $festival->available_tickets }} van {{ $festival->capacity }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3 class="h5 mb-3">Over het Festival</h3>
                        <p class="text-muted">{{ $festival->description }}</p>
                    </div>

                    @can('update', $festival)
                    <div class="d-flex gap-2">
                        <a href="{{ route('festivals.edit', $festival) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Bewerken
                        </a>
                        <form action="{{ route('festivals.destroy', $festival) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Weet je zeker dat je dit festival wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-2"></i>Verwijderen
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Ticket Options -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="h4 mb-4">Tickets</h3>

                    @if($festival->is_sold_out)
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Dit festival is uitverkocht!
                        </div>
                    @else
                        @forelse($festival->active_tickets as $ticket)
                            <div class="ticket-option mb-3 p-3 border rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h4 class="h5 mb-0">{{ $ticket->type }}</h4>
                                    <span class="badge bg-primary">€{{ number_format($ticket->price, 2) }}</span>
                                </div>
                                <p class="small text-muted mb-2">{{ $ticket->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $ticket->remaining_quantity }} beschikbaar
                                    </small>
                                    <form action="{{ route('cart.add', $ticket) }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 120px;">
                                            <input type="number" class="form-control" name="quantity" 
                                                   value="1" min="1" max="{{ $ticket->remaining_quantity }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Er zijn momenteel geen tickets beschikbaar.
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Festivals -->
    @if($relatedFestivals->isNotEmpty())
    <div class="mt-5">
        <h2 class="h3 mb-4">Andere Festivals</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($relatedFestivals as $relatedFestival)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm festival-card">
                        @if($relatedFestival->image)
                            <img src="{{ asset('storage/' . $relatedFestival->image) }}" 
                                 class="card-img-top festival-image" 
                                 alt="{{ $relatedFestival->name }}">
                        @else
                            <div class="card-img-top festival-image-placeholder">
                                <i class="fas fa-music fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedFestival->name }}</h5>
                            <div class="d-flex align-items-center text-muted small mb-2">
                                <i class="fas fa-calendar me-2"></i>
                                {{ $relatedFestival->start_date->format('d M Y') }}
                            </div>
                            <p class="card-text text-primary mb-2">
                                Vanaf €{{ number_format($relatedFestival->base_price, 2) }}
                            </p>
                            <a href="{{ route('festivals.show', $relatedFestival) }}" 
                               class="btn btn-outline-primary w-100">
                                Bekijk Festival
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
    .festival-banner {
        max-height: 400px;
        overflow: hidden;
    }
    
    .festival-banner img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    
    .ticket-option {
        transition: transform 0.2s ease-in-out;
    }
    
    .ticket-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .festival-card {
        transition: transform 0.2s ease-in-out;
    }
    
    .festival-card:hover {
        transform: translateY(-5px);
    }
    
    .festival-image {
        height: 200px;
        object-fit: cover;
    }
    
    .festival-image-placeholder {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
</style>
@endpush
@endsection 