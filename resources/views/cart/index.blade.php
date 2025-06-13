@extends('layouts.app')

@section('title', 'Winkelwagen')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Winkelwagen</h1>
                        @if(count($items) > 0)
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash me-2"></i>Winkelwagen leegmaken
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(count($items) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ticket</th>
                                        <th class="text-center">Aantal</th>
                                        <th class="text-end">Prijs</th>
                                        <th class="text-end">Subtotaal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group input-group-sm" style="width: 120px; margin: 0 auto;">
                                                        <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(this, -1)">-</button>
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                               class="form-control text-center" min="0" max="99" 
                                                               onchange="this.form.submit()">
                                                        <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(this, 1)">+</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-end">€{{ number_format($item['price'], 2) }}</td>
                                            <td class="text-end">€{{ number_format($item['subtotal'], 2) }}</td>
                                            <td class="text-end">
                                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h3>Je winkelwagen is leeg</h3>
                            <p class="text-muted">Bekijk onze festivals en koop tickets!</p>
                            <a href="{{ route('festivals.index') }}" class="btn btn-primary">
                                <i class="fas fa-ticket-alt me-2"></i>Festivals bekijken
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if(count($items) > 0)
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h4 mb-4">Bestelling</h2>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotaal</span>
                            <span>€{{ number_format($total, 2) }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>BTW (21%)</span>
                            <span>€{{ number_format($total * 0.21, 2) }}</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Totaal</strong>
                            <strong>€{{ number_format($total * 1.21, 2) }}</strong>
                        </div>

                        <a href="{{ route('orders.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-credit-card me-2"></i>Afrekenen
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function updateQuantity(button, change) {
    const input = button.parentElement.querySelector('input');
    const newValue = parseInt(input.value) + change;
    if (newValue >= 0 && newValue <= 99) {
        input.value = newValue;
        input.form.submit();
    }
}
</script>
@endpush
@endsection 