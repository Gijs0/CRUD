@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative mb-5">
    <div class="hero-bg" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); background-size: cover; background-position: center; height: 500px;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-8 text-white">
                    <h1 class="display-3 fw-bold mb-4">Ontdek Onze Nieuwe Collectie</h1>
                    <p class="lead mb-4">De nieuwste trends in kleding voor elk seizoen. Ontdek onze exclusieve collectie en vind jouw perfecte stijl.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Shop Nu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="container mb-5">
    <h2 class="text-center mb-4">Shop per Categorie</h2>
    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-md-4">
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 category-card">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-tshirt fa-3x text-primary mb-3"></i>
                            <h3 class="h4 mb-0">{{ $category->name }}</h3>
                            <p class="text-muted mb-0">{{ $category->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Featured Products Section -->
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Uitgelichte Producten</h2>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
            Bekijk Alle Producten
            <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach($featuredProducts as $product)
            <div class="col">
                <div class="card h-100 product-card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-tshirt fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $product->name }}</h5>
                            <span class="category-badge">{{ $product->category->name }}</span>
                        </div>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-tag">€{{ number_format($product->price, 2) }}</span>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock > 0 ? 'Op voorraad' : 'Uitverkocht' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-grid">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>Bekijk Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Features Section -->
<div class="bg-light py-5 mb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                    <h4>Gratis Verzending</h4>
                    <p class="text-muted mb-0">Bij bestellingen boven €50</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <i class="fas fa-undo fa-3x text-primary mb-3"></i>
                    <h4>30 Dagen Retour</h4>
                    <p class="text-muted mb-0">Gratis retourneren</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                    <h4>Veilig Betalen</h4>
                    <p class="text-muted mb-0">100% beveiligd</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                    <h4>24/7 Support</h4>
                    <p class="text-muted mb-0">Altijd bereikbaar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="container mb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5 text-center">
            <h3 class="mb-4">Blijf op de hoogte van onze nieuwste collecties</h3>
            <p class="text-muted mb-4">Schrijf je in voor onze nieuwsbrief en ontvang 10% korting op je eerste aankoop</p>
            <form class="row g-3 justify-content-center">
                <div class="col-md-6">
                    <input type="email" class="form-control form-control-lg" placeholder="Jouw e-mailadres">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Inschrijven
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.hero-section {
    margin-top: -1.5rem;
    margin-bottom: 3rem;
}

.category-card {
    transition: transform 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
}

.product-card {
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-card .card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
@endpush
