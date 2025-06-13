@extends('layouts.app')

@section('title', 'Over Ons')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative mb-5">
    <div class="hero-bg" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); background-size: cover; background-position: center; height: 400px;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-8 text-white">
                    <h1 class="display-3 fw-bold mb-4">Over Ons</h1>
                    <p class="lead">Ontdek het verhaal achter onze passie voor festivals en muziek.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Story Section -->
<div class="container mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 alt="Ons Verhaal" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="mb-4">Ons Verhaal</h2>
            <p class="lead text-muted mb-4">
                Sinds 2010 zijn wij gepassioneerd over het creëren van onvergetelijke festival ervaringen. 
                Onze missie is om de beste festival outfits te combineren met comfort en stijl.
            </p>
            <p class="text-muted">
                We geloven dat iedereen recht heeft op unieke festival kleding die niet alleen 
                er geweldig uitziet, maar ook comfortabel is tijdens lange festival dagen. 
                Daarom selecteren we zorgvuldig onze materialen en werken we samen met 
                creatieve ontwerpers die onze festival spirit delen.
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
                        <i class="fas fa-music fa-3x text-primary mb-3"></i>
                        <h4>Festival Spirit</h4>
                        <p class="text-muted mb-0">
                            We leven voor de festival cultuur en brengen die energie 
                            in elk kledingstuk dat we maken.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-tshirt fa-3x text-success mb-3"></i>
                        <h4>Comfort & Stijl</h4>
                        <p class="text-muted mb-0">
                            Onze kleding combineert festival fashion met het comfort 
                            dat je nodig hebt voor dagenlang dansen.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-star fa-3x text-warning mb-3"></i>
                        <h4>Uniciteit</h4>
                        <p class="text-muted mb-0">
                            We creëren unieke stukken die je laten stralen op elk festival, 
                            van dance tot rock en alles daartussenin.
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
                <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     class="card-img-top" alt="Team Member">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Lisa van der Meer</h5>
                    <p class="text-muted mb-3">Festival Fashion Director</p>
                    <p class="card-text text-muted">
                        Met meer dan 15 jaar ervaring in festival fashion, 
                        leidt Lisa ons team met creativiteit en passie.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     class="card-img-top" alt="Team Member">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">David Martinez</h5>
                    <p class="text-muted mb-3">Creative Designer</p>
                    <p class="card-text text-muted">
                        David brengt zijn festival ervaring en creativiteit 
                        in elk ontwerp dat we maken.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     class="card-img-top" alt="Team Member">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Sophie Anderson</h5>
                    <p class="text-muted mb-3">Festival Experience Manager</p>
                    <p class="card-text text-muted">
                        Sophie zorgt ervoor dat onze kleding perfect past bij 
                        de festival ervaring van onze klanten.
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
                    Heb je vragen over onze festival collectie of wil je meer weten? 
                    We staan altijd klaar om je te helpen met je festival outfit!
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="mailto:info@festivalfashion.nl" class="btn btn-primary">
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

.btn-primary {
    background-color: #ff6b6b;
    border-color: #ff6b6b;
}

.btn-primary:hover {
    background-color: #ff5252;
    border-color: #ff5252;
}

.btn-outline-primary {
    color: #ff6b6b;
    border-color: #ff6b6b;
}

.btn-outline-primary:hover {
    background-color: #ff6b6b;
    border-color: #ff6b6b;
}
</style>
@endpush 