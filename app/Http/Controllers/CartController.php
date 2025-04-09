<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        return view('shopping_cart');
    }

    public function reduce($id)
    {
        if (Session::has('cart')) {
            $cart = new Cart(Session::get('cart'));
            $cart->reduceByOne($id);
            Session::put('cart', $cart);
        }
        return redirect()->route('shopping_cart');
    }

    public function increase($id)
    {
        if (Session::has('cart')) {
            $cart = new Cart(Session::get('cart'));
            $cart->increase($id);
            Session::put('cart', $cart);
        }
        return redirect()->route('shopping_cart');
    }

    public function destroy($id)
    {
        if (Session::has('cart')) {
            $cart = new Cart(Session::get('cart'));
            $cart->removeItem($id);
            Session::put('cart', $cart);
        }
        return redirect()->route('cart');
    }
}
