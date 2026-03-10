@extends('master_nav')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Complete Payment</h4>
                </div>
                <div class="card-body">
                    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                    <p><strong>Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    
                    <form id="paymentForm" method="POST" action="{{ route('payment.verify') }}">
                        @csrf
                        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                        
                        <button type="button" id="rzp-button1" class="btn btn-primary btn-block w-100">
                            Pay ₹{{ number_format($order->total_amount, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('rzp-button1').onclick = function(e) {
        var options = {
            "key": "{{ $key }}",
            "amount": {{ $order->total_amount * 100 }},
            "currency": "INR",
            "name": "Medi-Go",
            "order_id": "{{ $razorpayOrder['id'] }}",
            "handler": function(response) {
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('paymentForm').submit();
            },
            "prefill": {
                "name": "{{ auth()->user()->name }}",
                "email": "{{ auth()->user()->email }}"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
    }
</script>
@endsection
