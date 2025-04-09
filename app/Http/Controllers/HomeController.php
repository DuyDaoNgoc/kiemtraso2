<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 4 sản phẩm đầu tiên
        $products = Product::take(4)->get();

        // Trả về view 'home' với dữ liệu sản phẩm
        return view('home', compact('products'));
    }
}
