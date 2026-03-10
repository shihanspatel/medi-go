<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Razorpay\Api\Api;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

    public function verify(Request $request)
    {
        $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        try {
            $this->api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ]);

            $order->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'payment_status' => 'completed',
                'status' => 'confirmed'
            ]);

            // Clear cart after successful payment
            Cart::where('user_id', auth()->id())->delete();

            return response()->json(['success' => true, 'message' => 'Payment successful']);
        } catch (\Exception $e) {
            $order->update(['payment_status' => 'failed']);
            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 400);
        }
    }
}
