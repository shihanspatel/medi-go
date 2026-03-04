@extends('master_nav')

@section('title','Search Results')

@section('content')

<div class="container py-5">

    <h3 class="fw-bold mb-4">
        Search Results for "{{ $search }}"
    </h3>

    <div class="row g-4">

        @forelse($products as $product)

        <div class="col-md-3">

            <div class="card p-3">

                <img src="{{ asset('uploads/products/'.$product->image) }}"
                    class="img-fluid mb-3">

                <h6 class="fw-bold">
                    {{ $product->name }}
                </h6>

                <p class="text-success fw-bold">
                    ₹{{ $product->price }}
                </p>

                <a href="{{ route('product.show',$product->id) }}"
                    class="btn btn-success btn-sm">

                    View Product

                </a>

            </div>

        </div>

        @empty

        <div class="col-12 text-center">

            <h5>No medicines found</h5>

        </div>

        @endforelse

    </div>

</div>

@endsection