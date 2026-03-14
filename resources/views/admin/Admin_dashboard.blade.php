@extends('admin.master_admin')

@section('title','Admin Dashboard')
@section('page-title','Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <small class="text-muted">Users</small>
            <h2 class="fw-bold">{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <small class="text-muted">Orders</small>
            <h2 class="fw-bold">{{ $totalOrders }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <small class="text-muted">Products</small>
            <h2 class="fw-bold">{{ $totalProducts }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <small class="text-muted">Revenue</small>
            <h2 class="fw-bold">₹{{ number_format($totalRevenue, 2) }}</h2>
        </div>
    </div>
</div>
@endsection
