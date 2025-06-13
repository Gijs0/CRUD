@extends('layouts.app')

@section('title', 'Festival Bewerken')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Festival Bewerken</h1>
                        <a href="{{ route('festivals.show', $festival) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Terug naar Festival
                        </a>
                    </div>

                    <form action="{{ route('festivals.update', $festival) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Naam -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Festivalnaam</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $festival->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Locatie -->
                            <div class="col-md-6">
                                <label for="location" class="form-label">Locatie</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location', $festival->location) }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Start Datum -->
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Datum</label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" 
                                       value="{{ old('start_date', $festival->start_date->format('Y-m-d\TH:i')) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Eind Datum -->
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Eind Datum</label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" 
                                       value="{{ old('end_date', $festival->end_date->format('Y-m-d\TH:i')) }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Basis Prijs -->
                            <div class="col-md-6">
                                <label for="base_price" class="form-label">Basis Prijs</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" step="0.01" class="form-control @error('base_price') is-invalid @enderror" 
                                           id="base_price" name="base_price" value="{{ old('base_price', $festival->base_price) }}" required>
                                </div>
                                @error('base_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Capaciteit -->
                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capaciteit</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" name="capacity" value="{{ old('capacity', $festival->capacity) }}" required>
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Festival Afbeelding -->
                            <div class="col-12">
                                <label for="image" class="form-label">Festival Afbeelding</label>
                                @if($festival->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" 
                                             class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <div class="form-text">Maximaal 2MB. Toegestane formaten: JPG, PNG, GIF</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Banner Afbeelding -->
                            <div class="col-12">
                                <label for="banner_image" class="form-label">Banner Afbeelding</label>
                                @if($festival->banner_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $festival->banner_image) }}" alt="{{ $festival->name }} Banner" 
                                             class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('banner_image') is-invalid @enderror" 
                                       id="banner_image" name="banner_image" accept="image/*">
                                <div class="form-text">Maximaal 2MB. Toegestane formaten: JPG, PNG, GIF</div>
                                @error('banner_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Beschrijving -->
                            <div class="col-12">
                                <label for="description" class="form-label">Beschrijving</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="5" required>{{ old('description', $festival->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           value="1" {{ old('is_active', $festival->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Festival is actief</label>
                                </div>
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