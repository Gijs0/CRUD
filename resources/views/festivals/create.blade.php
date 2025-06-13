@extends('layouts.app')

@section('title', 'Nieuw Festival')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Nieuw Festival</h1>
                        <a href="{{ route('festivals.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Terug naar Festivals
                        </a>
                    </div>

                    <form action="{{ route('festivals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <!-- Naam -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Festivalnaam</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Locatie -->
                            <div class="col-md-6">
                                <label for="location" class="form-label">Locatie</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Start Datum -->
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Datum</label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Eind Datum -->
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Eind Datum</label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date') }}" required>
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
                                           id="base_price" name="base_price" value="{{ old('base_price') }}" required>
                                </div>
                                @error('base_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Capaciteit -->
                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capaciteit</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" name="capacity" value="{{ old('capacity') }}" required>
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Festival Afbeelding -->
                            <div class="col-12">
                                <label for="image" class="form-label">Festival Afbeelding</label>
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
                                          id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Festival Opslaan
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