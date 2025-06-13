@extends('layouts.app')

@section('title', 'Over Ons')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative mb-5">
    <div class="hero-bg" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); background-size: cover; background-position: center; height: 400px;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-8 text-white">
                    <h1 class="display-3 fw-bold mb-4">Over Ons</h1>
                    <p class="lead">Ontdek het verhaal achter onze passie voor mode en kwaliteit.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Story Section -->
<div class="container mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 alt="Ons Verhaal" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="mb-4">Ons Verhaal</h2>
            <p class="lead text-muted mb-4">
                Sinds 2010 zijn wij gepassioneerd over het leveren van hoogwaardige kleding voor iedereen. 
                Onze missie is om betaalbare mode te combineren met duurzaamheid en kwaliteit.
            </p>
            <p class="text-muted">
                We geloven dat iedereen recht heeft op stijlvolle kleding die lang meegaat. 
                Daarom selecteren we zorgvuldig onze materialen en werken we samen met 
                verantwoorde fabrikanten die onze waarden delen.
            </p>
        </div>
    </div>
</div>

<!-- Values Section -->
<div class="bg-light py-5 mb-5">
    <div class="container">
        <h2 class="text-center mb-5">Onze Waarden</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                        <h4>Duurzaamheid</h4>
                        <p class="text-muted mb-0">
                            We streven naar een duurzame toekomst door milieuvriendelijke 
                            materialen en productiemethoden te gebruiken.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                        <h4>Kwaliteit</h4>
                        <p class="text-muted mb-0">
                            We geloven in het leveren van de hoogste kwaliteit kleding 
                            die lang meegaat en er goed uitziet.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-handshake fa-3x text-primary mb-3"></i>
                        <h4>Eerlijkheid</h4>
                        <p class="text-muted mb-0">
                            We werken samen met partners die onze waarden delen en 
                            eerlijke arbeidsomstandigheden bieden.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="container mb-5">
    <h2 class="text-center mb-5">Ons Team</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     class="card-img-top" alt="Team Member">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Sarah Johnson</h5>
                    <p class="text-muted mb-3">CEO & Oprichter</p>
                    <p class="card-text text-muted">
                        Met meer dan 15 jaar ervaring in de mode-industrie, 
                        leidt Sarah ons bedrijf met passie en visie.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     class="card-img-top" alt="Team Member">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Michael Chen</h5>
                    <p class="text-muted mb-3">Creative Director</p>
                    <p class="card-text text-muted">
                        Michael brengt creativiteit en innovatie in elk aspect 
                        van onze collecties.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     class="card-img-top" alt="Team Member">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Emma Wilson</h5>
                    <p class="text-muted mb-3">Head of Sustainability</p>
                    <p class="card-text text-muted">
                        Emma zorgt ervoor dat we onze duurzaamheidsdoelen 
                        behalen en innoveren.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="mb-4">Neem Contact Op</h2>
                <p class="lead text-muted mb-4">
                    Heb je vragen of wil je meer weten over ons? 
                    We staan altijd klaar om je te helpen.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="mailto:info@kledingwinkel.nl" class="btn btn-primary">
                        <i class="fas fa-envelope me-2"></i>E-mail Ons
                    </a>
                    <a href="tel:+31201234567" class="btn btn-outline-primary">
                        <i class="fas fa-phone me-2"></i>Bel Ons
                    </a>
                </div>
            </div>
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

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    height: 300px;
    object-fit: cover;
}
</style>
@endpush 