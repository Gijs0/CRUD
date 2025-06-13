@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container">
    <h1 class="mb-4">Orders</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            {{ $order->customer_name }}<br>
                            <small class="text-muted">{{ $order->customer_email }}</small>
                        </td>
                        <td>€{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : 
                                ($order->status === 'processing' ? 'info' : 
                                ($order->status === 'shipped' ? 'primary' : 
                                ($order->status === 'delivered' ? 'success' : 'danger'))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" 
                               class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection 