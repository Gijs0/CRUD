@extends('layouts.app')

@section('title', 'Afrekenen')

@section('content')
<div class="container">
    <h1 class="display-4 mb-4">Afrekenen</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Verzendgegevens</h5>
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">Naam</label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                       id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="customer_email" class="form-label">E-mailadres</label>
                                <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                                       id="customer_email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label">Telefoonnummer</label>
                                <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" 
                                       id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="shipping_address" class="form-label">Verzendadres</label>
                                <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                          id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="notes" class="form-label">Opmerkingen (optioneel)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Betaalmethode</h5>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="ideal" value="ideal" checked>
                        <label class="form-check-label" for="ideal">
                            <i class="fab fa-ideal me-2"></i>iDEAL
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="creditcard" value="creditcard">
                        <label class="form-check-label" for="creditcard">
                            <i class="fas fa-credit-card me-2"></i>Creditcard
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                        <label class="form-check-label" for="paypal">
                            <i class="fab fa-paypal me-2"></i>PayPal
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Bestelling Samenvatting</h5>
                    
                    <div class="table-responsive mb-4">
                        <table class="table table-sm">
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php
                                        $subtotal = $details['price'] * $details['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $details['name'] }} x {{ $details['quantity'] }}
                                            <br>
                                            <small class="text-muted">
                                                {{ $details['size'] }} | {{ $details['color'] }}
                                            </small>
                                        </td>
                                        <td class="text-end">€{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotaal</span>
                        <span>€{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Verzendkosten</span>
                        <span>Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Totaal</strong>
                        <strong class="text-primary">€{{ number_format($total, 2) }}</strong>
                    </div>

                    <button type="submit" form="checkout-form" class="btn btn-primary w-100">
                        <i class="fas fa-lock me-2"></i>Bestelling Plaatsen
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{ route('cart.index') }}" class="text-muted">
                            <i class="fas fa-arrow-left me-1"></i>Terug naar Winkelwagen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 