<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // 🛒 Hiển thị trang thanh toán
    public function checkout()
    {
        // Lấy giỏ hàng từ session (nếu có)
        $productCarts = Session::get('cart', []);
        $totalPrice = 0;

        // Tính tổng tiền giỏ hàng
        foreach ($productCarts as $product) {
            $price = ($product['item']['promotion_price'] == 0) ? $product['item']['unit_price'] : $product['item']['promotion_price'];
            $totalPrice += $price * $product['qty'];
        }

        // Truyền dữ liệu vào view
        return view('checkout', compact('productCarts', 'totalPrice'));
    }

    // 🏷️ Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        // Truy vấn sản phẩm với thông tin loại sản phẩm
        $product = Product::join('type_products as t', 'products.id_type', '=', 't.id') 
            ->select('products.*', 't.name as type_name', 't.description as type_description', 't.image as type_image')
            ->where('products.id', $id)
            ->first();

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại!');
        }

        // Trả về view sản phẩm chi tiết
        return view('products.show', compact('product')); // Đúng tên file Blade
    }
    
}
