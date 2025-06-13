@extends('layouts.app')

@section('title', 'Bestelling Plaatsen')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Bestelling Plaatsen</h1>

                    @if(empty($items))
                        <div class="alert alert-warning">
                            Er zijn geen items in je winkelwagen. <a href="{{ route('cart.index') }}">Terug naar winkelwagen</a>
                        </div>
                    @else
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">Naam</label>
                                <input type="text" class="form-control" 
                                       id="customer_name" name="customer_name" 
                                       value="{{ old('customer_name', auth()->user()->name ?? '') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="customer_email" class="form-label">E-mailadres</label>
                                <input type="email" class="form-control" 
                                       id="customer_email" name="customer_email" 
                                       value="{{ old('customer_email', auth()->user()->email ?? '') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label">Telefoonnummer</label>
                                <input type="tel" class="form-control" 
                                       id="customer_phone" name="customer_phone" 
                                       value="{{ old('customer_phone') }}">
                            </div>

                            <div class="col-12">
                                <label for="shipping_address" class="form-label">Adres</label>
                                <textarea class="form-control" 
                                          id="shipping_address" name="shipping_address" rows="3">{{ old('shipping_address') }}</textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h2 class="h4 mb-3">Bestelling Overzicht</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ticket</th>
                                        <th class="text-center">Aantal</th>
                                        <th class="text-end">Prijs</th>
                                        <th class="text-end">Subtotaal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($items as $item)
                                        @php
                                            $subtotal = floatval($item['price']) * intval($item['quantity']);
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td class="text-center">{{ $item['quantity'] }}</td>
                                            <td class="text-end">€{{ number_format($item['price'], 2) }}</td>
                                            <td class="text-end">€{{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Totaal</strong></td>
                                        <td class="text-end"><strong>€{{ number_format($total, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-arrow-left me-2"></i>Terug naar Winkelwagen
                            </a>
                            <form id="orderForm" action="{{ route('cart.clear') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <button type="button" class="btn btn-primary" onclick="showOrderConfirmation()">
                                <i class="fas fa-check me-2"></i>Betalen
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function showOrderConfirmation() {
    Swal.fire({
        title: 'Bestelling Verzonden!',
        text: 'Your order is send to your mail',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form to clear the cart
            document.getElementById('orderForm').submit();
        }
    });
}
</script>
@endpush 