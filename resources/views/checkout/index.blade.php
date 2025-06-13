@extends('layouts.app')

@section('title', 'Afrekenen')

@section('content')
<div class="container">
    <h1 class="display-4 mb-4">Afrekenen</h1>

    @if(empty(session('cart')))
        <div class="alert alert-warning">
            Je winkelwagen is leeg. <a href="{{ route('cart.index') }}">Terug naar winkelwagen</a>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Verzendgegevens</h5>
                        <form action="{{ route('cart.index') }}" method="GET" id="checkout-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="customer_name" class="form-label">Naam</label>
                                    <input type="text" class="form-control" 
                                           id="customer_name" name="customer_name" value="{{ auth()->user()->name ?? '' }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="customer_email" class="form-label">E-mailadres</label>
                                    <input type="email" class="form-control" 
                                           id="customer_email" name="customer_email" value="{{ auth()->user()->email ?? '' }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="customer_phone" class="form-label">Telefoonnummer</label>
                                    <input type="tel" class="form-control" 
                                           id="customer_phone" name="customer_phone" required>
                                </div>

                                <div class="col-12">
                                    <label for="shipping_address" class="form-label">Verzendadres</label>
                                    <textarea class="form-control" 
                                              id="shipping_address" name="shipping_address" rows="3" required></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="notes" class="form-label">Opmerkingen (optioneel)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
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
                                    @foreach(session('cart', []) as $id => $details)
                                        @if(is_array($details))
                                            @php
                                                $subtotal = floatval($details['price']) * intval($details['quantity']);
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $details['name'] }} x {{ $details['quantity'] }}
                                                </td>
                                                <td class="text-end">€{{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                        @endif
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

                        <button type="button" class="btn btn-primary w-100">
                            <i class="fas fa-credit-card me-2"></i>Betalen
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
    @endif
</div>

@push('scripts')
<script>
function placeOrder() {
    // Show success message
    Swal.fire({
        title: 'Bestelling Succesvol!',
        text: 'Je bestelling is succesvol geplaatst. Je tickets zijn verzonden naar je e-mailadres.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Clear cart and redirect to home
            window.location.href = "{{ route('cart.index') }}";
        }
    });
}
</script>
@endpush
@endsection 