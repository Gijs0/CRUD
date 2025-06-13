@extends('layouts.app')

@section('title', 'Festivals')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Upcoming Festivals</h1>
            <p class="lead text-muted">Ontdek de beste festivals van dit seizoen</p>
        </div>
        @can('create', App\Models\Festival::class)
        <div class="col-md-4 text-end">
            <a href="{{ route('festivals.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Nieuw Festival
            </a>
        </div>
        @endcan
    </div>

    <!-- Filters Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('festivals.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Zoeken</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Zoek op naam of locatie...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="month" class="form-label">Maand</label>
                    <select class="form-select" id="month" name="month">
                        <option value="">Alle maanden</option>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="sort" class="form-label">Sorteren</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Datum (eerste-laatste)</option>
                        <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Datum (laatste-eerste)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prijs (laag-hoog)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prijs (hoog-laag)</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Naam (A-Z)</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-2"></i>Filter Toepassen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Festivals Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($festivals as $festival)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm festival-card">
                    @if($festival->image)
                        <img src="{{ asset('storage/' . $festival->image) }}" 
                             class="card-img-top festival-image" 
                             alt="{{ $festival->name }}">
                    @else
                        <div class="card-img-top festival-image-placeholder">
                            <i class="fas fa-music fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $festival->name }}</h5>
                            <span class="badge bg-primary">{{ $festival->location }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center text-muted small mb-2">
                                <i class="fas fa-calendar me-2"></i>
                                {{ $festival->start_date->format('d M Y') }} - {{ $festival->end_date->format('d M Y') }}
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="fas fa-ticket-alt me-2"></i>
                                Vanaf €{{ number_format($festival->base_price, 2) }}
                            </div>
                        </div>
                        
                        <p class="card-text text-muted small mb-3">
                            {{ Str::limit($festival->description, 100) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-{{ $festival->is_sold_out ? 'danger' : 'success' }}">
                                    {{ $festival->is_sold_out ? 'Uitverkocht' : $festival->available_tickets . ' tickets beschikbaar' }}
                                </span>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('festivals.show', $festival) }}" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('update', $festival)
                                <a href="{{ route('festivals.edit', $festival) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('delete', $festival)
                                <form action="{{ route('festivals.destroy', $festival) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Weet je zeker dat je dit festival wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Geen festivals gevonden die voldoen aan je zoekcriteria.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $festivals->links() }}
    </div>
</div>

@push('styles')
<style>
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