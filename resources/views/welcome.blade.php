@extends('layouts.app')

@section('title', 'Festival Tickets')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative">
    <div class="hero-content text-center text-white py-5">
        <h1 class="display-4 fw-bold mb-4">Ontdek de Beste Festivals</h1>
        <p class="lead mb-4">Koop tickets voor de meest geweldige festivals van het seizoen</p>
        <a href="{{ route('festivals.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-ticket-alt me-2"></i>Bekijk Festivals
        </a>
    </div>
</div>

<!-- Featured Festivals -->
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="h3 mb-0">Aankomende Festivals</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('festivals.index') }}" class="btn btn-outline-primary">
                Bekijk Alle Festivals
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    <div class="row g-4">
        @foreach($upcomingFestivals as $festival)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($festival->image)
                        <img src="{{ asset('storage/' . $festival->image) }}" 
                             class="card-img-top" alt="{{ $festival->name }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-music fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $festival->name }}</h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $festival->location }}<br>
                            <i class="fas fa-calendar me-2"></i>{{ $festival->start_date->format('d M Y') }} - 
                            {{ $festival->end_date->format('d M Y') }}
                        </p>
                        <p class="card-text">{{ Str::limit($festival->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">Vanaf €{{ number_format($festival->base_price, 2) }}</span>
                            <a href="{{ route('festivals.show', $festival) }}" class="btn btn-primary">
                                <i class="fas fa-ticket-alt me-2"></i>Tickets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Features Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-ticket-alt fa-3x text-primary mb-3"></i>
                    <h3 class="h5">Makkelijk Tickets Kopen</h3>
                    <p class="text-muted">Koop je tickets snel en veilig online</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h3 class="h5">100% Veilig</h3>
                    <p class="text-muted">Veilige betaling en gegarandeerde tickets</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                    <h3 class="h5">24/7 Support</h3>
                    <p class="text-muted">We staan altijd voor je klaar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="h3 mb-4">Blijf op de Hoogte</h2>
            <p class="text-muted mb-4">Schrijf je in voor onze nieuwsbrief en mis geen enkel festival!</p>
            <form class="row g-3 justify-content-center">
                <div class="col-md-8">
                    <input type="email" class="form-control form-control-lg" placeholder="Je e-mailadres">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Inschrijven</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                url('/images/hero-bg.jpg') center/cover no-repeat;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
}

.hero-content {
    max-width: 800px;
    padding: 0 1rem;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    border-top-left-radius: 0.375rem;
    border-top-right-radius: 0.375rem;
}
</style>
@endpush
@endsection
