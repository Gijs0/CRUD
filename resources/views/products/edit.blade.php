@extends('layouts.app')

@section('title', 'Product Bewerken')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Product Bewerken</h1>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Terug naar Product
                        </a>
                    </div>

                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Naam -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Productnaam</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div class="col-md-6">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Categorie -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Categorie</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Selecteer een categorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Prijs -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Prijs</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Voorraad -->
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Voorraad</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Maat -->
                            <div class="col-md-6">
                                <label for="size" class="form-label">Maat</label>
                                <select class="form-select @error('size') is-invalid @enderror" 
                                        id="size" name="size" required>
                                    <option value="">Selecteer een maat</option>
                                    <option value="XS" {{ old('size', $product->size) == 'XS' ? 'selected' : '' }}>XS</option>
                                    <option value="S" {{ old('size', $product->size) == 'S' ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ old('size', $product->size) == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="L" {{ old('size', $product->size) == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="XL" {{ old('size', $product->size) == 'XL' ? 'selected' : '' }}>XL</option>
                                    <option value="XXL" {{ old('size', $product->size) == 'XXL' ? 'selected' : '' }}>XXL</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kleur -->
                            <div class="col-md-6">
                                <label for="color" class="form-label">Kleur</label>
                                <select class="form-select @error('color') is-invalid @enderror" 
                                        id="color" name="color" required>
                                    <option value="">Selecteer een kleur</option>
                                    <option value="Zwart" {{ old('color', $product->color) == 'Zwart' ? 'selected' : '' }}>Zwart</option>
                                    <option value="Wit" {{ old('color', $product->color) == 'Wit' ? 'selected' : '' }}>Wit</option>
                                    <option value="Rood" {{ old('color', $product->color) == 'Rood' ? 'selected' : '' }}>Rood</option>
                                    <option value="Blauw" {{ old('color', $product->color) == 'Blauw' ? 'selected' : '' }}>Blauw</option>
                                    <option value="Groen" {{ old('color', $product->color) == 'Groen' ? 'selected' : '' }}>Groen</option>
                                    <option value="Geel" {{ old('color', $product->color) == 'Geel' ? 'selected' : '' }}>Geel</option>
                                    <option value="Paars" {{ old('color', $product->color) == 'Paars' ? 'selected' : '' }}>Paars</option>
                                    <option value="Oranje" {{ old('color', $product->color) == 'Oranje' ? 'selected' : '' }}>Oranje</option>
                                    <option value="Grijs" {{ old('color', $product->color) == 'Grijs' ? 'selected' : '' }}>Grijs</option>
                                </select>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Afbeelding -->
                            <div class="col-12">
                                <label for="image" class="form-label">Productafbeelding</label>
                                @if($product->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="Huidige afbeelding" 
                                             class="img-thumbnail" 
                                             style="max-height: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <div class="form-text">Laat leeg om de huidige afbeelding te behouden. Maximaal 2MB. Toegestane formaten: JPG, PNG, GIF</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Beschrijving -->
                            <div class="col-12">
                                <label for="description" class="form-label">Beschrijving</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Wijzigingen Opslaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 