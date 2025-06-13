{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Producten')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Onze Producten</h1>
            <p class="lead text-muted">Ontdek onze collectie van hoogwaardige kledingstukken</p>
        </div>
        @can('create', App\Models\Product::class)
        <div class="col-md-4 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Nieuw Product
            </a>
        </div>
        @endcan
    </div>

    <!-- Filters Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Zoeken</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Zoek op naam of beschrijving...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="category" class="form-label">Categorie</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Alle categorieën</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="sort" class="form-label">Sorteren</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Nieuwste</option>
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

    <!-- Products Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($products as $product)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm product-card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="card-img-top product-image" 
                             alt="{{ $product->name }}">
                    @else
                        <div class="card-img-top product-image-placeholder">
                            <i class="fas fa-tshirt fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $product->name }}</h5>
                            <span class="badge bg-primary">{{ $product->category->name }}</span>
                        </div>
                        
                        <p class="card-text text-muted small mb-3">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="h5 mb-0">€{{ number_format($product->price, 2) }}</span>
                                <small class="text-muted d-block">Voorraad: {{ $product->stock }}</small>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('update', $product)
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('delete', $product)
                                <form action="{{ route('products.destroy', $product) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
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
                    Geen producten gevonden die voldoen aan je zoekcriteria.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>

@push('styles')
<style>
    .product-card {
        transition: transform 0.2s ease-in-out;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
    
    .product-image {
        height: 200px;
        object-fit: cover;
    }
    
    .product-image-placeholder {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
</style>
@endpush
@endsection