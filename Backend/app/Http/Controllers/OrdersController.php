<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Http\Resources\OrdersResource;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderItems.book', 'payments','shipping'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return OrdersResource::collection($orders);
    }

    public function store(OrdersRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        $items = $validated['items'];
        $shipping = $validated['shipping'];
        $paymentMethod = $validated['payment_method'];
        $totalAmount = $validated['total_amount'];

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $user->id,
                'OrderDate' => now(),
                'Status' => 'Függőben',
                'TotalAmount' => $totalAmount,
                'reference_id' => $request->reference_id
            ]);

            Shipping::create([
                'order_id' => $order->id,
                'name' => $shipping['name'],
                'email' => $shipping['email'],
                'phone' => $shipping['phone'],
                'address' => $shipping['address'],
                'method' => $shipping['method'],
                'fee' => $shipping['fee']
            ]);

            $paymentMethodId = PaymentMethod::where('MethodName', $paymentMethod)->first()->id;
            Payment::create([
                'order_id' => $order->id,
                'paymentmethod_id' => $paymentMethodId,
                'PaymentDate' => now()
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item['book_id'],
                    'Quantity' => $item['quantity'],
                    'UnitPrice' => $item['price'],
                    'BooksTotalPrice'=> $item['quantity'] * $item['price']
                ]);
            }

            DB::commit();

            $paymentMethodObj = PaymentMethod::where('MethodName', $paymentMethod)->first();
            $firstBook = \App\Models\Book::find($items[0]['book_id']);
            $orderItems = OrderItem::where('order_id', $order->id)->with('book')->get();

            try {
                Mail::to($shipping['email'])->send(new OrderMail(
                    $user,
                    $order,
                    $orderItems,
                    $paymentMethodObj,
                    (object) $shipping,
                    $firstBook
                ));
            } catch (\Exception $e) {
                return response()->json(['error' => 'Hiba történt az e-mail küldésekor: ' . $e->getMessage()], 500);
            }

            return response()->json([
                'success' => true,
                'order_id' => $request->reference_id ?? $order->id,
                'message' => 'A rendelés sikeresen feldolgozva',
                'order' => new OrdersResource($order->load(['orderItems.book', 'payments', 'shipping']))
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Hiba történt a rendelés feldolgozásakor: ' . $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $order = Order::with(['orderItems.book', 'payments', 'shipping'])->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return new OrdersResource($order);
    }

    public function update(OrdersRequest $request, string $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->update($request->validated());
        return new OrdersResource($order);
    }

    public function destroy(string $id)
    {
        $items = OrderItem::find($id);
        if (!$items) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $items->delete();
        return response()->json(['message' => 'A kosár tartalma sikeresen törölve']);
    }
}
