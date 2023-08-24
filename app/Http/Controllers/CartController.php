<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\Order as NotificationsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cart');
    }



    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                "product_name" => $product->product_name,
                "price" => $product->total_price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }



    public function update_cart(Request $request)
    {
        // {_token: 'jviaqQ746p9hPwtMyJ2eZekL4r41wc3djXKkI5HD', id: '1', quantity: '5'}
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
        return redirect()->back();
    }

    public function remove_from_cart($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back();
    }




    public function checkout()
    {
        return view('checkout');
    }
    public function checkout_store(StoreOrder $request)
    {
        $products = session()->get('cart');
        Order::create([
            "user_id" => auth()->user()->id,
            "address" => $request->address,
            "phone" => $request->phone,
            "notes" => $request->notes,
            "products" => $products,
            "total_price" => $request->total_price,
        ]);
        Notification::send(auth()->user(), new NotificationsOrder($products, $request->total_price));
        session()->put('cart', []);
        return redirect()->route('cart')->with('order', 'Order Susseccfuly');
    }
}
