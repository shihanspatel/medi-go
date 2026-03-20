<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    
    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
        }

        foreach ($cartItems as $item) {
            if (!$item->product || !$item->product->price) {
                return response()->json(['success' => false, 'message' => 'Product price not found'], 400);
            }
        }

        DB::beginTransaction();

        try {

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            if ($total <= 0) {
                throw new \Exception('Invalid total amount');
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'Pending',
                'payment_status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            DB::commit();

            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $razorpayOrder = $api->order->create([
                'amount' => $order->total_amount * 100,
                'currency' => 'INR',
                'receipt' => 'order_' . $order->id,
            ]);

            $order->update([
                'razorpay_order_id' => $razorpayOrder['id'],
                'payment_status' => 'initiated'
            ]);

            return response()->json([
                'success' => true,
                'razorpay_order_id' => $razorpayOrder['id'],
                'order_id' => $order->id,
                'amount' => $order->total_amount * 100,
                'key' => env('RAZORPAY_KEY_ID')
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Checkout Error: ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
            return response()->json([
                'success' => false, 
                'message' => 'Error creating order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }
}
