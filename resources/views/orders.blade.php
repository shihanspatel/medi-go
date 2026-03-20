@extends('master_nav')

@section('title', 'My Orders - Medi-Go')

@section('styles')
<style>
    .page-header-bg {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 40px 0;
        margin-bottom: 40px;
        color: white;
    }

    .page-header-bg h2 {
        color: white;
        margin: 0;
    }

    .order-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
        padding: 25px;
        margin-bottom: 25px;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .order-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border-color: #059669;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
    }

    .order-id {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
    }

    .order-date {
        color: #64748b;
        font-size: 0.9rem;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-confirmed {
        background: #d1fae5;
        color: #065f46;
    }

    .status-completed {
        background: #dbeafe;
        color: #0c4a6e;
    }

    .order-items {
        margin: 20px 0;
    }

    .order-item {
        display: flex;
        gap: 15px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 10px;
        margin-bottom: 12px;
        align-items: center;
    }

    .item-image {
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .item-image img {
        max-width: 60px;
        max-height: 60px;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: #111827;
        margin-bottom: 5px;
    }

    .item-qty {
        color: #64748b;
        font-size: 0.9rem;
    }

    .item-price {
        font-weight: 700;
        color: #059669;
        font-size: 1.1rem;
    }

    .order-summary {
        background: #f8fafc;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        color: #64748b;
    }

    .summary-row.total {
        border-top: 2px solid #e5e7eb;
        padding-top: 10px;
        margin-top: 10px;
        font-weight: 700;
        color: #111827;
        font-size: 1.1rem;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        border: 2px dashed #cbd5e1;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        color: #64748b;
        margin-bottom: 15px;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')

<div class="page-header-bg">
    <div class="container">
        <h2><i class="fas fa-box me-2"></i>My Orders</h2>
        <p class="mb-0 mt-2">Track and manage your orders</p>
    </div>
</div>

<div class="container pb-5">
    @if($orders->isEmpty())
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h4>No Orders Yet</h4>
        <p>You haven't placed any orders yet. Start shopping now!</p>
        <a href="{{ url('/') }}" class="btn btn-success rounded-pill">
            Continue Shopping
        </a>
    </div>
    @else
    @foreach($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-id">Order #{{ $order->id }}</div>
                <div class="order-date">
                    <i class="fas fa-calendar me-1"></i>{{ $order->created_at->format('d M Y, h:i A') }}
                </div>
            </div>
            <div class="text-end">
                <span class="status-badge status-{{ strtolower($order->payment_status) }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        <div class="order-items">
            @foreach($order->items as $item)
            <div class="order-item">
                <div class="item-image">
                    <img src="{{ asset('uploads/products/'.$item->product->image) }}"
                        alt="{{ $item->product->name }}">
                </div>
                <div class="item-details">
                    <div class="item-name">{{ $item->product->name }}</div>
                    <div class="item-qty">Qty: {{ $item->quantity }}</div>
                </div>
                <div class="item-price">
                    ₹{{ number_format($item->price * $item->quantity, 2) }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="order-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹{{ number_format($order->total_amount * 0.95, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>Tax (5%)</span>
                <span>₹{{ number_format($order->total_amount * 0.05, 2) }}</span>
            </div>
            <div class="summary-row total">
                <span>Total Amount</span>
                <span>₹{{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>

@endsection