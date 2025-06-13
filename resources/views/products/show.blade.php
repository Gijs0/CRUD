@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Producten</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="img-fluid rounded" 
                             alt="{{ $product->name }}">
                    @else
                        <div class="product-image-placeholder rounded">
                            <i class="fas fa-tshirt fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="h2 mb-0">{{ $product->name }}</h1>
                        <span class="badge bg-primary">{{ $product->category->name }}</span>
                    </div>

                    <div class="mb-4">
                        <h2 class="h3 text-primary mb-0">€{{ number_format($product->price, 2) }}</h2>
                        <small class="text-muted">Inclusief BTW</small>
                    </div>

                    <div class="mb-4">
                        <h3 class="h5 mb-3">Product Details</h3>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-ruler me-2 text-muted"></i>
                                    <span>Maat: {{ $product->size }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-palette me-2 text-muted"></i>
                                    <span>Kleur: {{ $product->color }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-box me-2 text-muted"></i>
                                    <span>SKU: {{ $product->sku }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-warehouse me-2 text-muted"></i>
                                    <span>Voorraad: {{ $product->stock }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3 class="h5 mb-3">Beschrijving</h3>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="quantity" class="form-label">Aantal</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" 
                                           value="1" min="1" max="{{ $product->stock }}">
                                </div>
                                <div class="col-md-8 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>In Winkelwagen
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Dit product is momenteel niet op voorraad.
                        </div>
                    @endif

                    @can('update', $product)
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Bewerken
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
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
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
    <div class="mt-5">
        <h2 class="h3 mb-4">Gerelateerde Producten</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        @if($relatedProduct->image)
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" 
                                 class="card-img-top product-image" 
                                 alt="{{ $relatedProduct->name }}">
                        @else
                            <div class="card-img-top product-image-placeholder">
                                <i class="fas fa-tshirt fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-primary mb-2">€{{ number_format($relatedProduct->price, 2) }}</p>
                            <a href="{{ route('products.show', $relatedProduct) }}" class="btn btn-outline-primary w-100">
                                Bekijk Product
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
    .product-image-placeholder {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
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
</style>
@endpush
@endsection 